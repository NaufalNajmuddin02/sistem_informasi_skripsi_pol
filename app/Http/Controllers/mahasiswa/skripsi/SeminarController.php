<?php

namespace App\Http\Controllers\mahasiswa\skripsi;
use App\Models\Seminar;
use App\Models\KategoriProposal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BatasWaktuPengajuan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SeminarController extends Controller
{

    public function pendaftaranseminarproposal()
    {
        $seminars = Seminar::where('user_id', Auth::id())->get(); 
        Carbon::setLocale('id');
        return view('mahasiswa.skripsi.seminar.pendaftaran-seminar-proposal', compact('seminars'));
    }
    
    public function formseminarproposal()
    {
        $user = Auth::user();

        $nama = $user->username;
        $kelas = $user->kelas;
        $no_hp = $user->no_hp;
        $tanggalSekarang = now()->format('Y-m-d');
        $tahunAkademik = now()->format('Y') . '/' . now()->addYear()->format('Y');
        $kategoriList = KategoriProposal::all();

        $batas = BatasWaktuPengajuan::where('tahun_akademik', $tahunAkademik)->first();

        if (!$batas || now()->toDateString() > $batas->tanggal_batas) {
            return redirect()->route('pendaftaran-seminar-proposal')->with('error', 'Pengajuan ditutup karena batas waktu sudah lewat.');
}

        return view('mahasiswa.skripsi.seminar.create-seminar', compact(
            'nama', 'kelas', 'tanggalSekarang', 'tahunAkademik', 'kategoriList', 'no_hp', 'batas'
        ));
    }


    public function store(Request $request)
    {
        $userId = Auth::id();

        // Cek apakah user sudah punya seminar
        $cekSeminar = Seminar::where('user_id', $userId)->first();
        if ($cekSeminar) {
            return redirect()->route('pendaftaran-seminar-proposal')->with('error', 'Anda sudah mengajukan seminar. Silakan hapus seminar sebelumnya untuk mengajukan yang baru.');
        }

        // 🔄 Pindahkan ke atas sebelum dipakai
        $tahunAkademik = now()->format('Y') . '/' . now()->addYear()->format('Y');

        $batas = BatasWaktuPengajuan::where('tahun_akademik', $tahunAkademik)->first();
        if (!$batas || now()->toDateString() > $batas->tanggal_batas) {
            return redirect()->route('pendaftaran-seminar-proposal')->with('error', 'Pengajuan ditutup karena batas waktu sudah lewat.');
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'class' => 'required|in:A,B,C,D,E',
            'script_title' => 'required|string|max:255',
            'submission_date' => 'required|date',
            'link' => 'required|url|max:255',
            'kategori_proposal_id' => 'required|exists:kategori_proposals,id',
        ]);

        Seminar::create([
            'user_id' => $userId,
            'name' => $request->name,
            'class' => $request->class,
            'script_title' => $request->script_title,
            'submission_date' => $request->submission_date,
            'tahun_akademik' => $tahunAkademik,
            'link' => $request->link,
            'kategori_proposal_id' => $request->kategori_proposal_id,
            'no_hp' => Auth::user()->no_hp,
        ]);

        return redirect()->route('pendaftaran-seminar-proposal')->with('success', 'Seminar berhasil diajukan!');
    }

    public function edit($id)
    {
        $seminar = Seminar::findOrFail($id);
        $kategoriList = KategoriProposal::all();
        $user = Auth::user();

        return view('mahasiswa.skripsi.seminar.edit-seminar', compact('seminar', 'kategoriList', 'user'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:A,B,C,D,E',
            'script_title' => 'required|string|max:255',
            'submission_date' => 'required|date',
            'link' => 'required|url|max:255',
            'kategori_proposal_id' => 'required|exists:kategori_proposals,id',
        ]);

        $seminar = Seminar::findOrFail($id);

        $seminar->update([
            'name' => $request->name,
            'class' => $request->class,
            'script_title' => $request->script_title,
            'submission_date' => $request->submission_date,
            'link' => $request->link,
            'kategori_proposal_id' => $request->kategori_proposal_id,
            'no_hp' => Auth::user()->no_hp, // update no_hp jika berubah
            // 'tahun_akademik' => tidak diupdate karena readonly
        ]);

        return redirect()->route('pendaftaran-seminar-proposal')->with('success', 'Seminar berhasil diperbarui!');
    }



    public function destroy($id)
    {
        $seminar = Seminar::findOrFail($id);
        $seminar->delete();

        return redirect()->route('pendaftaran-seminar-proposal')->with('success', 'Seminar berhasil dihapus!');
    }

}