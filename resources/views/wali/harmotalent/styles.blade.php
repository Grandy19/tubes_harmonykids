@push('styles')
<style>
    .page-container {
        position: relative; 
        width: 100%;
        height: 100vh;
        background: #F8FAFC;
        overflow: hidden; 
    }

    .header-layer {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 140px; 
        z-index: 50;
        pointer-events: none;
    }
    .header-layer > * { pointer-events: auto; }

    .content-scroll {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0; 
        
        padding-top: 240px; 
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 120px; 
        
        overflow-y: auto; 
        z-index: 10;
        
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-scroll::-webkit-scrollbar { display: none; }

    .instruction-text { 
        text-align: center; color: #3577E5; font-weight: 700; 
        font-size: 15px; margin-bottom: 24px; 
    }
    
    .talent-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    
    .talent-card { 
        position: relative; aspect-ratio: 1/1; border-radius: 20px; overflow: hidden; 
        cursor: pointer; transition: 0.2s; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .talent-card:active { transform: scale(0.98); }
    .talent-card img { width: 100%; height: 100%; object-fit: cover; }
    .overlay { 
        position: absolute; inset: 0; padding: 12px; display: flex; align-items: flex-end;
        background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(0,0,0,0.7) 100%);
    }
    .talent-name { color: white; font-size: 14px; font-weight: 800; line-height: 1.2; }
</style>
@endpush