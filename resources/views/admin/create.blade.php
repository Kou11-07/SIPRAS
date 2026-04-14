<x-layout>
    @section('title', 'Admin Panel - ' . (isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa'))

    @section('content')
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <x-sidebar active="siswa" />

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto scroll-smooth">
                <!-- Header -->
                <x-header title="Manajemen Siswa">
                </x-header>

                <!-- Content Area -->
                <div class="p-4 sm:p-6 md:p-8 animate-slide-in-up">
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <ul class="list-disc pl-4 sm:pl-5 text-sm sm:text-base">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-3xl mx-auto">
                        <div
                            class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 md:py-6 border-b border-slate-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                            <h2 class="text-lg sm:text-xl font-bold text-slate-800">
                                {{ isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa' }}
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">Isi data siswa dengan lengkap</p>
                        </div>

                        <form method="POST" id="siswaForm"
                            action="{{ isset($siswa) ? route('admin.siswa.update', $siswa->id) : route('admin.siswa.store') }}"
                            class="p-4 sm:p-6 md:p-8">
                            @csrf
                            @if (isset($siswa))
                                @method('PUT')
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                <!-- NISN -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1 sm:mb-2">
                                        NISN <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nisn" id="nisn"
                                        value="{{ old('nisn', $siswa->nisn ?? '') }}" required maxlength="10"
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm sm:text-base"
                                        placeholder="Masukkan 10 digit NISN">
                                    <p class="text-xs text-slate-400 mt-1">* NISN terdiri dari 10 digit angka</p>
                                </div>

                                <!-- Username -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1 sm:mb-2">
                                        Username <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="username" id="username"
                                        value="{{ old('username', $siswa->username ?? '') }}" required
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm sm:text-base"
                                        placeholder="Masukkan username">
                                </div>

                                <!-- Tanggal Lahir -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1 sm:mb-2">
                                        Tanggal Lahir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ?? date('Y-m-d')) }}" required
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm sm:text-base">
                                </div>

                                <!-- Kelas Dropdown -->
                                <div>
                                    <label for="kelas" class="block text-sm font-semibold text-slate-700 mb-1 sm:mb-2">
                                        Kelas <span class="text-red-500">*</span>
                                    </label>
                                    <select id="kelas" name="kelas"
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm sm:text-base"
                                        required>
                                        <option value="" selected disabled>-- Pilih Kelas --</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}"
                                                {{ old('kelas', isset($selectedKelas) ? $selectedKelas->id : (isset($siswa) && $siswa->kelas_id ? $siswa->kelas_id : '')) == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nomor Telepon -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1 sm:mb-2">
                                        Nomor Telepon
                                    </label>
                                    <input type="tel" name="phone" id="phone"
                                        value="{{ old('phone', $siswa->phone ?? '') }}" maxlength="13"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm sm:text-base"
                                        placeholder="Contoh: 081234567890">
                                    <p class="text-xs text-slate-400 mt-1">* Diisi dengan nomor WhatsApp aktif (maksimal 13
                                        digit, opsional)</p>
                                </div>
                            </div>

                            <!-- INFO PENTING: Password Otomatis -->
                            @if (!isset($siswa))
                                <div class="mt-6 p-3 sm:p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-2 sm:ml-3">
                                            <h3 class="text-sm font-semibold text-blue-800">Informasi Login Siswa</h3>
                                            <p class="text-xs sm:text-sm text-blue-700 mt-1">
                                                Password siswa akan dibuat otomatis berdasarkan <strong>TANGGAL
                                                    LAHIR</strong> dengan format <strong>YYYYMMDD</strong>.<br>
                                                Contoh: Lahir 15 Mei 2005 → Password: <strong>20050515</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Form Actions -->
                            <div
                                class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                                <a href="{{ route('admin.siswa') }}"
                                    class="w-full sm:w-auto px-4 py-2 sm:px-6 sm:py-3 bg-slate-100 text-slate-600 rounded-xl font-medium hover:bg-slate-200 transition text-center">
                                    Batal
                                </a>
                                <button type="submit" id="submitBtn"
                                    class="w-full sm:w-auto px-4 py-2 sm:px-6 sm:py-3 bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                                    {{ isset($siswa) ? 'Update Siswa' : 'Simpan Siswa' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>

        <script>
            document.getElementById('siswaForm').addEventListener('submit', function(e) {
                // Ambil nilai dari form
                const nisn = document.getElementById('nisn').value.trim();
                const username = document.getElementById('username').value.trim();
                const tanggalLahir = document.getElementById('tanggal_lahir').value;
                const kelas = document.getElementById('kelas');
                const phone = document.getElementById('phone').value.trim();

                // Validasi nomor telepon (jika diisi)
                if (phone && phone.length > 13) {
                    alert('Nomor telepon maksimal 13 digit!');
                    e.preventDefault();
                    return false;
                }

                // Validasi hanya angka untuk phone
                if (phone && !/^\d+$/.test(phone)) {
                    alert('Nomor telepon hanya boleh berisi angka!');
                    e.preventDefault();
                    return false;
                }

                // Ambil text kelas
                const kelasText = kelas.options[kelas.selectedIndex]?.textContent || 'Belum dipilih';

                // Format tanggal
                let tglFormatted = '';
                if (tanggalLahir) {
                    const tgl = new Date(tanggalLahir);
                    tglFormatted = tgl.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                }

                // Buat pesan konfirmasi sederhana
                let confirmMessage = "Yakin data sudah lengkap?\n\n";
                confirmMessage += "NISN: " + nisn + "\n";
                confirmMessage += "Username: " + username + "\n";
                confirmMessage += "Tanggal Lahir: " + tglFormatted + "\n";
                confirmMessage += "Kelas: " + kelasText + "\n";
                confirmMessage += "Telepon: " + (phone || "-") + "\n";

                @if (!isset($siswa))
                    const passwordOtomatis = tanggalLahir.replace(/-/g, '');
                    confirmMessage += "\nPassword Otomatis: " + passwordOtomatis;
                @endif

                confirmMessage += "\n\nKlik OK untuk menyimpan, Batal untuk perbaiki.";

                // Cek konfirmasi - jika Batal, hentikan submit
                if (!confirm(confirmMessage)) {
                    e.preventDefault();
                    return false;
                }
            });
        </script>
    @endsection
</x-layout>
