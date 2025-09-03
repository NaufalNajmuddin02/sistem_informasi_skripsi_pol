<?php
namespace App\Http\Controllers\admin\dosen_penilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Seminar;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Log;

class PembagianRuanganPenilaiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tahunAkademik = $request->input('tahun_akademik');
        $statusJadwal = $request->input('status_jadwal'); // 👈 ambil filter status
        $ruangans = Ruangan::all();

        $daftarTahunAkademik = Seminar::select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'desc')
            ->pluck('tahun_akademik');

        $seminars = Seminar::when($search, function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('class', 'like', "%{$search}%")
                    ->orWhere('script_title', 'like', "%{$search}%");
            })
            ->when($tahunAkademik, function($query) use ($tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            })
            ->when($statusJadwal, function($query) use ($statusJadwal) {
                if ($statusJadwal === 'belum') {
                    $query->whereNull('tanggal')
                        ->orWhereNull('jam')
                        ->orWhereNull('jam_selesai')
                        ->orWhereNull('ruangan_id');
                } elseif ($statusJadwal === 'sudah') {
                    $query->whereNotNull('tanggal')
                        ->whereNotNull('jam')
                        ->whereNotNull('jam_selesai')
                        ->whereNotNull('ruangan_id');
                }
            })
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('admin.seminar.seminars', compact(
            'seminars', 
            'search', 
            'tahunAkademik', 
            'daftarTahunAkademik', 
            'ruangans',
            'statusJadwal' // 👈 kirim ke view
        ));
    }


    
    public function setReschedule($id)
    {
        $seminar = Seminar::findOrFail($id);
        $seminar->is_rescheduled = true;
        $seminar->save();

        // langsung buka modal di halaman daftar seminar
        return redirect()->route('admin.seminar', ['reschedule_id' => $seminar->id])
            ->with('success', 'Mahasiswa ini telah ditandai untuk penjadwalan ulang. Silakan atur ulang jadwalnya.');
    }

    public function updateJadwal(Request $request, $id)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal' => 'required|date',
            'jam' => ['required', 'date_format:H:i'],
            'jam_selesai' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value <= $request->jam) {
                        $fail('Jam selesai harus lebih besar dari jam mulai.');
                    }
                    if ($value < '08:00' || $value > '18:00') {
                        $fail('Jam selesai harus antara 08:00 sampai 18:00.');
                    }
                },
            ],
        ]);

        $seminar = Seminar::findOrFail($id);
        $tanggalSeminar = Carbon::parse($request->tanggal);

        // Jika tanggal sudah lewat dan tidak ditandai untuk penjadwalan ulang → blok
        if ($tanggalSeminar->isPast() && !$seminar->is_rescheduled) {
            return redirect()->back()->with('error', 'Jadwal tidak bisa diubah karena seminar sudah lewat. Tandai "Jadwalkan Ulang" terlebih dahulu.');
        }

        // Cek bentrok jika tanggal seminar adalah hari ini atau lebih
        if ($tanggalSeminar->isToday() || $tanggalSeminar->isFuture()) {
            $conflictingSeminar = Seminar::where('id', '!=', $id)
                ->where('ruangan_id', $request->ruangan_id)
                ->where('tanggal', $request->tanggal)
                ->where(function ($query) use ($request) {
                    $query->where('jam', '<', $request->jam_selesai)
                          ->where('jam_selesai', '>', $request->jam);
                })
                ->first();

            if ($conflictingSeminar) {
                $conflictInfo = "Ruangan sudah digunakan oleh mahasiswa {$conflictingSeminar->mahasiswa->username}
                    untuk seminar berjudul '{$conflictingSeminar->script_title}'
                    dari pukul {$conflictingSeminar->jam}
                    sampai {$conflictingSeminar->jam_selesai} 
                    pada tanggal " . \Carbon\Carbon::parse($conflictingSeminar->tanggal)->format('d-m-Y');

                return redirect()->back()->with('error', $conflictInfo);
            }
        }

        try {
            $seminar->ruangan_id = $request->ruangan_id;
            $seminar->tanggal = $request->tanggal;
            $seminar->jam = $request->jam;
            $seminar->jam_selesai = $request->jam_selesai;
            $seminar->is_rescheduled = false; // reset setelah dijadwalkan ulang
            $seminar->save();

            $namaRuangan = $seminar->ruangan ? $seminar->ruangan->nama : 'Unknown';

            // Kirim notifikasi (sama seperti sebelumnya)
            if ($seminar->mahasiswa) {
                $seminar->mahasiswa->notifications()->create([
                    'title' => 'Jadwal Seminar Telah Ditetapkan',
                    'message' => "Seminar Anda dengan judul '{$seminar->script_title}' telah dijadwalkan ulang pada:
                                Ruangan: {$namaRuangan}, 
                                Tanggal: {$seminar->tanggal}, 
                                Waktu: {$seminar->jam} - {$seminar->jam_selesai}.",
                    'read_at' => null,
                ]);
            }

            if ($seminar->dosenPenilai1) {
                $seminar->dosenPenilai1->notifications()->create([
                    'title' => 'Jadwal Seminar Mahasiswa Ditetapkan Ulang',
                    'message' => "Anda ditugaskan sebagai Dosen Penilai 1 untuk seminar mahasiswa: {$seminar->mahasiswa->username}. 
                                Judul: '{$seminar->script_title}', 
                                Ruangan: {$namaRuangan}, 
                                Tanggal: {$seminar->tanggal}, 
                                Waktu: {$seminar->jam} - {$seminar->jam_selesai}.",
                    'read_at' => null,
                ]);
            }

            if ($seminar->dosenPenilai2) {
                $seminar->dosenPenilai2->notifications()->create([
                    'title' => 'Jadwal Seminar Mahasiswa Ditetapkan Ulang',
                    'message' => "Anda ditugaskan sebagai Dosen Penilai 2 untuk seminar mahasiswa: {$seminar->mahasiswa->username}. 
                                Judul: '{$seminar->script_title}', 
                                Ruangan: {$namaRuangan}, 
                                Tanggal: {$seminar->tanggal}, 
                                Waktu: {$seminar->jam} - {$seminar->jam_selesai}.",
                    'read_at' => null,
                ]);
            }

            return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error("Update Jadwal Gagal: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui jadwal.');
        }
    }

    
}
