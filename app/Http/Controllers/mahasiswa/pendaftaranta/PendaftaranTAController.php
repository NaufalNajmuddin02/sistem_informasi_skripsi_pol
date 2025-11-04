<?php

namespace App\Http\Controllers\mahasiswa\pendaftaranta;

use App\Http\Controllers\Controller;
use App\Models\kaprodi\DataPesertaTAModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PendaftaranSidangTA;
use App\Models\Seminar;
use App\Models\User;

class PendaftaranTAController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user();
        $data = PendaftaranSidangTA::where('nim', $mahasiswa->nim)->first();

        $seminar = Seminar::where('user_id', $mahasiswa->id)->first();

        // Ambil semua dosen (kalau tetap ingin pakai <select>)
        $dosenList = User::where('role', 'dosen')->get();

        return view('mahasiswa.pendaftaranta.index', compact('seminar', 'dosenList','data'));
    }
   public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|unique:table_pendaftaran_t_a,nim',
            'nama' => 'required|string',
            'judul_skripsi' => 'required|string',
            'email' => 'required|email',
            'nomor_wa' => 'required|string',
            'jenis_laporan' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'nik_ktp' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'asal_slta' => 'required|string',
            'ukuran_toga' => 'required|string',
            'pembimbing_1' => 'nullable|string',
            'pembimbing_2' => 'nullable|string',
            'tema_skripsi' => 'required|string',
            'hasil_plagiasi' => 'required|file|mimes:pdf|max:2048',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'skor_toefl' => 'required|file|mimes:pdf|max:2048',
            'ijazah_sma' => 'required|file|mimes:pdf|max:2048',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_rekomendasi' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $fileFields = [
            'hasil_plagiasi',
            'bukti_pembayaran',
            'skor_toefl',
            'ijazah_sma',
            'ktp',
            'kk',
            'surat_rekomendasi'
            
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/uploads', $filename);
                $validatedData[$field] = str_replace('public/', 'storage/', $path);
            }
        }

        // Mapping pembimbing
        $validatedData['nama_pembimbing_1'] = $validatedData['pembimbing_1'] ?? null;
        $validatedData['nama_pembimbing_2'] = $validatedData['pembimbing_2'] ?? null;
        unset($validatedData['pembimbing_1'], $validatedData['pembimbing_2']);

        // Simpan ke database
        PendaftaranSidangTA::create($validatedData);

        return redirect()->back()->with('success', 'Pendaftaran berhasil disimpan!');
    }
    public function indexLihatPersetujuan()
    {
        $nim = Auth::user()->nim;
        $data = PendaftaranSidangTA::where('nim', $nim)->first();
        return view('mahasiswa.pendaftaranta.lihatpertsetujuan', compact('data'));
    }
    public function edit($id)
    {
        $datapesertasidang = DataPesertaTAModel::find($id); // contoh
        $users = User::all();
        $dosenList = User::all();
        $nim = Auth::user()->nim;
        $data = PendaftaranSidangTA::where('nim', $nim)->first();
        
        return view('mahasiswa.pendaftaranta.edit', compact('datapesertasidang', 'users', 'dosenList','data'));
    }
    public function update(Request $request, $id)
    {
        $data = PendaftaranSidangTA::findOrFail($id);

        if ($data->nim !== Auth::user()->nim) {
            abort(403, 'Anda tidak diizinkan mengedit data ini.');
        }

        $validatedData = $request->validate([
            'email' => 'required|email',
            'judul_skripsi' => 'required|string',
            'nomor_wa' => 'required|string',
            'jenis_laporan' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'nik_ktp' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'asal_slta' => 'required|string',
            'ukuran_toga' => 'required|string',
            'pembimbing_1' => 'nullable|string',
            'pembimbing_2' => 'nullable|string',
            'tema_skripsi' => 'required|string',
            'hasil_plagiasi' => 'sometimes|file|mimes:pdf|max:2048',
            'bukti_pembayaran' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'skor_toefl' => 'sometimes|file|mimes:pdf|max:2048',
            'ijazah_sma' => 'sometimes|file|mimes:pdf|max:2048',
            'ktp' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_rekomendasi' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $fileFields = [
            'hasil_plagiasi',
            'bukti_pembayaran',
            'skor_toefl',
            'ijazah_sma',
            'ktp',
            'kk',
            'surat_rekomendasi'

        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($data->$field) {
                    $oldFile = str_replace('storage/', 'public/', $data->$field);
                    Storage::delete($oldFile);
                }
                
                // Upload file baru
                $path = $request->file($field)->store('public/uploads');
                $validatedData[$field] = str_replace('public/', 'storage/', $path);
            } else {
                // Pertahankan file lama
                $validatedData[$field] = $data->$field;
            }
        }

        $validatedData['nama_pembimbing_1'] = $validatedData['pembimbing_1'] ?? null;
        $validatedData['nama_pembimbing_2'] = $validatedData['pembimbing_2'] ?? null;
        unset($validatedData['pembimbing_1'], $validatedData['pembimbing_2']);

        $data->update($validatedData);

        return redirect()->route('mahasiswa.persetujuan')->with('success', 'Data berhasil diperbarui!');
    }
}