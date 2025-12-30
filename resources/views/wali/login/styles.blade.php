@push('styles')
<style>
    /* GUE PERTAHANIN STYLE ASLI LO */
    .mobile-card {
        background: linear-gradient(180deg, #0F3974 0%, #2E7CF6 100%);
        display: flex; flex-direction: column; padding: 30px; min-height: 850px;
    }
    .btn-back {
        position: absolute; top: 25px; left: 25px; width: 45px; height: 45px;
        background: white; border-radius: 50%; display: flex; align-items: center;
        justify-content: center; color: #1A73E8; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        text-decoration: none; z-index: 20; font-size: 22px;
    }
    .plane-img {
        width: 100%; max-width: 320px; margin-top: 40px; align-self: center;
        transform: translateY(-10px); filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
    }
    .headline { text-align: center; color: white; margin-bottom: 30px; }
    .headline h1 { font-weight: 800; font-size: 32px; margin: 0; }
    .headline p { font-size: 16px; margin-top: 5px; opacity: 0.95; }
    
    .custom-input-box {
        background: white; border-radius: 15px; padding: 0 20px; height: 60px;
        display: flex; align-items: center; margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .field-icon { color: #1A73E8; font-size: 20px; margin-right: 15px; }
    
    .form-input {
        border: none; outline: none; width: 100%; height: 100%;
        font-family: 'Baloo 2', cursive; font-weight: 700; font-size: 16px;
        color: #1A73E8; background: transparent;
    }
    .password-toggle { color: #1A73E8; cursor: pointer; font-size: 20px; padding: 10px; }
    
    .btn-masuk {
        width: 100%; height: 55px; background: white; color: #0D253F;
        border: none; border-radius: 15px; font-size: 18px; font-weight: 800;
        margin-top: 10px; cursor: pointer; box-shadow: 0 8px 0 #D8D5EA;
    }
    .btn-masuk:active { transform: translateY(4px); box-shadow: 0 4px 0 #D8D5EA; }
    
    .alert-custom {
        background: rgba(255,255,255,0.9); color: #dc3545; padding: 15px;
        border-radius: 10px; font-size: 14px; text-align: center;
        margin-bottom: 20px; font-weight: bold; border-left: 5px solid #dc3545;
    }
</style>
@endpush