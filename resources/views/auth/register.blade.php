<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <title>Register - Sistem Informasi Skripsi</title>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <img src="{{ asset('images/logologin.png') }}" alt="Student studying illustration">
        </div>
        <div class="login-form">
            <h1>Daftar Akun<br>Sistem Informasi Skripsi</h1>
            <p>Lengkapi formulir di bawah ini untuk membuat akun baru.</p>

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-control">
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required>
                    @error('username')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <input type="text" name="nim" value="{{ old('nim') }}" placeholder="NIM" required>
                    @error('nim')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    @error('password')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" id="showPassword" onclick="togglePassword()">
                    <label for="showPassword">Show Password</label>
                </div>

                <button type="submit" class="login-btn">Register</button>
            </form>

            <div class="forgot-password">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>

            <div class="copyright">
                Copyright © {{ date('Y') }} | Politeknik Harapan Bersama
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
