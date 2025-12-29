<x-mobile-app title="Masuk - HarmonyKids" :withNavbar="false">

    @push('styles')
    <style>
        /* ============================= */
        /* STYLE KHUSUS LOGIN (ASLI LO) */
        /* ============================= */
        .mobile-card {
            background: linear-gradient(180deg, #0F3974 0%, #2E7CF6 100%);
            display: flex;
            flex-direction: column;
            padding: 30px;
            min-height: 850px;
        }

        .btn-back {
            position: absolute;
            top: 25px;
            left: 25px;
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1A73E8;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-decoration: none;
            z-index: 20;
            font-size: 22px;
        }

        .plane-img {
            width: 100%;
            max-width: 320px;
            margin-top: 40px;
            align-self: center;
            transform: translateY(-10px);
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
        }

        .headline {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .headline h1 {
            font-weight: 800;
            font-size: 32px;
            margin: 0;
        }

        .headline p {
            font-size: 16px;
            margin-top: 5px;
            opacity: 0.95;
        }

        .custom-input-box {
            background: white;
            border-radius: 15px;
            padding: 0 20px;
            height: 60px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .field-icon {
            color: #1A73E8;
            font-size: 20px;
            margin-right: 15px;
        }

        .form-input {
            border: none;
            outline: none;
            width: 100%;
            height: 100%;
            font-family: 'Baloo 2', cursive;
            font-weight: 700;
            font-size: 16px;
            color: #1A73E8;
            background: transparent;
        }

        .password-toggle {
            color: #1A73E8;
            cursor: pointer;
            font-size: 20px;
            padding: 10px;
        }

        .btn-masuk {
            width: 100%;
            height: 55px;
            background: white;
            color: #0D253F;
            border: none;
            border-radius: 15px;
            font-size: 18px;
            font-weight: 800;
            margin-top: 10px;
            cursor: pointer;
            box-shadow: 0 8px 0 #D8D5EA;
        }

        .btn-masuk:active {
            transform: translateY(4px);
            box-shadow: 0 4px 0 #D8D5EA;
        }

        .alert-custom {
            background: rgba(255,255,255,0.9);
            color: #dc3545;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
    @endpush

    {{-- BACK --}}
    <a href="{{ route('wali.welcome') }}" class="btn-back">
        <i class="fa-solid fa-chevron-left"></i>
    </a>

    {{-- ILUSTRASI --}}
    <img src="{{ asset('assets/images/plane.png') }}" class="plane-img" onerror="this.style.display='none'">

    {{-- HEADLINE --}}
    <div class="headline">
        <h1>“Hai, Mama Papa!”</h1>
        <p>Siap tumbuh bersama <strong>HarmonyKids?</strong></p>
    </div>

    {{-- ERROR BOX --}}
    <div id="errorBox" class="alert-custom d-none"></div>

    {{-- INPUT EMAIL --}}
    <div class="custom-input-box">
        <div class="field-icon"><i class="fa-regular fa-envelope"></i></div>
        <input type="email" id="email" class="form-input" placeholder="Email">
    </div>

    {{-- INPUT PASSWORD --}}
    <div class="custom-input-box">
        <div class="field-icon"><i class="fa-solid fa-lock"></i></div>
        <input type="password" id="password" class="form-input" placeholder="Kata Sandi">
        <i class="fa-regular fa-eye-slash password-toggle" onclick="togglePass()"></i>
    </div>

    <button class="btn-masuk" onclick="loginWali()">Masuk</button>

    <div class="mt-4 text-center">
        <a href="{{ route('wali.register') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 14px;">
            Belum punya akun? <strong style="text-decoration: underline;">Daftar</strong>
        </a>
    </div>

    @push('scripts')
    <script>
        function togglePass() {
            const input = document.getElementById('password')
            input.type = input.type === 'password' ? 'text' : 'password'
        }

        async function loginWali() {
            const email = document.getElementById('email').value
            const password = document.getElementById('password').value
            const errorBox = document.getElementById('errorBox')

            errorBox.classList.add('d-none')

            try {
                const res = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ email, password })
                })

                const data = await res.json()

                if (!res.ok) {
                    errorBox.textContent = data.message ?? 'Login gagal'
                    errorBox.classList.remove('d-none')
                    return
                }

                if (data.role !== 'wali') {
                    errorBox.textContent = 'Akun ini bukan akun wali'
                    errorBox.classList.remove('d-none')
                    return
                }

                localStorage.setItem('auth_token', data.access_token)
                localStorage.setItem('role', data.role)
                localStorage.setItem('user_name', data.user.name)

                window.location.href = "{{ route('wali.home') }}"
            } catch {
                errorBox.textContent = 'Gagal terhubung ke server'
                errorBox.classList.remove('d-none')
            }
        }
    </script>
    @endpush

</x-mobile-app>
