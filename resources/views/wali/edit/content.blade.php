{{-- HEADER --}}
<div class="header-layer">
    <x-custom-header title="Edit Akun" />
</div>

{{-- CONTENT --}}
<div class="content-scroll">

    <form action="{{ route('wali.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- FOTO PROFIL --}}
        @php
            $photo = ($user && $user->foto_profil)
                ? asset('storage/'.$user->foto_profil)
                : asset('assets/images/default_avatar.png');
        @endphp

        <div class="profile-img-container" onclick="document.getElementById('fotoInput').click()">
            <img src="{{ $photo }}" class="profile-img" id="previewImg">
            <div class="edit-icon-badge"><i class="fa-solid fa-pen"></i></div>
            <input type="file" id="fotoInput" name="foto_profil" hidden accept="image/*" onchange="previewImage(this)">
        </div>

        @error('foto_profil')
            <div style="color: red; font-size: 14px; text-align: center; margin-bottom: 20px; font-weight: bold;">
                {{ $message }}
            </div>
        @enderror

        {{-- INPUT LIST --}}
        <div class="input-group-custom">
            <i class="fa-solid fa-user input-icon"></i>
            <input type="text" name="name" class="form-control-custom"
                   value="{{ old('name', $user->name) }}" placeholder="Nama Lengkap" required>
            <i class="fa-solid fa-pen edit-suffix"></i>
        </div>

        <div class="input-group-custom">
            <i class="fa-solid fa-envelope input-icon"></i>
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