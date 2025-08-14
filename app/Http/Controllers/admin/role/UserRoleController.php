<?php

namespace App\Http\Controllers\admin\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('dosen_prodi', Auth::user()->dosen_prodi);

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->paginate(10);

        return view('admin.role.user_management', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,dosen,mahasiswa,kaprodi,dosen_penilai,dosen_pembimbing'
        ]);

        if ($user->role !== $validated['role']) {
            $user->update(['role' => $validated['role']]);
            return redirect()->back()->with('success', 'Role pengguna berhasil diperbarui.');
        }

        return redirect()->back()->with('info', 'Tidak ada perubahan role yang dilakukan.');
    }
    public function bulkUpdateRole(Request $request)
{
    $request->validate([
        'selected_users' => 'required|array',
        'new_role' => 'required|in:admin,dosen,mahasiswa,kaprodi,dosen_penilai,dosen_pembimbing'
    ]);

    $updatedCount = 0;

    foreach ($request->selected_users as $userId) {
        $user = User::find($userId);
        if ($user && $user->role !== $request->new_role) {
            $user->update(['role' => $request->new_role]);
            $updatedCount++;
        }
    }

    return redirect()->back()->with('success', "$updatedCount pengguna berhasil diperbarui ke role {$request->new_role}.");
}


}
