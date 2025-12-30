@push('styles')
<style>
    .header-layer{position:absolute;top:0;left:0;right:0;z-index:10}
    .content-scroll { 
        padding-top: 250px; 
        padding-left: 24px; 
        padding-right: 24px; 
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