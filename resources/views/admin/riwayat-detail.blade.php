<x-alayout>
    @section('title', 'Admin Panel - Detail Riwayat Tiket')

    @section('content')
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <x-sidebar active="riwayat" />

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto scroll-smooth">
                <!-- Header -->
                <x-header title="Detail Tiket" :subtitle="'Informasi lengkap tiket ' . ($ticket->no_tiket ?? '')" :showBackButton="true" backRoute="{{ route('admin.riwayat') }}">
                    <!-- Slot actions tetap ada jika diperlukan -->
                </x-header>

                <!-- Content Area -->
                <div class="p-8">
                    <div class="max-w-4xl mx-auto">
                        <!-- Informasi Tiket -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 animate-slide-in-up">
                            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                                <h2 class="text-xl font-bold text-slate-800">Informasi Tiket</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Nomor Tiket</label>
                                        <p class="text-lg font-semibold text-slate-800">{{ $ticket->no_tiket }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Status</label>
                                        <p class="text-lg font-semibold">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full text-sm 
                                                @if ($ticket->status == 'selesai') bg-emerald-100 text-emerald-700
                                                @else bg-red-100 text-red-700 @endif">
                                                {{ $ticket->status == 'selesai' ? 'Selesai' : 'Ditolak' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Tanggal Dibuat</label>
                                        <p class="text-slate-800">
                                            {{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Tanggal
                                            Selesai/Ditolak</label>
                                        <p class="text-slate-800">
                                            {{ $ticket->selesai_at ? \Carbon\Carbon::parse($ticket->selesai_at)->format('d M Y') : '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Pengirim -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
                            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                                <h2 class="text-xl font-bold text-slate-800">Informasi Pengirim</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Nama Pengirim</label>
                                        <p class="text-slate-800 font-medium">{{ $ticket->nama_pengirim }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">NISN</label>
                                        <p class="text-slate-800">{{ $ticket->nisn_pengirim }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Kontak</label>
                                        <p class="text-slate-800">{{ $ticket->kontak ?? '-' }}</p>
                                    </div>
                                </div>
                                @if ($ticket->is_anonim)
                                    <div class="mt-3">
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                            ✓ Dikirim sebagai Anonim
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Detail Pengaduan -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
                            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                                <h2 class="text-xl font-bold text-slate-800">Detail Pengaduan</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Lokasi</label>
                                        <p class="text-slate-800">
                                            {{ $ticket->lokasi->nama ?? ($ticket->lokasi->nama_lokasi ?? '-') }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Kategori</label>
                                        <p class="text-slate-800">
                                            {{ $ticket->kategori->nama ?? ($ticket->kategori->nama_kategori ?? '-') }}</p>
                                        @if (isset($ticket->kategori->deskripsi))
                                            <p class="text-xs text-slate-500 mt-1">{{ $ticket->kategori->deskripsi }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-1">Deskripsi</label>
                                    <div class="bg-slate-50 rounded-lg p-4">
                                        <p class="text-slate-700 whitespace-pre-wrap">{{ $ticket->deskripsi }}</p>
                                    </div>
                                </div>

                                <!-- FOTO BUKTI - SAMA SEPERTI DI HISTORI USER -->
                                @if ($ticket->foto_bukti)
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Foto Bukti</label>
                                        <div class="bg-slate-50 p-3 rounded-lg border border-slate-200">
                                            <img src="{{ asset('storage/' . $ticket->foto_bukti) }}" alt="Foto Bukti"
                                                class="max-h-64 rounded-lg mx-auto cursor-pointer hover:opacity-90 transition-opacity shadow-md"
                                                onclick="window.open(this.src, '_blank')">
                                            <p class="text-xs text-slate-400 text-center mt-2">Klik gambar untuk memperbesar
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Foto Bukti</label>
                                        <div
                                            class="bg-slate-50 rounded-lg p-8 text-center border-2 border-dashed border-slate-200">
                                            <svg class="w-12 h-12 text-slate-400 mx-auto mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-slate-500">Tidak ada foto bukti</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($ticket->catatan_admin)
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-slate-600 mb-1">Catatan Admin</label>
                                        <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                                            <p class="text-sm text-yellow-800">{{ $ticket->catatan_admin }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
                            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                                <h2 class="text-xl font-bold text-slate-800">Timeline</h2>
                            </div>
                            <div class="p-6">
                                <div class="space-y-2">
                                    <p class="text-sm text-slate-600">
                                        <span class="font-medium">Dibuat:</span>
                                        {{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') }}
                                    </p>
                                    @if ($ticket->diproses_at)
                                        <p class="text-sm text-slate-600">
                                            <span class="font-medium">Diproses:</span>
                                            {{ \Carbon\Carbon::parse($ticket->diproses_at)->format('d M Y') }}
                                        </p>
                                    @endif
                                    @if ($ticket->selesai_at || $ticket->status === 'ditolak')
                                        <p class="text-sm text-slate-600">
                                            <span
                                                class="font-medium">{{ $ticket->status === 'ditolak' ? 'Ditolak' : 'Selesai' }}:</span>
                                            {{ $ticket->selesai_at ? \Carbon\Carbon::parse($ticket->selesai_at)->format('d M Y') : ($ticket->updated_at ? $ticket->updated_at->format('d M Y') : '-') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Riwayat Perubahan Status -->
                        @if ($ticket->histories && $ticket->histories->count() > 0)
                            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                                <div
                                    class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                                    <h2 class="text-xl font-bold text-slate-800">Riwayat Perubahan Status</h2>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-3">
                                        @foreach ($ticket->histories->sortByDesc('created_at') as $history)
                                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg">
                                                <div
                                                    class="w-3 h-3 mt-1.5 rounded-full 
                                                    @if ($history->status == 'pending') bg-yellow-500
                                                    @elseif($history->status == 'verifikasi') bg-blue-500
                                                    @elseif($history->status == 'proses') bg-purple-500
                                                    @elseif($history->status == 'selesai') bg-green-500
                                                    @elseif($history->status == 'ditolak') bg-red-500 @endif">
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-slate-800">
                                                        Status berubah menjadi
                                                        <span class="font-semibold">
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
                                                            <span class="text-slate-600"> - {{ $history->catatan }}</span>
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-slate-400">
                                                        {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}
                                                        oleh {{ $history->changedBy->username ?? 'System' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    @endsection
</x-alayout>
