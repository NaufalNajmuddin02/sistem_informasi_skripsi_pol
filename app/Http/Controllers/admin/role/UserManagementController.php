<?php

namespace App\Http\Controllers\admin\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $roles = ['admin', 'dosen', 'kaprodi', 'mahasiswa', 'dosen_penilai','dosen_pembimbing'];
        $selectedRole = $request->get('role', 'mahasiswa');

        $query = User::where('role', $selectedRole);

        if (Auth::user()->isDosen()) {
            $query->where('dosen_prodi', Auth::user()->dosen_prodi);
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->paginate(10);

        return view('admin.user.index', compact('users', 'roles', 'selectedRole'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'kelas' => 'nullable|string|max:50',
            'semester' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:15'
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('data.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'prodi' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:50',
            'semester' => 'nullable|string|max:10',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'nullable|string|max:15',
            'role' => 'required|in:mahasiswa,dosen',
            'password' => 'required|string|min:8|confirmed',
            'dosen_prodi' => 'nullable|string|max:100',
            'jabfung' => 'nullable|string|max:100',
        ]);

        $data = $request->only([
            'username', 'nim', 'kelas', 'semester', 'prodi', 'email', 'no_hp',
            'role', 'dosen_prodi', 'jabfung'
        ]);
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('data.index')->with('success', 'Pengguna berhasil dibuat.');
    }
    public function create()
    {
        return view('admin.user.create');
    }
}
