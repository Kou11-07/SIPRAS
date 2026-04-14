<x-layout>
    @section('title', 'Form Pengaduan - Pengaduan Sarana Sekolah')

    @section('content')
        <!-- Navbar -->
        <x-navbar active="form" />

        <!-- HERO SECTION -->
        <div class="relative overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 -z-10"
                style="background-image: url('{{ asset('img/hero.png') }}'); background-size: cover; background-position: top center;">
            </div>

            <!-- HEADER -->
            <div class="text-center pt-16 md:pt-38 md:pb-90 px-4">
                <h1 class="text-lg md:text-4xl font-bold text-white relative z-10">
                    Layanan Pengaduan Sarana Sekolah
                </h1>
                <p class="text-white md:mt-3 md:text-3xl relative z-10">
                    Sampaikan laporan Anda langsung kepada SAPRAS Sekolah
                </p>
                <div class="w-25 md:w-30 h-1 mb-12 md:mb-4 bg-white mx-auto mt-2 md:mt-4 rounded-full relative z-10"></div>
            </div>
        </div>

        <!-- FORM CONTAINER -->
        <div class="flex justify-center pb-5 md:pb-10 px-3 md:px-4 relative z-20 md:-mt-70">
            <div class="bg-white shadow-lg p-4 md:p-8 w-full max-w-3xl rounded-lg md:rounded-none">
                <!-- Form Header -->
                <div class="bg-blue-400 text-start py-2 md:py-3 mb-4 md:mb-6 rounded pl-3 md:pl-6">
                    <h2 class="text-xl font-bold md:text-1xl text-white">Sampaikan Laporan Anda</h2>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div
                        class="mb-4 p-3 md:p-4 bg-green-100 border border-green-400 text-green-700 rounded text-sm md:text-base">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-3 md:p-4 bg-red-100 border border-red-400 text-red-700 rounded text-sm md:text-base">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 md:p-4 bg-red-100 border border-red-400 text-red-700 rounded text-sm md:text-base">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('user.tickets.store') }}" enctype="multipart/form-data"
                    onsubmit="return confirm('Apakah Anda yakin data pengaduan sudah lengkap dan benar?')">
                    @csrf

                    <!-- Data Anda -->
                    <div class="mb-6 p-4 bg-gray-50 rounded">
                        <h3 class="font-semibold mb-2">Data Anda</h3>
                        <p>Nama: {{ Auth::user()->username }}</p>
                        <p>NISN: {{ Auth::user()->nisn }}</p>
                        <p>Kelas:
                            {{ Auth::user()->kelas ? (is_object(Auth::user()->kelas) ? Auth::user()->kelas->nama_kelas : Auth::user()->kelas) : '-' }}
                        </p>
                    </div>

                    <!-- ========================================== -->
                    <!-- PERHATIKAN CARA MENYAMPAIKAN PENGADUAN (DIPINDAHKAN KE SINI) -->
                    <!-- ========================================== -->
                    <div class="mb-6 border-t border-gray-200 pt-4">
                        <div class="flex flex-wrap items-center justify-between gap-3 p-3 rounded-md">
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-800 font-medium text-sm md:text-base">Perhatikan Cara Menyampaikan
                                    Pengaduan Yang Baik dan Benar</span>
                                <!-- Kotak tanda tanya persis seperti di gambar -->
                                <button type="button" id="infoTriggerBtn"
                                    class="w-10 h-7 md:w-7 md:h-7 bg-blue-400 text-white rounded-md text-sm font-bold flex items-center justify-center hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300 transition shadow-sm">
                                    ?
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori Sarana -->
                    <div class="mb-4">
                        <label for="kategori_id"
                            class="block text-black text-base md:text-1xl font-medium mb-1 md:mb-2">Kategori
                            Sarana</label>
                        <select id="kategori_id" name="kategori_id"
                            class="w-full text-black px-3 md:px-4 py-2 md:py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white text-sm md:text-base"
                            required>
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama }}
                                </option>
                            @endforeach
                            <option value="lainnya" {{ old('kategori_id') == 'lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                        @error('kategori_id')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input teks untuk Kategori Lainnya -->
                    <div id="kategori_lainnya_container" class="mb-4 hidden">
                        <label for="kategori_lainnya"
                            class="block text-black text-base md:text-1xl font-medium mb-1 md:mb-2">Kategori
                            Lainnya</label>
                        <input type="text" id="kategori_lainnya" name="kategori_lainnya"
                            class="w-full text-black px-3 md:px-4 py-2 md:py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm md:text-base"
                            placeholder="Masukkan kategori sarana" value="{{ old('kategori_lainnya') }}">
                        @error('kategori_lainnya')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi Gedung -->
                    <div class="mb-4">
                        <label for="lokasi_id" class="block text-black text-base md:text-1xl font-medium mb-1 md:mb-1">
                            Lokasi Gedung
                        </label>

                        <!-- Keterangan tambahan -->
                        <p class="text-gray-500 text-xs md:text-sm mb-2 mt-0">
                            Denah lokasi tersedia di bagian bawah halaman
                        </p>

                        <select id="lokasi_id" name="lokasi_id"
                            class="w-full text-black px-3 md:px-4 py-2 md:py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white text-sm md:text-base"
                            required>
                            <option value="" selected disabled>-- Pilih Gedung --</option>
                            @foreach ($lokasi as $loc)
                                <option value="{{ $loc->id }}" {{ old('lokasi_id') == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->nama }}
                                </option>
                            @endforeach
                            <option value="lainnya" {{ old('lokasi_id') == 'lainnya' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>

                        @error('lokasi_id')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input teks untuk Lokasi Lainnya -->
                    <div id="lokasi_lainnya_container" class="mb-4 hidden">
                        <label for="lokasi_lainnya"
                            class="block text-black text-base md:text-1xl font-medium mb-1 md:mb-2">Lokasi
                            Lainnya</label>
                        <input type="text" id="lokasi_lainnya" name="lokasi_lainnya"
                            class="w-full text-black px-3 md:px-4 py-2 md:py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm md:text-base"
                            placeholder="Masukkan nama gedung/lokasi" value="{{ old('lokasi_lainnya') }}">
                        @error('lokasi_lainnya')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi"
                            class="block text-black text-base md:text-1xl font-medium mb-1 md:mb-2">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="5"
                            class="w-full text-black px-3 md:px-4 py-2 md:py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none text-sm md:text-base"
                            placeholder="Jelaskan detail kerusakan atau masalah yang Anda temui..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Bukti -->
                    <div class="mb-4">
                        <label for="foto" class="block text-black text-base md:text-1xl font-medium mb-1 md:mb-2">Foto
                            Bukti</label>
                        <input type="file" id="foto" name="foto" accept="image/*" required
                            class="w-full text-black px-3 md:px-4 py-2 md:py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white text-sm md:text-base file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            onchange="previewImage(this)">
                        <div id="preview-container" class="mt-3 hidden">
                            <img id="fotoPreview" class="max-w-full max-h-48 rounded-lg shadow-md" src="#"
                                alt="Preview foto">
                            <button type="button" onclick="clearPreview()"
                                class="mt-2 text-sm text-red-600 hover:text-red-800">Hapus</button>
                        </div>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 10MB</p>
                        @error('foto')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info dan Submit Button - RESPONSIVE -->
                    <div
                        class="flex flex-col space-y-4 md:space-y-0 md:flex-row items-center justify-between gap-4 border-t pt-6">
                        <div class="flex items-center text-xs md:text-sm text-gray-600">
                            <!-- Kosongkan atau bisa diisi dengan teks lain, karena sudah dipindah ke atas -->
                            <span class="text-gray-400 text-xs">Pastikan data yang diisi sudah benar</span>
                        </div>

                        <div
                            class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
                            <div class="flex items-center">
                                <input type="checkbox" id="is_anonim" name="is_anonim" value="1"
                                    class="h-4 w-4 md:h-5 md:w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                    {{ old('is_anonim') ? 'checked' : '' }}>
                                <label for="is_anonim" class="ml-2 text-xs md:text-sm text-gray-700">Kirim sebagai
                                    Anonim</label>
                            </div>

                            <button type="submit"
                                class="bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 md:py-3 px-6 md:px-10 rounded transition duration-200 text-sm md:text-lg w-full sm:w-auto">
                                LAPOR!
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ALUR PROSES SECTION -->
        <section class="py-10 px-4">
            <div class="max-w-4xl mx-auto">
                <div class="relative">
                    <!-- Garis Horizontal -->
                    <div class="absolute top-5 md:top-8 left-[10%] right-[10%] h-[2px] bg-gray-300"></div>

                    <div class="flex justify-between">
                        <!-- STEP 1 (ACTIVE) -->
                        <div class="flex-1 text-center relative z-10">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-10 h-10 md:w-15 md:h-15 bg-blue-400 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </div>
                                <h3 class="mt-3 font-semibold text-sm md:text-lg text-gray-800">Tulis Laporan</h3>
                                <p
                                    class="text-sm text-gray-600 mt-2 max-w-[180px] md:max-w-[220px] mx-auto leading-relaxed hidden md:block">
                                    Isi formulir pengaduan terkait kerusakan atau kebutuhan sarana sekolah
                                    secara lengkap dan jelas
                                </p>
                            </div>
                        </div>

                        <!-- STEP 2 -->
                        <div class="flex-1 text-center relative z-10">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-10 h-10 md:w-15 md:h-15 bg-gray-200 rounded-full flex items-center justify-center shadow">
                                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <h3 class="mt-3 font-semibold text-sm md:text-lg text-gray-800">Proses Verifikasi</h3>
                                <p
                                    class="text-sm text-gray-600 mt-2 max-w-[180px] md:max-w-[220px] mx-auto leading-relaxed hidden md:block">
                                    Laporan Anda akan diperiksa dan diverifikasi oleh admin sekolah
                                </p>
                            </div>
                        </div>

                        <!-- STEP 3 -->
                        <div class="flex-1 text-center relative z-10">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-10 h-10 md:w-15 md:h-15 bg-gray-200 rounded-full flex items-center justify-center shadow">
                                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7z" />
                                    </svg>
                                </div>
                                <h3 class="mt-3 font-semibold text-sm md:text-lg text-gray-800">Proses Tindak Lanjut</h3>
                                <p
                                    class="text-sm text-gray-600 mt-2 max-w-[180px] md:max-w-[220px] mx-auto leading-relaxed hidden md:block">
                                    Petugas atau pihak sekolah akan menindaklanjuti laporan sesuai dengan jenis permasalahan
                                    yang dilaporkan
                                </p>
                            </div>
                        </div>

                        <!-- STEP 4 -->
                        <div class="flex-1 text-center relative z-10">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-10 h-10 md:w-15 md:h-15 bg-gray-200 rounded-full flex items-center justify-center shadow">
                                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4" />
                                    </svg>
                                </div>
                                <h3 class="mt-3 font-semibold text-sm md:text-lg text-gray-800">Selesai</h3>
                                <p
                                    class="text-sm text-gray-600 mt-2 max-w-[180px] md:max-w-[220px] mx-auto leading-relaxed hidden md:block">
                                    Laporan dinyatakan selesai setelah permasalahan sarana sekolah telah ditangani dengan
                                    baik
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- STATISTIK SECTION -->
        <section class="bg-white py-8 md:py-10 lg:py-12">
            <div class="w-full bg-cover bg-center relative"
                style="background-image: url('{{ asset('img/bg_bawh.png') }}');">
                <div class="py-10 md:py-16 lg:py-20 px-4 text-center text-white">
                    <p class="text-sm md:text-base lg:text-lg font-semibold tracking-widest mb-4 md:mb-6">
                        JUMLAH LAPORAN SEKARANG
                    </p>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold" id="totalLaporan"
                        data-total="{{ $totalLaporan }}">
                        <span id="totalAngka">0</span>
                    </h1>
                </div>
            </div>
        </section>

        <!-- MAP SECTION -->
        <section class="w-full bg-white py-8 md:py-10 lg:py-12">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-center text-2xl sm:text-3xl md:text-4xl text-black font-semibold mb-6 md:mb-8 lg:mb-10">
                    Map SMKN 1 Cisarua
                </h2>
                <div class="max-w-5xl mx-auto">
                    <!-- Clickable Map Container -->
                    <div class="relative w-full cursor-pointer group" id="mapContainer">
                        <img src="{{ asset('img/map.png') }}" alt="Map SMKN 1 Cisarua"
                            class="w-full h-64 sm:h-80 md:h-96 lg:h-120 xl:h-[28rem] object-cover rounded-lg shadow-md transition-transform duration-300 group-hover:scale-105"
                            onerror="this.onerror=null; this.src='https://via.placeholder.com/1200x800/3498db/ffffff?text=Map+SMKN+1+Cisarua';">

                        <!-- Overlay with click indicator -->
                        <div
                            class="absolute inset-0 bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 rounded-lg flex items-center justify-center">
                            <div
                                class="bg-white bg-opacity-90 rounded-full p-2 md:p-3 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <svg class="w-6 h-6 md:w-8 md:h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Hint text -->
                        <div
                            class="absolute bottom-3 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-70 text-white text-xs md:text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                            Klik untuk melihat full map
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- MODAL MAP - Dengan background blur -->
        <div id="mapModal"
            class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 backdrop-blur-md items-center justify-center p-4 transition-all duration-300">
            <div class="relative w-full h-full max-w-7xl mx-auto">
                <!-- Tombol Close -->
                <button id="closeModal"
                    class="absolute top-4 right-4 z-10 bg-white rounded-full p-2 hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                    <svg class="w-6 h-6 md:w-8 md:h-8 text-gray-800" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <!-- Gambar Map Fullscreen -->
                <div class="flex items-center justify-center w-full h-full">
                    <img src="{{ asset('img/map.png') }}" alt="Map SMKN 1 Cisarua Fullscreen"
                        class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                        onerror="this.onerror=null; this.src='https://via.placeholder.com/1920x1080/3498db/ffffff?text=Map+SMKN+1+Cisarua';">
                </div>

                <!-- Hint Zoom -->
                <div
                    class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-60 text-white text-xs md:text-sm px-3 py-1 rounded-full backdrop-blur-sm">
                    Gunakan pinch zoom untuk memperbesar
                </div>
            </div>
        </div>

        <!-- MODAL PANDUAN - Dengan background blur -->
        <div id="infoModal"
            class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 backdrop-blur-md items-center justify-center p-4 transition-all duration-300">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden max-w-5xl max-h-[90vh] flex flex-col">
                <!-- Header Modal dengan judul dan tombol close -->
                <div
                    class="bg-gradient-to-r from-blue-500 to-blue-600 px-5 py-3 flex justify-between items-center flex-shrink-0">
                    <h3 class="text-white text-lg font-semibold">Panduan Pengisian Pengaduan</h3>
                    <button id="closeInfoModalBtn"
                        class="text-white hover:bg-white/20 rounded-full p-1 transition w-7 h-7 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Area Gambar Full -->
                <div class="p-4 bg-gray-100 flex justify-center items-center overflow-auto">
                    <img src="{{ asset('img/cara.png') }}" alt="Panduan Melapor"
                        class="rounded-lg max-w-full h-auto max-h-[75vh] object-contain"
                        onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 400 300%27%3E%3Crect width=%27400%27 height=%27300%27 fill=%27%23E5E7EB%27/%3E%3Ctext x=%2750%25%27 y=%2750%25%27 text-anchor=%27middle%27 dy=%27.3em%27 fill=%27%239CA3AF%27 font-size=%2716%27%3EGambar Panduan%3C/text%3E%3C/svg%3E';">
                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer />
    @endsection

    @push('scripts')
        <script src="{{ asset('js/navbar.js') }}"></script>
        <script>
            // Preview foto sebelum upload
            function previewImage(input) {
                const previewContainer = document.getElementById('preview-container');
                const preview = document.getElementById('fotoPreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    }

                    reader.readAsDataURL(input.files[0]);

                    if (input.files[0].size > 10 * 1024 * 1024) {
                        alert('Ukuran foto maksimal 10MB');
                        input.value = '';
                        previewContainer.classList.add('hidden');
                    }
                } else {
                    previewContainer.classList.add('hidden');
                    preview.src = '#';
                }
            }

            function clearPreview() {
                const input = document.getElementById('foto');
                const previewContainer = document.getElementById('preview-container');
                const preview = document.getElementById('fotoPreview');

                input.value = '';
                previewContainer.classList.add('hidden');
                preview.src = '#';
            }

            // ==========================================
            // MODAL PANDUAN INFO (TANDA ?)
            // ==========================================
            const infoModal = document.getElementById('infoModal');
            const infoTriggerBtn = document.getElementById('infoTriggerBtn');
            const closeInfoModalBtn = document.getElementById('closeInfoModalBtn');
            const closeInfoModalFooterBtn = document.getElementById('closeInfoModalFooterBtn');

            function openInfoModal() {
                if (infoModal) {
                    infoModal.classList.remove('hidden');
                    infoModal.classList.add('flex');
                    document.body.classList.add('overflow-hidden');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeInfoModal() {
                if (infoModal) {
                    infoModal.classList.add('hidden');
                    infoModal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                    document.body.style.overflow = '';
                }
            }

            if (infoTriggerBtn) {
                infoTriggerBtn.addEventListener('click', openInfoModal);
            }
            if (closeInfoModalBtn) {
                closeInfoModalBtn.addEventListener('click', closeInfoModal);
            }
            if (closeInfoModalFooterBtn) {
                closeInfoModalFooterBtn.addEventListener('click', closeInfoModal);
            }
            if (infoModal) {
                infoModal.addEventListener('click', function(e) {
                    if (e.target === infoModal) {
                        closeInfoModal();
                    }
                });
            }
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && infoModal && !infoModal.classList.contains('hidden')) {
                    closeInfoModal();
                }
            });

            // Animasi angka total laporan
            document.addEventListener('DOMContentLoaded', function() {
                const totalElement = document.getElementById('totalLaporan');
                const angkaElement = document.getElementById('totalAngka');

                if (!totalElement || !angkaElement) return;

                let total = parseInt(totalElement.dataset.total) || 0;
                let animated = false;

                function startAnimation() {
                    let current = 0;
                    let duration = 1500;
                    let increment = total / (duration / 16);

                    function animate() {
                        current += increment;
                        if (current < total) {
                            angkaElement.innerText = Math.floor(current);
                            requestAnimationFrame(animate);
                        } else {
                            angkaElement.innerText = total;
                        }
                    }
                    animate();
                }

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !animated) {
                            startAnimation();
                            animated = true;
                        }
                    });
                }, {
                    threshold: 0.5
                });

                observer.observe(totalElement);
            });

            function animateNumber(element, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const current = Math.floor(progress * (end - start) + start);
                    element.textContent = current;
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const totalElement = document.getElementById('totalLaporan');
                const totalAngkaElement = document.getElementById('totalAngka');
                if (totalElement && totalAngkaElement) {
                    const totalLaporan = parseInt(totalElement.getAttribute('data-total')) || 0;
                    animateNumber(totalAngkaElement, 0, totalLaporan, 1500);
                }
            });

            // Lokasi lainnya handler
            const lokasiSelect = document.getElementById('lokasi_id');
            const lokasiLainnyaContainer = document.getElementById('lokasi_lainnya_container');
            const lokasiLainnyaInput = document.getElementById('lokasi_lainnya');

            function handleLokasiLainnya() {
                if (lokasiSelect && lokasiSelect.value === 'lainnya') {
                    lokasiLainnyaContainer.classList.remove('hidden');
                    lokasiLainnyaInput.setAttribute('required', 'required');
                } else {
                    lokasiLainnyaContainer.classList.add('hidden');
                    lokasiLainnyaInput.removeAttribute('required');
                    lokasiLainnyaInput.value = '';
                }
            }

            if (lokasiSelect) {
                lokasiSelect.addEventListener('change', handleLokasiLainnya);
                handleLokasiLainnya();
            }

            // Kategori lainnya handler
            const kategoriSelect = document.getElementById('kategori_id');
            const kategoriLainnyaContainer = document.getElementById('kategori_lainnya_container');
            const kategoriLainnyaInput = document.getElementById('kategori_lainnya');

            function handleKategoriLainnya() {
                if (kategoriSelect && kategoriSelect.value === 'lainnya') {
                    kategoriLainnyaContainer.classList.remove('hidden');
                    kategoriLainnyaInput.setAttribute('required', 'required');
                } else {
                    kategoriLainnyaContainer.classList.add('hidden');
                    kategoriLainnyaInput.removeAttribute('required');
                    kategoriLainnyaInput.value = '';
                }
            }

            if (kategoriSelect) {
                kategoriSelect.addEventListener('change', handleKategoriLainnya);
                handleKategoriLainnya();
            }

            // Map Modal Functionality
            document.addEventListener('DOMContentLoaded', function() {
                const mapContainer = document.getElementById('mapContainer');
                const modal = document.getElementById('mapModal');
                const closeModal = document.getElementById('closeModal');

                function openModal() {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.classList.add('modal-open');
                    document.body.style.overflow = 'hidden';
                }

                function closeModalFunction() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                }

                if (mapContainer) {
                    mapContainer.addEventListener('click', openModal);
                }
                if (closeModal) {
                    closeModal.addEventListener('click', closeModalFunction);
                }
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeModalFunction();
                        }
                    });
                }
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                        closeModalFunction();
                    }
                });

                // Map Modal Functionality
                document.addEventListener('DOMContentLoaded', function() {
                    const mapContainer = document.getElementById('mapContainer');
                    const modal = document.getElementById('mapModal');
                    const closeModal = document.getElementById('closeModal');

                    function openModal() {
                        if (modal) {
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                            document.body.style.overflow = 'hidden';
                        }
                    }

                    function closeModalFunction() {
                        if (modal) {
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                            document.body.style.overflow = '';
                        }
                    }

                    if (mapContainer) {
                        mapContainer.addEventListener('click', openModal);
                    }
                    if (closeModal) {
                        closeModal.addEventListener('click', closeModalFunction);
                    }
                    if (modal) {
                        modal.addEventListener('click', function(e) {
                            if (e.target === modal) {
                                closeModalFunction();
                            }
                        });
                    }
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                            closeModalFunction();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layout>
