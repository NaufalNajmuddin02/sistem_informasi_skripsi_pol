<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi data input
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'nim' => 'required|string|unique:users,nim|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan user ke database
        User::create([
            'username' => $request->username,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi data
        $request->validate([
            'nim' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        // Cari user berdasarkan NIM
        $user = User::where('nim', $request->nim)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            // Login berhasil
            Auth::login($user);
    
            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            } elseif ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            } elseif ($user->role === 'kaprodi'){
                return redirect()->route('kaprodi.dashboard');
            } elseif ($user->role === 'dosen_penilai'){
                return redirect()->route('dosen_penilai.dashboard');
            } elseif ($user->role === 'dosen_pembimbing'){
                return redirect()->route('dosen_pembimbing.dashboard');
            } elseif ($user->role === 'perpus'){
                return redirect()->route('perpus.dashboard');
            }
            
        }
    
        // Login gagal
        return back()->with('error', 'Username atau Kata Sandi salah.');
    }

    public function editProfile()
    {
        // Menampilkan halaman edit profil
        return view('mahasiswa.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $validationRules = [
            'username' => 'required|string|max:255',
            'nim' => 'required|integer',
            'semester' => 'required|string|max:10',
            'kelas' => 'required|string|max:10',
            'prodi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:13',
            'email' => 'required|string|max:255',
        ];
    
        $request->validate($validationRules);
    
        $user = auth()->user();
    
        // Update data profil
        $user->username = $request->username;
        $user->nim = $request->nim;
        $user->semester = $request->semester;
        $user->kelas = $request->kelas;
        $user->prodi = $request->prodi;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
    
        $user->save();
    
        return redirect()->route('edit-profile')->with('success', 'Profil berhasil diperbarui!');
    }
    
    public function updatePassword(Request $request)
    {
        $validationRules = [
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ];
    
        $request->validate($validationRules);
    
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('edit-profile')->with('success', 'Password berhasil diperbarui!');
    }
    
    public function updateProfilePicture(Request $request)
    {
        $validationRules = [
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    
        $request->validate($validationRules);
    
        $user = auth()->user();
    
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }
    
        return redirect()->route('edit-profile')->with('success', 'Foto profil berhasil diperbarui!');
    }
    
    public function logout()
    {
        Auth::logout(); // Logout pengguna yang sedang aktif
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
    public function logoutdosen()
    {
        Auth::logout(); // Logout pengguna yang sedang aktif
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
