@props(['active' => ''])

@php
    $menuItems = [
        'form' => [
            'route' => 'user.form',
            'label' => 'Formulir',
            'icon' => '
            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
            </svg>
        ',
        ],
        'tentang' => [
            'route' => 'user.tentang',
            'label' => 'Tentang Sipras',
            'icon' => '
            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        ',
        ],
        'riwayat' => [
            'route' => 'user.histori',
            'label' => 'Riwayat',
            'icon' => '
            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
            </svg>
        ',
        ],
    ];
@endphp

<!-- Desktop Navbar -->
@include('components.navbar-desktop', ['active' => $active, 'menuItems' => $menuItems])

<!-- Mobile Navbar -->
@include('components.navbarm', ['active' => $active, 'menuItems' => $menuItems])

@stack('scripts')
