<?php

namespace App\Http\Controllers\dosen_pembimbing\bimbingan;

use App\Http\Controllers\Controller;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekomendasiDosenController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Seminar::where(function ($q) use ($userId) {
            $q->where('dosen_penilai_1', $userId)
            ->orWhere('dosen_penilai_2', $userId);
        });

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('script_title', 'like', "%{$search}%");
            });
        }

        $seminars = $query->get();

        return view('dosen_pembimbing.rekomendasi.index', compact('seminars'));
    }


    public function store(Request $request, $id)
    {
        $userId = Auth::id();
        $seminar = Seminar::findOrFail($id);
        $dosenRekomendasi = null;

        if ($seminar->dosen_penilai_1 == $userId && $request->has('rekomendasi_1')) {
            $seminar->rekomendasi_dosen_1 = $request->input('rekomendasi_1');
            $dosenRekomendasi = "Dosen Pembimbing 1";
        }

        if ($seminar->dosen_penilai_2 == $userId && $request->has('rekomendasi_2')) {
            $seminar->rekomendasi_dosen_2 = $request->input('rekomendasi_2');
            $dosenRekomendasi = "Dosen Pembimbing 2";
        }

        $seminar->save();

        // Kirim notifikasi ke mahasiswa
        if ($seminar->mahasiswa) {
            $seminar->mahasiswa->notifications()->create([
                'title' => 'Rekomendasi Sidang Diberikan',
                'message' => "Anda telah mendapatkan rekomendasi sidang dari {$dosenRekomendasi}. 
                            Judul Skripsi: '{$seminar->script_title}'.",
                'read_at' => null,
            ]);
        }

        // Kirim notifikasi ke dosen pembimbing
        if ($dosenRekomendasi && $seminar->user) {
            $seminar->user->notifications()->create([
                'title' => 'Rekomendasi Sidang dari ' . $dosenRekomendasi,
                'message' => "{$dosenRekomendasi} telah memberikan rekomendasi sidang untuk mahasiswa: {$seminar->mahasiswa->username}. 
                            Judul Skripsi: '{$seminar->script_title}'.",
                'read_at' => null,
            ]);
        }

        return redirect()->back()->with('success', 'Rekomendasi berhasil diperbarui.');
    }

}