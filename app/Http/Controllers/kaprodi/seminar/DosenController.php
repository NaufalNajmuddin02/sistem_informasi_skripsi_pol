<?php

namespace App\Http\Controllers\kaprodi\seminar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Seminar;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dosenList = User::whereIn('role', ['dosen', 'dosen_penilai', 'kaprodi'])
            ->where('dosen_prodi', $user->dosen_prodi)
            ->get()
            ->map(function ($dosen) {
                $terpakai = Seminar::where('dosen_penilai_1', $dosen->id)
                    ->orWhere('dosen_penilai_2', $dosen->id)
                    ->count();
                $dosen->kapasitas_terpakai = $terpakai;
                return $dosen;
            });

        return view('kaprodi.seminar.index', compact('dosenList'));
    }

    
    // DosenController.php
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'selected_dosen' => 'required|array',
            'new_role' => 'nullable|in:dosen,dosen_penilai',
            'new_kapasitas' => 'nullable|integer|min:0',
        ]);

        // Pastikan setidaknya salah satu field diisi
        if (!$request->filled('new_role') && !$request->filled('new_kapasitas')) {
            return redirect()->back()->with('error', 'Silakan isi role baru atau kapasitas baru.');
        }

        foreach ($request->selected_dosen as $id) {
            $dosen = User::find($id);
            if (!$dosen) continue;

            if ($request->filled('new_role')) {
                if ($dosen->role === 'kaprodi') {
                    $roles = json_decode($dosen->additional_roles ?? '[]', true);
                    $roles[] = 'dosen_penilai';
                    $dosen->additional_roles = json_encode(array_unique($roles));
                } else {
                    $dosen->role = $request->new_role;
                }
            }

            if ($request->filled('new_kapasitas')) {
                $dosen->kapasitas_bimbingan = $request->new_kapasitas;
            }

            $dosen->save();
        }

        return redirect()->back()->with('success', 'Data dosen berhasil diperbarui.');
    }


    // public function updateRole(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:users,id',
    //         'role' => 'required|in:dosen,dosen_penilai',
    //     ]);

    //     $dosen = User::findOrFail($request->id);

    //     // Jika dosen memiliki role kaprodi, tambahkan peran dosen penilai tanpa mengubah role asli
    //     if ($dosen->role === 'kaprodi') {
    //         $dosen->additional_roles = json_encode(array_unique(array_merge(
    //             json_decode($dosen->additional_roles, true) ?? [],
    //             ['dosen_penilai']
    //         )));
    //     } else {
    //         $dosen->role = $request->role;
    //     }
    //     $dosen->save();

    //     return response()->json(['message' => 'Peran berhasil diperbarui!']);
    // }

    // public function updateKapasitas(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:users,id',
    //         'kapasitas_bimbingan' => 'required|integer|min:0',
    //     ]);

    //     $dosen = User::findOrFail($request->id);
    //     $dosen->kapasitas_bimbingan = $request->kapasitas_bimbingan;
    //     $dosen->save();

    //     return response()->json(['message' => 'Kapasitas berhasil diperbarui!']);
    // }

}

