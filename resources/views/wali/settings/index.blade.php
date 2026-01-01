<x-mobile-app title="Pengaturan" :withNavbar="true">

    {{-- Tidak perlu .page-container lagi, langsung include style & content --}}
    @include('wali.settings.styles')
    @include('wali.settings.content')
    @include('wali.settings.scripts')

</x-mobile-app>