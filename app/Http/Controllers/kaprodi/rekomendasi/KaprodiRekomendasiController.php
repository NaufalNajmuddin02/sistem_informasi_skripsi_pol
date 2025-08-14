<?php

namespace App\Http\Controllers\kaprodi\rekomendasi;

use App\Http\Controllers\Controller;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiRekomendasiController extends Controller
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

        return view('kaprodi.rekomendasi.index', compact('seminars'));
    }


    public function store(Request $request, $id)
    {
        $userId = Auth::id();
        $seminar = Seminar::findOrFail($id);

        if ($seminar->dosen_penilai_1 == $userId && $request->has('rekomendasi_1')) {
            $seminar->rekomendasi_dosen_1 = $request->input('rekomendasi_1');
        }

        if ($seminar->dosen_penilai_2 == $userId && $request->has('rekomendasi_2')) {
            $seminar->rekomendasi_dosen_2 = $request->input('rekomendasi_2');
        }

        $seminar->save();

        return redirect()->back()->with('success', 'Rekomendasi berhasil diperbarui.');
    }
}