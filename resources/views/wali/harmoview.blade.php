<x-mobile-app title="HarmoView" :withNavbar="true">

@push('styles')
<style>
.header-layer{position:absolute;top:0;left:0;right:0;z-index:10}
.content-scroll{padding:220px 24px 120px;min-height:100vh}

.compare-select{
    width:100%;
    height:50px;
    border-radius:14px;
    border:none;
    padding:0 16px;
    font-weight:700;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
    margin-bottom:16px;
}

.label-center{
    text-align:center;
    font-weight:800;
    color:#3577E5;
    margin:12px 0;
}

.chart-card{
    background:white;
    border-radius:20px;
    padding:16px;
    margin-top:20px;
}

.result-card{
    display:flex;
    background:white;
    border-radius:16px;
    padding:12px;
    margin-top:16px;
    box-shadow:0 4px 12px rgba(0,0,0,.05);
}

.result-card img{
    width:100px;height:100px;
    border-radius:12px;
    object-fit:cover;
}

.result-content{
    flex:1;
    padding-left:12px;
}

.result-title{
    font-weight:800;
    color:#3577E5;
}

.result-price{
    font-weight:700;
    margin:6px 0;
}
</style>
@endpush

{{-- HEADER --}}
<div class="header-layer">
    <x-custom-header title="HarmoView" />
</div>

<div class="content-scroll">

    {{-- DROPDOWN 1 --}}
    <select id="instansi1" class="compare-select">
        <option value="">Pilih Instansi</option>
    </select>

    <div class="label-center">Cari untuk Membandingkan</div>

    {{-- DROPDOWN 2 --}}
    <select id="instansi2" class="compare-select">
        <option value="">Pilih Instansi</option>
    </select>

    {{-- CHART --}}
    <div id="chartSection" class="chart-card" style="display:none">
        <canvas id="compareChart" height="200"></canvas>
    </div>

    {{-- RESULT CARDS --}}
    <div id="resultCards"></div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let instansiList = []
let chart

document.addEventListener('DOMContentLoaded', async () => {
    const res = await fetch('/api/instansi')
    instansiList = await res.json()

    const s1 = instansi1
    const s2 = instansi2

    instansiList.forEach(i => {
        s1.innerHTML += `<option value="${i.id}">${i.nama}</option>`
        s2.innerHTML += `<option value="${i.id}">${i.nama}</option>`
    })

    s1.onchange = compare
    s2.onchange = compare
})

async function compare(){
    const id1 = instansi1.value
    const id2 = instansi2.value

    if(!id1 || !id2 || id1 === id2) return

    const res = await fetch(`/harmoview/compare?ids=${id1},${id2}`)
    const data = await res.json()

    renderChart(data)
    renderCards(data)
}

function renderChart(data){
    document.getElementById('chartSection').style.display = 'block'

    const labels = ['Fasilitas','Jam Operasional','Program','Biaya']
    const d1 = data[0]
    const d2 = data[1]

    const v1 = [
        d1.jumlah_fasilitas,
        d1.jam_operasional,
        d1.jumlah_program,
        d1.biaya / 100000
    ]

    const v2 = [
        d2.jumlah_fasilitas,
        d2.jam_operasional,
        d2.jumlah_program,
        d2.biaya / 100000
    ]

    if(chart) chart.destroy()

    chart = new Chart(compareChart,{
        type:'line',
        data:{
            labels,
            datasets:[
                {
                    label:d1.nama,
                    data:v1,
                    borderColor:'#2E7CF6',
                    tension:.4
                },
                {
                    label:d2.nama,
                    data:v2,
                    borderColor:'#EA4335',
                    tension:.4
                }
            ]
        },
        options:{
            responsive:true,
            plugins:{legend:{display:true}},
            scales:{y:{beginAtZero:true}}
        }
    })
}

function renderCards(data){
    const c = document.getElementById('resultCards')
    c.innerHTML = ''

    data.forEach(i => {
        c.innerHTML += `
        <div class="result-card">
            <img src="https://via.placeholder.com/100">
            <div class="result-content">
                <div class="result-title">${i.nama}</div>
                <div class="result-price">Rp ${Number(i.biaya).toLocaleString()} /Bulan</div>
                <div>Fasilitas: ${i.jumlah_fasilitas}</div>
                <div>Program: ${i.jumlah_program}</div>
            </div>
        </div>
        `
    })
}
</script>
@endpush

</x-mobile-app>
