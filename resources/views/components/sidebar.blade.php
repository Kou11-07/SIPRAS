@props(['active' => ''])

@php
    $menuItems = [
        'dashboard' => [
            'route' => 'admin.dashboard',
            'label' => 'Dashboard',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
</svg>',
        ],
        'tiket' => [
            'route' => 'admin.tiket',
            'label' => 'Daftar Tiket',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
</svg>',
        ],
        'riwayat' => [
            'route' => 'admin.riwayat',
            'label' => 'Riwayat',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
</svg>',
        ],
        'siswa' => [
            'route' => 'admin.siswa',
            'label' => 'Manajemen Siswa',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
</svg>',
        ],
    ];
@endphp

<!-- Sidebar untuk Desktop & Mobile -->
<aside id="sidebar"
    class="fixed md:relative inset-y-0 left-0 z-40 w-64 bg-white shadow-2xl flex flex-col h-full transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">

    <!-- Header Sidebar dengan Logo dan Tombol Close (Mobile) -->
    <div class="p-4 border-b border-slate-100 flex items-center justify-between">
        <img src="{{ asset('img/LogoV1.png') }}" alt="Logo" class="h-10 w-auto">
        <button id="sidebarClose" class="md:hidden text-gray-500 hover:text-gray-700 p-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        @foreach ($menuItems as $key => $item)
            <a href="{{ route($item['route']) }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200
                {{ request()->routeIs($item['route']) ? 'bg-blue-500 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                <div class="w-5 h-5 flex-shrink-0">
                    {!! $item['icon'] !!}
                </div>
                <span class="text-sm font-medium">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- User Info & Logout -->
    <div class="p-4 border-t border-slate-100 bg-white">
        <div class="flex items-center space-x-3 mb-4">
            <div
                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                {{ substr(Auth::user()->username ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->username ?? 'Admin' }}</p>
            </div>
        </div>

        <button type="button" id="logoutButton"
            class="flex items-center space-x-3 px-4 py-3 rounded-xl text-red-600 font-medium hover:bg-red-50 transition w-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="text-sm">Logout</span>
        </button>

        <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</aside>

<!-- Overlay untuk mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden transition-all duration-300"></div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Sidebar elements
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarClose = document.getElementById('sidebarClose');

        // Cari tombol toggle di header (akan dipanggil dari header)
        let sidebarToggle = null;

        function findSidebarToggle() {
            sidebarToggle = document.getElementById('sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.removeEventListener('click', openSidebar);
                sidebarToggle.addEventListener('click', openSidebar);
            }
        }

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
            document.body.classList.add('sidebar-open');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
            document.body.classList.remove('sidebar-open');
        }

        // Event listeners
        if (sidebarClose) {
            sidebarClose.addEventListener('click', closeSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }

        // Handle resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('sidebar-open');
            } else {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    closeSidebar();
                }
            }
        });

        // Initial find toggle button
        setTimeout(findSidebarToggle, 100);

        // Logout functionality
        const logoutBtn = document.getElementById('logoutButton');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan keluar dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Keluar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form-admin').submit();
                    }
                });
            });
        }
    </script>
@endpush
