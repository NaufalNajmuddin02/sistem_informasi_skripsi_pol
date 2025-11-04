<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\admin\RuanganController;
use App\Http\Controllers\perpus\PerpusController;
use App\Http\Controllers\Admin\BatasWaktuController;
use App\Http\Controllers\admin\InfoTerbaruController;
// use App\Http\Controllers\dosen\management\CommentController;

use App\Http\Controllers\admin\role\UserRoleController;
use App\Http\Controllers\kaprodi\mapel\MapelController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\skpi\SKPIAdminController;
use App\Http\Controllers\dosen\DosenDashboardController;
use App\Http\Controllers\kaprodi\RekapSeminarController;
use App\Http\Controllers\kaprodi\seminar\DosenController;
use App\Http\Controllers\kaprodi\RekapBimbinganController;
use App\Http\Controllers\Admin\RekapSeminarAdminController;

use App\Http\Controllers\dosen\jadwal\ListJadwalController;
use App\Http\Controllers\kaprodi\JadwalTAKaprodiController;
use App\Http\Controllers\dosen\management\CommentController;
use App\Http\Controllers\kaprodi\KaprodiDashboardController;
use App\Http\Controllers\kaprodi\KategoriProposalController;
use App\Http\Controllers\admin\RekapBimbinganAdminController;
use App\Http\Controllers\admin\role\UserManagementController;
use App\Http\Controllers\admin\sidangta\PenilaianTAControler;
use App\Http\Controllers\mahasiswa\skripsi\SeminarController;
use App\Http\Controllers\admin\jadwal\YudisiumAdminController;
use App\Http\Controllers\mahasiswa\skripsi\ProposalController;
use App\Http\Controllers\admin\Skripsi\AdminValidasiController;

use App\Http\Controllers\mahasiswa\JadwalTAMahasiswaController;
use App\Http\Controllers\mahasiswa\surat\RekomendasiController;
use App\Http\Controllers\admin\sidangta\DataPesertaTAController;
use App\Http\Controllers\kaprodi\mapel\CommentKaprodiController;
use App\Http\Controllers\mahasiswa\MahasiswaDashboardController;
use App\Http\Controllers\admin\sidangta\JadwalSidangTAController;
use App\Http\Controllers\kaprodi\dosen_penilai\PenilaiController;
use App\Http\Controllers\kaprodi\JadwalYudisiumKaprodiController;
use App\Http\Controllers\kaprodi\mapel\ProposalKaprodiController;
use App\Http\Controllers\mahasiswa\skpi\SKPIMahasiswaController_;
use App\Http\Controllers\mahasiswa\jadwal\JadwalSeminarController;
use App\Http\Controllers\mahasiswa\jadwal\JadwalYudisiumController;
use App\Http\Controllers\mahasiswa\jadwal\JadwalBimbinganController;
use App\Http\Controllers\dosen\jadwal\JadwalBimbinganDosenController;
use App\Http\Controllers\admin\sidangta\PendaftaranSidangTAController;
use App\Http\Controllers\dosen_penilai\jadwal\JadwalPenilaiController;
use App\Http\Controllers\dosen_penilai\JadwalTADosenPenilaiController;

// use App\Http\Controllers\dosen\JadwalTADosenController;
use App\Http\Controllers\kaprodi\bimbingan\BimbinganKaprodiController;
use App\Http\Controllers\kaprodi\seminar\nilai\NilaiSeminarController;
use App\Http\Controllers\dosen\Management\ProposalManagementController;
use App\Http\Controllers\dosen_penilai\DosenPenilaiDashboardController;
use App\Http\Controllers\admin\dosen_mapel\PembagianMahasiswaController;
use App\Http\Controllers\dosen_pembimbing\bimbingan\BimbinganController;

use App\Http\Controllers\dosen_pembimbing\PembimbingDashboardController;
use App\Http\Controllers\kaprodi\datapesertata\PesertaSidangTAController;
use App\Http\Controllers\mahasiswa\BerkasAkhir\RevisiMahasiswaController;
use App\Http\Controllers\mahasiswa\pendaftaranta\PendaftaranTAController;
use App\Http\Controllers\dosen_penilai\seminar\PenilaianSeminarController;
use App\Http\Controllers\kaprodi\rekomendasi\KaprodiRekomendasiController;
use App\Http\Controllers\mahasiswa\bimbingan\BimbinganMahasiswaController;

use App\Http\Controllers\mahasiswa\bimbingan\PengajuanPembimbingController;
use App\Http\Controllers\dosen_pembimbing\JadwalTADosenPembimbingController;
use App\Http\Controllers\mahasiswa\skripsi\PengumpulanBerkasAkhirController;
use App\Http\Controllers\mahasiswa\validasipenguji\ValidasiSkripsiController;
use App\Http\Controllers\admin\dosen_penilai\PembagianRuanganPenilaiController;
use App\Http\Controllers\dosen_pembimbing\bimbingan\RekomendasiDosenController;
use App\Http\Controllers\kaprodi\seminar\jadwal\JadwalSeminarKaprodiController;

use App\Http\Controllers\kaprodi\penilaian\PenilaianTugasAkhirKaprodiController;
use App\Http\Controllers\dosen_penilai\validasi_skripsi\ValidasiPengujiController;
use App\Http\Controllers\kaprodi\validasi_skripsi\ValidasiSkripsiKaprodiController;
use App\Http\Controllers\admin\datarekomendasisidang\DataRekomendasiSidangController;

use App\Http\Controllers\dosen_pembimbing\penilaian_bimbingan\PenilaianBimbinganController;
use App\Http\Controllers\dosen_penilai\penilaian\PenilaianTugasAkhirDosenPenilaiController;
use App\Http\Controllers\dosen_pembimbing\validasi_skripsi\DosenPembimbingValidasiController;
use App\Http\Controllers\admin\aspekpenilaianbimbingan\AspekPenilaianBimbinganAdminController;
use App\Http\Controllers\admin\aspekpenilaiansidangta\AspekPenilaianSidangTAHKIAdminController;
use App\Http\Controllers\admin\aspekpenilaiansidangta\AspekPenilaianSidangTAIlmiahAdminController;
use App\Http\Controllers\admin\aspekpenilaiansidangta\AspekPenilaianSidangTASkripsiAdminController;
use App\Http\Controllers\dosen_pembimbing\validasi_skripsi_penguji\ValidasiSkripsiDospemController;
use App\Http\Controllers\admin\aspekpenilaianbimbingan\AspekPenilaianBimbinganIlmiahAdminController;
use App\Http\Controllers\admin\aspekpenilaianbimbingan\AspekPenilaianBimbinganSkripsiAdminController;
use App\Http\Controllers\admin\datakelulusansidangta\DataKelulusanSidangTaController;
use App\Http\Controllers\admin\datapesertasidangta\DataPesertaSidangTAController;
use App\Http\Controllers\kaprodi\validasi_skripsi_penguji\ValidasiSkripsiKaprodiController as Validasi_skripsi_pengujiValidasiSkripsiKaprodiController;

//auth
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('edit-profile');
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('update-profile');
Route::put('/profile/update-password', [AuthController::class, 'updatePassword'])->name('update-password');
Route::put('/profile/update-picture', [AuthController::class, 'updateProfilePicture'])->name('update-gambar-profile');


Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi', [NotificationController::class, 'store'])->name('notifikasi.store');
Route::get('/notifikasi/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifikasi.read');
Route::get('/notifikasi/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifikasi.markAllRead');
Route::get('/notifikasi/delete/{id}', [NotificationController::class, 'delete'])->name('notifikasi.delete');
Route::get('/notifikasi/delete-all', [NotificationController::class, 'deleteAll'])->name('notifikasi.deleteAll');


// Route untuk mahasiswa
// ==================== MAHASISWA ====================
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    //dashboard
    Route::get('/mahasiswa/dashboard', [MahasiswaDashboardController::class, 'index'])
    ->name('mahasiswa.dashboard');
    
    //Skripsi Mahasiswa(proposal)
    Route::get('/mahasiswa/pengajuan-proposal', [ProposalController::class, 'pengajuanproposal'])->name('pengajuan-proposal');
    Route::get('/mahasiswa/proposals/create', [ProposalController::class, 'formpengajuanproposal'])->name('create-proposal');
    Route::post('/mahasiswa/proposals', [ProposalController::class, 'store'])->name('proposals.store');
    Route::get('/mahasiswa/proposals/{id}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
    Route::put('/mahasiswa/proposals/{id}', [ProposalController::class, 'update'])->name('proposals.update');
    Route::delete('/mahasiswa/proposals/{id}', [ProposalController::class, 'destroy'])->name('proposals.destroy');

    //Skripsi mahasiswa(seminar)
    Route::get('/mahasiswa/pendaftaranseminarproposal',[SeminarController::class, 'pendaftaranseminarproposal'])->name('pendaftaran-seminar-proposal');
    Route::get('/mahasiswa/seminar/create',[SeminarController::class, 'formseminarproposal'])->name('create-seminar');
    Route::post('/mahasiswa/seminar', [SeminarController::class, 'store'])->name('seminar.store');
    Route::get('/mahasiswa/seminar/{id}/edit', [SeminarController::class, 'edit'])->name('seminar.edit');
    Route::put('/mahasiswa/seminar/{id}', [SeminarController::class, 'update'])->name('seminar.update');
    Route::delete('/mahasiswa/seminar/{id}', [SeminarController::class, 'destroy'])->name('seminar.destroy');
    Route::get('/mahasiswa/pengumpulanberkasskripsi',[PengumpulanBerkasAkhirController::class,'pengumpulanberkasSkripsi'])->name('berkas.skripsi');
    Route::get('/mahasiswa/lihatberkas',[PengumpulanBerkasAkhirController::class,'liatberkas'])->name('berkas.skripsi.lihat');
    Route::post('/mahasiswa/berkas-skripsi',[PengumpulanBerkasAkhirController::class,'store'])->name('berkas.skripsistore');
    Route::put('/berkas-skripsi/update-all/{id}', [PengumpulanBerkasAkhirController::class, 'updateAll'])->name('berkas.skripsi.update.all');


    //Skripsi mahasiswa (Berkas Akhir)
    Route::get('/mahasiswa/pengumpulanberkasakhir',[PengumpulanBerkasAkhirController::class,'pengumpulanberkasakhir'])->name('pengumpulan-berkas-akhir');

    //jadwal
    Route::get('/mahasiswa/jadwalbimbingan',[JadwalBimbinganController::class, 'index'])->name('bimbingan');
    Route::get('/mahasiswa/jadwalseminar',[JadwalSeminarController::class, 'jadwalseminar'])->name('jadwal-seminar-proposal');
    Route::get('/mahasiswa/jadwalyudisium',[JadwalYudisiumController::class, 'jadwalyudisium'])->name('jadwal-yudisium');
    Route::get('/mahasiswa/jadwalta',[JadwalTAMahasiswaController::class, 'index'])->name('jadwalta.mahasiswa');

    //bimbingan
    // Route::get('/mahasiswa/pembimbing',[PengajuanPembimbingController::class, 'pengajuanpembimbing'])->name('pengajuan-pembimbing');
    // Route::get('/mahasiswa/permohonanpembimbing',[PengajuanPembimbingController::class, 'view'])->name('create-pembimbing');
    // Route::get('/mahasiswa/bimbingan/create', [PengajuanPembimbingController::class, 'create'])->name('bimbingan.create');// Form Pengajuan
    // Route::post('/mahasiswa//bimbingans', [PengajuanPembimbingController::class, 'store'])->name('bimbingans.store');
    // Route::get('/mahasiswa/bimbingans/{id}/edit', [PengajuanPembimbingController::class, 'edit'])->name('bimbingans.edit');
    // Route::put('/mahasiswa/bimbingans/{id}', [PengajuanPembimbingController::class, 'update'])->name('bimbingans.update');
    // Route::delete('/mahasiswa/bimbingans/{id}', [PengajuanPembimbingController::class, 'destroy'])->name('bimbingans.destroy');
    Route::get('/mahasiswa/bimbingan-saya', [BimbinganMahasiswaController::class, 'index'])->name('bimbingan.index');
    Route::get('/mahasiswa/bimbingan/export/pdf', [BimbinganMahasiswaController::class, 'exportPDF'])->name('bimbingan.exportPdf');
    //rekomendasi
    Route::get('/surat-rekomendasi/{id}', [RekomendasiController::class, 'show'])->name('rekomendasi.show');
    
    Route::get('/rekomendasi/download/{id}', [RekomendasiController::class, 'download'])->name('rekomendasi.download');

    //route penfataranTA
    Route::get('/mahasiswa/pendaftaranTA/', [PendaftaranTAController::class, 'index'])->name('mahasiswa.pendaftaranTA');
    Route::post('/mahasiswa/pendaftaranTA/store', [PendaftaranTAController::class, 'store'])->name('berkas.store');
    Route::get('/mahasiswa/peersetujuan/', [PendaftaranTAController::class, 'indexLihatPersetujuan'])->name('mahasiswa.persetujuan');
    Route::get('/mahasiswa/pendaftaran/edit/{id}', [PendaftaranTAController::class, 'edit'])->name('mahasiswa.edit.pendaftaran');
    Route::put('/mahasiswa/pendaftaran/update/{id}', [PendaftaranTAController::class, 'update'])
    ->name('mahasiswa.update.pendaftaran');
    Route::get('/mahasiswa/skpi/', [SKPIMahasiswaController_::class, 'create'])->name('mahasiswa.skpi');
    Route::post('/skpi', [SKPIMahasiswaController_::class, 'store'])->name('mahasiswa.skpi.store');
    Route::get('/mahasiswa/skpi/edit', [SKPIMahasiswaController_::class, 'edit'])->name('mahasiswa.skpi.edit');
    Route::put('/mahasiswa/skpi/update', [SKPIMahasiswaController_::class, 'update'])->name('mahasiswa.skpi.update');
   // Arahkan halaman utama ke index dulu
    Route::get('/mahasiswa/validasi-berkas', [RevisiMahasiswaController::class, 'index'])->name('mahasiswa.berkas-akhir');
    Route::get('/mahasiswa/validasi-berkas/create', [RevisiMahasiswaController::class, 'create'])->name('mahasiswa.berkas-akhir.create');
    Route::post('/mahasiswa/validasi-berkas', [RevisiMahasiswaController::class, 'store'])->name('mahasiswa.berkas-akhir.store');
    Route::put('/mahasiswa/validasi-berkas/{id}', [RevisiMahasiswaController::class, 'update'])->name('mahasiswa.berkas-akhir.update');

    Route::get('/mahasiswa/validasi-skripsi-pembimbing', [ValidasiSkripsiController::class, 'create'])->name('mahasiswa.validasi-skripsi-penguji');
    Route::post('/mahasiswa/validasi-skripsi-pembimbing', [ValidasiSkripsiController::class, 'store'])->name('mahasiswa.validasi-skripsi-penguji.store');
    Route::put('/mahasiswa/berkas-akhir/update/{id}', [ValidasiSkripsiController::class, 'update'])->name('mahasiswa.berkas-akhir.update');

});


// Route untuk dosen
// ==================== DOSEN ====================
Route::middleware(['auth', 'role:dosen'])->group(function () {

    Route::get('/dosen/dashboard', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');

    Route::get('/dosen/management-proposal',[ProposalManagementController::class, 'index'])->name('management-proposal');
    Route::post('/dosen/proposal/update-status', [ProposalManagementController::class, 'updateStatus'])->name('proposal.updateStatus');
    // Route::post('/dosen/proposal/comment', [CommentController::class, 'store'])->name('proposal.comment');
    Route::post('/dosen/management/proposal/set-deadline', [ProposalManagementController::class, 'setDeadline'])->name('proposal.setDeadline');
    Route::post('/dosen/proposal/add-comment', [ProposalManagementController::class, 'addComment'])->name('proposal.addComment');
    Route::get('/dosen/semua-proposal', [ProposalManagementController::class, 'semuaProposal'])->name('proposal.all');
    Route::get('/dosen/proposal/export', [ProposalManagementController::class, 'export'])->name('proposal.export.dosen');
});

// Route untuk kaprodi
// ==================== KAPRODI ====================
Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::get('/kaprodi/dashboard', [KaprodiDashboardController::class, 'index'])->name('kaprodi.dashboard');

    //proposal 
    Route::get('/kaprodi/mapel', [MapelController::class, 'index'])->name('mapel.index');
    Route::get('/kaprodi/mapel/create', [MapelController::class, 'create'])->name('mapel.create');
    Route::post('/kaprodi/mapel/store', [MapelController::class, 'store'])->name('mapel.store');
    Route::get('/kaprodi/mapel/{id}/edit', [MapelController::class, 'edit'])->name('mapel.edit');
    // Route::post('/kaprodi/mapel/{id}/update', [MapelController::class, 'update'])->name('mapel.update');
    Route::put('/kaprodi/mapel/{id}/update', [MapelController::class, 'update'])->name('mapel.update');
    Route::post('/kaprodi/mapel/{id}/delete', [MapelController::class, 'destroy'])->name('mapel.delete');
    Route::get('/kaprodi/proposal', [ProposalKaprodiController::class, 'index'])->name('view');
    Route::post('/kaprodi/proposal/update', [ProposalKaprodiController::class, 'updateStatus'])->name('update');
    Route::post('/kaprodi/proposal/set-deadline', [ProposalKaprodiController::class, 'setDeadlinekaprodi'])->name('proposal.setDeadline.kaprodi');
    Route::post('/kaprodi/proposal/comment', [ProposalKaprodiController::class, 'addCommentkaprodi'])->name('proposal.addComment.kaprodi');
    Route::get('/kaprodi/semua-proposal', [ProposalKaprodiController::class, 'semuaProposalKaprodi'])->name('kaprodi.semua-proposal');
    // Route::post('/kaprodi/proposal/comment', [CommentKaprodiController::class, 'store'])->name('comment');
    Route::get('/kaprodi/proposal/export', [ProposalKaprodiController::class, 'export'])->name('proposal.export');


    Route::get('/kategori', [KategoriProposalController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriProposalController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriProposalController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriProposalController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriProposalController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriProposalController::class, 'destroy'])->name('kategori.destroy');

    //seminar
    Route::get('/kaprodi/menagementseminar/', [DosenController::class, 'index'])->name('kaprodi.seminar.index');
    // Route::post('/kaprodi/update-role', [DosenController::class, 'updateRole'])->name('update.role');
    // Route::post('/kaprodi/seminar/update-kapasitas', [DosenController::class, 'updateKapasitas'])->name('update.kapasitas');
    // routes/web.php
    Route::post('/kaprodi/bulk-update', [DosenController::class, 'bulkUpdate'])->name('kaprodi.bulkUpdate');

    Route::get('/kaprodi/seminar', [PenilaiController::class, 'view'])->name('kaprodi.seminar');
    Route::post('/kaprodi/seminar/assign', [PenilaiController::class, 'assignDosenPenilai'])->name('kaprodi.seminar.assign');

    // Penilaian seminar
    Route::get('/kaprodi/penilai', [NilaiSeminarController::class, 'index'])->name('kaprodi.seminar.penilai');
    // Route::post('/kaprodi/seminar/nilai/{id}', [NilaiSeminarController::class, 'nilai'])->name('kaprodi.seminar.nilai');
    Route::post('/kaprodi/seminar/{id}/penilaian', [NilaiSeminarController::class, 'store'])->name('penilaian.store.kaprodi');
    Route::post('/kaprodi/penilaian/update/{seminarId}', [NilaiSeminarController::class, 'update'])->name('penilaian.update.kaprodi');

    Route::get('/kaprodi/rekap-seminar', [RekapSeminarController::class, 'index'])->name('rekap.seminar');
    Route::get('/kaprodi/rekap-seminar/export', [RekapSeminarController::class, 'export'])->name('rekap.seminar.export');
    // Route::get('/kaprodi/rekap-seminar/export', [RekapSeminarController::class, 'exportCsv'])->name('rekap.seminar.export');

    // Jadwal seminar
    Route::get('/kaprodi/jadwal-seminar', [JadwalSeminarKaprodiController::class, 'index'])->name('kaprodi.jadwal.seminar');
    Route::get('/kaprodi/jalwal-ta', [JadwalTAKaprodiController::class, 'index'])->name('kaprodi.jadwalta');

    // Rute untuk melihat daftar seminar bimbingan
    Route::get('/kaprodi/bimbingan', [BimbinganKaprodiController::class, 'index'])->name('kaprodi.bimbingan.index');

    // Rute untuk halaman tambah bimbingan (form input)
    Route::get('/kaprodi/bimbingan/create/{seminarId}', [BimbinganKaprodiController::class, 'create'])->name('kaprodi.bimbingan.create');
    Route::get('/kaprodi/rekap', [BimbinganKaprodiController::class, 'rekap'])->name('kaprodi.bimbingan.rekap');
    // Rute untuk menyimpan data bimbingan
    Route::post('/kaprodi/bimbingan/store', [BimbinganKaprodiController::class, 'store'])->name('kaprodi.bimbingan.store');
    Route::get('/kaprodi/rekomendasi', [KaprodiRekomendasiController::class, 'index'])->name('kaprodi.rekomendasi.index');
    Route::post('/kaprodi/rekomendasi/store/{id}', [KaprodiRekomendasiController::class, 'store'])->name('kaprodi.rekomendasi.store');
    Route::get('/kaprodi/rekap-bimbingan', [RekapBimbinganController::class, 'index'])->name('rekap.bimbingan');
    Route::get('/kaprodi/rekap-bimbingan/export', [RekapBimbinganController::class, 'export'])->name('rekap.bimbingan.export');

    // PesetaSidangTA
    Route::get('/kaprodi/pesertasidangta',[PesertaSidangTAController::class, 'index'])->name('kaprodi.pesertasidang');
    Route::get('/kaprodi/datapesertasidang/create',[PesertaSidangTAController::class, 'create'])->name('kaprodi.create');
    Route::post('/kaprodi/datapesertasidang/store', [PesertaSidangTAController::class, 'store'])->name('kaprodi.datapesertasidang.store');
    Route::get('/kaprodi/datapesertasidang/{id}/edit', [PesertaSidangTAController::class, 'edit'])->name('kaprodi.datapesertasidang.edit');
    Route::delete('/kaprodi/datapesertasidang/{id}', [PesertaSidangTAController::class, 'destroy'])->name('kaprodi.datapesertasidang.destroy');
    Route::put('/kaprodi/datapesertasidang/{id}', [PesertaSidangTAController::class, 'update'])->name('kaprodi.datapesertasidang.update');

    // Penilaian
    Route::get('/kaprodi/penilaianTA', [PenilaianTugasAkhirKaprodiController::class, 'create'])->name('kaprodi.penilaianta');
    Route::get('/kaprodi/penilaianBimbingan', [PenilaianTugasAkhirKaprodiController::class, 'createPembimbing'])->name('kaprodi.penilaianbimbingan');
    Route::post('/kaprodi/penilaiTAMahasiswaKetuaPenguji', [PenilaianTugasAkhirKaprodiController::class, 'simpanKetuaPenguji'])->name('penilaian.ketua');
    Route::post('/kaprodi/penilaiTAMahasiswaPenguji1', [PenilaianTugasAkhirKaprodiController::class, 'simpanPenguji1'])->name('penilaian.penguji1');
    Route::post('/kaprodi/penilaiTAMahasiswaPenguji2', [PenilaianTugasAkhirKaprodiController::class, 'simpanPenguji2'])->name('penilaian.penguji2');
    Route::post('/kaprodi/penilaiTAMahasiswaPembimbing1', [PenilaianTugasAkhirKaprodiController::class, 'simpanPembimbing1'])->name('penilaian.pembimbing1');
    Route::post('/kaprodi/penilaiTAMahasiswaPembimbing2', [PenilaianTugasAkhirKaprodiController::class, 'simpanPembimbing2'])->name('penilaian.pembimbing2');
    Route::post('/kaprodi/penilaian/store', [PenilaianTugasAkhirKaprodiController::class,'store'])->name('penilaian.store.bimbingan.kaprodi');
    Route::get('/kaprodi/penilaian/kriteria/bimbingan', [PenilaianTugasAkhirKaprodiController::class,'getKriteria'])
    ->name('penilaian.getKriteria.bimbingan.kaprodi');

    //
    Route::get('/kaprodi/daftarnilaita',[PenilaianTugasAkhirKaprodiController::class, 'indexPenguji'])->name('kaprodi.daftarpenilaian');
    Route::get('/kaprodi-penilaian/ketua/{id}', [PenilaianTugasAkhirKaprodiController::class, 'editKetuaPEnguji'])->name('kaprodi.penilaian.ketua.edit');
    Route::put('/kaprodi-penilaian/update-ketua-penguji/{id}', [PenilaianTugasAkhirKaprodiController::class, 'updateKetuaPenguji'])->name('penilaian.updateKetuaPenguji');
    Route::get('/kaprodi-penilaian/penguji1/{id}', [PenilaianTugasAkhirKaprodiController::class, 'editPEnguji1'])->name('kaprodi.penilaian.penguji1.edit');
    Route::put('/kaprodi-penilaian/update-penguji1/{id}', [PenilaianTugasAkhirKaprodiController::class, 'updatePenguji1'])->name('penilaian.updatePenguji1');
    Route::get('/kaprodi-penilaian/penguji2/{id}', [PenilaianTugasAkhirKaprodiController::class, 'editPEnguji2'])->name('kaprodi.penilaian.penguji2.edit');
    Route::put('/kaprodi-penilaian/update-penguji2/{id}', [PenilaianTugasAkhirKaprodiController::class, 'updatePenguji2'])->name('penilaian.updatePenguji2');
    Route::get('/kaprodi/daftarnilaipembimbing',[PenilaianTugasAkhirKaprodiController::class, 'indexPembimbing'])->name('kaprodi.daftarnilaipembimbing');
    Route::get('/kaprodi-penilaian/pembimbing1/{id}', [PenilaianTugasAkhirKaprodiController::class, 'editPembimbing1'])->name('kaprodi.penilaian.penguji1.edit');
    Route::put('/kaprodi-penilaian/update-pembimbing-1/{id}', [PenilaianTugasAkhirKaprodiController::class, 'updatePembimbing1'])->name('penilaian.updatepembimbing1');
    Route::get('/kaprodi-penilaian/pembimbing2/{id}', [PenilaianTugasAkhirKaprodiController::class, 'editPembimbing2'])->name('kaprodi.penilaian.penguji2.edit');
    Route::put('/kaprodi-penilaian/update-pembimbing-2/{id}', [PenilaianTugasAkhirKaprodiController::class, 'updatePembimbing2'])->name('penilaian.updatepembimbing2');

    Route::post('/kaprodi/penilaian/simpan', [PenilaianTugasAkhirKaprodiController::class, 'simpan'])->name('penilaian.simpan.sidang.kaprodi');
    Route::get('/kaprodi/penilaian/kriteria/sidang', [PenilaianTugasAkhirKaprodiController::class,'getKriteriaPenguji'])
    ->name('penilaian.kriteria.sidang.kaprodi');

    Route::get('/kaprodi/jadwal-yudisium-create', [JadwalYudisiumKaprodiController::class, 'create'])->name('yudisium.create');
    Route::get('/kaprodi/jadwal-yudisium', [JadwalYudisiumKaprodiController::class, 'index'])->name('yudisium.index');
    Route::post('/kaprodi/jadwal-yudisium-post', [JadwalYudisiumKaprodiController::class, 'store'])->name('yudisium.store');
    // Tampilkan form edit
    Route::get('/kaprodi/jadwal-yudisium/{id}/edit', [JadwalYudisiumKaprodiController::class, 'edit'])->name('yudisium.edit');
    Route::put('/kaprodi/jadwal-yudisium/{id}', [JadwalYudisiumKaprodiController::class, 'update'])->name('yudisium.update');

    // Proses hapus data
    Route::delete('/kaprodi/jadwal-yudisium/{id}', [JadwalYudisiumKaprodiController::class, 'destroy'])->name('yudisium.destroy');

    Route::get('/kaprodi/validasi-skripsi', [ValidasiSkripsiKaprodiController::class, 'indexDospem1'])->name('kaprodi.validasi.index');
    Route::post('/kaprodi/validasi-skripsi/{id}/approve', [ValidasiSkripsiKaprodiController::class, 'approveDospem1'])->name('kaprodi.validasi.approve');
    Route::get('/kaprodi/validasi-skripsi/pembimbing2', [ValidasiSkripsiKaprodiController::class, 'indexDospem2'])->name('kaprodi.validasi.pembimbing2');
    Route::post('/kaprodi/validasi-skripsi/pembimbing2/{id}/approve', [ValidasiSkripsiKaprodiController::class, 'approveDospem2'])->name('kaprodi.validasi.pembimbing2.approve');

    Route::post('/kaprodi/validasi/{id}/{field}', [Validasi_skripsi_pengujiValidasiSkripsiKaprodiController::class, 'approve'])->name('kaprodi.validasi.approve');
    Route::get('/kaprodi/validasi', [Validasi_skripsi_pengujiValidasiSkripsiKaprodiController::class, 'index'])->name('kaprodi.validasi.index');
});

// Route untuk admin
// ==================== ADMIN ====================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // mapel
    Route::get('/admin/dosen_mapel', [PembagianMahasiswaController::class, 'index'])->name('dosen_mapel.index');
    Route::post('/admin/pembagian/store', [PembagianMahasiswaController::class, 'store'])->name('pembagian.store');
    Route::get('/admin/get-mahasiswa', [PembagianMahasiswaController::class, 'getMahasiswa'])->name('get.mahasiswa');

    //seminar
    Route::get('/admin/seminar', [PembagianRuanganPenilaiController::class, 'index'])->name('admin.seminar');
    Route::post('/admin/seminar/update-jadwal/{id}', [PembagianRuanganPenilaiController::class, 'updateJadwal'])->name('seminar.updateJadwal');
    Route::post('/admin/seminar/{id}/reschedule', [PembagianRuanganPenilaiController::class, 'setReschedule'])->name('seminar.reschedule');
    Route::get('/admin/batas-waktu', [BatasWaktuController::class, 'index'])->name('admin.batas.index');
    Route::post('/admin/batas-waktu', [BatasWaktuController::class, 'store'])->name('admin.batas.store');
    Route::get('/admin/rekap-seminar', [RekapSeminarAdminController::class, 'index'])->name('rekap.seminar.admin');
    Route::get('/admin/rekap-seminar/export', [RekapSeminarAdminController::class, 'export'])->name('rekap.seminar.export.admin');
    
    // rekap bimbingan
    Route::get('/admin/rekap-bimbingan', [RekapBimbinganAdminController::class, 'index'])->name('rekap.bimbingan.admin');
    Route::get('/admin/rekap-bimbingan/export', [RekapBimbinganAdminController::class, 'export'])->name('rekap.bimbingan.export.admin');

    //datarekoendasi
    Route::get('/admin/datarekomendasi', [DataRekomendasiSidangController::class, 'index'])->name('admin.rekomendasi.data');
    Route::get('/admin/datapesertasidangta/data', [DataPesertaSidangTAController::class, 'index'])->name('admin.test.data');
    Route::get('/admin/sidangta/kelulusan', [DataKelulusanSidangTaController::class, 'index'])->name('sidangta.kelulusan');


    

    //role
    Route::get('/admin/users', [UserRoleController::class, 'index'])->name('users.index');
    Route::post('/admin/users/{user}/update-role', [UserRoleController::class, 'updateRole'])->name('users.updateRole');
    Route::post('/admin/users/bulk-update-role', [UserRoleController::class, 'bulkUpdateRole'])->name('users.bulkUpdateRole');

    // Data ruangan
    Route::get('/admin/ruangan', [RuanganController::class, 'index'])->name('data.ruangan.index');
    Route::get('/admin/ruangan/create', [RuanganController::class, 'create'])->name('data.ruangan.create');
    Route::post('/admin/ruangan', [RuanganController::class, 'store'])->name('data.ruangan.store');
    Route::get('/admin/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('data.ruangan.edit');
    Route::put('/admin/ruangan/{id}', [RuanganController::class, 'update'])->name('data.ruangan.update');
    Route::delete('/admin/ruangan/{id}', [RuanganController::class, 'destroy'])->name('data.ruangan.destroy');
    //user
    Route::get('/admin/data', [UserManagementController::class, 'index'])->name('data.index');
    Route::get('/admin/data/{id}/edit', [UserManagementController::class, 'edit'])->name('data.edit');
    Route::put('/admin/data/{id}', [UserManagementController::class, 'update'])->name('data.update');
    Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('data.create');
    Route::post('/admin/create/users', [UserManagementController::class, 'store'])->name('data.store');

    //pendaftaransidangta
    Route::get('/admin/sidang-ta', [PendaftaranSidangTAController::class, 'index'])->name('admin.sidangta.index');
    Route::get('/admin/sidang-ta/{id}/edit', [PendaftaranSidangTAController::class, 'edit'])->name('admin.sidangta.edit');
    Route::put('/admin/sidang-ta/{id}', [PendaftaranSidangTAController::class, 'update'])->name('admin.sidangta.update');
    Route::get('/admin/pesertata', [DataPesertaTAController::class, 'index'])->name('admin.datapesertata');

    //jadwal ta
    Route::get('/admin/jadwalta', [JadwalSidangTAController::class, 'index'])->name('admin.jadwalta');
    Route::get('/admin/jadwalta/create', [JadwalSidangTAController::class, 'create'])->name('admin.jadwalta.create');
    Route::post('/admin/jadwal-sidang/store', [JadwalSidangTAController::class, 'store'])->name('jadwal.sidangta.store');
    Route::get('/admin/jadwalta/{id}/edit', [JadwalSidangTAController::class, 'edit'])->name('admin.jadwalta.edit');
    Route::put('/admin/jadwalta/{id}', [JadwalSidangTAController::class, 'update'])->name('admin.jadwalta.update');
    Route::delete('/admin/jadwalta/{id}', [JadwalSidangTAController::class, 'destroy'])->name('admin.jadwalta.destroy');
    // Route::get('/kaprodi/pendaftaran-ta/{userId}', [KaprodiController::class, 'getPendaftaranTA']);
    Route::get('/admin/datapesertasidang/get-pendaftaran-ta/{userId}', [PesertaSidangTAController::class, 'getPendaftaranTA']);

    Route::get('/admin/jadwal-yudisium',[YudisiumAdminController::class,'index'])->name('yudisium.index.admin');


    //daftarnilaita
    Route::get('/admin/datanilaita',[PenilaianTAControler::class, 'index'])->name('admin.daftarnilaita');
    Route::delete('/admin/delete-nilai/{id}',[PenilaianTAControler::class, 'destroy'])->name('admin.destroy-nilai-ta');

    //SKPI
    Route::get('/admin/skpi', [SKPIAdminController::class, 'index'])->name('admin.skpi.index');
    Route::get('/admin/skpi/{id}/edit', [SKPIAdminController::class, 'edit'])->name('admin.skpi.edit');
    Route::put('/admin/skpi/{id}', [SKPIAdminController::class, 'update'])->name('admin.skpi.update');
    Route::delete('/admin/skpi/{id}', [SKPIAdminController::class, 'destroy'])->name('admin.skpi.destroy');
    Route::get('/admin/info-terbaru', [InfoTerbaruController::class, 'index'])->name('infoTerbaru.index');
    Route::get('/admin/info-terbaru/create', [InfoTerbaruController::class, 'create'])->name('infoTerbaru.create');
    Route::post('/admin/info-terbaru/store', [InfoTerbaruController::class, 'store'])->name('infoTerbaru.store');
    Route::get('/admin/info-terbaru/{id}/edit', [InfoTerbaruController::class, 'edit'])->name('infoTerbaru.edit');
    Route::put('/admin/info-terbaru/{id}', [InfoTerbaruController::class, 'update'])->name('infoTerbaru.update');
    Route::delete('/admin/info-terbaru/{id}', [InfoTerbaruController::class, 'destroy'])->name('infoTerbaru.destroy');
    Route::get('/admin/validasi-skripsi', [AdminValidasiController::class, 'index'])->name('admin.validasi.index');

       // INDEX (tabel daftar aspek penilaian)
    Route::get('/penilaian-bimbingan/create', [AspekPenilaianBimbinganAdminController::class, 'create'])->name('penilaian.hki.create');
    Route::post('/penilaian-bimbingan', [AspekPenilaianBimbinganAdminController::class, 'store'])->name('penilaian.hki.store');
    Route::get('/penilaian-bimbingan/{id}/edit', [AspekPenilaianBimbinganAdminController::class, 'edit'])->name('penilaian.hki.edit');
    Route::put('/penilaian-bimbingan/{id}', [AspekPenilaianBimbinganAdminController::class, 'update'])->name('penilaian.hki.update');
    Route::delete('/penilaian-bimbingan/{id}', [AspekPenilaianBimbinganAdminController::class, 'destroy'])->name('penilaian.hki.destroy');
  
Route::get('/admin/aspek-penilaian', [AspekPenilaianBimbinganAdminController::class, 'index'])->name('penilaian.hki.index');
    

    //aspek penilaian skripsi
    Route::get('/penilaian-bimbingan-skripsi/create', [AspekPenilaianBimbinganSkripsiAdminController::class, 'create'])->name('penilaian.skripsi.create');
    Route::post('/penilaian-bimbingan-skripsi', [AspekPenilaianBimbinganSkripsiAdminController::class, 'store'])->name('penilaian.skripsi.store');
    Route::get('/penilaian-bimbingan-skripsi/{id}/edit', [AspekPenilaianBimbinganSkripsiAdminController::class, 'edit'])->name('penilaian.skripsi.edit');
    Route::put('/penilaian-bimbingan-skripsi/{id}', [AspekPenilaianBimbinganSkripsiAdminController::class, 'update'])->name('penilaian.skripsi.update');
    Route::delete('/penilaian-bimbingan-skripsi/{id}', [AspekPenilaianBimbinganSkripsiAdminController::class, 'destroy'])->name('penilaian.skripsi.destroy');

    Route::get('/penilaian-bimbingan-ilmiah/create', [AspekPenilaianBimbinganIlmiahAdminController::class, 'create'])->name('penilaian.ilmiah.create');
    Route::post('/penilaian-bimbingan-ilmiah', [AspekPenilaianBimbinganIlmiahAdminController::class, 'store'])->name('penilaian.ilmiah.store');
    Route::get('/penilaian-bimbingan-ilmiah/{id}/edit', [AspekPenilaianBimbinganIlmiahAdminController::class, 'edit'])->name('penilaian.ilmiah.edit');
    Route::put('/penilaian-bimbingan-ilmiah/{id}', [AspekPenilaianBimbinganIlmiahAdminController::class, 'update'])->name('penilaian.ilmiah.update');
    Route::delete('/penilaian-bimbingan-ilmiah/{id}', [AspekPenilaianBimbinganIlmiahAdminController::class, 'destroy'])->name('penilaian.ilmiah.destroy');

    Route::get('/penilaian-sidang-hki/create', [AspekPenilaianSidangTAHKIAdminController::class, 'create'])->name('penilaian.sidang.hki.create');
    Route::post('/penilaian-sidang-hki', [AspekPenilaianSidangTAHKIAdminController::class, 'store'])->name('penilaian.sidang.hki.store');
    Route::get('/penilaian-sidang-hki/{id}/edit', [AspekPenilaianSidangTAHKIAdminController::class, 'edit'])->name('penilaian.sidang.hki.edit');
    Route::put('/penilaian-sidang-hki/{id}', [AspekPenilaianSidangTAHKIAdminController::class, 'update'])->name('penilaian.sidang.hki.update');
    Route::delete('/penilaian-sidang-hki/{id}', [AspekPenilaianSidangTAHKIAdminController::class, 'destroy'])->name('penilaian.sidang.hki.destroy');

    Route::get('/penilaian-sidang-skripsi/create', [AspekPenilaianSidangTASkripsiAdminController::class, 'create'])->name('penilaian.sidang.skripsi.create');
    Route::post('/penilaian-sidang-skripsi', [AspekPenilaianSidangTASkripsiAdminController::class, 'store'])->name('penilaian.sidang.skripsi.store');
    Route::get('/penilaian-sidang-skripsi/{id}/edit', [AspekPenilaianSidangTASkripsiAdminController::class, 'edit'])->name('penilaian.sidang.skripsi.edit');
    Route::put('/penilaian-sidang-skripsi/{id}', [AspekPenilaianSidangTASkripsiAdminController::class, 'update'])->name('penilaian.sidang.skripsi.update');
    Route::delete('/penilaian-sidang-skripsi/{id}', [AspekPenilaianSidangTASkripsiAdminController::class, 'destroy'])->name('penilaian.sidang.skripsi.destroy');

     Route::get('/penilaian-sidang-ilmiah/create', [AspekPenilaianSidangTAIlmiahAdminController::class, 'create'])->name('penilaian.sidang.ilmiah.create');
    Route::post('/penilaian-sidang-ilmiah', [AspekPenilaianSidangTAIlmiahAdminController::class, 'store'])->name('penilaian.sidang.ilmiah.store');
    Route::get('/penilaian-sidang-ilmiah/{id}/edit', [AspekPenilaianSidangTAIlmiahAdminController::class, 'edit'])->name('penilaian.sidang.ilmiah.edit');
    Route::put('/penilaian-sidang-ilmiah/{id}', [AspekPenilaianSidangTAIlmiahAdminController::class, 'update'])->name('penilaian.sidang.ilmiah.update');
    Route::delete('/penilaian-sidang-ilmiah/{id}', [AspekPenilaianSidangTAIlmiahAdminController::class, 'destroy'])->name('penilaian.sidang.ilmiah.destroy');


});


// Route untuk dosen_penilai
// ==================== DOSEN PENILAI ====================
Route::middleware(['auth', 'role:dosen_penilai'])->group(function () {
    Route::get('/dosen_penilai/dashboard', [DosenPenilaiDashboardController::class, 'index'])->name('dosen_penilai.dashboard');

    // Penilaian seminar
    Route::get('/dosen_penilai/penilai', [PenilaianSeminarController::class, 'index'])->name('dosen.seminar.penilai');
    Route::post('/seminar/{id}/penilaian', [PenilaianSeminarController::class, 'store'])->name('penilaian.store');
    Route::post('/penilaian/update/{seminarId}', [PenilaianSeminarController::class, 'update'])->name('penilaian.update');
    // Route::post('/dosen-penilai/seminar/nilai/{id}', [PenilaianSeminarController::class, 'nilai'])->name('dosen.seminar.nilai');
    
    // Jadwal seminar
    Route::get('/jadwal-penilai', [JadwalPenilaiController::class, 'index'])->name('dosen.jadwal.seminar');
    Route::get('/dosen-penilai/jadwalta', [JadwalTADosenPenilaiController::class, 'index'])->name('dosen-penilai.jadwalta');

    // PenilaianTA
    Route::get('/dosen-penilai/TAPenilaian', [PenilaianTugasAkhirDosenPenilaiController::class, 'create'])->name('dosen-penilai.penilaiantapenguji');
    Route::get('/dosen-penilai/TAPembimbingPenilaian', [PenilaianTugasAkhirDosenPenilaiController::class, 'createPembimbing'])->name('dosen-penilai.penilaiantapembimbing');
    Route::post('/dosen-penilai/penilaiTAMahasiswaKetuaPenguji', [PenilaianTugasAkhirDosenPenilaiController::class, 'simpanKetuaPenguji'])->name('dosen-penilai.ketua');
    Route::post('/dosen-penilai/penilaiTAMahasiswaPenguji1', [PenilaianTugasAkhirDosenPenilaiController::class, 'simpanPenguji1'])->name('dosen-penilai.penguji1');
    Route::post('/dosen-penilai/penilaiTAMahasiswaPenguji2', [PenilaianTugasAkhirDosenPenilaiController::class, 'simpanPenguji2'])->name('dosen-penilai.penguji2');
    Route::post('/dosen-penilai/penilaiTAMahasiswaPembimbing1', [PenilaianTugasAkhirDosenPenilaiController::class, 'simpanPembimbing1'])->name('dosen-penilai.pembimbing1');
    Route::post('/dosen-penilai/penilaiTAMahasiswaPembimbing2', [PenilaianTugasAkhirDosenPenilaiController::class, 'simpanPembimbing2'])->name('dosen-penilai.pembimbing2');
    Route::post('/dosen-penilai/simpan', [PenilaianTugasAkhirDosenPenilaiController::class, 'simpan'])->name('penilaian.simpan.sidangpenilai');
    Route::get('/dosen-penilai/kriteria', [PenilaianTugasAkhirDosenPenilaiController::class, 'getKriteria'])->name('penilaian.kriteria.sidangpenilai');


    Route::get('/dosen-penilai/daftarnilaipenguji',[PenilaianTugasAkhirDosenPenilaiController::class, 'indexPenguji'])->name('dosen-penilai.daftarpenilaian');
    Route::get('/dosen-penilai/daftarnilaipembimbing',[PenilaianTugasAkhirDosenPenilaiController::class, 'indexPembimbing'])->name('dosen-penilai.daftarpenilaianpembimbing');
    Route::get('/dosen-penilai/ketua/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'editKetuaPEnguji'])->name('dosen-penilai.penilaian.ketua.edit');
    Route::put('/dosen-penilai/update-ketua-penguji/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'updateKetuaPenguji'])->name('dosen-penilai.updateKetuaPenguji');
    Route::get('/dosen-penilain/penguji1/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'editPEnguji1'])->name('dosen-penilai.penilaian.penguji1.edit');
    Route::put('/dosen-penilai/update-penguji1/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'updatePenguji1'])->name('dosen-penilai.updatePenguji1');
    Route::get('/dosen-penilai/penguji2/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'editPEnguji2'])->name('dosen-penilai.penilaian.penguji2.edit');
    Route::put('/dosen-penilai/update-penguji2/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'updatePenguji2'])->name('dosen-penilai.updatePenguji2');
    Route::get('/dosen-penilai/pembimbing1/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'editPembimbing1'])->name('dosen-penilai.penilaian.penguji1.edit');
    Route::put('/dosen-penilai/update-pembimbing-1/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'updatePembimbing1'])->name('dosen-penilai.updatepembimbing1');
    Route::get('/dosen-penilai/pembimbing2/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'editPembimbing2'])->name('dosen-penilai.penilaian.penguji2.edit');
    Route::put('/dosen-penilai/update-pembimbing-2/{id}', [PenilaianTugasAkhirDosenPenilaiController::class, 'updatePembimbing2'])->name('dosen-penilai.updatepembimbing2');

    Route::post('/dosen-penilai/validasi/{id}/{field}', [ValidasiPengujiController::class, 'approve'])->name('dosen-penilai.validasi.approve');
    Route::get('/dosen-penilai/validasi', [ValidasiPengujiController::class, 'index'])->name('dosen-penilai.validasi.index');


});

// Route untuk dosen_pembimbing
//  ==================== DOSEN PEMBIMBING ====================
Route::middleware(['auth', 'role:dosen_pembimbing'])->group(function () {
    Route::get('/dosen_pembimbing/dashboard', [PembimbingDashboardController::class, 'index'])->name('dosen_pembimbing.dashboard');

    // Rute untuk melihat daftar seminar bimbingan
    Route::get('/dosen-pembimbing/bimbingan', [BimbinganController::class, 'index'])->name('dosen-pembimbing.bimbingan.index');

    // Rute untuk halaman tambah bimbingan (form input)
    Route::get('/dosen-pembimbing/bimbingan/create/{seminarId}', [BimbinganController::class, 'create'])->name('dosen-pembimbing.bimbingan.create');

    // Rute untuk menyimpan data bimbingan
    Route::post('/bimbingan/store', [BimbinganController::class, 'store'])->name('bimbingan.store');
    Route::get('/dosen-pembimbing/rekap', [BimbinganController::class, 'rekap'])->name('pembimbing.bimbingan.rekap');
    Route::get('/rekomendasi', [RekomendasiDosenController::class, 'index'])->name('rekomendasi.index');
    Route::post('/rekomendasi/store/{id}', [RekomendasiDosenController::class, 'store'])->name('rekomendasi.store');
    //jadwal
    Route::get('/dosen-pembimbing/jadwalta', [JadwalTADosenPembimbingController::class, 'index'])->name('dosen-pembimbing-ta');

    //penilaian
    Route::get('/penilaian/get/{mahasiswa}/{peran}', [PenilaianBimbinganController::class, 'getPenilaian']);
    Route::put('/penilaian/update/{mahasiswaId}', [PenilaianBimbinganController::class, 'update'])->name('penilaian.update.bimbingan');
    Route::get('/dosen-pembimbing/penilaian', [PenilaianBimbinganController::class,'createPembimbing'])->name('penilaian.index');
    Route::get('/dosen-pembimbing/penilaian/kriteria', [PenilaianBimbinganController::class,'getKriteria'])->name('penilaian.getKriteria');
    Route::post('/dosen-pembimbing/penilaian/store', [PenilaianBimbinganController::class,'store'])->name('penilaian.store');
    Route::get('/dosen-pembimbing/penilaianpenguji',[PenilaianBimbinganController::class, 'createPenguji'])->name('dosen-pembimbing.penilaian');
    Route::post('/dosen-pembimbing/penilaiTAMahasiswaKetuaPenguji', [PenilaianBimbinganController::class, 'simpanKetuaPenguji'])->name('dosen-pembimbing.ketua');
    Route::post('/dosen-pembimbing/penilaiTAMahasiswaPenguji1', [PenilaianBimbinganController::class, 'simpanPenguji1'])->name('dosen-pembimbing.penguji1');
    Route::post('/dosen-pembimbing/penilaiTAMahasiswaPenguji2', [PenilaianBimbinganController::class, 'simpanPenguji2'])->name('dosen-pembimbing.penguji2');
    Route::post('/dosen-pembimbing/penilaiTAMahasiswaPembimbing1', [PenilaianBimbinganController::class, 'simpanPembimbing1'])->name('dosen-pembimbing.pembimbing1');
    Route::post('/dosen-pembimbing/penilaiTAMahasiswaPembimbing2', [PenilaianBimbinganController::class, 'simpanPembimbing2'])->name('dosen-pembimbing.pembimbing2');
    Route::get('/dosen-pembimbing/daftarnilaipenguji',[PenilaianBimbinganController::class, 'indexPenguji'])->name('dosen-pembimbing.daftarpenilaian');
    Route::get('/dosen-pembimbing/daftarnilaipembimbing',[PenilaianBimbinganController::class, 'indexPembimbing'])->name('dosen-pembimbing.daftarpenilaianpembimbing');
    // route/web.php
    Route::get('/get-kriteria-edit/{penilaianId}', [PenilaianBimbinganController::class, 'getKriteriaEdit'])->name('penilaian.getKriteriaEdit');
    
    Route::get('/dosen-pembimbing/ketua/{id}', [PenilaianBimbinganController::class, 'editKetuaPEnguji'])->name('dosen-pembimbing.penilaian.ketua.edit');
    Route::put('/dosen-pembimbing/update-ketua-penguji/{id}', [PenilaianBimbinganController::class, 'updateKetuaPenguji'])->name('dosen-pembimbing.updateKetuaPenguji');
    Route::get('/dosen-pembimbing/penguji1/{id}', [PenilaianBimbinganController::class, 'editPEnguji1'])->name('dosen-pembimbing.penilaian.penguji1.edit');
    Route::put('/dosen-pembimbing/update-penguji1/{id}', [PenilaianBimbinganController::class, 'updatePenguji1'])->name('dosen-pembimbing.updatePenguji1');
    Route::get('/dosen-pembimbing/penguji2/{id}', [PenilaianBimbinganController::class, 'editPEnguji2'])->name('dosen-pembimbing.penilaian.penguji2.edit');
    Route::put('/dosen-pembimbing/update-penguji2/{id}', [PenilaianBimbinganController::class, 'updatePenguji2'])->name('dosen-pembimbing.updatePenguji2');
     Route::get('/dosen-pembimbing/pembimbing1/{id}', [PenilaianBimbinganController::class, 'editPembimbing1'])->name('dosen-pembimbing.pembimbing.penguji1.edit');
    Route::put('/dosen-pembimbing/update-pembimbing-1/{id}', [PenilaianBimbinganController::class, 'updatePembimbing1'])->name('dosen-pembimbing.updatepembimbing1');
    Route::get('/dosen-pembimbing/pembimbing2/{id}', [PenilaianBimbinganController::class, 'editPembimbing2'])->name('dosen-pembimbing.pembimbing.penguji2.edit');
    Route::put('/dosen-pembimbing/update-pembimbing-2/{id}', [PenilaianBimbinganController::class, 'updatePembimbing2'])->name('dosen-pembimbing.updatepembimbing2');

    Route::get('/validasi-skripsi', [DosenPembimbingValidasiController::class, 'index'])->name('dosen.validasi.index');
    Route::post('/validasi-skripsi/{id}/approve', [DosenPembimbingValidasiController::class, 'approve'])->name('dosen.validasi.approve');
    Route::get('/validasi-skripsi/pembimbing-2', [DosenPembimbingValidasiController::class, 'indexDospem2'])->name('dosen.validasi.dospem2.index');
    Route::post('/validasi-skripsi/pembimbing-2/{id}/approve', [DosenPembimbingValidasiController::class, 'approveDospem2'])->name('dosen.validasi.dospem2.approve');

    Route::post('/dosen-pembimbing/validasi/{id}/{field}', [ValidasiSkripsiDospemController::class, 'approve'])->name('dosen-pembimbing.validasi.approve');
    Route::get('/dosen-pembimbing/validasi', [ValidasiSkripsiDospemController::class, 'index'])->name('dosen-pembimbing.validasi.index');

});

// web.php atau api.php
Route::get('/get-data-pendaftaran/{nim}', [PesertaSidangTAController::class, 'getPendaftaranByNIM']);
Route::get('/get-peserta-ta/{userId}', [JadwalSidangTAController::class, 'getPesertaTA'])->name('get.peserta.ta');


Route::middleware(['auth', 'role:perpus'])->group(function () {
    Route::get('/perpus/dashboard', [PerpusController::class, 'dashboard'])->name('perpus.dashboard');
    Route::get('/perpus/daftarberkas', [PerpusController::class, 'index'])->name('perpus.index');
    Route::put('/berkas-perpus/update-all/{id}', [PerpusController::class, 'updateAll'])->name('perpus.skripsi.update.all');
});




