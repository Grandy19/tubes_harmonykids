@push('styles')
<style>
    .safe-bottom-padding, 
    .safe-area-bottom {
        display: none !important;
        background-color: transparent !important;
        height: 0 !important;
        padding: 0 !important;
    }

    .mobile-card { 
        background: linear-gradient(180deg, #0F3974 0%, #2E7CF6 100%); 
        padding: 0; 
        
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow-y: auto;
    }

    .scroll-content { 
        padding: 24px 24px 50px; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        width: 100%;
    }

    .btn-back { 
        position: absolute; top: 25px; left: 25px; 
        width: 45px; height: 45px; 
        background: #fff; border-radius: 50%; 
        display: flex; align-items: center; justify-content: center; 
        color: #1A73E8; 
        box-shadow: 0 4px 6px rgba(0,0,0,.1); 
        text-decoration: none; 
        z-index: 10; font-size: 22px; 
    }

    .family-img { 
        width: 100%; max-width: 280px; 
        margin-top: 60px; margin-bottom: 10px; 
    }

    .headline { 
        text-align: center; color: #fff; margin-bottom: 25px; 
    }
    .headline h1 { font-weight: 800; font-size: 30px; }
    .headline p { font-size: 15px; }
    
    .custom-input-box { 
        background: #fff; border-radius: 15px; 
        padding: 0 15px; height: 55px; width: 100%; 
        display: flex; align-items: center; margin-bottom: 18px; 
        box-shadow: 0 4px 6px rgba(0,0,0,.1); 
    }

    .field-icon { color: #1A73E8; font-size: 20px; width: 35px; }
    
    .form-input { 
        border: none; outline: none; width: 100%; 
        font-weight: 600; color: #1A73E8; background: transparent; 
    }
    
    .checkbox-wrapper { 
        display: flex; gap: 10px; color: #fff; font-size: 13px; 
        margin-bottom: 25px; width: 100%; 
    }

    .custom-checkbox { 
        width: 22px; height: 22px; border: 2px solid #fff; 
        border-radius: 6px; display: flex; align-items: center; 
        justify-content: center; cursor: pointer; 
    }

    .custom-checkbox.checked { background: #fff; }
    .custom-checkbox i { color: #1A73E8; display: none; }
    .custom-checkbox.checked i { display: block; }
    
    .btn-daftar { 
        width: 100%; height: 55px; 
        background: #fff; 
        color: #0D253F; border-radius: 15px; 
        font-size: 18px; font-weight: 800; 
        border: none; cursor: pointer; 
        box-shadow: 0 8px 0 #D8D5EA; 
        margin-top: 10px;
        transition: transform 0.1s;
    }

    .btn-daftar:active { 
        transform: translateY(4px); 
        box-shadow: 0 4px 0 #D8D5EA; 
    }
    
    .alert-custom { 
        background: rgba(255,255,255,0.95); color: #dc3545; 
        padding: 15px; border-radius: 10px; font-size: 14px; 
        text-align: left; margin-bottom: 20px; font-weight: 600; 
        border-left: 5px solid #dc3545; width: 100%; 
    }
</style>
@endpush