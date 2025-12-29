<x-mobile-app title="Edit Akun" :withNavbar="true">

    @push('styles')
    <style>
        .header-curve {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 180px;
            background: #1A73E8;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            z-index: 0;
        }

        .content-area {
            position: relative;
            z-index: 1;
            padding: 0 24px 120px 24px;
        }

        .profile-wrapper {
            position: relative;
            margin-top: 100px;
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
        }

        .avatar-box {
            width: 110px;
            height: 110px;
            background: #D8D5EA;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 8px 15px rgba(26,115,232,0.3);
            overflow: hidden;
            position: relative;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .edit-badge {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 35px;
            height: 35px;
            background: #1A73E8;
            border: 2px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .input-group-custom {
            background: white;
            height: 60px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            padding: 0 20px;
            margin-bottom: 20px;
        }

        .input-icon {
            color: #1A73E8;
            font-size: 24px;
            margin-right: 15px;
            min-width: 30px;
            text-align: center;
        }

        .form-control-custom {
            border: none;
            outline: none;
            width: 100%;
            color: #1A73E8;
            font-weight: 700;
            font-size: 16px;
            background: transparent;
        }

        .form-control-custom::placeholder {
            color: rgba(26,115,232,0.6);
        }

        .edit-icon {
            color: rgba(26,115,232,0.4);
            font-size: 16px;
        }

        .btn-save {
            width: 100%;
            height: 50px;
            background: white;
            color: #0F3974;
            font-weight: 800;
            font-size: 18px;
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 0 #D8D5EA;
            margin-top: 20px;
        }

        .btn-save:active {
            transform: translateY(4px);
            box-shadow: 0 6px 0 #D8D5EA;
        }
    </style>
    @endpush

    {{-- HEADER --}}
    <div class="header-curve"></div>

    <div class="content-area">

        {{-- BACK --}}
        <div class="d-flex align-items-center pt-4 mb-3">
            <a href="{{ route('wali.home') }}" class="text-white me-3">
                <i class="fa-solid fa-chevron-left fa-lg"></i>
            </a>
            <h1 class="text-white fw-bold fs-5 m-0">Edit Akun</h1>
        </div>

        {{-- FORM --}}
        <form action="{{ route('wali.profile.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- FOTO PROFIL --}}
            <div class="profile-wrapper">
                <div class="avatar-box">
                    @if(auth()->user()->foto_profil)
                        <img id="previewImg"
                             src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                             class="avatar-img">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="fa-solid fa-user fa-3x text-white"></i>
                        </div>
                    @endif
                </div>

                <input type="file"
                       name="foto_profil"
                       id="fotoInput"
                       hidden
                       onchange="previewFile()">

                <div class="edit-badge"
                     onclick="document.getElementById('fotoInput').click()">
                    <i class="fa-solid fa-pen"></i>
                </div>
            </div>

            {{-- INPUT --}}
            <div class="input-group-custom">
                <i class="fa-solid fa-user input-icon"></i>
                <input type="text" name="name"
                       value="{{ old('name', auth()->user()->name) }}"
                       class="form-control-custom"
                       placeholder="Nama Lengkap">
                <i class="fa-solid fa-pen edit-icon"></i>
            </div>

            <div class="input-group-custom">
                <i class="fa-solid fa-envelope input-icon"></i>
                <input type="email" name="email"
                       value="{{ old('email', auth()->user()->email) }}"
                       class="form-control-custom"
                       placeholder="Email">
                <i class="fa-solid fa-pen edit-icon"></i>
            </div>

            <div class="input-group-custom">
                <i class="fa-solid fa-location-dot input-icon"></i>
                <input type="text" name="alamat"
                       value="{{ old('alamat', auth()->user()->alamat) }}"
                       class="form-control-custom"
                       placeholder="Alamat">
                <i class="fa-solid fa-pen edit-icon"></i>
            </div>

            <div class="input-group-custom">
                <i class="fa-solid fa-phone input-icon"></i>
                <input type="text" name="phone"
                       value="{{ old('phone', auth()->user()->phone) }}"
                       class="form-control-custom"
                       placeholder="Nomor Telepon">
                <i class="fa-solid fa-pen edit-icon"></i>
            </div>

            <div class="input-group-custom">
                <i class="fa-solid fa-venus-mars input-icon"></i>
                <select name="jenis_kelamin" class="form-control-custom">
                    <option value="">Jenis Kelamin</option>
                    <option value="Laki-laki" {{ auth()->user()->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ auth()->user()->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <i class="fa-solid fa-caret-down edit-icon"></i>
            </div>

            <div class="input-group-custom">
                <i class="fa-solid fa-briefcase input-icon"></i>
                <input type="text" name="pekerjaan"
                       value="{{ old('pekerjaan', auth()->user()->pekerjaan) }}"
                       class="form-control-custom"
                       placeholder="Pekerjaan">
                <i class="fa-solid fa-pen edit-icon"></i>
            </div>

            <div class="input-group-custom">
                <i class="fa-solid fa-heart input-icon"></i>
                <input type="text" name="hubungan"
                       value="{{ old('hubungan', auth()->user()->hubungan) }}"
                       class="form-control-custom"
                       placeholder="Hubungan dengan Anak">
                <i class="fa-solid fa-pen edit-icon"></i>
            </div>

            <button type="submit" class="btn-save">Simpan</button>

        </form>
    </div>

    @push('scripts')
    <script>
        function previewFile() {
            const file = document.getElementById('fotoInput').files[0];
            const preview = document.getElementById('previewImg');

            if (!file) return;

            const reader = new FileReader();
            reader.onload = e => preview.src = e.target.result;
            reader.readAsDataURL(file);
        }
    </script>

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#1A73E8'
            });
        </script>
    @endif
    @endpush

</x-mobile-app>
