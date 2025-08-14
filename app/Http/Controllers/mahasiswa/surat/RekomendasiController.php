<?php

namespace App\Http\Controllers\mahasiswa\surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seminar;

class RekomendasiController extends Controller
{
    public function show($id, Request $request)
    {
        // Ambil data seminar berdasarkan ID
        $seminar = Seminar::with(['user', 'dosenPenilai1', 'dosenPenilai2'])->findOrFail($id);

        // Cek status rekomendasi dosen pembimbing 1 dan 2
        $rekomendasiDosen1 = strtolower($seminar->rekomendasi_dosen_1) === 'direkomendasikan';
        $rekomendasiDosen2 = strtolower($seminar->rekomendasi_dosen_2) === 'direkomendasikan';

        // Jika kedua dosen sudah merekomendasikan
        if ($rekomendasiDosen1 && $rekomendasiDosen2) {
            // Kirim notifikasi kepada mahasiswa
            if ($seminar->mahasiswa) {
                $seminar->mahasiswa->notifications()->create([
                    'title' => 'Surat Rekomendasi Sidang',
                    'message' => 'Surat rekomendasi sidang Anda sudah keluar. Silakan periksa halaman surat rekomendasi.',
                    'read_at' => null,
                ]);
            }
        }

        return view('mahasiswa.rekomendasi.surat', compact('seminar', 'rekomendasiDosen1', 'rekomendasiDosen2'));
    }

    public function download($id)
    {
        // Ambil data seminar berdasarkan ID
        $seminar = Seminar::with(['user', 'dosenPenilai1', 'dosenPenilai2'])->findOrFail($id);

        // Cek status rekomendasi dosen pembimbing 1 dan 2
        $rekomendasiDosen1 = strtolower($seminar->rekomendasi_dosen_1) === 'direkomendasikan';
        $rekomendasiDosen2 = strtolower($seminar->rekomendasi_dosen_2) === 'direkomendasikan';

        // Buat PDF dari view
        $pdf = \PDF::loadView('mahasiswa.rekomendasi.surat_pdf', compact('seminar', 'rekomendasiDosen1', 'rekomendasiDosen2'))
                ->setPaper('A4', 'portrait');

        // Unduh PDF dengan nama file yang dinamis
        return $pdf->download('Surat_Rekomendasi_' . $seminar->user->username . '.pdf');
    }

}
