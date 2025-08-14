<?php

namespace App\Http\Controllers\admin\dosen_mapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\User;
use App\Models\PembagianMahasiswa;

class PembagianMahasiswaController extends Controller
{
     public function index(Request $request)
    {
        $search = $request->input('search');
        $mapel = Mapel::with('dosen')
            ->when($search, function ($query, $search) {
                return $query->where('nama_mapel', 'like', "%{$search}%")
                    ->orWhereHas('dosen', function ($q) use ($search) {
                        $q->where('dosen_nama', 'like', "%{$search}%");
                    });
            })
            ->paginate(3);

        return view('admin.dosen_mapel.index', compact('mapel', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required|exists:mapel,id',
            'mahasiswa_ids' => 'required|array',
        ]);
    
        $mapel = Mapel::with('dosen')->findOrFail($request->mapel_id);
        $dosen_nama = $mapel->dosen_nama; // Ambil nama dosen
    
        foreach ($request->mahasiswa_ids as $mahasiswa_id) {
            $mahasiswa = User::find($mahasiswa_id); // Ambil data mahasiswa
            PembagianMahasiswa::create([
                'mapel_id' => $mapel->id,
                'dosen_id' => $mapel->dosen_id,
                'dosen_nama' => $dosen_nama,
                'mahasiswa_id' => $mahasiswa->id,
                'mahasiswa_nama' => $mahasiswa->username
            ]);
        }
    
        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan.');
    }


    public function getMahasiswa(Request $request)
    {
        $mapel_id = $request->mapel_id;
        $kelas = $request->kelas;

        // Ambil ID mahasiswa yang sudah terdaftar pada mata kuliah manapun
        $terdaftarDiMapelLain = PembagianMahasiswa::pluck('mahasiswa_id')->toArray();

        // Ambil ID mahasiswa yang sudah terdaftar pada mapel ini
        $terdaftarDiMapelIni = PembagianMahasiswa::where('mapel_id', $mapel_id)
                                            ->pluck('mahasiswa_id')
                                            ->toArray();

        // Gabungkan daftar mahasiswa yang sudah terdaftar di mapel mana pun
        $terdaftar = array_unique(array_merge($terdaftarDiMapelLain, $terdaftarDiMapelIni));

        // Ambil mahasiswa yang belum terdaftar dan sesuai kelas
        $mahasiswa = User::where('role', 'mahasiswa')
                        ->where('kelas', $kelas) // filter berdasarkan kelas dari mapel
                        ->whereNotIn('id', $terdaftar)
                        ->get(['id', 'username', 'kelas']);

        return response()->json($mahasiswa);
    }

}
