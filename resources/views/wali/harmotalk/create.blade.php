<x-mobile-app title="Buat Postingan" :withNavbar="false">

    @push('styles')
    <style>
        .page-container { position: relative; width: 100%; height: 100vh; background: #F8FAFC; overflow: hidden; }
        .header-layer { position: absolute; top: 0; left: 0; right: 0; height: 140px; z-index: 50; pointer-events: none; }
        .header-layer > * { pointer-events: auto; }
        .content-scroll { position: absolute; top: 0; left: 0; right: 0; bottom: 0; padding-top: 140px; padding-bottom: 40px; overflow-y: auto; z-index: 10; -ms-overflow-style: none; scrollbar-width: none; }
        .content-scroll::-webkit-scrollbar { display: none; }
        
        .form-area { padding: 10px 24px 40px 24px; }
        .input-card { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; margin-bottom: 20px; }
        label { display: block; font-weight: 800; color: #1E293B; font-size: 14px; margin-bottom: 12px; }
        
        textarea { width: 100%; border: 1px solid #E2E8F0; border-radius: 16px; padding: 16px; font-size: 14px; color: #334155; font-weight: 500; resize: none; outline: none; transition: 0.2s; min-height: 160px; background: #F8FAFC; font-family: inherit; line-height: 1.6; }
        textarea:focus { border-color: #3577E5; background: #fff; box-shadow: 0 0 0 4px rgba(53, 119, 229, 0.1); }
        
        .upload-box { border: 2px dashed #CBD5E1; border-radius: 16px; padding: 30px 20px; text-align: center; cursor: pointer; transition: 0.2s; background: #FAFAFA; position: relative; overflow: hidden; }
        .upload-box:hover { border-color: #3577E5; background: #EFF6FF; }
        .upload-icon { font-size: 36px; color: #94A3B8; margin-bottom: 12px; transition: 0.2s; }
        #preview-img { width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; display: none; border-radius: 14px; }

        .btn-submit { background: linear-gradient(135deg, #3C7BEA 0%, #3577E5 100%); color: white; width: 100%; border: none; padding: 18px; border-radius: 16px; font-weight: 800; font-size: 16px; box-shadow: 0 10px 25px rgba(53, 119, 229, 0.3); cursor: pointer; transition: 0.2s; display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 10px; }
        .btn-submit:active { transform: scale(0.98); }
        
        .btn-cancel { display: block; width: 100%; text-align: center; margin-top: 15px; color: #EF4444; font-size: 14px; font-weight: 700; text-decoration: none; padding: 12px; border-radius: 14px; background: #FEF2F2; border: 1px solid #FECACA; transition: 0.2s; }
        .btn-cancel:active { background: #FEE2E2; transform: scale(0.98); }
    </style>
    @endpush

    <div class="page-container">
        <div class="header-layer">
            <x-custom-header title="Buat Postingan" backUrl="{{ route('wali.harmotalk') }}" />
        </div>

        <div class="content-scroll">
            <div class="form-area">
                <form action="{{ route('wali.harmotalk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-card">
                        <label>Ceritakan Momen Si Kecil</label>
                        <textarea name="content" placeholder="Apa yang sedang si kecil lakukan hari ini? Sharing yuk..." required></textarea>
                    </div>
                    <div class="input-card">
                        <label>Tambahkan Foto (Opsional)</label>
                        <div class="upload-box" onclick="document.getElementById('imageInput').click()">
                            <input type="file" name="image" id="imageInput" accept="image/*" hidden onchange="previewImage(this)">
                            <div id="upload-placeholder">
                                <i class="fa-regular fa-image upload-icon"></i>
                                <div style="font-size:13px; color:#64748B; font-weight:700;">Klik untuk pilih foto</div>
                                <div style="font-size:11px; color:#cbd5e1; margin-top:4px;">Maksimal 2MB</div>
                            </div>
                            <img id="preview-img" src="#" alt="Preview">
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Terbitkan</button>
                    <a href="{{ route('wali.harmotalk') }}" class="btn-cancel"><i class="fa-solid fa-xmark" style="margin-right: 5px;"></i> Batal</a>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview-img');
            const placeholder = document.getElementById('upload-placeholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.opacity = '0';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-mobile-app>