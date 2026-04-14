<x-alayout>
    @section('title', 'Admin Panel - Pengaduan Sarana')

    @section('content')
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <x-sidebar active="riwayat" />

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto scroll-smooth">
                <!-- Header -->
                <x-header title="Riwayat" subtitle="Riwayat tiket yang telah selesai atau ditolak." :showMobileMenu="true">
                    <x-slot name="actions">
                        <form action="{{ route('admin.laporan.pdf') }}" method="GET" target="_blank" class="flex gap-2">
                            <button type="submit"
                                class="px-3 py-2 sm:px-4 sm:py-2 bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition text-sm sm:text-base">
                                Cetak PDF
                            </button>
                        </form>
                    </x-slot>
                </x-header>

                <!-- Content Area -->
                <div class="p-4 sm:p-6 md:p-8">
                    <!-- Stats Cards - Sama seperti di dashboard -->
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
                        <!-- Total Selesai -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Total Selesai</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-emerald-600">{{ $totalSelesai }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-emerald-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Bulan Ini -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Bulan Ini</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-blue-600">{{ $bulanIni }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Minggu Ini -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Minggu Ini</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-purple-600">{{ $mingguIni }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-purple-400 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat List - Responsive -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-in-up">
                        <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-slate-200">
                            <h2 class="text-lg sm:text-xl font-bold text-slate-800">Daftar Riwayat Tiket</h2>
                        </div>

                        <div class="p-4 sm:p-6">
                            <!-- Mobile Card View -->
                            <div class="block md:hidden space-y-3">
                                @forelse($riwayat as $tiket)
                                    <a href="{{ route('admin.riwayat.show', $tiket->id) }}"
                                        class="history-card bg-gradient-to-r from-slate-50 to-white border border-slate-200 rounded-xl p-4 hover:border-indigo-300 hover:shadow-lg transition-all duration-300 block">
                                        <div class="flex items-start justify-between">
                                            <div class="flex items-start space-x-3 flex-1">
                                                <div
                                                    class="w-10 h-10 rounded-full flex items-center justify-center shadow-lg flex-shrink-0
                                                    @if ($tiket->status == 'selesai') bg-gradient-to-br from-emerald-400 to-green-600
                                                    @else bg-gradient-to-br from-red-400 to-red-600 @endif">
                                                    @if ($tiket->status == 'selesai')
                                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="text-base font-bold text-slate-800 truncate">
                                                        {{ $tiket->no_tiket }}</h3>
                                                    <p class="text-xs text-slate-500 mt-0.5">
                                                        {{ $tiket->nama_pengirim }} •
                                                        {{ $tiket->selesai_at ? \Carbon\Carbon::parse($tiket->selesai_at)->format('d M Y') : $tiket->updated_at->format('d M Y') }}
                                                    </p>
                                                    <p class="text-xs text-slate-400 mt-1 line-clamp-2">
                                                        {{ Str::limit($tiket->deskripsi, 80) }}</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end space-y-2 ml-2">
                                                <span
                                                    class="status-badge inline-flex px-2 py-1 text-xs font-semibold rounded-full whitespace-nowrap
                                                    @if ($tiket->status == 'selesai') bg-emerald-100 text-emerald-700
                                                    @else bg-red-100 text-red-700 @endif">
                                                    {{ $tiket->status == 'selesai' ? 'Selesai' : 'Ditolak' }}
                                                </span>
                                                <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-8">
                                        <svg class="w-16 h-16 mx-auto text-slate-300 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-slate-500">Belum ada riwayat tiket</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Desktop List View -->
                            <div class="hidden md:block space-y-4">
                                @forelse($riwayat as $tiket)
                                    <a href="{{ route('admin.riwayat.show', $tiket->id) }}"
                                        class="history-card bg-gradient-to-r from-slate-50 to-white border-2 border-slate-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-lg transition-all duration-300 block">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4 flex-1">
                                                <div
                                                    class="w-12 h-12 rounded-full flex items-center justify-center shadow-lg flex-shrink-0
                                                    @if ($tiket->status == 'selesai') bg-gradient-to-br from-emerald-400 to-green-600
                                                    @else bg-gradient-to-br from-red-400 to-red-600 @endif">
                                                    @if ($tiket->status == 'selesai')
                                                        <svg class="w-6 h-6 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-6 h-6 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="text-lg font-bold text-slate-800">{{ $tiket->no_tiket }}
                                                    </h3>
                                                    <p class="text-sm text-slate-500 mt-0.5">
                                                        {{ $tiket->nama_pengirim }} •
                                                        {{ $tiket->selesai_at ? \Carbon\Carbon::parse($tiket->selesai_at)->format('d M Y') : $tiket->updated_at->format('d M Y') }}
                                                    </p>
                                                    <p class="text-xs text-slate-400 mt-1 line-clamp-2">
                                                        {{ Str::limit($tiket->deskripsi, 100) }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4 flex-shrink-0">
                                                <span
                                                    class="status-badge inline-flex px-4 py-2 text-sm font-semibold rounded-full whitespace-nowrap
                                                    @if ($tiket->status == 'selesai') bg-emerald-100 text-emerald-700
                                                    @else bg-red-100 text-red-700 @endif">
                                                    {{ $tiket->status == 'selesai' ? 'Selesai' : 'Ditolak' }}
                                                </span>
                                                <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-8">
                                        <svg class="w-16 h-16 mx-auto text-slate-300 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-slate-500">Belum ada riwayat tiket</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Pagination - Responsive -->
                            @if ($riwayat->hasPages())
                                <div class="mt-6 pt-6 border-t border-slate-200">
                                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                        <p class="text-xs sm:text-sm text-slate-600">
                                            Menampilkan {{ $riwayat->firstItem() }} - {{ $riwayat->lastItem() }} dari
                                            {{ $riwayat->total() }} tiket
                                        </p>
                                        <div class="flex flex-wrap items-center justify-center gap-1 sm:gap-2">
                                            {{-- Previous --}}
                                            @if ($riwayat->onFirstPage())
                                                <span
                                                    class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed text-sm">&laquo;
                                                    Sebelumnya</span>
                                            @else
                                                <a href="{{ $riwayat->previousPageUrl() }}"
                                                    class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-indigo-50 transition text-sm">&laquo;
                                                    Sebelumnya</a>
                                            @endif

                                            {{-- Page Numbers --}}
                                            @foreach ($riwayat->getUrlRange(1, $riwayat->lastPage()) as $page => $url)
                                                @if ($page == $riwayat->currentPage())
                                                    <span
                                                        class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-indigo-600 text-white shadow-md text-sm">{{ $page }}</span>
                                                @elseif ($page >= $riwayat->currentPage() - 2 && $page <= $riwayat->currentPage() + 2)
                                                    <a href="{{ $url }}"
                                                        class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-indigo-50 transition text-sm">{{ $page }}</a>
                                                @endif
                                            @endforeach

                                            {{-- Next --}}
                                            @if ($riwayat->hasMorePages())
                                                <a href="{{ $riwayat->nextPageUrl() }}"
                                                    class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-indigo-50 transition text-sm">Selanjutnya
                                                    &raquo;</a>
                                            @else
                                                <span
                                                    class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed text-sm">Selanjutnya
                                                    &raquo;</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @endsection
</x-alayout>
