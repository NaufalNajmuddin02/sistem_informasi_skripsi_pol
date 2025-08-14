<?php

namespace App\Http\Controllers\dosen_pembimbing\penilaian_bimbingan;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSidangTA;
use App\Models\PenilaianTugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianBimbinganController extends Controller
{
    //
    public function updatePenguji2(Request $request, $id)
    {
     
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);

        // Konversi nilai input (skor 1–5) ke skor berbobot sesuai ketentuan
        $sikap_kp = $request->sikap_kp * 5;
        $topik_kp = $request->mampu_menjelaskan_topik_kp * 5;
        $hasil_kp = $request->mampu_menjelaskan_hasil_kp * 15;
        $simulasi_kp = $request->simulasi_produk_kp * 20;
        $pengujian_kp = $request->pengujian_produk_kp * 10;
        $bermanfaat_kp = $request->produk_bermanfaat_kp * 15;
        $kejelasan_kp = $request->kejelasan_proses_kp * 10;
        $susunan_kp = $request->susunan_laporan_kp * 5;
        $isi_kp = $request->isi_laporan_kp * 10;
        $kualitas_kp = $request->kualitas_penulisan_kp * 5;

        $total = $sikap_kp + $topik_kp + $hasil_kp + $simulasi_kp + $pengujian_kp + $bermanfaat_kp + $kejelasan_kp + $susunan_kp + $isi_kp + $kualitas_kp;

        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'judul' => $request->judul,
            'sikap_penguji2' => $sikap_kp,
            'mampu_menjelaskan_topik_penguji2' => $topik_kp,
            'mampu_menjelaskan_hasil_penguji2' => $hasil_kp,
            'simulasi_produk_penguji2' => $simulasi_kp,
            'pengujian_produk_penguji2' => $pengujian_kp,
            'produk_bermanfaat_penguji2' => $bermanfaat_kp,
            'kejelasan_proses_penguji2' => $kejelasan_kp,
            'susunan_laporan_penguji2' => $susunan_kp,
            'isi_laporan_penguji2' => $isi_kp,
            'kualitas_penulisan_penguji2' => $kualitas_kp,
            'total_nilai_penguji2' => $total,
          
        ]);

        return redirect()->back()->with('success', 'Data Ketua Penguji berhasil diperbarui.');
    }
    public function updatePenguji1(Request $request, $id)
    {
   

        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);

        // Konversi nilai input (skor 1–5) ke skor berbobot sesuai ketentuan
        $sikap_kp = $request->sikap_kp * 5;
        $topik_kp = $request->mampu_menjelaskan_topik_kp * 5;
        $hasil_kp = $request->mampu_menjelaskan_hasil_kp * 15;
        $simulasi_kp = $request->simulasi_produk_kp * 20;
        $pengujian_kp = $request->pengujian_produk_kp * 10;
        $bermanfaat_kp = $request->produk_bermanfaat_kp * 15;
        $kejelasan_kp = $request->kejelasan_proses_kp * 10;
        $susunan_kp = $request->susunan_laporan_kp * 5;
        $isi_kp = $request->isi_laporan_kp * 10;
        $kualitas_kp = $request->kualitas_penulisan_kp * 5;

        $total = $sikap_kp + $topik_kp + $hasil_kp + $simulasi_kp + $pengujian_kp + $bermanfaat_kp + $kejelasan_kp + $susunan_kp + $isi_kp + $kualitas_kp;

        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'judul' => $request->judul,
            'sikap_penguji1' => $sikap_kp,
            'mampu_menjelaskan_topik_penguji1' => $topik_kp,
            'mampu_menjelaskan_hasil_penguji1' => $hasil_kp,
            'simulasi_produk_penguji1' => $simulasi_kp,
            'pengujian_produk_penguji1' => $pengujian_kp,
            'produk_bermanfaat_penguji1' => $bermanfaat_kp,
            'kejelasan_proses_penguji1' => $kejelasan_kp,
            'susunan_laporan_penguji1' => $susunan_kp,
            'isi_laporan_penguji1' => $isi_kp,
            'kualitas_penulisan_penguji1' => $kualitas_kp,
            'total_nilai_penguji1' => $total,
          
        ]);

        return redirect()->back()->with('success', 'Data Ketua Penguji berhasil diperbarui.');
    }
    public function updateKetuaPenguji(Request $request, $id)
    {
        
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);

        // Konversi nilai input (skor 1–5) ke skor berbobot sesuai ketentuan
        $sikap_kp = $request->sikap_kp * 5;
        $topik_kp = $request->mampu_menjelaskan_topik_kp * 5;
        $hasil_kp = $request->mampu_menjelaskan_hasil_kp * 15;
        $simulasi_kp = $request->simulasi_produk_kp * 20;
        $pengujian_kp = $request->pengujian_produk_kp * 10;
        $bermanfaat_kp = $request->produk_bermanfaat_kp * 15;
        $kejelasan_kp = $request->kejelasan_proses_kp * 10;
        $susunan_kp = $request->susunan_laporan_kp * 5;
        $isi_kp = $request->isi_laporan_kp * 10;
        $kualitas_kp = $request->kualitas_penulisan_kp * 5;

        $total = $sikap_kp + $topik_kp + $hasil_kp + $simulasi_kp + $pengujian_kp + $bermanfaat_kp + $kejelasan_kp + $susunan_kp + $isi_kp + $kualitas_kp;

        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'judul' => $request->judul,
            'sikap_kp' => $sikap_kp,
            'mampu_menjelaskan_topik_kp' => $topik_kp,
            'mampu_menjelaskan_hasil_kp' => $hasil_kp,
            'simulasi_produk_kp' => $simulasi_kp,
            'pengujian_produk_kp' => $pengujian_kp,
            'produk_bermanfaat_kp' => $bermanfaat_kp,
            'kejelasan_proses_kp' => $kejelasan_kp,
            'susunan_laporan_kp' => $susunan_kp,
            'isi_laporan_kp' => $isi_kp,
            'kualitas_penulisan_kp' => $kualitas_kp,
            'total_nilai_kp' => $total,
            'status_sidang_kp' => $request->status_sidang_kp,
        ]);

        return redirect()->back()->with('success', 'Data Ketua Penguji berhasil diperbarui.');
    }
     public function editPembimbing1($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('dosen_pembimbing.penilaian.editbimbingan1', compact('mahasiswa'));
    }
     public function editPembimbing2($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('dosen_pembimbing.penilaian.editbimbingan2', compact('mahasiswa'));
    }

    public function editKetuaPenguji($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('dosen_pembimbing.penilaian.editketuapenguji', compact('mahasiswa'));
    }
    public function editPenguji1($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('dosen_pembimbing.penilaian.editpenguji1', compact('mahasiswa'));
    }
    public function editPenguji2($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('dosen_pembimbing.penilaian.editpenguji2', compact('mahasiswa'));
    }
    public function indexPenguji(){
        $user = Auth::user()->id;
        $daftartabel1 = PenilaianTugasAkhir::where('ketua_penguji_id', $user)
                    ->get();
        $daftartabel2 = PenilaianTugasAkhir::where('penguji1_id', $user)
                    ->get();
        $daftartabel3 = PenilaianTugasAkhir::where('penguji2_id', $user)
                    ->get();            
        return view('dosen_pembimbing.penilaian.index', compact('daftartabel1','daftartabel2','daftartabel3'));
    }
    public function indexPembimbing(){
        $user = Auth::user()->id;
        $daftartabel1 = PenilaianTugasAkhir::where('dosbing1_id', $user)
                    ->get();
        $daftartabel2 = PenilaianTugasAkhir::where('dosbing2_id', $user)
                    ->get();
          
        return view('dosen_pembimbing.penilaian.indexPembimbing', compact('daftartabel1','daftartabel2'));
    }
    public function createPembimbing(){
         $mahasiswa = PendaftaranSidangTA::select('id', 'nama', 'nim', 'judul_skripsi')->get();
        return view('dosen_pembimbing.penilaian.bimbingan', compact('mahasiswa'));
    }
    public function createPenguji(){
         $mahasiswa = PendaftaranSidangTA::select('id', 'nama', 'nim', 'judul_skripsi')->get();
        return view('dosen_pembimbing.penilaian.ta', compact('mahasiswa'));
    }
    public function simpanKetuaPenguji(Request $request)
    {
        // Cek apakah sudah ada data Ketua Penguji untuk mahasiswa ini
        $user_id = Auth::user()->id;
        $total_nilai_kp = $request->sikap_kp*5 +
                    $request->mampu_menjelaskan_topik_kp*5 +
                    $request->mampu_menjelaskan_hasil_kp*15 +
                    $request->simulasi_produk_kp*20 +
                    $request->pengujian_produk_kp*10 +
                    $request->produk_bermanfaat_kp*15 +
                    $request->kejelasan_proses_kp*10 +
                    $request->susunan_laporan_kp*5 +
                    $request->isi_laporan_kp*10 +
                    $request->kualitas_penulisan_kp*5;
        $penilaian = PenilaianTugasAkhir::where('nim', $request->nim)
            ->first();
        if ($penilaian) {

            $nilaipenguji = $penilaian->total_nilai_kp + $penilaian->total_nilai_penguji1 + $penilaian->total_nilai_penguji2;
            $nilaipembimbing = $penilaian->total_score_pembimbing_p1 + $penilaian->total_score_pembimbing_p2;
            $totalscore = $nilaipenguji*0.75 + $nilaipembimbing*0.25;
            // Update data
            $penilaian->update([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'ketua_penguji_id' => $user_id,
                'judul' => $request->judul,
                'sikap_kp' => $request->sikap_kp*5,
                'mampu_menjelaskan_topik_kp' => $request->mampu_menjelaskan_topik_kp*5,
                'mampu_menjelaskan_hasil_kp' => $request->mampu_menjelaskan_hasil_kp*15,
                'simulasi_produk_kp' => $request->simulasi_produk_kp*20,
                'pengujian_produk_kp' => $request->pengujian_produk_kp*10,
                'produk_bermanfaat_kp' => $request->produk_bermanfaat_kp*15,
                'kejelasan_proses_kp' => $request->kejelasan_proses_kp*10,
                'susunan_laporan_kp' => $request->susunan_laporan_kp*5,
                'isi_laporan_kp' => $request->isi_laporan_kp*10,
                'kualitas_penulisan_kp' => $request->kualitas_penulisan_kp*5,
                'total_nilai_kp'=> $total_nilai_kp,
                'total_score_penguji'=> $nilaipenguji*0.75,
                'status_sidang_kp' => $request->status_sidang_kp,
                'total_score'=> $totalscore,
            ]);
        } else {
            // Buat baru
            PenilaianTugasAkhir::create([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'ketua_penguji_id' => $user_id,
                'nim' => $request->nim,
                'judul' => $request->judul,
                'sikap_kp' => $request->sikap_kp*5,
                'mampu_menjelaskan_topik_kp' => $request->mampu_menjelaskan_topik_kp*5,
                'mampu_menjelaskan_hasil_kp' => $request->mampu_menjelaskan_hasil_kp*15,
                'simulasi_produk_kp' => $request->simulasi_produk_kp*20,
                'pengujian_produk_kp' => $request->pengujian_produk_kp*10,
                'produk_bermanfaat_kp' => $request->produk_bermanfaat_kp*15,
                'kejelasan_proses_kp' => $request->kejelasan_proses_kp*10,
                'susunan_laporan_kp' => $request->susunan_laporan_kp*5,
                'isi_laporan_kp' => $request->isi_laporan_kp*10,
                'kualitas_penulisan_kp' => $request->kualitas_penulisan_kp*5,
                'total_nilai_kp'=> $total_nilai_kp,
                'status_sidang_kp' => $request->status_sidang_kp,
            ]);
        }
        return redirect()->back()->with('success', 'Data penilaian berhasil disimpan.');
    }
    public function simpanPenguji1(Request $request)
    {
        // Cek apakah sudah ada data Ketua Penguji untuk mahasiswa ini
        $user_id = Auth::user()->id;
        $total_nilai_p1 = $request->sikap_p1*5 +
                    $request->mampu_menjelaskan_topik_p1*5 +
                    $request->mampu_menjelaskan_hasil_p1*15 +
                    $request->simulasi_produk_p1*20 +
                    $request->pengujian_produk_p1*10 +
                    $request->produk_bermanfaat_p1*15 +
                    $request->kejelasan_proses_p1*10 +
                    $request->susunan_laporan_p1*5 +
                    $request->isi_laporan_p1*10 +
                    $request->kualitas_penulisan_p1*5;
        $penilaian = PenilaianTugasAkhir::where('nim', $request->nim)
            ->first();

       
        

        if ($penilaian) {

            $nilaipenguji = $penilaian->total_nilai_kp + $penilaian->total_nilai_penguji1 + $penilaian->total_nilai_penguji2;
            $nilaipembimbing = $penilaian->total_score_pembimbing_p1 + $penilaian->total_score_pembimbing_p2;
            $totalscore = $nilaipenguji*0.75 + $nilaipembimbing*0.25;
            // Update data
            $penilaian->update([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'penguji1_id' => $user_id,
                'judul' => $request->judul,
                'sikap_penguji1' => $request->sikap_p1*5,
                'mampu_menjelaskan_topik_penguji1' => $request->mampu_menjelaskan_topik_p1*5,
                'mampu_menjelaskan_hasil_penguji1' => $request->mampu_menjelaskan_hasil_p1*15,
                'simulasi_produk_penguji1' => $request->simulasi_produk_p1*20,
                'pengujian_produk_penguji1' => $request->pengujian_produk_p1*10,
                'produk_bermanfaat_penguji1' => $request->produk_bermanfaat_p1*15,
                'kejelasan_proses_penguji1' => $request->kejelasan_proses_p1*10,
                'susunan_laporan_penguji1' => $request->susunan_laporan_p1*5,
                'isi_laporan_penguji1' => $request->isi_laporan_p1*10,
                'kualitas_penulisan_penguji1' => $request->kualitas_penulisan_p1*5,
                'total_nilai_penguji1'=> $total_nilai_p1,
                'total_score_penguji'=> $nilaipenguji*0.75,
                'total_score'=> $totalscore,
            ]);
        } else {
            // Buat baru
            PenilaianTugasAkhir::create([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'penguji1_id' => $user_id,
                'nim' => $request->nim,
                'judul' => $request->judul,
                'sikap_penguji1' => $request->sikap_p1*5,
                'mampu_menjelaskan_topik_penguji1' => $request->mampu_menjelaskan_topik_p1*5,
                'mampu_menjelaskan_hasil_penguji1' => $request->mampu_menjelaskan_hasil_p1*15,
                'simulasi_produk_penguji1' => $request->simulasi_produk_p1*20,
                'pengujian_produk_penguji1' => $request->pengujian_produk_p1*10,
                'produk_bermanfaat_penguji1' => $request->produk_bermanfaat_p1*15,
                'kejelasan_proses_penguji1' => $request->kejelasan_proses_p1*10,
                'susunan_laporan_penguji1' => $request->susunan_laporan_p1*5,
                'isi_laporan_penguji1' => $request->isi_laporan_p1*10,
                'kualitas_penulisan_penguji1' => $request->kualitas_penulisan_p1*5,
                'total_nilai_penguji1'=> $total_nilai_p1,
            ]);
        }

        return redirect()->back()->with('success', 'Data penilaian berhasil disimpan.');
    }
    public function simpanPenguji2(Request $request)
    {
        // Cek apakah sudah ada data Ketua Penguji untuk mahasiswa ini
        $user_id = Auth::user()->id;
        $total_nilai_p2 = $request->sikap_p2*5 +
                    $request->mampu_menjelaskan_topik_p2*5 +
                    $request->mampu_menjelaskan_hasil_p2*15 +
                    $request->simulasi_produk_p2*20 +
                    $request->pengujian_produk_p2*10 +
                    $request->produk_bermanfaat_p2*15 +
                    $request->kejelasan_proses_p2*10 +
                    $request->susunan_laporan_p2*5 +
                    $request->isi_laporan_p2*10 +
                    $request->kualitas_penulisan_p2*5;
        $penilaian = PenilaianTugasAkhir::where('nim', $request->nim)
            ->first();
        if ($penilaian) {

            $nilaipenguji = $penilaian->total_nilai_kp + $penilaian->total_nilai_penguji1 + $penilaian->total_nilai_penguji2;
            $nilaipembimbing = $penilaian->total_score_pembimbing_p1 + $penilaian->total_score_pembimbing_p2;
            $totalscore = $nilaipenguji*0.75 + $nilaipembimbing*0.25;
            // Update data
            $penilaian->update([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'penguji2_id' => $user_id,
                'judul' => $request->judul,
                'sikap_penguji2' => $request->sikap_p2*5,
                'mampu_menjelaskan_topik_penguji2' => $request->mampu_menjelaskan_topik_p2*5,
                'mampu_menjelaskan_hasil_penguji2' => $request->mampu_menjelaskan_hasil_p2*15,
                'simulasi_produk_penguji2' => $request->simulasi_produk_p2*20,
                'pengujian_produk_penguji2' => $request->pengujian_produk_p2*10,
                'produk_bermanfaat_penguji2' => $request->produk_bermanfaat_p2*15,
                'kejelasan_proses_penguji2' => $request->kejelasan_proses_p2*10,
                'susunan_laporan_penguji2' => $request->susunan_laporan_p2*5,
                'isi_laporan_penguji2' => $request->isi_laporan_p2*10,
                'kualitas_penulisan_penguji2' => $request->kualitas_penulisan_p2*5,
                'total_nilai_penguji2'=> $total_nilai_p2,
                'total_score_penguji'=> $nilaipenguji*0.75,
                'total_score'=> $totalscore,
            ]);
        } else {
            // Buat baru
            PenilaianTugasAkhir::create([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'penguji2_id' => $user_id,
                'nim' => $request->nim,
                'judul' => $request->judul,
                'sikap_penguji2' => $request->sikap_p2*5,
                'mampu_menjelaskan_topik_penguji2' => $request->mampu_menjelaskan_topik_p2*5,
                'mampu_menjelaskan_hasil_penguji2' => $request->mampu_menjelaskan_hasil_p2*15,
                'simulasi_produk_penguji2' => $request->simulasi_produk_p2*20,
                'pengujian_produk_penguji2' => $request->pengujian_produk_p2*10,
                'produk_bermanfaat_penguji2' => $request->produk_bermanfaat_p2*15,
                'kejelasan_proses_penguji2' => $request->kejelasan_proses_p2*10,
                'susunan_laporan_penguji2' => $request->susunan_laporan_p2*5,
                'isi_laporan_penguji2' => $request->isi_laporan_p2*10,
                'kualitas_penulisan_penguji2' => $request->kualitas_penulisan_p2*5,
                'total_nilai_penguji2'=> $total_nilai_p2,
            ]);
        }
        return redirect()->back()->with('success', 'Data penilaian berhasil disimpan.');
    }
    public function simpanPembimbing1(Request $request)
    {
        $user_id = Auth::user()->id;
        $total_nilai_p1 = $request->pelaksanaan_bimbingan_p1*5 +
                    $request->daya_kritis_p1*10 +
                    $request->sikap_p1*5 +
                    $request->tujuan_utama_p1*5 +
                    $request->topik_penelitian_p1*15 +
                    $request->latar_belakang_p1*5+
                    $request->teori_p1*5 +
                    $request->desain_dan_perancangan_p1*15 +
                    $request->hasil_p1*5 +
                    $request->pengujian_p1*5 +
                    $request->hasil_penelitian_p1*15+
                    $request->kesimpulan_p1*5+
                    $request->saran_penelitian_p1*5;
             
        $penilaian = PenilaianTugasAkhir::where('nim', $request->nim)
            ->first();
        if ($penilaian) {
            $nilaipenguji = $penilaian->total_nilai_kp + $penilaian->total_nilai_penguji1 + $penilaian->total_nilai_penguji2;
            $nilaipembimbing = $penilaian->total_score_pembimbing_p1 + $penilaian->total_score_pembimbing_p2;
            $totalscore = $nilaipenguji*0.75 + $nilaipembimbing*0.25;
            // Update data
            $penilaian->update([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'dosbing1_id' => $user_id,
                'nim' => $request->nim,
                'judul' => $request->judul,
                'pelaksanaan_bimbingan_p1' => $request->pelaksanaan_bimbingan_p1*5,
                'daya_kritis_p1' => $request->daya_kritis_p1*10,
                'sikap_perilaku_p1' => $request->sikap_p1*5,
                'tujuan_utama_p1' => $request->tujuan_utama_p1*5 ,
                'topik_penelitian_p1' => $request->topik_penelitian_p1*15,
                'latar_belakang_p1' => $request->latar_belakang_p1*5,
                'teori_yang_dijelaskan_p1' => $request->teori_p1*5,
                'desain_dan_perancangan_p1' => $request->desain_dan_perancangan_p1*15,
                'hasil_p1' => $request->hasil_p1*5,
                'pengujian_p1' => $request->pengujian_p1*5,
                'kesimpulan_p1'=> $request->kesimpulan_p1*5,
                'hasil_penelitian_p1' => $request->hasil_penelitian_p1*15,
                'saran_penelitian_p1' => $request->saran_penelitian_p1*5,
                'total_score_pembimbing_p1'=> $total_nilai_p1,
                'total_score_pembimbing'=> $nilaipembimbing*0.25,
                'total_score'=> $totalscore,
            ]);
        } else {
            // Buat baru
            PenilaianTugasAkhir::create([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'dosbing1_id' => $user_id,
                'nim' => $request->nim,
                'judul' => $request->judul,
                'pelaksanaan_bimbingan_p1' => $request->pelaksanaan_bimbingan_p1*5,
                'daya_kritis_p1' => $request->daya_kritis_p1*10,
                'sikap_perilaku_p1' => $request->sikap_p1*5,
                'tujuan_utama_p1' => $request->tujuan_utama_p1*5 ,
                'topik_penelitian_p1' => $request->topik_penelitian_p1*15,
                'latar_belakang_p1' => $request->latar_belakang_p1*5,
                'teori_yang_dijelaskan_p1' => $request->teori_p1*5,
                'desain_dan_perancangan_p1' => $request->desain_dan_perancangan_p1*15,
                'hasil_p1' => $request->hasil_p1*5,
                'pengujian_p1' => $request->pengujian_p1*5,
                'kesimpulan_p1'=> $request->kesimpulan_p1*5,
                'hasil_penelitian_p1' => $request->hasil_penelitian_p1*15,
                'saran_penelitian_p1' => $request->saran_penelitian_p1*5,
                'total_score_pembimbing_p1'=> $total_nilai_p1,
            ]);
        }
        return redirect()->back()->with('success', 'Data penilaian berhasil disimpan.');
    }
    public function simpanPembimbing2(Request $request)
    {
        $user_id = Auth::user()->id;
        $total_nilai_p2 = $request->pelaksanaan_bimbingan_p2*5 +
                    $request->daya_kritis_p2*10 +
                    $request->sikap_p2*5 +
                    $request->tujuan_utama_p2*5 +
                    $request->topik_penelitian_p2*15 +
                    $request->latar_belakang_p2*5+
                    $request->teori_p2*5 +
                    $request->desain_dan_perancangan_p2*15 +
                    $request->hasil_p2*5 +
                    $request->pengujian_p2*5 +
                    $request->hasil_penelitian_p2*15+
                    $request->kesimpulan_p2*5+
                    $request->saran_penelitian_p2*5;
             
        $penilaian = PenilaianTugasAkhir::where('nim', $request->nim)
            ->first();
        if ($penilaian) {
            $nilaipenguji = $penilaian->total_nilai_kp + $penilaian->total_nilai_penguji1 + $penilaian->total_nilai_penguji2;
            $nilaipembimbing = $penilaian->total_score_pembimbing_p1 + $penilaian->total_score_pembimbing_p2;
            $totalscore = $nilaipenguji*0.75 + $nilaipembimbing*0.25;
            // Update data
            $penilaian->update([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'dosbing2_id' => $user_id,
                'nim' => $request->nim,
                'judul' => $request->judul,
                'pelaksanaan_bimbingan_p2' => $request->pelaksanaan_bimbingan_p2*5,
                'daya_kritis_p2' => $request->daya_kritis_p2*10,
                'sikap_perilaku_p2' => $request->sikap_p2*5,
                'tujuan_utama_p2' => $request->tujuan_utama_p2*5 ,
                'topik_penelitian_p2' => $request->topik_penelitian_p2*15,
                'latar_belakang_p2' => $request->latar_belakang_p2*5,
                'teori_yang_dijelaskan_p2' => $request->teori_p2*5,
                'desain_dan_perancangan_p2' => $request->desain_dan_perancangan_p2*15,
                'hasil_p2' => $request->hasil_p2*5,
                'pengujian_p2' => $request->pengujian_p2*5,
                'kesimpulan_p2'=> $request->kesimpulan_p2*5,
                'hasil_penelitian_p2' => $request->hasil_penelitian_p2*15,
                'saran_penelitian_p2' => $request->saran_penelitian_p2*5,
                'total_score_pembimbing_p2'=> $total_nilai_p2,
                'total_score'=> $totalscore,
                'total_score_pembimbing'=> $nilaipembimbing*0.25,        
            ]);
        } else {
            // Buat baru
            PenilaianTugasAkhir::create([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'dosbing2_id' => $user_id,
                'nim' => $request->nim,
                'judul' => $request->judul,
                'pelaksanaan_bimbingan_p2' => $request->pelaksanaan_bimbingan_p2*5,
                'daya_kritis_p2' => $request->daya_kritis_p2*10,
                'sikap_perilaku_p2' => $request->sikap_p2*5,
                'tujuan_utama_p2' => $request->tujuan_utama_p2*5 ,
                'topik_penelitian_p2' => $request->topik_penelitian_p2*15,
                'latar_belakang_p2' => $request->latar_belakang_p2*5,
                'teori_yang_dijelaskan_p2' => $request->teori_p2*5,
                'desain_dan_perancangan_p2' => $request->desain_dan_perancangan_p2*15,
                'hasil_p2' => $request->hasil_p2*5,
                'pengujian_p2' => $request->pengujian_p2*5,
                'kesimpulan_p2'=> $request->kesimpulan_p2*5,
                'hasil_penelitian_p2' => $request->hasil_penelitian_p2*15,
                'saran_penelitian_p2' => $request->saran_penelitian_p2*5,
                'total_score_pembimbing_p2'=> $total_nilai_p2,
            ]);
        }
        return redirect()->back()->with('success', 'Data penilaian berhasil disimpan.');
    }
}
