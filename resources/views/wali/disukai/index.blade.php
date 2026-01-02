<x-mobile-app title="Disukai" :withNavbar="true">

    {{-- HEADER --}}
    <div class="header-layer">
        <x-custom-header title="Disukai" />
    </div>

    {{-- CONTENT --}}
    <div class="setting-content-area">
        @include('wali.disukai.content')
    </div>

    {{-- STYLES --}}
    @include('wali.disukai.styles')

    {{-- SCRIPTS --}}
    @include('wali.disukai.scripts')

</x-mobile-app>
