<x-mobile-app title="Notifikasi" :withNavbar="true">

    {{-- HEADER --}}
    <div class="header-layer">
        <x-custom-header title="Notifikasi" />
    </div>

    {{-- CONTENT --}}
    <div class="setting-content-area">
        @include('wali.notifikasi.content')
    </div>

    {{-- STYLES --}}
    @include('wali.notifikasi.styles')

    {{-- SCRIPTS --}}
    @include('wali.notifikasi.scripts')

</x-mobile-app>
