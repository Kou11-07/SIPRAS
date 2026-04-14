@props(['title' => '', 'subtitle' => null, 'showBackButton' => false, 'backRoute' => null, 'showDate' => false])

<header class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-30">
    <div class="px-4 sm:px-6 py-3">
        <div class="flex items-center justify-between">
            <!-- Left Section -->
            <div class="flex items-center space-x-3">
                <!-- Tombol Burger (Mobile only) -->
                <button id="sidebarToggle" class="md:hidden p-2 hover:bg-slate-100 rounded-lg text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                @if ($showBackButton && $backRoute)
                    <a href="{{ $backRoute }}" class="p-2 hover:bg-slate-100 rounded-lg">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                @endif

                <div>
                    <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-800">
                        {{ $title }}
                    </h1>
                    @if ($subtitle)
                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5 hidden sm:block">
                            {{ $subtitle }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex items-center space-x-3">
                {{ $actions ?? '' }}

                @if ($showDate)
                    <span
                        class="text-xs sm:text-sm text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg whitespace-nowrap">
                        {{ date('d/m/Y') }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Subtitle for mobile -->
        @if ($subtitle)
            <p class="text-xs text-slate-500 mt-2 block sm:hidden">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</header>

@push('scripts')
    <script>
        // Re-attach sidebar toggle event after header is loaded
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebarOverlay');
                    if (sidebar) {
                        sidebar.classList.remove('-translate-x-full');
                        if (overlay) overlay.classList.remove('hidden');
                        document.body.classList.add('sidebar-open');
                    }
                });
            }
        });
    </script>
@endpush
