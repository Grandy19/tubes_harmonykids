@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<style>
    /* --- LAYOUT GLOBAL --- */
    .header-layer { 
        position: absolute; top: 0; left: 0; right: 0; 
        z-index: 50; 
        pointer-events: none; 
    }
    
    .header-layer > * { pointer-events: auto; }

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
    .content-scroll::-webkit-scrollbar { display: none; }

    .label-center {
        font-weight: 800; color: #3577E5; font-size: 14px;
        text-align: center; margin: 12px 0;
        text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.8;
    }

    .search-pill {
        position: relative;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        min-height: 55px;
        display: flex;
        align-items: center;
        padding: 0 15px;
        border: 1px solid #f0f0f0;
    }

    .search-icon { font-size: 18px; color: #aaa; margin-right: 10px; z-index: 5; }

    .dot-indicator { 
        width: 14px; height: 14px; border-radius: 50%; margin-left: 10px; flex-shrink: 0; z-index: 5;
    }
    .dot-blue { background: #3577E5; }
    .dot-red { background: #EA4335; }

    /* Choices JS Styling */
    .choices { flex: 1; margin-bottom: 0; font-size: 14px; font-weight: 600; color: #333; overflow: visible; }
    .choices__inner { border: none !important; background-color: transparent !important; padding: 0 !important; min-height: auto !important; display: flex; align-items: center; }
    .choices__input { background-color: transparent !important; margin-bottom: 0 !important; font-size: 14px !important; color: #333 !important; font-weight: 600 !important; }
    .choices__placeholder { opacity: 0.5; color: #999; }
    .choices__list--dropdown { background: #ffffff; border: none; border-radius: 12px; box-shadow: 0 10px 30px rgba(53, 119, 229, 0.15); margin-top: 10px; padding: 5px; z-index: 100 !important; }
    .choices__list--dropdown .choices__item { border-radius: 8px; font-size: 13px; padding: 10px 14px; margin-bottom: 2px; color: #555; }
    .choices__list--dropdown .choices__item--selectable.is-highlighted { background-color: #F0F7FF; color: #3577E5; font-weight: 700; }
    .choices[data-type*="select-one"]::after { display: none; }

    /* Result Cards */
    .chart-card { background: white; border-radius: 24px; padding: 20px; margin-top: 24px; box-shadow: 0 6px 20px rgba(0,0,0,0.05); display: none; }
    .chart-title { text-align: center; color: #3577E5; font-weight: 700; font-size: 16px; margin-bottom: 20px; }
    
    .result-card { display: flex; background: white; border-radius: 20px; padding: 12px; margin-top: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); position: relative; border: 1px solid #f8f9fa; cursor: pointer; }
    .result-card img { width: 90px; height: 90px; border-radius: 16px; object-fit: cover; margin-right: 14px; background: #eee; }
    .result-content { flex: 1; display: flex; flex-direction: column; justify-content: center; }
    .result-title { font-weight: 800; color: #3577E5; font-size: 15px; margin-bottom: 4px; }
    .result-price { font-weight: 700; color: #3577E5; font-size: 14px; margin-bottom: 6px; }
    .badge-pill { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700; color: white; width: fit-content; margin-bottom: 6px; }
    .bg-green { background: #4CD964; } .bg-yellow { background: #FFC107; }
    .result-loc { font-size: 11px; color: #666; font-weight: 600; display: flex; align-items: center; }
    .result-loc i { color: #3577E5; margin-right: 5px; font-size: 13px; }
    .rating-pill { position: absolute; top: 12px; right: 12px; background: #fff; border: 1px solid #eee; padding: 4px 8px; border-radius: 10px; font-size: 12px; font-weight: 800; color: #333; display: flex; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    .rating-pill i { color: #FFC107; margin-right: 4px; }
</style>
@endpush