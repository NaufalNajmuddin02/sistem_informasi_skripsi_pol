<?php

namespace App\Http\Controllers\admin\sidangta;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSidangTA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranSidangTAController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Data mahasiswa yang sudah daftar
        $query = DB::table('table_pendaftaran_t_a');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                ->orWhere('nim', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        $pendaftars = $query->paginate(10);

        // Data mahasiswa yang BELUM daftar
        $sudahDaftarNIM = DB::table('table_pendaftaran_t_a')->pluck('nim');

        $belumDaftar = DB::table('users')
            ->where('role', 'mahasiswa')
            ->whereNotIn('nim', $sudahDaftarNIM)
            ->select('nim', 'username as nama', 'no_hp') // sesuaikan kolom
            ->paginate(10); // gunakan paginate

        return view('admin.sidangta.index', compact('pendaftars', 'search', 'belumDaftar'));
    }



    public function edit($id) 
    {
        $pendaftar = PendaftaranSidangTA::findOrFail($id);
        return view('admin.sidangta.edit', compact('pendaftar'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_hasil_plagiasi' => 'required',
            'status_bukti_pembayaran' => 'required',
            'status_skor_toefl' => 'required',
            'status_ijazah_sma' => 'required',
            'status_ktp' => 'required',
            'status_kk' => 'required',
            'status_surat_rekomendasi' => 'required',
            
        ]);

        $pendaftar = PendaftaranSidangTA::findOrFail($id);
        $pendaftar->update($validated);

        return redirect()->route('admin.sidangta.index')->with('success', 'Data berhasil diperbarui');
    }

}
