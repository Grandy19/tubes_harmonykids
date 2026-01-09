<x-mobile-app title="Buat Postingan" :withNavbar="true">

    @push('styles')
    <style>
        /* --- LAYOUT UTAMA --- */
        .page-container {
            position: relative;
            width: 100%;
            height: 100vh;
            background: #F8FAFC;
            overflow: hidden;
        }

        /* Layer Header (Fixed) */
        .header-layer {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 140px;
            z-index: 50;
            pointer-events: none;
        }
        .header-layer > * { pointer-events: auto; }

        /* Area Scroll (Content) */
        .content-scroll {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            padding-top: 240px; /* Disesuaikan agar pas di bawah header */
            padding-bottom: 32px;
            overflow-y: auto;
            z-index: 10;
            -ms-overflow-style: none;
            scrollbar-width: none;
            scroll-behavior: smooth;
        }
        .content-scroll::-webkit-scrollbar { display: none; }

        .form-area {
            padding: 20px 24px 100px; /* Padding bawah extra untuk safe area */
            max-width: 600px;
            margin: 0 auto;
        }

        /* --- INPUT CARDS --- */
        .input-group {
            background: white;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid white;
            margin-bottom: 24px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .input-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 800;
            color: #1E293B;
            font-size: 15px;
            margin-bottom: 16px;
        }
        .input-label i { color: #3577E5; }

        /* --- TEXTAREA --- */
        .custom-textarea {
            width: 100%;
            border: 2px solid #F1F5F9;
            border-radius: 16px;
            padding: 16px;
            font-size: 15px;
            color: #334155;
            font-weight: 500;
            resize: none;
            outline: none;
            min-height: 180px;
            background: #FAFAFA;
            font-family: inherit;
            line-height: 1.6;
            transition: all 0.3s ease;
        }
        .custom-textarea:focus {
            border-color: #3577E5;
            background: #fff;
            box-shadow: 0 4px 12px rgba(53, 119, 229, 0.1);
        }
        .custom-textarea::placeholder { color: #94A3B8; font-weight: 400; }

        /* --- UPLOAD BOX --- */
        .upload-wrapper { position: relative; width: 100%; }
        
        .upload-box {
            border: 2px dashed #CBD5E1;
            border-radius: 18px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #FAFAFA;
            position: relative;
            overflow: hidden;
        }
        .upload-box:hover {
            border-color: #3577E5;
            background: #EFF6FF;
        }
        
        .upload-content { transition: opacity 0.3s; }
        .upload-icon {
            font-size: 42px;
            color: #94A3B8;
            margin-bottom: 12px;
            display: block;
        }

        /* Preview Image Style */
        .preview-container {
            display: none; /* Hidden by default */
            position: relative;
            width: 100%;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        #preview-img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 18px;
        }

        /* Tombol Hapus Foto */
        .btn-remove-img {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            color: white;
            border: none;
            width: 32px; height: 32px;
            border-radius: 50%;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: 0.2s;
            z-index: 20;
        }
        .btn-remove-img:hover { background: #EF4444; }

        /* --- ACTION BUTTONS --- */
        .action-area { margin-top: 10px; }

        .btn-submit {
            background: linear-gradient(135deg, #3C7BEA 0%, #3577E5 100%);
            color: white;
            width: 100%;
            border: none;
            padding: 18px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 16px;
            box-shadow: 0 10px 20px rgba(53, 119, 229, 0.25);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 15px 30px rgba(53, 119, 229, 0.3); }
        .btn-submit:active { transform: scale(0.98); }

        .btn-cancel {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 16px;
            color: #64748B;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            padding: 12px;
            border-radius: 14px;
            transition: 0.2s;
        }
        .btn-cancel:hover { color: #EF4444; background: #FEF2F2; }
    </style>
    @endpush

    <div class="page-container">
        {{-- Header Layer --}}
        <div class="header-layer">
            <x-custom-header title="Buat Postingan" backUrl="{{ route('wali.harmotalk') }}" />
        </div>

        {{-- Scrollable Content --}}
        <div class="content-scroll">
            <div class="form-area">
                <form action="{{ route('wali.harmotalk.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
                    @csrf
                    
                    {{-- Input Text --}}
                    <div class="input-group">
                        <label class="input-label">
                            <i class="fa-solid fa-pen-nib"></i> Ceritakan Momen
                        </label>
                        <textarea 
                            name="content" 
                            class="custom-textarea" 
                            placeholder="Apa yang sedang si kecil lakukan hari ini? Bagikan cerita seru Bunda di sini..." 
                            required></textarea>
                    </div>

                    {{-- Input Image --}}
                    <div class="input-group">
                        <label class="input-label">
                            <i class="fa-regular fa-image"></i> Foto (Opsional)
                        </label>
                        
                        <div class="upload-wrapper">
                            {{-- Input File Hidden --}}
                            <input type="file" name="image" id="imageInput" accept="image/*" hidden onchange="handleImageSelect(this)">
                            
                            {{-- State 1: Upload Box (Visible by default) --}}
                            <div class="upload-box" id="upload-trigger" onclick="document.getElementById('imageInput').click()">
                                <div class="upload-content">
                                    <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                                    <div style="font-size:14px; color:#1E293B; font-weight:700;">Ketuk untuk unggah foto</div>
                                    <div style="font-size:12px; color:#94A3B8; margin-top:4px;">JPG, PNG (Maks. 2MB)</div>
                                </div>
                            </div>

                            {{-- State 2: Preview Container (Hidden by default) --}}
                            <div class="preview-container" id="preview-container">
                                <button type="button" class="btn-remove-img" onclick="removeImage()">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <img id="preview-img" src="#" alt="Preview">
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="action-area">
                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-paper-plane"></i> Terbitkan Postingan
                        </button>
                        
                        <a href="{{ route('wali.harmotalk') }}" class="btn-cancel">
                            Batalkan
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const imageInput = document.getElementById('imageInput');
        const uploadTrigger = document.getElementById('upload-trigger');
        const previewContainer = document.getElementById('preview-container');
        const previewImg = document.getElementById('preview-img');

        function handleImageSelect(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    
                    // Sembunyikan box upload, tampilkan preview
                    uploadTrigger.style.display = 'none';
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            // Reset input value
            imageInput.value = '';
            previewImg.src = '#';
            
            // Kembalikan tampilan ke awal
            previewContainer.style.display = 'none';
            uploadTrigger.style.display = 'block';
        }
    </script>
    @endpush
</x-mobile-app>