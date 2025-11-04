<?php

namespace App\Http\Controllers\kaprodi\penilaian;

use App\Models\User;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\admin\JadwalTAModel;
use App\Models\PendaftaranSidangTA;
use App\Models\PenilaianTugasAkhir;
use App\Http\Controllers\Controller;
use App\Models\PenilaianSidangTAHKI;
use Illuminate\Support\Facades\Auth;
use App\Models\PenilaianBimbinganHKI;
use App\Models\PenilaianDosenPenilai;
use App\Models\PenilaianSidangTAIlmiah;
use App\Models\PenilaianBimbinganIlmiah;
use App\Models\PenilaianDosenPembimbing;
use App\Models\PenilaianSidangTASkripsi;
use App\Models\PenilaianBimbinganSkripsi;

class PenilaianTugasAkhirKaprodiController extends Controller
{
    //

    public function updatePembimbing2(Request $request, $id)
    {
        

        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        $penilaian = PenilaianTugasAkhir::where('nim', $request->nim)
            ->first();
        $nilaipenguji = $penilaian->total_nilai_kp + $penilaian->total_nilai_penguji1 + $penilaian->total_nilai_penguji2;
        $nilaipembimbing = $penilaian->total_score_pembimbing_p1 + $penilaian->total_score_pembimbing_p2;
        $totalscore = $nilaipenguji*0.75 + $nilaipembimbing*0.25;

        // Konversi nilai input (skor 1–5) ke skor berbobot sesuai ketentuan
        $user_id = Auth::user()->id;
        $total_nilai_p2 = $request->pelaksanaan_bimbingan_p1*5 +
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
                    


        $mahasiswa->update([
               'nama_mahasiswa' => $request->nama_mahasiswa,
                'dosbing1_id' => $user_id,
                'nim' => $request->nim,
                'judul' => $request->judul,
                'pelaksanaan_bimbingan_p2' => $request->pelaksanaan_bimbingan_p1*5,
                'daya_kritis_p2' => $request->daya_kritis_p1*10,
                'sikap_perilaku_p2' => $request->sikap_p1*5,
                'tujuan_utama_p2' => $request->tujuan_utama_p1*5 ,
                'topik_penelitian_p2' => $request->topik_penelitian_p1*15,
                'latar_belakang_p2' => $request->latar_belakang_p1*5,
                'teori_yang_dijelaskan_p2' => $request->teori_p1*5,
                'desain_dan_perancangan_p2' => $request->desain_dan_perancangan_p1*15,
                'hasil_p2' => $request->hasil_p1*5,
                'pengujian_p2' => $request->pengujian_p1*5,
                'kesimpulan_p2'=> $request->kesimpulan_p1*5,
                'hasil_penelitian_p2' => $request->hasil_penelitian_p1*15,
                'saran_penelitian_p2' => $request->saran_penelitian_p1*5,
                'total_score_pembimbing_p2'=> $total_nilai_p2,
                'total_score_pembimbing'=> $nilaipembimbing*0.25,
                'total_score'=> $totalscore,
          
        ]);

        return redirect()->back()->with('success', 'Data Ketua Penguji berhasil diperbarui.');
    }
    public function updatePembimbing1(Request $request, $id)
    {
        

        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        $penilaian = PenilaianTugasAkhir::where('nim', $request->nim)
            ->first();
        $nilaipenguji = $penilaian->total_nilai_kp + $penilaian->total_nilai_penguji1 + $penilaian->total_nilai_penguji2;
            $nilaipembimbing = $penilaian->total_score_pembimbing_p1 + $penilaian->total_score_pembimbing_p2;
            $totalscore = $nilaipenguji*0.75 + $nilaipembimbing*0.25;

        // Konversi nilai input (skor 1–5) ke skor berbobot sesuai ketentuan
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
                    


        $mahasiswa->update([
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

        return redirect()->back()->with('success', 'Data Ketua Penguji berhasil diperbarui.');
    }
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
        return view('kaprodi.penilaian.editbimbingan1', compact('mahasiswa'));
    }
     public function editPembimbing2($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('kaprodi.penilaian.editbimbingan2', compact('mahasiswa'));
    }

    public function editKetuaPenguji($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('kaprodi.penilaian.editketuapenguji', compact('mahasiswa'));
    }
    public function editPenguji1($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('kaprodi.penilaian.editpenguji1', compact('mahasiswa'));
    }
     public function editPenguji2($id)
    {
        $mahasiswa = PenilaianTugasAkhir::findOrFail($id);
        return view('kaprodi.penilaian.editpenguji2', compact('mahasiswa'));
    }
    public function indexPenguji(){
        $user = Auth::user()->id;
        $daftartabel1 = PenilaianTugasAkhir::where('ketua_penguji_id', $user)
                    ->get();
        $daftartabel2 = PenilaianTugasAkhir::where('penguji1_id', $user)
                    ->get();
        $daftartabel3 = PenilaianTugasAkhir::where('penguji2_id', $user)
                    ->get();            
        return view('kaprodi.penilaian.index', compact('daftartabel1','daftartabel2','daftartabel3'));
    }
    public function indexPembimbing(){
        $user = Auth::user()->id;
        $daftartabel1 = PenilaianTugasAkhir::where('dosbing1_id', $user)
                    ->get();
        $daftartabel2 = PenilaianTugasAkhir::where('dosbing2_id', $user)
                    ->get();
          
        return view('kaprodi.penilaian.indexPembimbing', compact('daftartabel1','daftartabel2'));
    }
    public function create(){
         $dosenId = Auth::id();

        $ketuaPenguji = JadwalTAModel::with(['user', 'penilaian'])
            ->select(
                'jadwal_ta.*',

                // ambil langsung total_ketua biar bisa dipakai di Blade
                DB::raw('COALESCE(pen.total_ketua,0) as total_ketua'),

                // Dosen pembimbing
                DB::raw('COALESCE(pdp.total_dosbing1,0) as total_dosbing1'),
                DB::raw('COALESCE(pdp.total_dosbing2,0) as total_dosbing2'),
                DB::raw('COALESCE(pdp.total_dosbing1,0)/5 as nilai_dosbing1'),
                DB::raw('COALESCE(pdp.total_dosbing2,0)/5 as nilai_dosbing2'),

                // rata-rata dosbing * 0.25
                DB::raw('((COALESCE(pdp.total_dosbing1,0)/5 + COALESCE(pdp.total_dosbing2,0)/5) / 2) * 0.25 as nilai_pembimbing_final'),

                // Dosen penguji
                DB::raw('COALESCE(pen.total_ketua,0)/5 as nilai_ketua'),
                DB::raw('COALESCE(pen.total_penguji1,0)/5 as nilai_penguji1'),
                DB::raw('COALESCE(pen.total_penguji2,0)/5 as nilai_penguji2'),

                // rata-rata penguji * 0.75
                DB::raw('((COALESCE(pen.total_ketua,0)/5 + COALESCE(pen.total_penguji1,0)/5 + COALESCE(pen.total_penguji2,0)/5) / 3) * 0.75 as nilai_penguji_final'),

                // nilai akhir gabungan
                DB::raw('
                    (((COALESCE(pen.total_ketua,0)/5 + COALESCE(pen.total_penguji1,0)/5 + COALESCE(pen.total_penguji2,0)/5) / 3) * 0.75)
                    +
                    (((COALESCE(pdp.total_dosbing1,0)/5 + COALESCE(pdp.total_dosbing2,0)/5) / 2) * 0.25)
                as nilai_akhir')
            )
            ->leftJoin('penilaian_dosen_penilai as pen', 'jadwal_ta.user_id', '=', 'pen.mahasiswa_id')
            ->leftJoin('penilaian_dosen_pembimbing as pdp', 'jadwal_ta.user_id', '=', 'pdp.mahasiswa_id')
            ->where('jadwal_ta.ketua_penguji_id', $dosenId)
            ->get();


        $penguji1 = JadwalTAModel::with(['user', 'penilaian'])
            ->select(
                'jadwal_ta.*',
                DB::raw('COALESCE(penilaian_dosen_penilai.total_ketua,0) as total_ketua'),
                DB::raw('COALESCE(penilaian_dosen_penilai.total_penguji1,0) as total_penguji1'),
                DB::raw('COALESCE(penilaian_dosen_penilai.total_penguji2,0) as total_penguji2'),
                DB::raw('COALESCE(penilaian_dosen_penilai.total_ketua,0) 
                    + COALESCE(penilaian_dosen_penilai.total_penguji1,0) 
                    + COALESCE(penilaian_dosen_penilai.total_penguji2,0) as total_nilai')
            )
            ->leftJoin('penilaian_dosen_penilai', 'jadwal_ta.user_id', '=', 'penilaian_dosen_penilai.mahasiswa_id')
            ->where('jadwal_ta.penguji1_id', $dosenId)
            ->get();

        $penguji2 = JadwalTAModel::with(['user', 'penilaian'])
            ->select(
                'jadwal_ta.*',
                DB::raw('COALESCE(penilaian_dosen_penilai.total_ketua,0) as total_ketua'),
                DB::raw('COALESCE(penilaian_dosen_penilai.total_penguji1,0) as total_penguji1'),
                DB::raw('COALESCE(penilaian_dosen_penilai.total_penguji2,0) as total_penguji2'),
                DB::raw('COALESCE(penilaian_dosen_penilai.total_ketua,0) 
                    + COALESCE(penilaian_dosen_penilai.total_penguji1,0) 
                    + COALESCE(penilaian_dosen_penilai.total_penguji2,0) as total_nilai')
            )
            ->leftJoin('penilaian_dosen_penilai', 'jadwal_ta.user_id', '=', 'penilaian_dosen_penilai.mahasiswa_id')
            ->where('jadwal_ta.penguji2_id', $dosenId)
            ->get();
            return view('kaprodi.penilaian.ta', compact('ketuaPenguji','penguji1','penguji2'));
    }
    public function createPembimbing(){
        $dosenId = auth()->id();

        $mahasiswaPembimbing1 = Seminar::with('mahasiswa')
            ->leftJoin('penilaian_dosen_pembimbing as pdp', 'seminars.user_id', '=', 'pdp.mahasiswa_id')
            ->where('seminars.dosen_penilai_1', $dosenId)
            ->select(
                'seminars.*',
                'pdp.total_dosbing1'
            )
            ->get();

        $mahasiswaPembimbing2 = Seminar::with('mahasiswa')
            ->leftJoin('penilaian_dosen_pembimbing as pdp', 'seminars.user_id', '=', 'pdp.mahasiswa_id')
            ->where('seminars.dosen_penilai_2', $dosenId)
            ->select(
                'seminars.*',
                'pdp.total_dosbing2'
            )
            ->get();

        $penilaian = PenilaianDosenPembimbing::whereIn('mahasiswa_id', 
        $mahasiswaPembimbing1->pluck('mahasiswa_id'))->get();

        // default kriteria (HKI)
        $kriteria = PenilaianBimbinganHKI::select('id','kriteria','bobot')->orderBy('id')->get();
        return view('kaprodi.penilaian.bimbingan',compact('dosenId','mahasiswaPembimbing1','mahasiswaPembimbing2','kriteria'));
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
        $mahasiswa = PendaftaranSidangTA::all();
        
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
    public function getKriteriaPenguji(Request $request)
    {
        $jenis = $request->jenis;
        switch ($jenis) {
            case 'skripsi':
                $kriteria = PenilaianSidangTASkripsi::all();
                break;
            case 'ilmiah':
                $kriteria = PenilaianSidangTAIlmiah::all();
                break;
            default:
                $kriteria = PenilaianSidangTAHKI::all();
        }
        return response()->json($kriteria);
    }

    public function store(Request $request)
    {
        $dosenId = auth()->id();
        $mahasiswaId = $request->mahasiswa_id;
        $peran = $request->peran_pembimbing;

        // ambil array nilai & bobot
        $nilaiInput = $request->input('nilai', []);   // contoh: [3, 4, 5]
        $bobotInput = $request->input('bobot', []);   // contoh: [20, 15, 10]

        $penilaian = PenilaianDosenPembimbing::firstOrNew([
            'mahasiswa_id' => $mahasiswaId,
        ]);

        $total = 0;
        $i = 1;

        foreach ($nilaiInput as $kritId => $nilai) {
            $bobot = $bobotInput[$kritId] ?? 0;
            $nilaiDenganBobot = $nilai * $bobot;

            if ($peran == 1) {
                $penilaian->dosbing1_id = $dosenId;
                $penilaian->{"nilai{$i}_dosbing1"} = $nilaiDenganBobot;
            } else {
                $penilaian->dosbing2_id = $dosenId;
                $penilaian->{"nilai{$i}_dosbing2"} = $nilaiDenganBobot;
            }

            $total += $nilaiDenganBobot;
            $i++;
        }

        // Simpan total sesuai pembimbing
        if ($peran == 1) {
            $penilaian->total_dosbing1 = $total;
        } else {
            $penilaian->total_dosbing2 = $total;
        }

        // Jika kedua dosen sudah isi, hitung rata-rata
        if ($penilaian->total_dosbing1 && $penilaian->total_dosbing2) {
            $penilaian->rata_rata = ($penilaian->total_dosbing1 + $penilaian->total_dosbing2) / 2;
        }

        $penilaian->save();

        return back()->with('success', 'Penilaian berhasil disimpan.');
    }
    public function getKriteria(Request $request)
    {
        $jenis = $request->jenis;
        if($jenis === 'hki'){
            $data = PenilaianSidangTAHKI::all();
        } elseif($jenis === 'ilmiah'){
            $data = PenilaianSidangTAIlmiah::all();
        } else {
            $data = PenilaianSidangTASkripsi::all();
        }

        return response()->json($data);
    }
    public function simpan(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:users,id',
            'peran_penguji' => 'required|in:1,2,3',
            'nilai' => 'required|array',
        ]);

         $penilaian = PenilaianDosenPenilai::firstOrNew([
        'mahasiswa_id' => $request->mahasiswa_id,
    ]);

        $total = 0;

        foreach ($request->nilai as $i => $val) {
            $index = $i + 1;
            $bobot = $request->bobot[$i] ?? 1; // default 1 kalau tidak ada

            // hasil perhitungan nilai x bobot
            $hasil = $val * $bobot;

            $kolom = match ($request->peran_penguji) {
                '1' => "nilai{$index}_ketua",
                '2' => "nilai{$index}_penguji1",
                '3' => "nilai{$index}_penguji2",
            };

            $penilaian->$kolom = $hasil;
            $total += $hasil;
        }

        // Simpan total & dosen penguji yang menilai
        if ($request->peran_penguji == 1) {
            $penilaian->total_ketua = $total;
            $penilaian->ketua_penguji_id = auth()->id();

            if ($request->filled('status_kelulusan')) {
                $penilaian->status = $request->status_kelulusan;
            }
        } elseif ($request->peran_penguji == 2) {
            $penilaian->total_penguji1 = $total;
            $penilaian->penguji1_id = auth()->id();
        } else {
            $penilaian->total_penguji2 = $total;
            $penilaian->penguji2_id = auth()->id();
        }

        $penilaian->save();

        return back()->with('success', 'Nilai berhasil disimpan.');
    }
}
