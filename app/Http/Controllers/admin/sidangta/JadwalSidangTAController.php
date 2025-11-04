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
        // Ambil semua mahasiswa yang sudah punya jadwal TA
        $mahasiswaSudahAdaJadwal = DB::table('jadwal_ta')->pluck('user_id');

        $mahasiswaList = User::where('role', 'mahasiswa')
            ->whereIn('nim', function($query) {
                $query->selectRaw("nim COLLATE utf8mb4_general_ci")
                    ->from('table_pendaftaran_t_a') // pastikan nama tabel benar
                    ->where('status_hasil_plagiasi', 'disetujui')
                    ->where('status_bukti_pembayaran', 'disetujui')
                    ->where('status_skor_toefl', 'disetujui')
                    ->where('status_ijazah_sma', 'disetujui')
                    ->where('status_ktp', 'disetujui')
                    ->where('status_kk', 'disetujui');
            })
            ->whereIn('id', function($query) {
                $query->select('mahasiswa_id')
                    ->from('penilaian_dosen_pembimbing')
                    ->whereNotNull('rata_rata');
            })
            ->whereNotIn('id', $mahasiswaSudahAdaJadwal) // ⬅️ filter
            ->get();

        $dosenList = User::whereIn('role', ['dosen', 'dosen_penilai', 'dosen_pembimbing', 'kaprodi'])->get();

        return view('admin.jadwal.jadwalta.create', compact('mahasiswaList', 'dosenList'));
    }


   public function store(Request $request)
{
    // Validasi lengkap
    // 🔎 Cek bentrok
    $bentrok = \App\Models\admin\JadwalTAModel::where('tanggal', $request->tanggal)
        ->where('ruangan', $request->ruangan)
        ->where(function ($q) use ($request) {
            $q->whereBetween('waktu', [$request->waktu, $request->selesai])
              ->orWhereBetween('selesai', [$request->waktu, $request->selesai]);
        })
        ->exists();

    if ($bentrok) {
        return back()->withInput()->withErrors([
            'ruangan' => 'Jadwal pada ' . $request->tanggal . 
                        ' jam ' . $request->waktu . '-' . $request->selesai . 
                        ' di ruangan ' . $request->ruangan . ' sudah terpakai.'
        ]);
    }

    // Cari ID dosen
    $getUserIdByUsername = function ($username) {
        if (!$username) return null;
        $user = \App\Models\User::where('username', $username)->first();
        return $user ? $user->id : null;
    };

    $dosbing1_id = $getUserIdByUsername($request->input('dosbing1_id'));
        $dosbing2_id = $getUserIdByUsername($request->input('dosbing2_id'));
        $ketua_penguji_id = $getUserIdByUsername($request->input('ketua_penguji_id'));
        $penguji1_id = $getUserIdByUsername($request->input('penguji1_id'));
        $penguji2_id = $getUserIdByUsername($request->input('penguji2_id'));
    // Simpan data
    \App\Models\admin\JadwalTAModel::create([
        'user_id' => $request->user_id,
        'nim' => $request->nim,
        'judul' => $request->judul,
        'tanggal' => $request->tanggal,
        'waktu' => $request->waktu,
        'selesai' => $request->selesai,
        'ruangan' => $request->ruangan,
        'dosbing1_id' => $dosbing1_id,
        'dosbing2_id' => $dosbing2_id,
        'ketua_penguji_id' => $ketua_penguji_id,
        'penguji1_id' => $penguji1_id,
        'penguji2_id' => $penguji2_id,
    ]);

    return redirect()->route('admin.jadwalta')
        ->with('success', 'Jadwal TA berhasil disimpan');
}






    public function edit($id)
    {
        $jadwalTA = JadwalTAModel::find($id);
        $jadwal = JadwalTAModel::findOrFail($id); // atau model kamu yang sesuai
        $mahasiswaList = DB::table('table_pendaftaran_t_a')
                            ->join('users', DB::raw('CONVERT(table_pendaftaran_t_a.nim USING utf8mb4)'), '=', DB::raw('CONVERT(users.nim USING utf8mb4)'))
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
    