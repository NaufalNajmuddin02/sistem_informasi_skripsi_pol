<?php

namespace App\Http\Controllers\mahasiswa\bimbingan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Bimbingan;
use App\Models\Seminar;
use App\Models\User;
use PDF;

class BimbinganMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil nama dosen pembimbing dari seminar
        $seminar = Seminar::where('user_id', $user->id)->first();
        $dosen1 = $seminar->dosen_penilai_1_nama ?? '';
        $dosen2 = $seminar->dosen_penilai_2_nama ?? '';

        // Ambil nama dosen dari request jika ada filter
        $filterDosen = $request->get('dosen');

        $query = Bimbingan::where('nama_mahasiswa', $user->username);

        if ($filterDosen) {
            $query->where('nama_dosen', $filterDosen);
        }

        $bimbingans = $query->get();

        return view('mahasiswa.bimbingan.index', compact('bimbingans', 'dosen1', 'dosen2', 'filterDosen','seminar'));
    }


    public function exportPDF()
    {
        ini_set('max_execution_time', 60); // cukup jika view sudah optimal

        $user = Auth::user();
        $seminar = Seminar::where('user_id', $user->id)->first();

        // Default values
        $namaPembimbing = '-';
        $pembimbingKe = '-';
        $nipyPembimbing = '-';
        $dosen = null;

        if ($seminar->dosen_penilai_1_nama) {
            $namaPembimbing = $seminar->dosen_penilai_1_nama;
            $pembimbingKe = 'I';
            $dosen = User::where('username', $seminar->dosen_penilai_1_nama)->first();
        } elseif ($seminar->dosen_penilai_2_nama) {
            $namaPembimbing = $seminar->dosen_penilai_2_nama;
            $pembimbingKe = 'II';
            $dosen = User::where('username', $seminar->dosen_penilai_2_nama)->first();
        }

        if (!empty($dosen)) {
            $nipyPembimbing = $dosen->nim ?? '-';
        }

        $bimbingans = Bimbingan::where('nama_mahasiswa', $user->username)
                        ->orderBy('tanggal_bimbingan', 'asc')
                        ->get();

        foreach ($bimbingans as $b) {
            $b->tanggal_format = \Carbon\Carbon::parse($b->tanggal_bimbingan)->translatedFormat('d F Y');
        }

        // Load logo as base64
        $path = public_path('images/image.png');
        $logoBase64 = '';
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        $pdf = PDF::loadView('mahasiswa.bimbingan.pdf', compact(
            'bimbingans',
            'user',
            'seminar',
            'namaPembimbing',
            'pembimbingKe',
            'nipyPembimbing',
            'logoBase64'
        ));

        return $pdf->download('lembar_bimbingan_' . $user->username . '.pdf');
    }
}
