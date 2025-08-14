<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  mixed  ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil pengguna yang login
        $user = Auth::user();

        // Periksa apakah pengguna memiliki salah satu dari role yang diberikan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika role tidak sesuai, redirect ke halaman yang sesuai
        switch ($user->role) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'dosen':
                return redirect('/dosen/dashboard');
            case 'mahasiswa':
                return redirect('/mahasiswa/dashboard');
            case 'kaprodi':
                return redirect('/kaprodi/dashboard');
            case 'dosen_penilai':
                return redirect('/dosen_penilai/dashboard');
            case 'dosen_pembimbing':
                return redirect('/dosen_pembimbing/dashboard');
            case 'dosen_pembimbing':
                return redirect('/dosen_pembimbing/dashboard');
            case 'perpus':
                return redirect('/perpus/dashboard');
            default:
                return redirect('/home');
        }
    }
}
