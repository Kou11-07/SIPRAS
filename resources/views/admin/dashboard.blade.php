<x-alayout>
    @section('title', 'Admin Panel - Pengaduan Sarana')

    @section('content')
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <x-sidebar active="dashboard" />

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto scroll-smooth">
                <!-- Top Bar -->
                <x-header title="Dashboard"
                    subtitle="Selamat datang, {{ Auth::user()->username }}! Lihat laporan terbaru disini." :showDate="true"
                    :showMobileMenu="true" />


                <!-- Dashboard Content -->
                <div class="p-4 sm:p-6 md:p-8 animate-slide-in-up">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
                        <!-- Total Tiket -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Total Tiket</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $totalTiket }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Menunggu -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Menunggu</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $menunggu }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Diproses -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Diproses</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $diproses }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Selesai -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Selesai</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $selesai }}</h3>
                                    <div class="text-xs text-slate-500 mt-1 lg:hidden">
                                        <span class="text-red-600 font-semibold">{{ $ditolak }}</span> ditolak
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="text-xs text-slate-500 mt-2 hidden lg:block">
                                        <span class="text-red-600 font-semibold">{{ $ditolak }}</span> ditolak
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tiket Aktif Terbaru Section -->
                    <div class="mb-6 md:mb-8">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 md:mb-6">
                            <div>
                                <h2 class="text-xl md:text-2xl font-bold text-slate-800 border-l-4 border-blue-500 pl-4">
                                    Tiket Aktif Terbaru
                                </h2>
                                <p class="text-xs md:text-sm text-slate-500 mt-1 ml-4">Menampilkan tiket yang masih dalam
                                    proses (belum selesai/ditolak)</p>
                            </div>
                            <a href="{{ route('admin.tiket') }}"
                                class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 transition-colors ml-4 sm:ml-0">
                                Kelola semua tiket
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>

                        <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                            <!-- Mobile Card View -->
                            <div class="block md:hidden">
                                @forelse($tiketTerbaru as $tiket)
                                    <div class="p-4 border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <p class="text-sm font-semibold text-slate-800 mb-1">{{ $tiket->no_tiket }}
                                                </p>
                                                <div class="flex items-center gap-2">
                                                    <div
                                                        class="w-6 h-6 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                                        {{ substr($tiket->nama_pengirim, 0, 1) }}
                                                    </div>
                                                    <span class="text-sm text-slate-600">{{ $tiket->nama_pengirim }}</span>
                                                </div>
                                            </div>
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                @if ($tiket->status == 'pending') bg-orange-100 text-orange-700
                                                @elseif($tiket->status == 'verifikasi') bg-blue-100 text-blue-700
                                                @elseif($tiket->status == 'proses') bg-purple-100 text-purple-700
                                                @else bg-gray-100 text-gray-700 @endif">
                                                @if ($tiket->status == 'pending')
                                                    Menunggu
                                                @elseif($tiket->status == 'verifikasi')
                                                    Verifikasi
                                                @elseif($tiket->status == 'proses')
                                                    Diproses
                                                @else
                                                    {{ $tiket->status }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-xs text-slate-500">
                                                <span class="font-medium">Kategori:</span>
                                                {{ $tiket->kategori->nama ?? '-' }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                <span class="font-medium">Lokasi:</span> {{ $tiket->lokasi->nama ?? '-' }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                <span class="font-medium">Tanggal:</span>
                                                {{ \Carbon\Carbon::parse($tiket->created_at)->translatedFormat('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-8 text-center text-slate-500">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <p>Tidak ada tiket aktif</p>
                                            <p class="text-xs">Semua tiket sudah selesai diproses</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Desktop Table View -->
                            <div class="hidden md:block overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                                Tiket</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                                Nama Pengirim</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                                Kategori</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                                Lokasi</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                                Tanggal</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-slate-100">
                                        @forelse($tiketTerbaru as $tiket)
                                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-800">
                                                    {{ $tiket->no_tiket }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center space-x-3">

                                                        <span
                                                            class="text-sm text-slate-600">{{ $tiket->nama_pengirim }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                                    {{ $tiket->kategori->nama ?? '-' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                                    {{ $tiket->lokasi->nama ?? '-' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                                    {{ \Carbon\Carbon::parse($tiket->created_at)->translatedFormat('d M Y, H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                        @if ($tiket->status == 'pending') bg-orange-100 text-orange-700
                                                        @elseif($tiket->status == 'verifikasi') bg-blue-100 text-blue-700
                                                        @elseif($tiket->status == 'proses') bg-purple-100 text-purple-700
                                                        @else bg-gray-100 text-gray-700 @endif">
                                                        @if ($tiket->status == 'pending')
                                                            Menunggu
                                                        @elseif($tiket->status == 'verifikasi')
                                                            Verifikasi
                                                        @elseif($tiket->status == 'proses')
                                                            Diproses
                                                        @else
                                                            {{ $tiket->status }}
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                                    <div class="flex flex-col items-center gap-2">
                                                        <svg class="w-12 h-12 text-slate-300" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                        <p>Tidak ada tiket aktif</p>
                                                        <p class="text-xs">Semua tiket sudah selesai diproses</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- List Aspirasi Keseluruhan -->
                    <div class="mt-6 md:mt-8">
                        <h2
                            class="text-xl md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 border-l-4 border-blue-500 pl-4">
                            Statistik Aspirasi Keseluruhan
                        </h2>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
                            <!-- Per Tanggal -->
                            <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-lg border border-slate-100">
                                <div class="flex items-center gap-2 md:gap-3 mb-3 md:mb-4">
                                    <div
                                        class="w-8 h-8 md:w-10 md:h-10 bg-blue-100 rounded-lg md:rounded-xl flex items-center justify-center">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-base md:text-lg font-bold text-slate-800">Per Tanggal</h3>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full ml-auto">
                                        Total: {{ $perTanggal->sum('total') }} tiket
                                    </span>
                                </div>
                                <div class="space-y-2 max-h-80 overflow-y-auto pr-1 md:pr-2">
                                    @forelse($perTanggal as $data)
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition">
                                            <span class="text-xs md:text-sm font-medium text-slate-700">
                                                {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}
                                            </span>
                                            <span
                                                class="text-xs md:text-sm font-semibold px-2 md:px-3 py-1 bg-blue-100 text-blue-700 rounded-full self-start sm:self-auto">
                                                {{ $data->total }} tiket
                                            </span>
                                        </div>
                                    @empty
                                        <p class="text-sm text-slate-500 text-center py-4">Tidak ada data</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Per Bulan -->
                            <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-lg border border-slate-100">
                                <div class="flex items-center gap-2 md:gap-3 mb-3 md:mb-4">
                                    <div
                                        class="w-8 h-8 md:w-10 md:h-10 bg-purple-100 rounded-lg md:rounded-xl flex items-center justify-center">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-base md:text-lg font-bold text-slate-800">Per Bulan</h3>
                                    <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full ml-auto">
                                        Total: {{ $perBulan->sum('total') }} tiket
                                    </span>
                                </div>
                                <div class="space-y-2 max-h-80 overflow-y-auto pr-1 md:pr-2">
                                    @forelse($perBulan as $data)
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition">
                                            <span class="text-xs md:text-sm font-medium text-slate-700">
                                                {{ \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->translatedFormat('F Y') }}
                                            </span>
                                            <span
                                                class="text-xs md:text-sm font-semibold px-2 md:px-3 py-1 bg-purple-100 text-purple-700 rounded-full self-start sm:self-auto">
                                                {{ $data->total }} tiket
                                            </span>
                                        </div>
                                    @empty
                                        <p class="text-sm text-slate-500 text-center py-4">Tidak ada data</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Per Siswa (Top 5 Pelapor) -->
                            <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-lg border border-slate-100">
                                <div class="flex items-center gap-2 md:gap-3 mb-3 md:mb-4">
                                    <div
                                        class="w-8 h-8 md:w-10 md:h-10 bg-emerald-100 rounded-lg md:rounded-xl flex items-center justify-center">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-base md:text-lg font-bold text-slate-800">Per Siswa (Top 5 Pelapor)
                                    </h3>
                                </div>
                                <div class="space-y-2">
                                    @forelse($perSiswa as $siswa)
                                        <div
                                            class="flex items-center justify-between gap-3 p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-slate-800 truncate">
                                                    {{ $siswa->username }}</p>
                                                <p class="text-xs text-slate-500 truncate">NISN: {{ $siswa->nisn ?? '-' }}
                                                </p>
                                            </div>
                                            <span
                                                class="text-xs md:text-sm font-semibold px-2 md:px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full whitespace-nowrap">
                                                {{ $siswa->tickets_count }} laporan
                                            </span>
                                        </div>
                                    @empty
                                        <p class="text-sm text-slate-500 text-center py-4">Tidak ada data</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Per Kategori -->
                            <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-lg border border-slate-100">
                                <div class="flex items-center gap-2 md:gap-3 mb-3 md:mb-4">
                                    <div
                                        class="w-8 h-8 md:w-10 md:h-10 bg-orange-100 rounded-lg md:rounded-xl flex items-center justify-center">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-orange-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-base md:text-lg font-bold text-slate-800">Per Kategori Sarana</h3>
                                </div>
                                <div class="space-y-2">
                                    @forelse($perKategori as $kategori)
                                        <div
                                            class="flex items-center justify-between gap-3 p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition">
                                            <span
                                                class="text-xs md:text-sm font-medium text-slate-700 break-words flex-1">{{ $kategori->nama }}</span>
                                            <span
                                                class="text-xs md:text-sm font-semibold px-2 md:px-3 py-1 bg-orange-100 text-orange-700 rounded-full whitespace-nowrap">
                                                {{ $kategori->tickets_count }} tiket
                                            </span>
                                        </div>
                                    @empty
                                        <p class="text-sm text-slate-500 text-center py-4">Tidak ada data</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @endsection
</x-alayout>
