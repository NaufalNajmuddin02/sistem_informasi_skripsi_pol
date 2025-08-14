<?php
namespace App\Http\Controllers\kaprodi\dosen_penilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Seminar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenilaiController extends Controller
{
    public function view(Request $request)
    {
        $tahun = $request->input('tahun');
        $status = $request->input('status'); // 'belum' atau 'sudah'

        $query = Seminar::query();

        // Filter berdasarkan tahun (jika ada kolom created_at atau tahun di table Seminar)
        if ($tahun) {
            $query->whereYear('created_at', $tahun); // ganti jika kolom tahun spesifik
        }

        // Filter berdasarkan status pembagian dosen
        if ($status === 'belum') {
            $query->whereNull('dosen_penilai_1')->whereNull('dosen_penilai_2');
        } elseif ($status === 'sudah') {
            $query->whereNotNull('dosen_penilai_1')->whereNotNull('dosen_penilai_2');
        }

        $seminars = $query->orderBy('created_at', 'desc')->paginate(15);

        $tahunList = Seminar::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
        $dosenList = User::whereIn('role', ['dosen_penilai', 'kaprodi'])
        ->where('dosen_prodi', Auth::user()->dosen_prodi)
        ->get();

        return view('kaprodi.seminar.seminars', compact('seminars', 'tahun', 'status', 'tahunList', 'dosenList'));
    }

    public function assignDosenPenilai(Request $request)
    {
        $request->validate([
            'assignments' => 'required|array',
            'assignments.*.seminar_id' => 'required|exists:seminars,id',
            'assignments.*.penilai_1' => 'required|exists:users,id|different:assignments.*.penilai_2',
            'assignments.*.penilai_2' => 'required|exists:users,id',
        ]);

        foreach ($request->assignments as $data) {
            $seminar = Seminar::find($data['seminar_id']);
            $penilai1 = User::find($data['penilai_1']);
            $penilai2 = User::find($data['penilai_2']);

            // Validasi kapasitas
            if ($penilai1->kapasitas_bimbingan <= 0 || $penilai2->kapasitas_bimbingan <= 0) {
                continue; // Lewati jika tidak memiliki kapasitas
            }

            // Cek jika belum pernah dibagikan
            if ($seminar->dosen_penilai_1 || $seminar->dosen_penilai_2) {
                continue;
            }

            // Update seminar
            $seminar->update([
                'dosen_penilai_1' => $penilai1->id,
                'dosen_penilai_1_nama' => $penilai1->username,
                'dosen_penilai_2' => $penilai2->id,
                'dosen_penilai_2_nama' => $penilai2->username,
            ]);

            // Kurangi kapasitas
            $penilai1->decrement('kapasitas_bimbingan');
            $penilai2->decrement('kapasitas_bimbingan');

            // Notifikasi
            $penilai1->notifications()->create([
                'title' => 'Penugasan Dosen Penilai Seminar',
                'message' => "Anda ditugaskan sebagai Dosen Penilai 1 untuk seminar mahasiswa: {$seminar->mahasiswa->username}.",
            ]);

            $penilai2->notifications()->create([
                'title' => 'Penugasan Dosen Penilai Seminar',
                'message' => "Anda ditugaskan sebagai Dosen Penilai 2 untuk seminar mahasiswa: {$seminar->mahasiswa->username}.",
            ]);

            if ($seminar->mahasiswa) {
                $seminar->mahasiswa->notifications()->create([
                    'title' => 'Penetapan Dosen Penilai Seminar',
                    'message' => "Dosen penilai seminar Anda telah ditetapkan: Dosen Penilai 1: {$penilai1->username}, Dosen Penilai 2: {$penilai2->username}.",
                ]);
            }
        }

        return redirect()->back()->with('success', 'Pembagian dosen penilai berhasil dilakukan.');
    }

}
