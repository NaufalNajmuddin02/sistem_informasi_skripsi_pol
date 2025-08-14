<?php

namespace App\Http\Controllers\mahasiswa\skripsi;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PembagianMahasiswa;
use App\Models\User;
use App\Models\KategoriProposal;
use App\Models\Notification;

class ProposalController extends Controller
{
    public function formpengajuanproposal()
    {
        $user = Auth::user();
        $pembagian = PembagianMahasiswa::where('mahasiswa_id', $user->id)->first();
        $nama_dosen = $pembagian ? $pembagian->dosen_nama : null;
        $nama = $user->username;
        $kelas = $user->kelas;
        $tanggalSekarang = now()->format('Y-m-d');
        $tahunAkademik = now()->format('Y') . '/' . now()->addYear()->format('Y');

        $kategoriList = KategoriProposal::all();

        return view('mahasiswa.skripsi.proposal.create-proposal', compact(
            'nama_dosen', 'nama', 'kelas', 'tanggalSekarang', 'tahunAkademik', 'kategoriList'
        ));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        // Cek apakah user sudah memiliki proposal
        $cekProposal = Proposal::where('user_id', $user_id)->first();
        if ($cekProposal) {
            return redirect()->route('pengajuan-proposal')->with('error', 'Anda hanya dapat mengajukan satu proposal. Hapus proposal lama jika ingin mengajukan lagi.');
        }

        // Cek apakah sudah melewati batas pengajuan
        $pembagian = PembagianMahasiswa::where('mahasiswa_id', $user_id)->first();

        if (!$pembagian || !$pembagian->mapel) {
            return redirect()->route('pengajuan-proposal')->with('error', 'Data pembagian atau mata kuliah tidak ditemukan.');
        }

        $batasPengajuan = $pembagian->mapel->batas_pengajuan;

        if ($batasPengajuan && now()->gt($batasPengajuan)) {
            return redirect()->route('pengajuan-proposal')->with('error', 'Batas waktu pengajuan proposal telah berakhir.');
        }

        // Ambil nama dosen
        $nama_dosen = $pembagian->dosen_nama;

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:A,B,C,D,E',
            'submission_date' => 'required|date',
            'script_title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'link' => 'required|url|max:500',
            'kategori_proposal_id' => 'required|exists:kategori_proposals,id',
        ]);

        // Hitung tahun akademik
        $tahunAkademik = now()->format('Y') . '/' . now()->addYear()->format('Y');

        // Simpan proposal
        $proposal = Proposal::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'nama_dosen' => $nama_dosen,
            'class' => $request->class,
            'submission_date' => $request->submission_date,
            'script_title' => $request->script_title,
            'abstract' => $request->abstract,
            'tahun_akademik' => $tahunAkademik,
            'link' => $request->link,
            'kategori_proposal_id' => $request->kategori_proposal_id,
        ]);

        // Kirim notifikasi ke dosen
        $dosen = User::where('username', $nama_dosen)->first();
        if ($dosen) {
            Notification::create([
                'user_id' => $dosen->id,
                'title' => 'Proposal Baru Dikirim',
                'message' => "Mahasiswa {$request->name} mengirim proposal berjudul '{$request->script_title}'.",
                'read_at' => null,
            ]);
        }

        return redirect()->route('pengajuan-proposal')->with('success', 'Proposal berhasil diajukan!');
    }


    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);
        $kategoriList = KategoriProposal::all();

        return view('mahasiswa.skripsi.proposal.edit-proposal', compact('proposal', 'kategoriList'));
    }


   public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:A,B,C,D,E',
            'submission_date' => 'required|date',
            'script_title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'link' => 'required|url|max:500',
            'kategori_proposal_id' => 'required|exists:kategori_proposals,id',
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->update($request->all());

        return redirect()->route('pengajuan-proposal')->with('success', 'Proposal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect()->route('pengajuan-proposal')->with('success', 'Proposal berhasil dihapus!');
    }

    public function pengajuanproposal()
    {
        $proposals = Proposal::where('user_id', Auth::id())->get();
        return view('mahasiswa.skripsi.proposal.pengajuan-proposal', compact('proposals'));
    }
}
