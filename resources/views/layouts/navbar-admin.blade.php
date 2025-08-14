<style>
/* Navbar Styling */
.navbar {
    background-color: rgb(163, 4, 4) !important;
    color: white !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed; /* Membuat navbar tetap di atas */
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000; /* Agar navbar selalu di atas elemen lain */
}

.navbar-brand {
    color: white !important;
    font-size: 1.5rem;
    margin-left: 90px;
}
.profile-menu {
    margin-right: 90px;
}

.navbar-nav .nav-link {
    color: white !important;
    transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #ddd !important;
}

.dropdown-menu {
    min-width: 250px;
}

.profile-dropdown {
    right: 20px;
    top: 60px;
    min-width: 280px;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}
.profile-img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #3b82f6;
}
.notification-icon {
    font-size: 1.3rem; 
    position: relative;
    text-decoration: none;
}

.notification-icon .badge {
    font-size: 0.8rem; 
    padding: 2px 6px; 
    position: absolute;
    top: -5px;
    right: -10px;
    background-color: #dc3545; 
    color: white;
    border-radius: 50%; 
}

.username-ellipsis {
    max-width: 120px; /* Atur sesuai kebutuhan */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: inline-block;
    vertical-align: middle;
}


/* Memberikan padding-top pada body agar tidak tertutup navbar */
body {
    padding-top: 70px;
}

/* Responsive Design */
@media (max-width: 991px) {
    .navbar-brand {
        margin-left: 20px;
    }
    .profile-menu {
        margin-right: 20px;
    }
}

@media (max-width: 767px) {
    .navbar {
        padding: 10px;
    }
    .profile-menu {
        margin-right: 10px;
    }
    .profile-img {
        width: 50px;
        height: 50px;
    }
}
</style>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SISTA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Proposal Skripsi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dosen_mapel.index') }}">Pembagian Dosen Proposal Skripsi </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Seminar Proposal Skripsi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.seminar') }}">Pembagian Jadwal Seminar Proposal</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.batas.index') }}">Batas Waktu Seminar Proposal</a></li>
                            <li><a class="dropdown-item" href="{{ route('rekap.seminar.admin') }}">Rekap Seminar Proposal</a></li>
                            <li><a class="dropdown-item" href="{{ route('data.ruangan.index') }}">Manajemen Ruangan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Bimbingan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('rekap.bimbingan.admin') }}">Rekap Bimbingan Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Manajemen Data 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">Daftar Pegawai</a></li>
                            <li><a class="dropdown-item" href="{{ route('data.index') }}">Daftar Data User</a></li>
                            <li><a class="dropdown-item" href="{{ route('infoTerbaru.index') }}">Informasi Terbaru</a></li>
                        </ul>
                        
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{route('yudisium.index.admin')}}">Yudisium</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            TA 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.sidangta.index') }}">Data Pendaftaran Sidang TA</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.datapesertata') }}">Data Peserta TA</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.jadwalta') }}">Jadwal Sidang TA</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.daftarnilaita') }}">Daftar Nilai TA</a></li>
                        </ul>
                    </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Berkas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.skpi.index') }}">SKPI</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('admin.skpi.index') }}" >
                            SKPI
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" >
                            Berkas Skripsi
                    </li> -->
                  
                </ul>
                <div class="d-flex align-items-center">
                    <a href="{{ route('notifikasi.index') }}" class="text-white me-3 notification-icon">🔔
                        @if($unreadCount = auth()->user()->notifications()->whereNull('read_at')->count())
                            <span class="badge">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                    <div class="profile-menu">
                        <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/no_profile.png') }}" 
                                class="rounded-circle me-2" width="35" height="35" alt="Profile Picture">
                            <span class="text-white username-ellipsis">{{ auth()->user()->username }}</span>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end profile-dropdown p-3 text-center">
                            <li>
                                <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/no_profile.png') }}" 
                                    class="profile-img mx-auto mb-2" alt="Profile Picture">
                            </li>
                            <li><h5 class="mb-1">{{ auth()->user()->username }}</h5></li>
                            <li><p class="text-muted">{{ auth()->user()->nim }}</p></li>
                            <li>
                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    <a href="{{ route('edit-profile') }}" class="btn btn-primary">Edit Profil</a>
                                    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>