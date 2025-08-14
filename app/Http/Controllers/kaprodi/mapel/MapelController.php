<?php

namespace App\Http\Controllers\kaprodi\mapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $tahunAkademikFilter = $request->input('tahun_akademik');
        $search = $request->input('search');

        $mapelQuery = Mapel::query();

        // Filter tahun akademik jika dipilih
        if ($tahunAkademikFilter) {
            $mapelQuery->where('tahun_akademik', $tahunAkademikFilter);
        }

        // Pencarian nama dosen atau kelas
        if ($search) {
            $mapelQuery->where(function ($query) use ($search) {
                $query->where('dosen_nama', 'like', "%$search%")
                    ->orWhere('kelas', 'like', "%$search%");
            });
        }

        // Ambil data terbaru & paginasi
        $mapelList = $mapelQuery->orderByDesc('created_at')->paginate(10);

        // Ambil daftar tahun akademik unik untuk dropdown filter
        $tahunAkademikList = Mapel::select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'desc')
            ->pluck('tahun_akademik');

        return view('kaprodi.mapel.index', compact('mapelList', 'tahunAkademikList', 'tahunAkademikFilter', 'search'));
    }


    public function create(Request $request)
    {
        $prodi = $request->query('prodi', auth()->user()->dosen_prodi);
        $tahunAkademik = now()->format('Y') . '/' . (now()->format('Y') + 1);

        // Ambil ID dosen yang sudah ditugaskan di mata kuliah proposal skripsi tahun ini
        $usedDosenIds = Mapel::where('nama_mapel', 'Proposal skripsi')
            ->where('tahun_akademik', $tahunAkademik)
            ->pluck('dosen_id');

        // Ambil dosen/kaprodi yang belum digunakan
        $dosenList = User::where('dosen_prodi', $prodi)
            ->whereIn('role', ['dosen', 'kaprodi'])
            ->whereNotIn('id', $usedDosenIds)
            ->get();

        return view('kaprodi.mapel.create', compact('dosenList', 'prodi', 'tahunAkademik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|in:Proposal skripsi',
            'dosen_id' => 'required|exists:users,id',
            'kelas' => 'required|in:A,B,C,D,E',
            'tahun_akademik' => 'required|string|max:10',
        ]);

        // Ambil tahun akademik dari request
        $tahunAkademik = $request->tahun_akademik;

        // Cek apakah dosen sudah pernah ditugaskan untuk Proposal Skripsi di tahun akademik yang sama
        $sudahAda = Mapel::where('nama_mapel', 'Proposal skripsi')
            ->where('tahun_akademik', $tahunAkademik)
            ->where('dosen_id', $request->dosen_id)
            ->exists();

        if ($sudahAda) {
            return redirect()->back()->withErrors([
                'dosen_id' => 'Dosen ini sudah ditugaskan untuk Proposal Skripsi pada tahun akademik tersebut.',
            ])->withInput();
        }

        // Ambil data dosen (hanya jika role-nya dosen/kaprodi)
        $dosen = User::where('id', $request->dosen_id)
            ->whereIn('role', ['dosen', 'kaprodi'])
            ->first();

        if (!$dosen) {
            return redirect()->back()->withErrors([
                'dosen_id' => 'Dosen atau Kaprodi tidak valid atau tidak sesuai dengan prodi.',
            ])->withInput();
        }

        // Simpan data mata kuliah
        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
            'dosen_id' => $request->dosen_id,
            'dosen_nama' => $dosen->username,
            'kelas' => $request->kelas,
            'tahun_akademik' => $tahunAkademik,
        ]);

        // Kirim notifikasi ke dosen
        $dosen->notifications()->create([
            'title' => 'Mata Kuliah Baru Ditambahkan',
            'message' => "Anda ditugaskan sebagai dosen mata kuliah: {$request->nama_mapel} pada kelas {$request->kelas} untuk tahun akademik {$tahunAkademik}.",
            'read_at' => null,
        ]);

        return redirect()->route('mapel.create')->with('success', 'Mata kuliah berhasil ditambahkan dan notifikasi dikirim!');
    }


    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        $dosenList = User::whereIn('role', ['dosen', 'kaprodi'])->get();
        return view('kaprodi.mapel.edit', compact('mapel', 'dosenList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|in:Proposal skripsi',
            'dosen_id' => 'required|exists:users,id',
            'kelas' => 'required|in:A,B,C,D,E',
        ]);

        $mapel = Mapel::findOrFail($id);
        $dosen = User::where('id', $request->dosen_id)
            ->whereIn('role', ['dosen', 'kaprodi'])
            ->first();

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'dosen_id' => $request->dosen_id,
            'dosen_nama' => $dosen->username,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('mapel.index')->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
