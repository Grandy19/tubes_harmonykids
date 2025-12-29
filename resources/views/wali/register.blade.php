<x-mobile-app title="Daftar - HarmonyKids">

@push('styles')
<style>
    .mobile-card {
        background: linear-gradient(180deg, #0F3974 0%, #2E7CF6 100%);
        padding: 0;
    }

    .scroll-content {
        padding: 24px 24px 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .btn-back {
        position: absolute;
        top: 25px;
        left: 25px;
        width: 45px;
        height: 45px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1A73E8;
        box-shadow: 0 4px 6px rgba(0,0,0,.1);
        text-decoration: none;
        z-index: 10;
        font-size: 22px;
    }

    .family-img {
        width: 100%;
        max-width: 280px;
        margin-top: 60px;
        margin-bottom: 10px;
    }

    .headline {
        text-align: center;
        color: #fff;
        margin-bottom: 25px;
    }

    .headline h1 {
        font-weight: 800;
        font-size: 30px;
    }

    .headline p {
        font-size: 15px;
    }

    .custom-input-box {
        background: #fff;
        border-radius: 15px;
        padding: 0 15px;
        height: 55px;
        width: 100%;
        display: flex;
        align-items: center;
        margin-bottom: 18px;
        box-shadow: 0 4px 6px rgba(0,0,0,.1);
    }

    .field-icon {
        color: #1A73E8;
        font-size: 20px;
        width: 35px;
    }

    .form-input {
        border: none;
        outline: none;
        width: 100%;
        font-weight: 600;
        color: #1A73E8;
        background: transparent;
    }

    .checkbox-wrapper {
        display: flex;
        gap: 10px;
        color: #fff;
        font-size: 13px;
        margin-bottom: 25px;
        width: 100%;
    }

    .custom-checkbox {
        width: 22px;
        height: 22px;
        border: 2px solid #fff;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .custom-checkbox.checked {
        background: #fff;
    }

    .custom-checkbox i {
        color: #1A73E8;
        display: none;
    }

    .custom-checkbox.checked i {
        display: block;
    }

    .btn-daftar {
        width: 100%;
        height: 50px;
        background: #fff;
        color: #0D253F;
        border-radius: 15px;
        font-size: 17px;
        font-weight: 800;
        border: none;
    }
</style>
@endpush

<a href="/" class="btn-back">
    <i class="fa-solid fa-chevron-left"></i>
</a>

<div class="scroll-content">

    <img src="{{ asset('assets/images/keluarga.png') }}" class="family-img">

    <div class="headline">
        <h1>Hai, Mama Papa!</h1>
        <p>Yuk bergabung bersama HarmonyKids</p>
    </div>

    <form id="registerForm" style="width:100%">
        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-user"></i></div>
            <input type="text" name="name" class="form-input" placeholder="Nama Lengkap" required>
        </div>

        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-envelope"></i></div>
            <input type="email" name="email" class="form-input" placeholder="Email" required>
        </div>

        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-phone"></i></div>
            <input type="tel" name="phone" class="form-input" placeholder="Nomor Telepon" required>
        </div>

        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-lock"></i></div>
            <input type="password" name="password" class="form-input" placeholder="Password" required>
        </div>

        <div class="custom-input-box">
            <div class="field-icon"><i class="fa fa-shield"></i></div>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Konfirmasi Password" required>
        </div>

        <div class="checkbox-wrapper">
            <div class="custom-checkbox" onclick="toggleAgree()">
                <i class="fa fa-check"></i>
            </div>
            <div onclick="toggleAgree()">
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
let agreed = false;

function toggleAgree() {
    agreed = !agreed;
    document.querySelector('.custom-checkbox').classList.toggle('checked', agreed);
}

document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    if (!agreed) {
        alert('Anda harus menyetujui ketentuan');
        return;
    }

    showLoading();

    const form = e.target;

    try {
        const res = await fetch('/api/auth/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: form.name.value,
                email: form.email.value,
                phone: form.phone.value,
                password: form.password.value,
                password_confirmation: form.password_confirmation.value,
                role: 'wali'
            })
        });

        const data = await res.json();
        if (!res.ok) throw data;

        alert('Registrasi berhasil, silakan login');
        window.location.href = '/wali/login';

    } catch (err) {
        let msg = 'Gagal mendaftar';
        if (err.errors) {
            msg = Object.values(err.errors).flat().join('\n');
        }
        alert(msg);
    } finally {
        hideLoading();
    }
});
</script>
@endpush

</x-mobile-app>
