<?php

namespace App\Http\Controllers\kaprodi\bimbingan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Seminar;
use App\Models\Bimbingan;
use Illuminate\Http\Request;

class BimbinganKaprodiController extends Controller
{
    public function index(Request $request)
    {
        $dosenId = Auth::user()->id;
        $search = $request->input('search');

        $seminars = Seminar::where(function ($query) use ($dosenId) {
            $query->where('dosen_penilai_1', $dosenId)
                ->orWhere('dosen_penilai_2', $dosenId);
        })
        ->where('status', 'Diterima')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('script_title', 'like', '%' . $search . '%');
            });
        })
        ->with(['bimbingan' => function ($query) {
            $query->latest();
        }])
        ->get();

        return view('kaprodi.bimbingan.index', compact('seminars', 'search'));
    }

    public function create($seminarId)
    {
        $seminar = Seminar::findOrFail($seminarId);
        $dosenId = Auth::id();

        // Tentukan nama dosen pembimbing berdasarkan dosen login
        if ($seminar->dosen_penilai_1 == $dosenId) {
            $namaDosen = $seminar->dosen_penilai_1_nama;
        } elseif ($seminar->dosen_penilai_2 == $dosenId) {
            $namaDosen = $seminar->dosen_penilai_2_nama;
        } else {
            abort(403, 'Anda tidak memiliki akses sebagai dosen pembimbing seminar ini.');
        }

        return view('kaprodi.bimbingan.create', compact('seminar', 'namaDosen'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'seminar_id' => 'required|exists:seminars,id',
            'nama_mahasiswa' => 'required|string',
            'nama_dosen' => 'required|string',
            'tanggal_bimbingan' => 'required|date',
            'pemeriksaan' => 'required|string|max:1000',
            'perbaikan' => 'required|string|max:1000',
        ]);

        Bimbingan::create([
            'seminar_id' => $request->seminar_id,
            'dosen_id' => Auth::id(),
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nama_dosen' => $request->nama_dosen,
            'tanggal_bimbingan' => $request->tanggal_bimbingan,
            'pemeriksaan' => $request->pemeriksaan,
            'perbaikan' => $request->perbaikan,
        ]);

        return redirect()->route('kaprodi.bimbingan.index')->with('success', 'Catatan bimbingan berhasil ditambahkan.');
    }

    public function rekap(Request $request)
    {
        $dosenId = Auth::id();
        $search = $request->input('search');

        $seminars = Seminar::where(function ($query) use ($dosenId) {
                $query->where('dosen_penilai_1', $dosenId)
                    ->orWhere('dosen_penilai_2', $dosenId);
            })
            ->where('status', 'Diterima')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('script_title', 'like', '%' . $search . '%');
                });
            })
            ->withCount('bimbingan')
            ->orderBy('name')
            ->paginate(5)
            ->appends(['search' => $search]); // menjaga nilai pencarian saat berpindah halaman

        return view('kaprodi.bimbingan.rekap', compact('seminars', 'search'));
    }

}