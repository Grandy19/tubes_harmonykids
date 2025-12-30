<x-mobile-app title="Edit Akun" :withNavbar="true">

@push('styles')
<style>
/* CSS LU UDAH OKE, GUE SKIP BIAR RINGKAS */
.header-layer{position:absolute;top:0;left:0;right:0;z-index:10}
    .content-scroll { 
        padding-top: 250px; 
        padding-left: 24px; 
        padding-right: 24px; 
        /* PERBAIKAN: Tambah padding bawah sedikit, spacer nanti dikurangi */
        padding-bottom: 20px; 
        min-height: 100vh; 
        background: #F9FAFB;
        overflow-y: auto; 
        position: relative;
        -ms-overflow-style: none; scrollbar-width: none;  
    }
.profile-img-container{position:relative;width:110px;height:110px;margin:0 auto 32px;}
.profile-img{width:100%;height:100%;border-radius:50%;object-fit:cover;border:4px solid white;box-shadow:0 8px 15px rgba(26,115,232,.3);background:#D8D5EA;}
.edit-icon-badge{position:absolute;bottom:0;right:0;width:35px;height:35px;background:#1A73E8;border-radius:50%;border:2px solid white;display:flex;align-items:center;justify-content:center;cursor:pointer;}
.edit-icon-badge i{color:white;font-size:16px}
.input-group-custom{background:white;border-radius:15px;height:60px;display:flex;align-items:center;padding:0 20px;margin-bottom:20px;box-shadow:0 6px 10px rgba(0,0,0,.04);}
.input-group-custom:focus-within{box-shadow:0 10px 15px rgba(26,115,232,.15);transform:translateY(-2px);}
.input-icon{width:30px;font-size:24px;color:#1A73E8;margin-right:16px;text-align:center;}
.form-control-custom{flex:1;border:none;outline:none;font-size:16px;font-weight:700;color:#1A73E8;background:transparent;}
.form-control-custom::placeholder{color:rgba(26,115,232,.6);}
.edit-suffix{font-size:18px;color:rgba(26,115,232,.4);}
.btn-save{width:100%;height:55px;background:white;border:none;border-radius:15px;font-size:18px;font-weight:800;color:#0F3974;box-shadow:0 10px 0 #D8D5EA;}
.btn-save:active{transform:translateY(4px);box-shadow:0 6px 0 #D8D5EA;}
select.form-control-custom{appearance:none;cursor:pointer;}
</style>
@endpush

{{-- HEADER --}}
<div class="header-layer">
    <x-custom-header title="Edit Akun" />
</div>

{{-- CONTENT --}}
<div class="content-scroll">

{{-- Pastikan Route di web.php: ->name('wali.profile.update') --}}
<form action="{{ route('wali.profile.update') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- FOTO PROFIL --}}
@php
    // GANTI Auth::user() JADI $user
    $photo = ($user && $user->foto_profil)
        ? asset('storage/'.$user->foto_profil)
        : asset('assets/images/default_avatar.png');
@endphp

<div class="profile-img-container" onclick="document.getElementById('fotoInput').click()">
    <img src="{{ $photo }}" class="profile-img" id="previewImg">
    <div class="edit-icon-badge"><i class="fa-solid fa-pen"></i></div>
    <input type="file" id="fotoInput" name="foto_profil" hidden accept="image/*" onchange="previewImage(this)">
</div>

{{-- TAMBAHKAN INI UNTUK MELIHAT ERROR FOTO --}}
@error('foto_profil')
    <div style="color: red; font-size: 14px; text-align: center; margin-bottom: 20px; font-weight: bold;">
        {{ $message }}
    </div>
@enderror

{{-- INPUT LIST --}}

<div class="input-group-custom">
    <i class="fa-solid fa-user input-icon"></i>
    {{-- PERHATIKAN: value pake $user->name, BUKAN Auth::user() --}}
    <input type="text" name="name" class="form-control-custom"
           value="{{ old('name', $user->name) }}" placeholder="Nama Lengkap" required>
    <i class="fa-solid fa-pen edit-suffix"></i>
</div>

<div class="input-group-custom">
    <i class="fa-solid fa-envelope input-icon"></i>
    {{-- FIX: Ganti Auth::user()->email jadi $user->email --}}
    <input type="email" name="email" class="form-control-custom"
           value="{{ old('email', $user->email) }}" placeholder="Email" required>
    <i class="fa-solid fa-pen edit-suffix"></i>
</div>

<div class="input-group-custom">
    <i class="fa-solid fa-location-dot input-icon"></i>
    <input type="text" name="alamat" class="form-control-custom"
           value="{{ old('alamat', $user->alamat) }}" placeholder="Alamat">
    <i class="fa-solid fa-pen edit-suffix"></i>
</div>

<div class="input-group-custom">
    <i class="fa-solid fa-phone input-icon"></i>
    <input type="text" name="no_telepon" class="form-control-custom"
        value="{{ old('no_telepon', $user->phone) }}" placeholder="Nomor Telepon">
    <i class="fa-solid fa-pen edit-suffix"></i>
</div>

<div class="input-group-custom">
    <i class="fa-solid fa-venus-mars input-icon" id="genderIcon"></i>
    <select name="jenis_kelamin" class="form-control-custom" onchange="updateGenderIcon(this)">
        <option value="">Jenis Kelamin</option>
        {{-- FIX: Ganti Auth::user() jadi $user --}}
        <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>
    <i class="fa-solid fa-caret-down edit-suffix"></i>
</div>

<div class="input-group-custom">
    <i class="fa-solid fa-briefcase input-icon"></i>
    <input type="text" name="pekerjaan" class="form-control-custom"
           value="{{ old('pekerjaan', $user->pekerjaan) }}" placeholder="Pekerjaan">
    <i class="fa-solid fa-pen edit-suffix"></i>
</div>

<div class="input-group-custom">
    <i class="fa-solid fa-heart input-icon"></i>
    <input type="text" name="hubungan_dengan_anak" class="form-control-custom"
           value="{{ old('hubungan_dengan_anak', $user->hubungan_dengan_anak) }}" placeholder="Hubungan dengan anak">
    <i class="fa-solid fa-pen edit-suffix"></i>
</div>

<button type="submit" class="btn-save">Simpan</button>

</form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function previewImage(input){
    const file=input.files[0]
    if(!file) return
    const reader=new FileReader()
    reader.onload=e=>document.getElementById('previewImg').src=e.target.result
    reader.readAsDataURL(file)
}
function updateGenderIcon(sel){
    const icon=document.getElementById('genderIcon')
    icon.className='fa-solid input-icon'
    if(sel.value==='Laki-laki') icon.classList.add('fa-mars')
    else if(sel.value==='Perempuan') icon.classList.add('fa-venus')
    else icon.classList.add('fa-venus-mars')
}
// Init icon on load
window.addEventListener('load', function() {
    const sel = document.querySelector('select[name="jenis_kelamin"]');
    if(sel) updateGenderIcon(sel);
});

@if(session('success'))
Swal.fire({
    icon:'success',
    title:'Berhasil',
    text:'{{ session('success') }}',
    confirmButtonColor:'#0F3974'
})
@endif
</script>
@endpush

</x-mobile-app>