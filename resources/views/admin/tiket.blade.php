<x-alayout>
    @section('title', 'Admin Panel - Pengaduan Sarana')

    @section('content')
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <x-sidebar active="tiket" />

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto scroll-smooth">
                <!-- Top Bar -->
                <x-header title="Daftar Tiket" subtitle="Kelola semua tiket pengaduan yang masuk" :showMobileMenu="true">
                </x-header>

                <!-- Page Content -->
                <div class="p-4 sm:p-6 md:p-8 animate-slide-in-up">
                    <!-- Stats Cards - Sama seperti di dashboard -->
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
                        <!-- Menunggu -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Menunggu</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-orange-600">{{ $totalMenunggu }}</h3>
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

                        <!-- Verifikasi -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Verifikasi</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-blue-600">{{ $totalDiverifikasi }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                    <h3 class="text-2xl md:text-3xl font-bold text-purple-600">{{ $totalDiproses }}</h3>
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
                    </div>

                    <!-- Filters Section - Responsive -->
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-lg border border-slate-100 mb-6">
                        <form method="GET" action="{{ route('admin.tiket') }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                                    <select name="status"
                                        class="w-full px-4 py-2.5 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Menunggu</option>
                                        <option value="verifikasi"
                                            {{ request('status') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>
                                            Diproses</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pencarian</label>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari no tiket/nama..."
                                        class="w-full px-4 py-2.5 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal</label>
                                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                                        class="w-full px-4 py-2.5 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                                </div>
                            </div>

                            <div
                                class="flex flex-col sm:flex-row items-center justify-end gap-3 mt-4 pt-4 border-t border-slate-100">
                                <a href="{{ route('admin.tiket') }}"
                                    class="w-full sm:w-auto px-5 py-2.5 text-slate-600 hover:bg-slate-100 rounded-xl font-medium transition text-center">
                                    Reset
                                </a>
                                <button type="submit"
                                    class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                                    Terapkan Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Table Section - Responsive -->
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                        <!-- Mobile Card View -->
                        <div class="block md:hidden">
                            @forelse($tickets as $ticket)
                                <div class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                    <!-- Card Header (Klik untuk expand) -->
                                    <div class="p-4 cursor-pointer" onclick="toggleDetailMobile({{ $ticket->id }})">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                    {{ substr($ticket->nama_pengirim, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-slate-800">
                                                        {{ $ticket->nama_pengirim }}</p>
                                                    <p class="text-xs text-slate-500">{{ $ticket->no_tiket }}</p>
                                                </div>
                                            </div>
                                            <span
                                                class="status-badge inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                @if ($ticket->status == 'pending') bg-orange-100 text-orange-700
                                                @elseif($ticket->status == 'verifikasi') bg-blue-100 text-blue-700
                                                @elseif($ticket->status == 'proses') bg-purple-100 text-purple-700
                                                @elseif($ticket->status == 'selesai') bg-green-100 text-green-700
                                                @elseif($ticket->status == 'ditolak') bg-red-100 text-red-700 @endif">
                                                @if ($ticket->status == 'pending')
                                                    Menunggu
                                                @elseif($ticket->status == 'verifikasi')
                                                    Verifikasi
                                                @elseif($ticket->status == 'proses')
                                                    Diproses
                                                @elseif($ticket->status == 'selesai')
                                                    Selesai
                                                @elseif($ticket->status == 'ditolak')
                                                    Ditolak
                                                @endif
                                            </span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2 text-xs text-slate-500">
                                            <p><span class="font-medium">NISN:</span> {{ $ticket->nisn_pengirim }}</p>
                                            <p><span class="font-medium">Tanggal:</span>
                                                {{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="mt-2 flex items-center justify-between">
                                            <span class="text-xs text-blue-600 font-medium">
                                                {{ $ticket->kategori->nama ?? '-' }}
                                            </span>
                                            <svg class="w-4 h-4 text-slate-400 transition-transform"
                                                id="mobile-arrow-{{ $ticket->id }}" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Detail Mobile -->
                                    <div id="mobile-detail-{{ $ticket->id }}"
                                        class="hidden bg-gray-50 p-4 border-t border-slate-100">
                                        <div class="space-y-4">
                                            <!-- Informasi Pengirim -->
                                            <div>
                                                <h4 class="text-sm font-semibold text-slate-700 mb-2">Informasi Pengirim
                                                </h4>
                                                <div
                                                    class="bg-white p-3 rounded-lg border border-slate-200 space-y-1 text-sm">
                                                    <p><span class="font-medium">Nama:</span> {{ $ticket->nama_pengirim }}
                                                    </p>
                                                    <p><span class="font-medium">NISN:</span> {{ $ticket->nisn_pengirim }}
                                                    </p>
                                                    <p><span class="font-medium">Kontak:</span>
                                                        {{ $ticket->kontak ?? '-' }}</p>
                                                    @if ($ticket->is_anonim)
                                                        <p class="text-xs text-blue-600">✓ Dikirim sebagai Anonim</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Informasi Tiket -->
                                            <div>
                                                <h4 class="text-sm font-semibold text-slate-700 mb-2">Informasi Tiket</h4>
                                                <div
                                                    class="bg-white p-3 rounded-lg border border-slate-200 space-y-1 text-sm">
                                                    <p><span class="font-medium">No. Tiket:</span> {{ $ticket->no_tiket }}
                                                    </p>
                                                    <p><span class="font-medium">Lokasi:</span>
                                                        {{ $ticket->lokasi->nama ?? ($ticket->lokasi->nama_lokasi ?? '-') }}
                                                    </p>
                                                    <p><span class="font-medium">Kategori:</span>
                                                        {{ $ticket->kategori->nama ?? ($ticket->kategori->nama_kategori ?? '-') }}
                                                    </p>
                                                    <p><span class="font-medium">Dibuat:</span>
                                                        {{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y, H:i') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Deskripsi -->
                                            <div>
                                                <h4 class="text-sm font-semibold text-slate-700 mb-2">Deskripsi</h4>
                                                <div class="bg-white p-3 rounded-lg border border-slate-200">
                                                    <p class="text-sm whitespace-pre-wrap">{{ $ticket->deskripsi }}</p>
                                                </div>
                                            </div>

                                            <!-- Ubah Status -->
                                            <div>
                                                <h4 class="text-sm font-semibold text-slate-700 mb-2">Ubah Status</h4>
                                                <div class="bg-white p-3 rounded-lg border border-slate-200">
                                                    <select onchange="updateStatus({{ $ticket->id }}, this.value, this)"
                                                        data-previous-status="{{ $ticket->status }}"
                                                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition mb-3">
                                                        <option value="pending"
                                                            {{ $ticket->status == 'pending' ? 'selected' : '' }}>Menunggu
                                                        </option>
                                                        <option value="verifikasi"
                                                            {{ $ticket->status == 'verifikasi' ? 'selected' : '' }}>
                                                            Verifikasi</option>
                                                        <option value="proses"
                                                            {{ $ticket->status == 'proses' ? 'selected' : '' }}>Diproses
                                                        </option>
                                                        <option value="selesai"
                                                            {{ $ticket->status == 'selesai' ? 'selected' : '' }}>Selesai
                                                        </option>
                                                        <option value="ditolak"
                                                            {{ $ticket->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                                        </option>
                                                    </select>

                                                    <label
                                                        class="block text-sm font-medium text-slate-700 mb-2">Feedback</label>
                                                    <textarea id="feedback-{{ $ticket->id }}" rows="3" placeholder="Tulis feedback untuk pengguna..."
                                                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('feedback', $ticket->feedback ?? '') }}</textarea>
                                                    <p class="text-xs text-slate-500 mt-1">Feedback wajib diisi sebelum
                                                        mengubah status</p>
                                                </div>
                                            </div>

                                            <!-- Foto Bukti - Mobile View -->
                                            @if ($ticket->foto_bukti)
                                                <div>
                                                    <h4 class="text-sm font-semibold text-slate-700 mb-2">Foto Bukti</h4>
                                                    <div class="bg-white p-3 rounded-lg border border-slate-200">
                                                        <img src="{{ asset($ticket->foto_bukti) }}" alt="Foto Bukti"
                                                            class="max-h-48 rounded-lg mx-auto cursor-pointer hover:opacity-90 transition"
                                                            onclick="window.open(this.src, '_blank')">
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Riwayat Perubahan -->
                                            @if ($ticket->histories && $ticket->histories->count() > 0)
                                                <div>
                                                    <h4 class="text-sm font-semibold text-slate-700 mb-2">Riwayat Perubahan
                                                    </h4>
                                                    <div class="bg-white rounded-lg border border-slate-200 divide-y">
                                                        @foreach ($ticket->histories->sortByDesc('created_at') as $history)
                                                            <div class="p-2 text-xs">
                                                                <span
                                                                    class="font-medium">{{ match ($history->status) {
                                                                        'pending' => 'Menunggu',
                                                                        'verifikasi' => 'Verifikasi',
                                                                        'proses' => 'Diproses',
                                                                        'selesai' => 'Selesai',
                                                                        'ditolak' => 'Ditolak',
                                                                        default => $history->status,
                                                                    } }}</span>
                                                                @if ($history->catatan)
                                                                    <span class="text-gray-600"> -
                                                                        {{ $history->catatan }}</span>
                                                                @endif
                                                                <p class="text-gray-400 text-xs">
                                                                    {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y H:i') }}
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-slate-500">
                                    Tidak ada tiket ditemukan
                                </div>
                            @endforelse
                        </div>

                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200">
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            No</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Nama</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            NISN</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Tiket</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Ubah Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($tickets as $index => $ticket)
                                        <!-- Baris Utama -->
                                        <tr class="main-row hover:bg-slate-50 transition-colors cursor-pointer"
                                            onclick="toggleDetail({{ $ticket->id }})" id="row-{{ $ticket->id }}">
                                            <td class="px-6 py-4 text-sm text-slate-600">
                                                {{ $tickets->firstItem() + $index }}</td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-3">

                                                    <div>
                                                        <p class="text-sm font-semibold text-slate-800">
                                                            {{ $ticket->nama_pengirim }}</p>
                                                        <p class="text-xs text-slate-500">{{ $ticket->no_tiket }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-600">{{ $ticket->nisn_pengirim }}</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="text-sm font-medium text-indigo-600">{{ $ticket->no_tiket }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="status-badge inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                                    @if ($ticket->status == 'pending') bg-orange-100 text-orange-700
                                                    @elseif($ticket->status == 'verifikasi') bg-blue-100 text-blue-700
                                                    @elseif($ticket->status == 'proses') bg-purple-100 text-purple-700
                                                    @elseif($ticket->status == 'selesai') bg-green-100 text-green-700
                                                    @elseif($ticket->status == 'ditolak') bg-red-100 text-red-700 @endif">
                                                    @if ($ticket->status == 'pending')
                                                        Menunggu
                                                    @elseif($ticket->status == 'verifikasi')
                                                        Verifikasi
                                                    @elseif($ticket->status == 'proses')
                                                        Diproses
                                                    @elseif($ticket->status == 'selesai')
                                                        Selesai
                                                    @elseif($ticket->status == 'ditolak')
                                                        Ditolak
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <select onclick="event.stopPropagation()"
                                                    onchange="updateStatus({{ $ticket->id }}, this.value, this)"
                                                    data-previous-status="{{ $ticket->status }}"
                                                    class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                                    <option value="pending"
                                                        {{ $ticket->status == 'pending' ? 'selected' : '' }}>Menunggu
                                                    </option>
                                                    <option value="verifikasi"
                                                        {{ $ticket->status == 'verifikasi' ? 'selected' : '' }}>Verifikasi
                                                    </option>
                                                    <option value="proses"
                                                        {{ $ticket->status == 'proses' ? 'selected' : '' }}>Diproses
                                                    </option>
                                                    <option value="selesai"
                                                        {{ $ticket->status == 'selesai' ? 'selected' : '' }}>Selesai
                                                    </option>
                                                    <option value="ditolak"
                                                        {{ $ticket->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <!-- Detail Row -->
                                        <tr id="detail-{{ $ticket->id }}" class="detail-row hidden bg-gray-50">
                                            <td colspan="6" class="px-6 py-6">
                                                <!-- Detail content (sama seperti sebelumnya) -->
                                                <div class="space-y-6">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                        <div>
                                                            <h4 class="text-sm font-semibold text-slate-700 mb-3">Informasi
                                                                Pengirim</h4>
                                                            <div
                                                                class="bg-white p-4 rounded-lg border border-slate-200 space-y-2">
                                                                <p class="text-sm"><span class="font-medium">Nama:</span>
                                                                    {{ $ticket->nama_pengirim }}</p>
                                                                <p class="text-sm"><span class="font-medium">NISN:</span>
                                                                    {{ $ticket->nisn_pengirim }}</p>
                                                                <p class="text-sm"><span
                                                                        class="font-medium">Kontak:</span>
                                                                    {{ $ticket->kontak ?? '-' }}</p>
                                                                @if ($ticket->is_anonim)
                                                                    <p class="text-xs text-blue-600 mt-1">✓ Dikirim sebagai
                                                                        Anonim</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4 class="text-sm font-semibold text-slate-700 mb-3">Informasi
                                                                Tiket</h4>
                                                            <div
                                                                class="bg-white p-4 rounded-lg border border-slate-200 space-y-2">
                                                                <p class="text-sm"><span class="font-medium">No.
                                                                        Tiket:</span> {{ $ticket->no_tiket }}</p>
                                                                <p class="text-sm"><span
                                                                        class="font-medium">Lokasi:</span>
                                                                    {{ $ticket->lokasi->nama ?? ($ticket->lokasi->nama_lokasi ?? '-') }}
                                                                </p>
                                                                <p class="text-sm"><span
                                                                        class="font-medium">Kategori:</span>
                                                                    {{ $ticket->kategori->nama ?? ($ticket->kategori->nama_kategori ?? '-') }}
                                                                </p>
                                                                <p class="text-sm"><span
                                                                        class="font-medium">Dibuat:</span>
                                                                    {{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y, H:i') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-sm font-semibold text-slate-700 mb-3">Deskripsi
                                                        </h4>
                                                        <div class="bg-white p-4 rounded-lg border border-slate-200">
                                                            <p class="text-sm whitespace-pre-wrap">
                                                                {{ $ticket->deskripsi }}</p>
                                                        </div>
                                                    </div>
                                                    @if ($ticket->foto_bukti)
                                                        <div>
                                                            <h4 class="text-sm font-semibold text-slate-700 mb-3">Foto
                                                                Bukti</h4>
                                                            <div class="bg-white p-4 rounded-lg border border-slate-200">
                                                                <img src="{{ asset($ticket->foto_bukti) }}"
                                                                    alt="Foto Bukti"
                                                                    class="max-h-64 rounded-lg mx-auto cursor-pointer hover:opacity-90 transition shadow-md"
                                                                    onclick="window.open(this.src, '_blank')">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h4 class="text-sm font-semibold text-slate-700 mb-3">Feedback
                                                            Admin</h4>
                                                        <div class="bg-white p-4 rounded-lg border border-slate-200">
                                                            @if ($ticket->feedback)
                                                                <div
                                                                    class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                                                    <p class="text-sm font-medium text-blue-800 mb-1">
                                                                        Feedback sebelumnya:</p>
                                                                    <p class="text-sm text-blue-700">
                                                                        {{ $ticket->feedback }}</p>
                                                                </div>
                                                            @endif
                                                            <textarea id="feedback-{{ $ticket->id }}" rows="3" placeholder="Tulis feedback untuk pengguna..."
                                                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('feedback', $ticket->feedback ?? '') }}</textarea>
                                                            <p class="text-xs text-slate-500 mt-1">Feedback wajib diisi
                                                                sebelum mengubah status</p>
                                                        </div>
                                                    </div>
                                                    @if ($ticket->histories && $ticket->histories->count() > 0)
                                                        <div>
                                                            <h4 class="text-sm font-semibold text-slate-700 mb-3">Riwayat
                                                                Perubahan Status</h4>
                                                            <div
                                                                class="bg-white rounded-lg border border-slate-200 divide-y">
                                                                @foreach ($ticket->histories->sortByDesc('created_at') as $history)
                                                                    <div class="p-3 flex items-start gap-3">
                                                                        <div
                                                                            class="w-2 h-2 mt-2 rounded-full 
                                                                            @if ($history->status == 'pending') bg-yellow-500
                                                                            @elseif($history->status == 'verifikasi') bg-blue-500
                                                                            @elseif($history->status == 'proses') bg-purple-500
                                                                            @elseif($history->status == 'selesai') bg-green-500
                                                                            @elseif($history->status == 'ditolak') bg-red-500 @endif">
                                                                        </div>
                                                                        <div class="flex-1">
                                                                            <p class="text-sm">
                                                                                <span
                                                                                    class="font-medium">{{ match ($history->status) {
                                                                                        'pending' => 'Menunggu',
                                                                                        'verifikasi' => 'Verifikasi',
                                                                                        'proses' => 'Diproses',
                                                                                        'selesai' => 'Selesai',
                                                                                        'ditolak' => 'Ditolak',
                                                                                        default => $history->status,
                                                                                    } }}</span>
                                                                                @if ($history->catatan)
                                                                                    <span class="text-gray-600"> -
                                                                                        {{ $history->catatan }}</span>
                                                                                @endif
                                                                            </p>
                                                                            <p class="text-xs text-gray-400">
                                                                                {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y H:i') }}
                                                                                oleh
                                                                                {{ $history->changedBy->username ?? 'System' }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">Tidak ada
                                                tiket ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($tickets->hasPages())
                            <div class="px-4 sm:px-6 py-4 bg-slate-50 border-t border-slate-200">
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <p class="text-sm text-slate-600">
                                        Menampilkan {{ $tickets->firstItem() }} - {{ $tickets->lastItem() }} dari
                                        {{ $tickets->total() }} tiket
                                    </p>
                                    <div class="flex flex-wrap items-center justify-center gap-2">
                                        @if ($tickets->onFirstPage())
                                            <span
                                                class="px-3 py-2 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed text-sm">&laquo;
                                                Sebelumnya</span>
                                        @else
                                            <a href="{{ $tickets->previousPageUrl() }}"
                                                class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-indigo-50 transition text-sm">&laquo;
                                                Sebelumnya</a>
                                        @endif

                                        @foreach ($tickets->getUrlRange(1, $tickets->lastPage()) as $page => $url)
                                            @if ($page == $tickets->currentPage())
                                                <span
                                                    class="px-3 py-2 rounded-lg bg-indigo-600 text-white shadow-md text-sm">{{ $page }}</span>
                                            @else
                                                <a href="{{ $url }}"
                                                    class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-indigo-50 transition text-sm">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        @if ($tickets->hasMorePages())
                                            <a href="{{ $tickets->nextPageUrl() }}"
                                                class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-indigo-50 transition text-sm">Selanjutnya
                                                &raquo;</a>
                                        @else
                                            <span
                                                class="px-3 py-2 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed text-sm">Selanjutnya
                                                &raquo;</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>

        @push('scripts')
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                // Toggle detail untuk desktop
                function toggleDetail(ticketId) {
                    const detailRow = document.getElementById('detail-' + ticketId);
                    const mainRow = document.getElementById('row-' + ticketId);
                    if (detailRow.classList.contains('hidden')) {
                        detailRow.classList.remove('hidden');
                        if (mainRow) mainRow.classList.add('bg-indigo-50');
                    } else {
                        detailRow.classList.add('hidden');
                        if (mainRow) mainRow.classList.remove('bg-indigo-50');
                    }
                }

                // Toggle detail untuk mobile
                function toggleDetailMobile(ticketId) {
                    const detailDiv = document.getElementById('mobile-detail-' + ticketId);
                    const arrow = document.getElementById('mobile-arrow-' + ticketId);
                    if (detailDiv.classList.contains('hidden')) {
                        detailDiv.classList.remove('hidden');
                        if (arrow) arrow.style.transform = 'rotate(180deg)';
                    } else {
                        detailDiv.classList.add('hidden');
                        if (arrow) arrow.style.transform = 'rotate(0deg)';
                    }
                }

                function updateStatus(ticketId, newStatus, selectElement) {
                    event.stopPropagation();

                    // 🔥 Ambil textarea yang SATU AREA dengan select
                    const container = selectElement.closest('tr')?.nextElementSibling ||
                        selectElement.closest('div'); // fallback mobile

                    const feedbackTextarea = container.querySelector('textarea');
                    const feedback = feedbackTextarea ? feedbackTextarea.value.trim() : '';

                    if (!feedback) {
                        alert('Feedback wajib diisi sebelum mengubah status tiket!');
                        const previousStatus = selectElement.getAttribute('data-previous-status');
                        selectElement.value = previousStatus;
                        return;
                    }

                    let confirmMessage = 'Yakin ingin mengubah status tiket ini?\n\nFeedback: "' + feedback +
                        '" akan dikirim ke pengguna.';

                    if (newStatus === 'selesai') {
                        confirmMessage =
                            'Apakah Anda yakin tiket ini sudah selesai?\n\nFeedback: "' + feedback + '"';
                    } else if (newStatus === 'ditolak') {
                        confirmMessage =
                            'Apakah Anda yakin ingin menolak tiket ini?\n\nFeedback: "' + feedback + '"';
                    }

                    if (!confirm(confirmMessage)) {
                        const previousStatus = selectElement.getAttribute('data-previous-status');
                        selectElement.value = previousStatus;
                        return;
                    }

                    $.ajax({
                        url: '/admin/tiket/' + ticketId + '/status',
                        type: 'PUT',
                        data: {
                            status: newStatus,
                            feedback: feedback,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Status berhasil diupdate!');
                                location.reload();
                            }
                        },
                        error: function(xhr) {
                            alert('Gagal update!');
                        }
                    });
                }
            </script>
        @endpush
    @endsection
</x-alayout>
