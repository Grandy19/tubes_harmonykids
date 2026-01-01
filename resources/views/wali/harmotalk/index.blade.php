@php
    // Fallback variable agar tidak error jika controller belum kirim data
    $tab = $tab ?? 'all';
    $sort = $sort ?? 'latest';
    $likedPostIds = $likedPostIds ?? [];
@endphp

<x-mobile-app title="HarmoTalk" :withNavbar="true">
    {{-- 1. Panggil Styles --}}
    @include('wali.harmotalk.styles')

    {{-- 2. Panggil Content --}}
    @include('wali.harmotalk.content')

    {{-- 3. Panggil Scripts --}}
    @include('wali.harmotalk.scripts')
</x-mobile-app>