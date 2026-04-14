<x-alayout>
    @section('title', 'Admin Panel - Manajemen Siswa')

    @section('content')
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <x-sidebar active="siswa" />

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto scroll-smooth">
                <!-- Header -->
                <x-header title="Manajemen Siswa" subtitle="Kelola data siswa pengguna aplikasi" :showMobileMenu="true">
                    <x-slot name="actions">
                        <a href="{{ route('admin.siswa.create') }}"
                            class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2.5 bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Siswa
                        </a>
                    </x-slot>
                </x-header>

                <!-- Content Area -->
                <div class="p-4 sm:p-6 md:p-8 animate-slide-in-up">
                    <!-- Alert Messages -->
                    @if (session('success'))
                        <div
                            class="mb-4 sm:mb-6 p-3 sm:p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm sm:text-base">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('warning'))
                        <div
                            class="mb-4 sm:mb-6 p-3 sm:p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg text-sm sm:text-base">
                            {{ session('warning') }}
                        </div>
                    @endif

                    <!-- Stats Cards - Sama seperti di dashboard -->
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
                        <!-- Total Siswa -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Total Siswa</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $totalSiswa }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Aktif -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Aktif</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-green-600">{{ $aktif }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-green-400 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Nonaktif -->
                        <div
                            class="stat-card bg-white rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 lg:aspect-auto aspect-square">
                            <div
                                class="flex flex-col items-center justify-center h-full p-3 md:p-4 lg:flex-row lg:justify-between lg:text-left">
                                <div class="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
                                    <p class="text-slate-500 text-xs md:text-sm font-medium mb-1">Nonaktif</p>
                                    <h3 class="text-2xl md:text-3xl font-bold text-red-600">{{ $nonaktif }}</h3>
                                </div>
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-red-400 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters Section - Responsive -->
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-lg border border-slate-100 mb-6">
                        <form method="GET" action="{{ route('admin.siswa') }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pencarian</label>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari nama/NISN..."
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 transition text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                                    <select name="status"
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                                        <option value="">Semua Status</option>
                                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>
                                            Nonaktif</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                                    <select name="kelas"
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                                        <option value="">Semua Kelas</option>
                                        @foreach ($daftarKelas as $kelas)
                                            <option value="{{ $kelas->nama_kelas }}"
                                                {{ request('kelas') == $kelas->nama_kelas ? 'selected' : '' }}>
                                                {{ $kelas->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex flex-col justify-end">
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <button type="submit"
                                            class="w-full sm:flex-1 px-4 py-2 sm:py-3 bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition text-sm">
                                            Filter
                                        </button>
                                        <a href="{{ route('admin.siswa') }}"
                                            class="w-full sm:flex-1 px-4 py-2 sm:py-3 bg-slate-100 text-slate-600 rounded-xl font-medium hover:bg-slate-200 transition text-sm text-center">
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table Section - Responsive -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <!-- Mobile Card View -->
                        <div class="block md:hidden">
                            @forelse($siswa as $index => $s)
                                <div class="border-b border-slate-100 p-4 hover:bg-slate-50 transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                {{ substr($s->username, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-800">{{ $s->username }}</p>
                                                <p class="text-xs text-slate-500 font-mono">{{ $s->nisn }}</p>
                                            </div>
                                        </div>
                                        <span
                                            class="status-badge inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if ($s->is_active) bg-green-100 text-green-700
                                            @else bg-red-100 text-red-700 @endif">
                                            {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 text-xs text-slate-500 mb-3">
                                        <p><span class="font-medium">Kelas:</span> {{ $s->kelas ?? '-' }}</p>
                                        <p><span class="font-medium">Kontak:</span> {{ $s->phone ?? '-' }}</p>
                                    </div>
                                    <div class="flex items-center justify-end space-x-2 pt-2 border-t border-slate-100">
                                        <a href="{{ route('admin.siswa.edit', $s->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg transition"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form method="POST" action="{{ route('admin.siswa.toggle-active', $s->id) }}"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 {{ $s->is_active ? 'bg-yellow-50 hover:bg-yellow-100 text-yellow-600' : 'bg-green-50 hover:bg-green-100 text-green-600' }} rounded-lg transition"
                                                title="{{ $s->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                onclick="return confirm('Yakin ingin {{ $s->is_active ? 'menonaktifkan' : 'mengaktifkan' }} siswa ini?')">
                                                @if ($s->is_active)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.siswa.destroy', $s->id) }}"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus siswa ini? Data tiket akan tetap aman.')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-slate-500">
                                    <svg class="w-16 h-16 mx-auto text-slate-300 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p>Tidak ada data siswa</p>
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
                                            Kelas</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Kontak</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($siswa as $index => $s)
                                        <tr class="hover:bg-slate-50 transition">
                                            <td class="px-6 py-4 text-sm text-slate-600">
                                                {{ $siswa->firstItem() + $index }}</td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-3">
                                                    <div
                                                        class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                        {{ substr($s->username, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-slate-800">
                                                            {{ $s->username }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-mono text-slate-600">{{ $s->nisn }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-600">{{ $s->kelas ?? '-' }}</td>
                                            <td class="px-6 py-4 text-sm text-slate-600">{{ $s->phone ?? '-' }}</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="status-badge inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                                    @if ($s->is_active) bg-green-100 text-green-700
                                                    @else bg-red-100 text-red-700 @endif">
                                                    {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('admin.siswa.edit', $s->id) }}"
                                                        class="inline-flex items-center justify-center w-9 h-9 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg transition"
                                                        title="Edit">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('admin.siswa.toggle-active', $s->id) }}"
                                                        class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="inline-flex items-center justify-center w-9 h-9 {{ $s->is_active ? 'bg-yellow-50 hover:bg-yellow-100 text-yellow-600' : 'bg-green-50 hover:bg-green-100 text-green-600' }} rounded-lg transition"
                                                            title="{{ $s->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                            onclick="return confirm('Yakin ingin {{ $s->is_active ? 'menonaktifkan' : 'mengaktifkan' }} siswa ini?')">
                                                            @if ($s->is_active)
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                                </svg>
                                                            @else
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            @endif
                                                        </button>
                                                    </form>

                                                    <form method="POST"
                                                        action="{{ route('admin.siswa.destroy', $s->id) }}"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center justify-center w-9 h-9 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition"
                                                            title="Hapus"
                                                            onclick="return confirm('Yakin ingin menghapus siswa ini? Data tiket akan tetap aman.')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                                Tidak ada data siswa
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination - Responsive -->
                        @if ($siswa->hasPages())
                            <div class="px-4 sm:px-6 py-4 bg-slate-50 border-t border-slate-200">
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <p class="text-xs sm:text-sm text-slate-600">
                                        Menampilkan {{ $siswa->firstItem() }} - {{ $siswa->lastItem() }} dari
                                        {{ $siswa->total() }} siswa
                                    </p>
                                    <div class="flex flex-wrap items-center justify-center gap-1 sm:gap-2">
                                        {{-- Previous --}}
                                        @if ($siswa->onFirstPage())
                                            <span
                                                class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed text-sm">&laquo;
                                                Sebelumnya</span>
                                        @else
                                            <a href="{{ $siswa->previousPageUrl() }}"
                                                class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-indigo-50 transition text-sm">&laquo;
                                                Sebelumnya</a>
                                        @endif

                                        {{-- Page Numbers --}}
                                        @foreach ($siswa->getUrlRange(1, $siswa->lastPage()) as $page => $url)
                                            @if ($page == $siswa->currentPage())
                                                <span
                                                    class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-indigo-600 text-white shadow-md text-sm">{{ $page }}</span>
                                            @elseif ($page >= $siswa->currentPage() - 2 && $page <= $siswa->currentPage() + 2)
                                                <a href="{{ $url }}"
                                                    class="px-2 py-1 sm:px-3 sm:py-2 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-indigo-50 transition text-sm">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        {{-- Next --}}
                                        @if ($siswa->hasMorePages())
                                            <a href="{{ $siswa->nextPageUrl() }}"
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
            </main>
        </div>
    @endsection
</x-alayout>
