<?php

namespace App\Http\Controllers\kaprodi\datapesertata;

use App\Http\Controllers\Controller;
use App\Models\kaprodi\DataPesertaTAModel;
use App\Models\PendaftaranSidangTA;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesertaSidangTAController extends Controller
{
    public function index()
    {
        $pesertaList = DataPesertaTAModel::with([
            'user', 
            'dosbing1', 
            'dosbing2', 
            'ketuaPenguji', 
            'penguji1', 
            'penguji2'
        ])->get();

        return view('kaprodi.datapesertasidangta.index', compact('pesertaList'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'judul' => 'required|string',
            'nama_pembimbing_1' => 'required|string',
            'nama_pembimbing_2' => 'nullable|string',
            'ketua_penguji_id' => 'required|integer|exists:users,id',
            'penguji1_id' => 'required|integer|exists:users,id',
            'penguji2' => 'nullable|string',
        ]);

        // Cari user mahasiswa berdasarkan nim (username)
        $user = User::where('nim', $request->nim)->first();
        if (!$user) {
            return back()->withErrors(['nim' => 'ID tidak ditemukan']);
        }

        // Cari dosbing1 berdasarkan nama
        $dosbing1 = User::where('username', $request->nama_pembimbing_1)->first();
        if (!$dosbing1) {
            return back()->withErrors(['nama_pembimbing_1' => 'Dosen pembimbing 1 tidak ditemukan']);
        }

        // Cari dosbing2 (nullable)
        $dosbing2_id = null;
        if ($request->filled('nama_pembimbing_2')) {
            $dosbing2 = User::where('username', $request->nama_pembimbing_2)->first();
            if (!$dosbing2) {
                return back()->withErrors(['nama_pembimbing_2' => 'Dosen pembimbing 2 tidak ditemukan']);
            }
            $dosbing2_id = $dosbing2->id;
        }

        // ketua_penguji_id dan penguji1_id langsung dari form, sudah ID validasi exists

        // Cari penguji2_id (nullable), dari nama
        $penguji2_id = null;
        if ($request->filled('penguji2')) {
            $penguji2 = User::where('username', $request->penguji2)->first();
            if (!$penguji2) {
                return back()->withErrors(['penguji2' => 'Penguji 2 tidak ditemukan']);
            }
            $penguji2_id = $penguji2->id;
        }

        DataPesertaTAModel::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'judul' => $request->judul,
            'dosbing1_id' => $dosbing1->id,
            'dosbing2_id' => $dosbing2_id,
            'ketua_penguji_id' => $request->ketua_penguji_id,
            'penguji1_id' => $request->penguji1_id,
            'penguji2_id' => $penguji2_id,
        ]);

        return redirect()->route('kaprodi.pesertasidang')->with('success', 'Data peserta TA berhasil ditambahkan.');
    }
    public function create()
    {
        // Dengan eager loading relasi user
        $mahasiswaList = PendaftaranSidangTA::with('user')->get();


        $dosenList = User::whereIn('role', ['dosen', 'dosen_penguji_ta', 'kaprodi'])->get();

        return view('kaprodi.datapesertasidangta.create', compact('mahasiswaList', 'dosenList'));
    }

    public function edit($id)
    {
        $datapesertasidang = DataPesertaTAModel::findOrFail($id);
        $users = User::all();
        $dosenList = User::where('role', 'dosen')->get(); // sesuaikan dengan role dosen

        return view('kaprodi.datapesertasidangta.edit', compact('datapesertasidang', 'users', 'dosenList'));
    }
    public function destroy($id)
    {
        $peserta = DataPesertaTAModel::findOrFail($id);
        $peserta->delete();

        $pesertaList = DataPesertaTAModel::with([
            'user', 
            'dosbing1', 
            'dosbing2', 
            'ketuaPenguji', 
            'penguji1', 
            'penguji2'
        ])->get();

        return view('kaprodi.datapesertasidangta.index', compact('pesertaList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nim' => 'required|string|max:20',
            'judul' => 'required|string',
            'dosbing1_id' => 'required|exists:users,id',
            'dosbing2_id' => 'nullable|exists:users,id',
            'ketua_penguji_id' => 'required|exists:users,id',
            'penguji1_id' => 'required|exists:users,id',
            'penguji2_id' => 'nullable|exists:users,id',
        ]);

        $datapesertasidang = DataPesertaTAModel::findOrFail($id);

        $datapesertasidang->update($request->only([
            'user_id',
            'nim',
            'judul',
            'dosbing1_id',
            'dosbing2_id',
            'ketua_penguji_id',
            'penguji1_id',
            'penguji2_id',
        ]));

        return redirect()->route('kaprodi.pesertasidang')->with('success', 'Data peserta TA berhasil diperbarui.');
    }
    public function getPendaftaranTA($userId)
    {
        $user = User::findOrFail($userId);
        $data = PendaftaranSidangTA::where('nim', $user->username)->first();

        if (!$data) {
            return response()->json(['message' => 'Data pendaftaran tidak ditemukan'], 404);
        }

        return response()->json([
            'nim' => $data->nim,
            'judul' => $data->tema_skripsi,
            // field lain jika perlu
        ]);
    }

    public function getPendaftaranByNIM($nim)
    {
        $pendaftaran = PendaftaranSidangTA::where('nim', $nim)->first();

        if (!$pendaftaran) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'nim' => $pendaftaran->nim,
            'judul' => $pendaftaran->tema_skripsi,
            'nama_pembimbing_1' => $pendaftaran->nama_pembimbing_1,  
            'nama_pembimbing_2' => $pendaftaran->nama_pembimbing_2,
            'penguji2' => $pendaftaran->nama_pembimbing_2,   
        ]);
    }










}