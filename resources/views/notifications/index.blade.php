<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex flex-wrap align-items-center mb-3">
            <h1 class="me-3 mb-0">Notifikasi</h1>
            <span class="text-muted"></span>
        </div>
        <hr>

        <div class="mb-3 d-flex justify-content-end gap-2">
            <a href="{{ route('notifikasi.markAllRead') }}" class="btn btn-outline-primary">
                <i class="fas fa-check-double"></i> Tandai Semua Dibaca
            </a>
            <a href="{{ route('notifikasi.deleteAll') }}" class="btn btn-outline-danger">
                <i class="fas fa-trash-alt"></i> Hapus Semua
            </a>
            <a href="javascript:history.back();" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        @foreach($notifications as $notification)
            <div class="alert alert-{{ $notification->read_at ? 'secondary' : 'info' }} d-flex justify-content-between align-items-center">
                <div>
                    <h5>{{ $notification->title }}</h5>
                    <p>{{ $notification->message }}</p>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                <div class="d-flex gap-2">
                    @if(is_null($notification->read_at))
                        <a href="{{ route('notifikasi.read', $notification->id) }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-check"></i> Tandai Dibaca
                        </a>
                    @endif
                    <a href="{{ route('notifikasi.delete', $notification->id) }}" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>