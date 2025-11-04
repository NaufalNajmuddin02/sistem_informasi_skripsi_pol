<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA Dashboard Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel ="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- Profile Card -->
                <div class="card mb-3" style="background-color: #333; color: white;">
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/no_profile.png') }}" 
                             class="rounded-circle me-3" width="50" height="50">
                        <div>
                            <h5 class="mb-1">{{ auth()->user()->username }}</h5>
                            <p class="mb-0">{{ auth()->user()->nim }}</p>
                        </div>
                        <span class="ms-auto badge status-badge">Aktif</span>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4">Prodi</div>
                            <div class="col-8 text-end">{{ auth()->user()->prodi }}</div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Pengguna -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Statistik Pengguna</h5>
                        <div class="d-flex justify-content-center">
                            <canvas id="userChart" style="max-width: 400px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Pendaftaran Ujian TA -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Statistik Pendaftaran Ujian TA</h5>
                        <div class="d-flex justify-content-center">
                            <canvas id="pendaftaranChart" style="max-width: 400px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Statistik Kelulusan Sidang -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Statistik Kelulusan Sidang</h5>
                        <div class="d-flex justify-content-center">
                            <canvas id="kelulusanChart" style="max-width: 500px; max-height: 350px;"></canvas>
                        </div>
                    </div>
                </div>


                <!-- Info Box Carousel -->
                <div class="card mt-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Informasi Terbaru</h5>
                        <div id="infoTerbaruCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000" data-bs-pause="hover">
                            <div class="carousel-inner">
                                @foreach ($infoTerbaru as $index => $info)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="px-4 py-3" style="max-height: 200px; overflow-y: auto;">
                                            <h6 class="text-primary fw-semibold">{{ $info->judul }}</h6>
                                            <p class="text-muted mb-0" style="white-space: pre-line;">{!! e($info->konten) !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#infoTerbaruCarousel" data-bs-slide="prev" aria-label="Previous">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#infoTerbaruCarousel" data-bs-slide="next" aria-label="Next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>

                            @if(count($infoTerbaru) > 1)
                                <div class="carousel-indicators mt-3">
                                    @foreach ($infoTerbaru as $index => $info)
                                        <button type="button" data-bs-target="#infoTerbaruCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <!-- Calendar Card -->
                <div class="card mb-3">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h2 class="mb-1">KALENDER AKADEMIK</h2>
                            <h5 class="mb-2">{{ $tahunAkademik }}</h5>
                            <p class="mb-0">Semester {{ $semester }}</p>
                        </div>
                        <div class="ms-auto calendar-icon p-2 rounded">
                            📅
                        </div>
                    </div>
                </div>

                <!-- Statistik Mahasiswa per Prodi -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Statistik Mahasiswa per Prodi</h5>
                        <div class="d-flex justify-content-center">
                            <canvas id="prodiChart" style="max-width: 400px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Statistik Rekomendasi Sidang -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Statistik Rekomendasi Sidang</h5>
                        <div class="d-flex justify-content-center">
                            <canvas id="rekomendasiChart" style="max-width: 400px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                
              

            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap and Popper.js -->

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Membuat warna gradien
        function createGradient(ctx, colorStart, colorEnd) {
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, colorStart);
            gradient.addColorStop(1, colorEnd);
            return gradient;
        }

        // Warna dinamis untuk grafik
        const colors = [
            ['#36A2EB', '#5AD3F1'],
            ['#FF6384', '#FF9AA2'],
            ['#FFCE56', '#FFD580'],
            ['#4BC0C0', '#80CBC4'],
            ['#9966FF', '#B39DDB'],
            ['#FF9F40', '#FFB74D']
        ];

        // Fungsi untuk mengonversi warna ke gradien
        function getGradientColors(ctx, colors) {
            return colors.map(color => createGradient(ctx, color[0], color[1]));
        }

        // Grafik Statistik Pengguna
        const userChartCtx = document.getElementById('userChart').getContext('2d');
        new Chart(userChartCtx, {
            type: 'bar',
            data: {
                labels: ['Admin', 'Dosen', 'Kaprodi', 'Dosen Penilai', 'Mahasiswa'],
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: [
                        {{ $jumlahAdmin }},
                        {{ $jumlahDosen }},
                        {{ $jumlahKaprodi }},
                        {{ $jumlahDosenPenilai }},
                        {{ $jumlahMahasiswa }}
                    ],
                    backgroundColor: getGradientColors(userChartCtx, colors),
                    borderColor: '#fff',
                    borderWidth: 2,
                    hoverBackgroundColor: '#F8B195',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#333',
                            font: { size: 14, weight: 'bold' }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Pengguna Berdasarkan Role',
                        font: { size: 18, weight: 'bold' },
                        color: '#333'
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#333',
                        bodyColor: '#333',
                        borderColor: '#ddd',
                        borderWidth: 1,
                        bodyFont: { size: 14 }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#333', font: { size: 12 } }
                    },
                    x: {
                        ticks: { color: '#333', font: { size: 12 } }
                    }
                }
            }
        });

        // Grafik Statistik Mahasiswa per Prodi
        const prodiChartCtx = document.getElementById('prodiChart').getContext('2d');
        new Chart(prodiChartCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($prodiStatistik->pluck('prodi')) !!},
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: {!! json_encode($prodiStatistik->pluck('total')) !!},
                    backgroundColor: getGradientColors(prodiChartCtx, colors),
                    borderColor: '#fff',
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: { size: 14 }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Mahasiswa Berdasarkan Prodi',
                        font: { size: 18, weight: 'bold' },
                        color: '#333'
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#333',
                        bodyColor: '#333',
                        borderColor: '#ddd',
                        borderWidth: 1
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    </script>

    <script>
        // Statistik Rekomendasi Sidang
        const rekomendasiCtx = document.getElementById('rekomendasiChart').getContext('2d');
        new Chart(rekomendasiCtx, {
            type: 'pie',
            data: {
                labels: ['Sudah Direkomendasikan', 'Belum Direkomendasikan'],
                datasets: [{
                    data: [{{ $jumlahDirekomendasikan }}, {{ $jumlahBelum }}],
                    backgroundColor: ['#4BC0C0', '#FF6384'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 14 } }
                    },
                    title: {
                        display: true,
                        text: 'Rekomendasi Sidang Mahasiswa',
                        font: { size: 18, weight: 'bold' }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });

    </script>
 <script>
    const pendaftaranCtx = document.getElementById('pendaftaranChart').getContext('2d');
    new Chart(pendaftaranCtx, {
        type: 'bar', // ubah dari pie → bar
        data: {
            labels: ['Sudah Mendaftar', 'Belum Mendaftar'],
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: [{{ $sudahDaftar }}, {{ $belumDaftar }}],
                backgroundColor: ['#4BC0C0', '#FF6384'],
                borderColor: ['#36A2EB', '#FF6384'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false // karena cuma 1 dataset
                },
                title: {
                    display: true,
                    text: 'Rekap Pendaftaran Ujian TA',
                    font: { size: 18, weight: 'bold' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 } // biar naik per 1
                }
            },
            animation: {
                duration: 800,
                easing: 'easeOutBounce'
            }
        }
    });
    const kelulusanCtx = document.getElementById('kelulusanChart').getContext('2d');
    new Chart(kelulusanCtx, {
        type: 'bar',
        data: {
            labels: ['Lulus', 'Belum Lulus'],
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: [{{ $lulus }}, {{ $belumLulus }}],
                backgroundColor: ['#4BC0C0', '#FF6384'],
                borderColor: ['#36A2EB', '#FF6384'],
                borderWidth: 1,
                borderRadius: 6 // sudut batang agak bulat biar modern
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Statistik Kelulusan Sidang',
                    font: { size: 18, weight: 'bold' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 } // biar angkanya naik 1,2,3 dst.
                }
            },
            animation: {
                duration: 1200,
                easing: 'easeOutBounce'
            }
        }
    });

</script>


</body>
</html>
