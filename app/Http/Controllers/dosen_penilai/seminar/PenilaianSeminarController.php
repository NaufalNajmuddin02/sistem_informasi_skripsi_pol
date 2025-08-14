<?php

namespace App\Http\Controllers\dosen_penilai\seminar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Seminar;
use App\Models\Ruangan;
use App\Models\PenilaianSeminar;
use Illuminate\Http\Request;

class PenilaianSeminarController extends Controller
{
    public function index(Request $request)
    {
        $dosenId = Auth::id();
        $ruangans = Ruangan::all();
        $query = Seminar::with('penilaians')
            ->where(function ($q) use ($dosenId) {
                $q->where('dosen_penilai_1', $dosenId)
                ->orWhere('dosen_penilai_2', $dosenId);
            });

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('script_title', 'like', "%$search%")
                ->orWhere('ruangan', 'like', "%$search%");
            });
        }

        // Urutkan berdasarkan tanggal seminar (jadwal) dari yang paling dekat
        $query->whereDate('tanggal', '>=', now())
        ->orderBy('tanggal', 'asc');


        $seminars = $query->paginate(6);

        return view('dosen_penilai.seminar.index', compact('seminars','ruangans'));
    }

    public function store(Request $request, $seminarId)
    {
        $request->validate([
            'peran_penilai' => 'required|in:penilai_1,penilai_2',
            'judul_penelitian' => 'required|integer|min:1|max:5',
            'pendahuluan' => 'required|integer|min:1|max:5',
            'metodologi' => 'required|integer|min:1|max:5',
            'solusi' => 'required|integer|min:1|max:5',
            'kesiapan_produk' => 'required|integer|min:1|max:5',
        ]);

        $seminar = Seminar::findOrFail($seminarId);
        $dosenId = Auth::id();

        $existing = PenilaianSeminar::where('seminar_id', $seminarId)
            ->where('dosen_id', $dosenId)
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah memberikan penilaian. Silakan update jika perlu.');
        }

        $nilai_total = (
            ($request->judul_penelitian * 10) +
            ($request->pendahuluan * 15) +
            ($request->metodologi * 15) +
            ($request->solusi * 25) +
            ($request->kesiapan_produk * 35)
        ) / 5;

        PenilaianSeminar::create([
            'seminar_id' => $seminarId,
            'dosen_id' => $dosenId,
            'peran_penilai' => $request->peran_penilai,
            'judul_penelitian' => $request->judul_penelitian,
            'pendahuluan' => $request->pendahuluan,
            'metodologi' => $request->metodologi,
            'solusi' => $request->solusi,
            'kesiapan_produk' => $request->kesiapan_produk,
            'nilai_total' => $nilai_total,
        ]);

        $this->updateSeminarStatus($seminarId);

        return back()->with('success', 'Penilaian berhasil disimpan.');
    }

    public function update(Request $request, $seminarId)
    {
        $request->validate([
            'peran_penilai' => 'required|in:penilai_1,penilai_2',
            'judul_penelitian' => 'required|integer|min:1|max:5',
            'pendahuluan' => 'required|integer|min:1|max:5',
            'metodologi' => 'required|integer|min:1|max:5',
            'solusi' => 'required|integer|min:1|max:5',
            'kesiapan_produk' => 'required|integer|min:1|max:5',
        ]);

        $dosenId = Auth::id();
        $seminar = Seminar::findOrFail($seminarId);
        $penilaian = PenilaianSeminar::where('seminar_id', $seminarId)
            ->where('dosen_id', $dosenId)->first();

        if (!$penilaian) {
            return back()->with('error', 'Data penilaian tidak ditemukan.');
        }

        $nilai_total = (
            ($request->judul_penelitian * 10) +
            ($request->pendahuluan * 15) +
            ($request->metodologi * 15) +
            ($request->solusi * 25) +
            ($request->kesiapan_produk * 35)
        ) / 5;

        $penilaian->update([
            'judul_penelitian' => $request->judul_penelitian,
            'pendahuluan' => $request->pendahuluan,
            'metodologi' => $request->metodologi,
            'solusi' => $request->solusi,
            'kesiapan_produk' => $request->kesiapan_produk,
            'nilai_total' => $nilai_total,
            'peran_penilai' => $request->peran_penilai,
        ]);

        $this->updateSeminarStatus($seminarId);

        return back()->with('success', 'Penilaian berhasil diperbarui.');
    }

    private function updateSeminarStatus($seminarId)
    {
        $seminar = Seminar::findOrFail($seminarId);
        $penilaians = PenilaianSeminar::where('seminar_id', $seminarId)->get();

        if ($penilaians->count() >= 2) {
            // Ambil rata-rata dari nilai_total dua penilai
            $avg = $penilaians->avg('nilai_total');

            // Simpan ke kolom `nilai` di tabel seminars
            $seminar->nilai = $avg;

            // Tentukan status berdasarkan rata-rata nilai
            if ($avg > 60) {
                $seminar->status = 'Diterima';
            } elseif ($avg >= 50) {
                $seminar->status = 'Menunggu';
            } else {
                $seminar->status = 'Ditolak';
            }

            $seminar->save();
        }
    }


}
