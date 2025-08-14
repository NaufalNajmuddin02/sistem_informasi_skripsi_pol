<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel ="stylesheet" href="{{asset('css/auth/login.css')}}">
    <title>Sistem Informasi Skripsi</title>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <img src="{{ asset('images/logologin.png') }}" alt="Student studying illustration">
        </div>
        <div class="login-form">
            <h1>Sistem Informasi Skripsi<br>Politeknik Harapan Bersama</h1>
            <p>Akses ke seluruh layanan skripsi kampus dengan mudah dan cepat.</p>

            @if (session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif
    
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-control">
                    <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Username" required>
                    @error('username')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    @error('password')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="checkbox-container">
                    <input type="checkbox" id="showPassword" onclick="togglePassword()">
                    <label for="showPassword">Show Password</label>
                </div>
                
                <button type="submit" class="login-btn">Login</button>
            </form>
            
            <div class="forgot-password">
                Lupa Password? <a href="#">Hubungi Admin</a>
            </div>
            
            <div class="copyright">
                Copyright © {{ date('Y') }} | Politeknik Harapan Bersama
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>