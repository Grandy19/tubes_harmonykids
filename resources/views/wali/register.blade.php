<x-mobile-app title="Daftar - HarmonyKids">

@push('styles')
<style>
    /* STYLE ASLI LO GUE PERTAHANIN */
    .mobile-card { background: linear-gradient(180deg, #0F3974 0%, #2E7CF6 100%); padding: 0; }
    .scroll-content { padding: 24px 24px 50px; display: flex; flex-direction: column; align-items: center; }
    .btn-back { position: absolute; top: 25px; left: 25px; width: 45px; height: 45px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1A73E8; box-shadow: 0 4px 6px rgba(0,0,0,.1); text-decoration: none; z-index: 10; font-size: 22px; }
    .family-img { width: 100%; max-width: 280px; margin-top: 60px; margin-bottom: 10px; }
    .headline { text-align: center; color: #fff; margin-bottom: 25px; }
    .headline h1 { font-weight: 800; font-size: 30px; }
    .headline p { font-size: 15px; }
    
    .custom-input-box { background: #fff; border-radius: 15px; padding: 0 15px; height: 55px; width: 100%; display: flex; align-items: center; margin-bottom: 18px; box-shadow: 0 4px 6px rgba(0,0,0,.1); }
    .field-icon { color: #1A73E8; font-size: 20px; width: 35px; }
    .form-input { border: none; outline: none; width: 100%; font-weight: 600; color: #1A73E8; background: transparent; }
    
    .checkbox-wrapper { display: flex; gap: 10px; color: #fff; font-size: 13px; margin-bottom: 25px; width: 100%; }
    .custom-checkbox { width: 22px; height: 22px; border: 2px solid #fff; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; }
    .custom-checkbox.checked { background: #fff; }
    .custom-checkbox i { color: #1A73E8; display: none; }
    .custom-checkbox.checked i { display: block; }
    
    .btn-daftar { width: 100%; height: 50px; background: #fff; color: #0D253F; border-radius: 15px; font-size: 17px; font-weight: 800; border: none; cursor: pointer; }
    
    /* Error Alert Style */
    .alert-custom { background: rgba(255,255,255,0.95); color: #dc3545; padding: 15px; border-radius: 10px; font-size: 14px; text-align: left; margin-bottom: 20px; font-weight: 600; border-left: 5px solid #dc3545; width: 100%; }
</style>
@endpush

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

@push('scripts')
<script>
    // Logic Checkbox Visual Saja
    let agreed = false;

    function toggleAgree() {
        agreed = !agreed;
        const visual = document.getElementById('chkBoxVisual');
        
        if(agreed) {
            visual.classList.add('checked');
        } else {
            visual.classList.remove('checked');
        }
    }

    // Validasi sebelum form disubmit browser
    function validateForm() {
        if (!agreed) {
            // Kita pake SweetAlert bawaan lu kalau ada, atau alert biasa
            if(typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Anda harus menyetujui ketentuan layanan!',
                    confirmButtonColor: '#0F3974'
                });
            } else {
                alert('Anda harus menyetujui ketentuan HarmonyKids');
            }
            return false; // Stop submit
        }
        return true; // Lanjut submit ke Controller
    }
</script>
@endpush

</x-mobile-app>