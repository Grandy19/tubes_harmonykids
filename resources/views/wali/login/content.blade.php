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

{{-- ERROR BOX (NATIVE LARAVEL) --}}
@if($errors->any())
    <div class="alert-custom">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

{{-- FORM LOGIN --}}
<form action="{{ route('login.process') }}" method="POST">
    @csrf {{-- WAJIB: Token keamanan Laravel --}}
    
    {{-- INPUT EMAIL --}}
    <div class="custom-input-box">
        <div class="field-icon"><i class="fa-regular fa-envelope"></i></div>
        <input type="email" name="email" class="form-input" placeholder="Email" value="{{ old('email') }}" required>
    </div>

    {{-- INPUT PASSWORD --}}
    <div class="custom-input-box">
        <div class="field-icon"><i class="fa-solid fa-lock"></i></div>
        <input type="password" name="password" id="password" class="form-input" placeholder="Kata Sandi" required>
        <i class="fa-regular fa-eye-slash password-toggle" onclick="togglePass()"></i>
    </div>

    {{-- BUTTON SUBMIT --}}
    <button type="submit" class="btn-masuk">Masuk</button>
</form>

<div class="mt-4 text-center">
    <a href="{{ route('wali.register') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 14px;">
        Belum punya akun? <strong style="text-decoration: underline;">Daftar</strong>
    </a>
</div>