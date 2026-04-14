<x-layout>
    @section('title', 'Form Pengaduan - Pengaduan Sarana Sekolah')

    @section('content')
        <!-- Navbar Component -->
        <x-navbar active="riwayat" />

        <div class="hero-section pt-20 pb-8 md:pb-10 lg:pb-12 px-4 sm:px-6 md:px-8"
            style="background-image: url('{{ asset('img/bgr.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
            <div class="container mx-auto">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2 md:mb-3 lg:mb-4">
                    Riwayat Pengaduan
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-white opacity-90 max-w-2xl">
                    Berikut adalah daftar pengaduan yang telah Anda kirimkan
                </p>
            </div>
        </div>

        <!-- Main Content -->
        <!-- Main Content -->
        <main class="pt-8 sm:pt-10 pb-12 px-4 sm:px-6 lg:px-8 mx-auto max-w-7xl">
            <!-- Statistik Cards -->
            @php
                $totalTickets = $tickets->count();
                $pendingCount = $tickets->where('status', 'pending')->count();
                $prosesCount = $tickets->whereIn('status', ['proses', 'verifikasi'])->count();
                // Status ditolak masuk ke selesai
                $selesaiCount = $tickets->whereIn('status', ['selesai', 'ditolak'])->count();
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8">
                <!-- Total Pengaduan -->
                <div class="bg-white rounded-lg shadow-xl p-3 sm:p-5 md:p-6 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex flex-col items-center text-center">
                        <div class="p-2 sm:p-3 bg-blue-100 rounded-full mb-2 sm:mb-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500">Total Pengaduan</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $totalTickets }}</p>
                        </div>
                    </div>
                </div>

                <!-- Menunggu -->
                <div
                    class="bg-white rounded-lg shadow-xl p-3 sm:p-5 md:p-6 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex flex-col items-center text-center">
                        <div class="p-2 sm:p-3 bg-yellow-100 rounded-full mb-2 sm:mb-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500">Menunggu</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $pendingCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Diproses -->
                <div
                    class="bg-white rounded-lg shadow-xl p-3 sm:p-5 md:p-6 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex flex-col items-center text-center">
                        <div class="p-2 sm:p-3 bg-purple-100 rounded-full mb-2 sm:mb-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500">Diproses</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $prosesCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Selesai/Ditolak -->
                <div
                    class="bg-white rounded-lg shadow-xl p-3 sm:p-5 md:p-6 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex flex-col items-center text-center">
                        <div class="p-2 sm:p-3 bg-green-100 rounded-full mb-2 sm:mb-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500">Selesai</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $selesaiCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Riwayat -->
            <div class="space-y-3 sm:space-y-4">
                @forelse($tickets as $ticket)
                    <div
                        class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden transition-all hover:shadow-lg">
                        <button onclick="toggleDetail('detail{{ $ticket->id }}')"
                            class="w-full px-4 sm:px-6 py-3 sm:py-4 flex flex-col sm:flex-row items-start sm:items-center justify-between text-left gap-3 sm:gap-0">
                            <div class="flex-1 w-full">
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-2">
                                    <span class="text-xs sm:text-sm font-medium text-gray-500">No. Tiket:</span>
                                    <span
                                        class="font-mono text-xs sm:text-sm bg-gray-100 px-2 py-1 rounded">{{ $ticket->no_tiket }}</span>
                                </div>
                                <p class="text-sm sm:text-base text-gray-800 line-clamp-2">
                                    {{ Str::limit($ticket->deskripsi, 100) }}</p>
                                <div
                                    class="flex flex-wrap items-center gap-2 sm:gap-4 mt-2 text-xs sm:text-sm text-gray-500">
                                    <span class="truncate max-w-[120px] sm:max-w-none">{{ $ticket->lokasi->nama }}</span>
                                    <span>•</span>
                                    <span class="truncate max-w-[100px] sm:max-w-none">{{ $ticket->kategori->nama }}</span>
                                    <span>•</span>
                                    <span>{{ $ticket->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-2 sm:gap-3 mt-2 sm:mt-0 w-full sm:w-auto justify-between sm:justify-end">
                                @php
                                    $statusClass = match ($ticket->status) {
                                        'pending' => 'status-pending',
                                        'verifikasi' => 'status-verifikasi',
                                        'proses' => 'status-proses',
                                        'selesai' => 'status-selesai',
                                        'ditolak' => 'status-ditolak',
                                        default => 'status-pending',
                                    };

                                    $statusLabel = match ($ticket->status) {
                                        'pending' => 'Menunggu',
                                        'verifikasi' => 'Verifikasi',
                                        'proses' => 'Diproses',
                                        'selesai' => 'Selesai',
                                        'ditolak' => 'Ditolak',
                                        default => $ticket->status,
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }} text-xs sm:text-sm px-2 sm:px-3 py-1">
                                    {{ $statusLabel }}
                                </span>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 transform transition-transform duration-200 flex-shrink-0"
                                    id="arrow{{ $ticket->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </div>
                        </button>

                        <!-- Detail Section -->
                        <div id="detail{{ $ticket->id }}"
                            class="hidden border-t border-gray-200 px-4 sm:px-6 py-4 sm:py-6 bg-gray-50">
                            <h3
                                class="text-base sm:text-lg font-semibold text-gray-800 mb-2 sticky top-0 bg-gray-50 py-2 z-10">
                                Perkembangan Pengaduan
                            </h3>
                            <!-- Timeline Progress -->
                            <div class="mb-6 overflow-x-auto pt-4">
                                <div class="min-w-[500px] sm:min-w-0">
                                    @php
                                        $statuses = ['pending', 'verifikasi', 'proses', 'selesai'];
                                        $isDitolak = $ticket->status === 'ditolak';
                                        $currentStatusIndex = $isDitolak ? 3 : array_search($ticket->status, $statuses);
                                        if ($currentStatusIndex === false) {
                                            $currentStatusIndex = 0;
                                        }
                                    @endphp

                                    <div class="flex items-center justify-between mb-4">
                                        @foreach (['Menunggu', 'Verifikasi', 'Diproses', 'Selesai'] as $index => $step)
                                            <div class="flex flex-col items-center flex-1">
                                                @if ($isDitolak && $index == 3)
                                                    <!-- Status Ditolak - Tanda X Merah -->
                                                    <div
                                                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center mb-2 bg-red-500 ring-4 ring-red-200">
                                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <!-- Status Normal -->
                                                    <div
                                                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center mb-2
                                                {{ $index <= $currentStatusIndex ? 'bg-blue-500' : 'bg-gray-300' }}
                                                {{ $index == $currentStatusIndex && !$isDitolak ? 'ring-4 ring-blue-200' : '' }}">
                                                        @if ($index <= $currentStatusIndex && !$isDitolak)
                                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white"
                                                                fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        @elseif($index <= $currentStatusIndex && $isDitolak && $index < 3)
                                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white"
                                                                fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                @endif
                                                <span
                                                    class="text-[10px] sm:text-xs font-medium text-center
                                            {{ $isDitolak && $index == 3 ? 'text-red-600' : ($index <= $currentStatusIndex ? 'text-gray-700' : 'text-gray-400') }}">
                                                    {{ $step }}
                                                </span>
                                            </div>
                                            @if ($index < 3)
                                                <div
                                                    class="flex-1 h-1 
                                            {{ $isDitolak && $index < 3 ? 'bg-blue-500' : ($index < $currentStatusIndex ? 'bg-blue-500' : 'bg-gray-300') }}">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if ($isDitolak)
                                        <div class="text-center mt-4">
                                            <span
                                                class="inline-flex items-center px-3 sm:px-4 py-1 sm:py-2 bg-red-100 text-red-800 rounded-full text-xs sm:text-sm font-medium">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Pengaduan Ditolak
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Detail Informasi -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Informasi
                                            Pelapor</label>
                                        <div class="bg-white p-3 rounded border border-gray-200">
                                            <p class="text-xs sm:text-sm"><span class="font-medium">Nama:</span>
                                                {{ $ticket->nama_pengirim }}</p>
                                            <p class="text-xs sm:text-sm"><span class="font-medium">NISN:</span>
                                                {{ $ticket->nisn_pengirim }}</p>
                                            <p class="text-xs sm:text-sm">
                                                <span class="font-medium">Kelas:</span>
                                                {{ $ticket->kelas_pengirim ?? (Auth::user()->kelas ?? '-') }}
                                            </p>
                                            @if ($ticket->is_anonim)
                                                <p class="text-xs text-blue-600 mt-1">✓ Dikirim sebagai Anonim</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                        <div class="bg-white p-3 rounded border border-gray-200">
                                            <p class="text-xs sm:text-sm">{{ $ticket->kategori->nama }}</p>
                                            @if ($ticket->kategori->deskripsi)
                                                <p class="text-[10px] sm:text-xs text-gray-500 mt-1">
                                                    {{ $ticket->kategori->deskripsi }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                    <div class="bg-white p-3 rounded border border-gray-200">
                                        <p class="text-xs sm:text-sm"><span class="font-medium"></span>
                                            {{ $ticket->lokasi->nama }}</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label
                                            class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                        <div class="bg-white p-3 rounded border border-gray-200">
                                            <p class="text-xs sm:text-sm break-words">{{ $ticket->deskripsi }}</p>
                                        </div>
                                    </div>

                                    @if ($ticket->foto_bukti)
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Foto
                                                Bukti</label>
                                            <div class="bg-white p-3 rounded border border-gray-200">
                                                <img src="{{ asset('storage/' . $ticket->foto_bukti) }}" alt="Foto Bukti"
                                                    class="max-h-40 sm:max-h-48 rounded mx-auto cursor-pointer hover:opacity-90 transition"
                                                    onclick="openImageModal(this.src)">
                                            </div>
                                        </div>
                                    @endif

                                    @if ($ticket->catatan_admin)
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Catatan
                                                Admin</label>
                                            <div class="bg-yellow-50 p-3 rounded border border-yellow-200">
                                                <p class="text-xs sm:text-sm text-yellow-800 break-words">
                                                    {{ $ticket->catatan_admin }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Feedback dari Admin -->
                                    @if ($ticket->feedback)
                                        <div class="mt-4">
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 inline mr-1 text-blue-600"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                                    </path>
                                                </svg>
                                                Feedback dari Admin
                                            </label>
                                            <div class="bg-blue-50 p-3 sm:p-4 rounded-lg border border-blue-200">
                                                <div class="flex items-start gap-2 sm:gap-3">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600"
                                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="text-xs sm:text-sm font-semibold text-blue-800 mb-1">
                                                            Pesan dari
                                                            Admin:</p>
                                                        <p class="text-xs sm:text-sm text-blue-700 break-words">
                                                            {{ $ticket->feedback }}</p>
                                                        @if ($ticket->updated_at)
                                                            <p class="text-[10px] sm:text-xs text-blue-500 mt-2">
                                                                {{ $ticket->updated_at->format('d M Y H:i') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div>
                                        <label
                                            class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Timeline</label>
                                        <div class="bg-white p-3 rounded border border-gray-200 space-y-2">
                                            <p class="text-[10px] sm:text-xs text-gray-500">
                                                <span class="font-medium">Dibuat:</span>
                                                {{ $ticket->created_at->format('d M Y') }}
                                            </p>
                                            @if ($ticket->diproses_at)
                                                <p class="text-[10px] sm:text-xs text-gray-500">
                                                    <span class="font-medium">Diproses:</span>
                                                    {{ \Carbon\Carbon::parse($ticket->diproses_at)->format('d M Y') }}
                                                </p>
                                            @endif
                                            @if ($ticket->selesai_at || $ticket->status === 'ditolak')
                                                <p class="text-[10px] sm:text-xs text-gray-500">
                                                    <span
                                                        class="font-medium">{{ $ticket->status === 'ditolak' ? 'Ditolak' : 'Selesai' }}:</span>
                                                    {{ $ticket->selesai_at ? \Carbon\Carbon::parse($ticket->selesai_at)->format('d M Y') : ($ticket->updated_at ? $ticket->updated_at->format('d M Y') : '-') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- History Log -->
                            @if ($ticket->histories && $ticket->histories->count() > 0)
                                <div class="mt-6">
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Riwayat
                                        Perubahan
                                        Status</label>
                                    <div class="bg-white rounded border border-gray-200 divide-y">
                                        @foreach ($ticket->histories->sortByDesc('created_at') as $history)
                                            <div class="p-3 flex items-start gap-2 sm:gap-3">
                                                <div
                                                    class="w-1.5 h-1.5 sm:w-2 sm:h-2 mt-1.5 sm:mt-2 rounded-full 
                                            @if ($history->status == 'pending') bg-yellow-500
                                            @elseif($history->status == 'verifikasi') bg-blue-500
                                            @elseif($history->status == 'proses') bg-purple-500
                                            @elseif($history->status == 'selesai') bg-green-500
                                            @elseif($history->status == 'ditolak') bg-red-500 @endif">
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs sm:text-sm">
                                                        <span class="font-medium">
                                                            {{ match ($history->status) {
                                                                'pending' => 'Menunggu',
                                                                'verifikasi' => 'Verifikasi',
                                                                'proses' => 'Diproses',
                                                                'selesai' => 'Selesai',
                                                                'ditolak' => 'Ditolak',
                                                                default => $history->status,
                                                            } }}
                                                        </span>
                                                        @if ($history->catatan)
                                                            <span class="text-gray-600"> - {{ $history->catatan }}</span>
                                                        @endif
                                                    </p>
                                                    <p class="text-[10px] sm:text-xs text-gray-400">
                                                        {{ $history->created_at->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="text-center py-12 sm:py-16 bg-white rounded-lg shadow">
                        <svg class="w-16 h-16 sm:w-24 sm:h-24 mx-auto text-gray-300 mb-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-gray-500 text-base sm:text-lg mb-2">Belum ada pengaduan</p>
                        <p class="text-gray-400 text-sm sm:text-base mb-4 sm:mb-6">Anda belum pernah mengirimkan pengaduan
                        </p>
                        <a href="{{ route('user.form') }}"
                            class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Buat Pengaduan Baru
                        </a>
                    </div>
                @endforelse
            </div>
        </main>

        <!-- Image Modal untuk Foto Bukti -->
        <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95 items-center justify-center p-4"
            onclick="closeImageModal()">
            <div class="relative max-w-full max-h-full">
                <button onclick="closeImageModal()"
                    class="absolute -top-10 right-0 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <img id="modalImage" src="" alt="Foto Bukti" class="max-w-full max-h-screen object-contain">
            </div>
        </div>

        <!-- Footer Component -->
        <x-footer />

        @push('scripts')
            <script src="{{ asset('js/navbar.js') }}"></script>
            <script>
                // Toggle detail function
                function toggleDetail(detailId) {
                    const detail = document.getElementById(detailId);
                    const arrowId = detailId.replace('detail', 'arrow');
                    const arrow = document.getElementById(arrowId);

                    if (detail.classList.contains('hidden')) {
                        detail.classList.remove('hidden');
                        arrow.style.transform = 'rotate(90deg)';
                    } else {
                        detail.classList.add('hidden');
                        arrow.style.transform = 'rotate(0deg)';
                    }
                }

                // Image modal function
                function openImageModal(src) {
                    const modal = document.getElementById('imageModal');
                    const modalImg = document.getElementById('modalImage');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    modalImg.src = src;
                    document.body.style.overflow = 'hidden';
                }

                function closeImageModal() {
                    const modal = document.getElementById('imageModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = '';
                }

                // Close modal with ESC key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        const modal = document.getElementById('imageModal');
                        if (modal && !modal.classList.contains('hidden')) {
                            closeImageModal();
                        }
                    }
                });
            </script>
        @endpush
    @endsection
</x-layout>
