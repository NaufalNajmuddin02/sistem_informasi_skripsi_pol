<?php

namespace App\Http\Controllers\admin\sidangta;

use App\Http\Controllers\Controller;
use App\Models\admin\JadwalTAModel;
use App\Models\kaprodi\DataPesertaTAModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalSidangTAController extends Controller
{
    //
    public function index()
    {
        $pesertaList = JadwalTAModel::with([
            'user', 
            'dosbing1', 
            'dosbing2', 
            'ketuaPenguji', 
            'penguji1', 
            'penguji2',
            
        ])->get();

        return view('admin.jadwal.jadwalta.index', compact('pesertaList'));
    }

    public function create()
        {
            // Ambil semua mahasiswa yang sudah mendaftar sidang TA berdasarkan user_id
            $mahasiswaList = User::whereIn('id', function ($query) {
                $query->select('user_id')->from('data_peserta_ta');
            })->where('role', 'mahasiswa')->get();

            $dosenList = User::where('role', 'dosen')->get();

            return view('admin.jadwal.jadwalta.create', compact('mahasiswaList', 'dosenList'));
        }


    public function store(Request $request)
    {
        // Validasi sederhana, misal wajib ada nama dosen
        $request->validate([
            'user_id' => 'required|exists:users,id', // id mahasiswa
            'dosbing1' => 'nullable|string',
            'dosbing2' => 'nullable|string',
            'ketua_penguji' => 'nullable|string',
            'penguji1' => 'nullable|string',
            'penguji2' => 'nullable|string',
            // field lain validasi jika perlu
        ]);

        // Fungsi bantu cari id user berdasarkan username atau nama (username misal)
        $getUserIdByUsername = function($username) {
            $user = \App\Models\User::where('username', $username)->first();
            return $user ? $user->id : null;
        };

        // Cari ID dosen berdasarkan nama/username yang dikirim
        $dosbing1_id = $getUserIdByUsername($request->input('dosbing1_id'));
        $dosbing2_id = $getUserIdByUsername($request->input('dosbing2_id'));
        $ketua_penguji_id = $getUserIdByUsername($request->input('ketua_penguji_id'));
        $penguji1_id = $getUserIdByUsername($request->input('penguji1_id'));
        $penguji2_id = $getUserIdByUsername($request->input('penguji2_id'));

        // Simpan ke tabel jadwal_ta
        \App\Models\admin\JadwalTAModel::create([
            'user_id' => $request->input('user_id'),
            'nim' => $request->input('nim'),
            'judul' => $request->input('judul'),
            'dosbing1_id' => $dosbing1_id,
            'dosbing2_id' => $dosbing2_id,
            'ketua_penguji_id' => $ketua_penguji_id,
            'penguji1_id' => $penguji1_id,
            'penguji2_id' => $penguji2_id,
            'tanggal' => $request->input('tanggal'),
            'waktu' => $request->input('waktu'),
            'ruangan' => $request->input('ruangan'),
            'selesai' => $request->input('selesai'),
        ]);

        return redirect()->route('admin.jadwalta')->with('success', 'Jadwal TA berhasil disimpan');
    }


    public function edit($id)
    {
        $jadwalTA = JadwalTAModel::find($id);
        $jadwal = JadwalTAModel::findOrFail($id); // atau model kamu yang sesuai
        $mahasiswaList = DB::table('table_pendaftaran_t_a')
                            ->join('users', DB::raw('CONVERT(table_pendaftaran_t_a.nim USING utf8mb4)'), '=', DB::raw('CONVERT(users.nim USING utf8mb4)'))
                            ->where('status_naskah', 'disetujui')
                            ->where('status_hasil_plagiasi', 'disetujui')
                            ->where('status_bukti_pembayaran', 'disetujui')
                            ->where('status_skor_toefl', 'disetujui')
                            ->where('status_ijazah_sma', 'disetujui')
                            ->where('status_ktp', 'disetujui')
                            ->where('status_kk', 'disetujui')
                             ->select('users.id', 'users.username')
                            ->get();
        $dosenList = User::where('role', 'dosen')
                        ->orWhere('role','dosen_penguji_ta')
                        ->orWhere('role','kaprodi')
                        ->orWhere('role', 'dosen_penilai')
                        ->orWhere('role', 'dosen_pembimbing')
                        ->get();
        
        $jadwalList = JadwalTAModel::with(['dosbing1', 'dosbing2'])->get();


       return view('admin.jadwal.jadwalta.edit', compact('jadwal', 'mahasiswaList', 'dosenList','jadwalTA', 'jadwalList'));
    } 


    public function destroy($id) {
        $peserta = JadwalTAModel::findOrFail($id);
        $peserta->delete();
        return redirect()->route('admin.jadwalta')->with('success', 'Data berhasil dihapus.');
    }
    


    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string',
            'judul' => 'required|string',
            'dosbing1_nama' => 'required|string',
            'dosbing2_nama' => 'nullable|string',
            'ketua_penguji_nama' => 'required|string',
            'penguji1_nama' => 'required|string',
            'penguji2_nama' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'ruangan' => 'required|string',
        ]);

        // Ambil ID berdasarkan nama
        $mahassiwa = User::where('username', $request->mahasiswa_nama)->first();
        $dosbing1 = User::where('username', $request->dosbing1_nama)->first();
        $dosbing2 = User::where('username', $request->dosbing2_nama)->first();
        $ketuaPenguji = User::where('username', $request->ketua_penguji_nama)->first();
        $penguji1 = User::where('username', $request->penguji1_nama)->first();
        $penguji2 = User::where('username', $request->penguji2_nama)->first();

        // Validasi manual jika nama tidak ditemukan
        if (!$dosbing1 || !$ketuaPenguji || !$penguji1) {
            return back()->withErrors(['error' => 'Beberapa nama dosen tidak ditemukan di database.']);
        }

        $jadwal = JadwalTAModel::findOrFail($id);
        $jadwal->update([
            'user_id' => $mahassiwa->id,
            'nim' => $request->nim,
            'judul' => $request->judul,
            'dosbing1_id' => $dosbing1->id,
            'dosbing2_id' => $dosbing2->id ?? null,
            'ketua_penguji_id' => $ketuaPenguji->id,
            'penguji1_id' => $penguji1->id,
            'penguji2_id' => $penguji2->id ?? null,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'ruangan' => $request->ruangan,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.jadwalta')->with('success', 'Jadwal sidang berhasil diperbarui.');
    }

    public function getPesertaTA($userId)
    {
        $peserta = DataPesertaTAModel::with(['dosbing1', 'dosbing2', 'ketua_penguji', 'penguji1', 'penguji2'])
                    ->where('user_id', $userId)
                    ->first();

        if (!$peserta) {
            return response()->json([], 404);
        }

        return response()->json([
            'nim' => $peserta->nim,
            'judul' => $peserta->judul,
            'dosbing1_id' => $peserta->dosbing1_id,
            'dosbing1' => $peserta->dosbing1,
            'dosbing2_id' => $peserta->dosbing2_id,
            'dosbing2' => $peserta->dosbing2,
            'ketua_penguji_id' => $peserta->ketua_penguji_id,
            'ketua_penguji' => $peserta->ketua_penguji,
            'penguji1_id' => $peserta->penguji1_id,
            'penguji1' => $peserta->penguji1,
            'penguji2_id' => $peserta->penguji2_id,
            'penguji2' => $peserta->penguji2,
        ]);
    }
}
