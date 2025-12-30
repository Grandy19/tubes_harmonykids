<a href="{{ route('wali.welcome') }}" class="btn-back">
    <i class="fa-solid fa-chevron-left"></i>
</a>

<div class="scroll-content">

    <img src="{{ asset('assets/images/keluarga.png') }}" class="family-img">

    <div class="headline">
        <h1>Hai, Mama Papa!</h1>
        <p>Yuk bergabung bersama HarmonyKids</p>
    </div>

    {{-- ERROR FEEDBACK (Native Laravel) --}}
    @if($errors->any())
        <div class="alert-custom">
            <ul style="margin:0; padding-left: 15px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM START --}}
    {{-- Action ke register.process, Method POST --}}
    <form action="{{ route('register.process') }}" method="POST" style="width:100%" onsubmit="return validateForm()">
        @csrf {{-- Token Keamanan Wajib --}}

        {{-- NAMA --}}
        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-user"></i></div>
            {{-- Tambah value old() biar kalau error gak ngetik ulang --}}
            <input type="text" name="name" class="form-input" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
        </div>

        {{-- EMAIL --}}
        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-envelope"></i></div>
            <input type="email" name="email" class="form-input" placeholder="Email" value="{{ old('email') }}" required>
        </div>

        {{-- PHONE --}}
        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-phone"></i></div>
            <input type="tel" name="phone" class="form-input" placeholder="Nomor Telepon" value="{{ old('phone') }}" required>
        </div>

        {{-- PASSWORD --}}
        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-lock"></i></div>
            <input type="password" name="password" class="form-input" placeholder="Password" required>
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-shield"></i></div>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Konfirmasi Password" required>
        </div>

        {{-- CHECKBOX AGREEMENT --}}
        <div class="checkbox-wrapper">
            {{-- Visual Checkbox --}}
            <div class="custom-checkbox" id="chkBoxVisual" onclick="toggleAgree()">
                <i class="fa fa-check"></i>
            </div>
            {{-- Input Hidden buat logic JS --}}
            <input type="hidden" id="agreementInput" value="0">
            
            <div onclick="toggleAgree()" style="cursor: pointer;">
                Saya setuju dengan ketentuan HarmonyKids
            </div>
        </div>

        <button type="submit" class="btn-daftar">
            Daftar
        </button>
    </form>

</div>