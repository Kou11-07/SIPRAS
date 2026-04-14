<x-layout>
    @section('title', 'Tentang SIPRAS')

    @section('content')
        <x-navbar active="tentang" />

        <!-- HERO -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 -z-10"
                style="background-image: url('{{ asset('img/hero.png') }}'); background-size: cover; background-position: center;">
            </div>

            <div class="text-center pt-17 md:pt-20 pb-16 px-4">
                <h1 class="text-lg md:text-4xl font-bold text-white relative z-10">
                    Tentang SIPRAS
                </h1>
                <p class="text-white md:mt-3 md:text-3xl relative z-10">
                    Sistem Pengaduan Sarana dan Prasarana Sekolah
                </p>
                <div class="w-25 md:w-30 h-1 mb-20 md:mb-25 bg-white mx-auto mt-2 md:mt-4 rounded-full relative z-10"></div>
            </div>
        </div>

        <!-- CONTENT -->
        <section class="bg-white md:py-16 px-4 -mt-17 md:-mt-6">
            <div class="max-w-5xl mx-auto space-y-10">

                <!-- Apa itu SIPRAS -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                        Apa itu SIPRAS?
                    </h2>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        SIPRAS adalah sistem yang digunakan untuk memfasilitasi siswa dalam menyampaikan laporan terkait
                        kerusakan atau masalah sarana dan prasarana di lingkungan sekolah. Sistem ini membantu sekolah
                        dalam menindaklanjuti laporan secara cepat, transparan, dan terstruktur.
                    </p>
                </div>

                <!-- Tujuan -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                        Tujuan SIPRAS
                    </h2>
                    <ul class="list-disc pl-5 text-gray-600 space-y-2 text-sm md:text-base">
                        <li>Mempermudah siswa dalam melaporkan kerusakan fasilitas</li>
                        <li>Meningkatkan kualitas sarana dan prasarana sekolah</li>
                        <li>Menciptakan lingkungan belajar yang nyaman</li>
                        <li>Meningkatkan transparansi penanganan laporan</li>
                    </ul>
                </div>

                <!-- Cara Kerja -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                        Cara Kerja SIPRAS
                    </h2>
                    <ol class="list-decimal pl-5 text-gray-600 space-y-2 text-sm md:text-base">
                        <li>Siswa mengisi form pengaduan</li>
                        <li>Admin memverifikasi laporan</li>
                        <li>Tim SAPRAS menindaklanjuti</li>
                        <li>Laporan diselesaikan dan ditutup</li>
                    </ol>
                </div>

                <!-- Keunggulan -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                        Keunggulan Sistem
                    </h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="p-4 border rounded-lg shadow-sm">
                            <h3 class="font-semibold text-blue-500 mb-2">Cepat</h3>
                            <p class="text-sm text-gray-600">Laporan diproses dengan cepat dan efisien</p>
                        </div>
                        <div class="p-4 border rounded-lg shadow-sm">
                            <h3 class="font-semibold text-blue-500 mb-2">Transparan</h3>
                            <p class="text-sm text-gray-600">Status laporan dapat dipantau</p>
                        </div>
                        <div class="p-4 border rounded-lg shadow-sm">
                            <h3 class="font-semibold text-blue-500 mb-2">Mudah</h3>
                            <p class="text-sm text-gray-600">Interface sederhana dan user-friendly</p>
                        </div>
                        <div class="p-4 border rounded-lg shadow-sm">
                            <h3 class="font-semibold text-blue-500 mb-2">Efektif</h3>
                            <p class="text-sm text-gray-600">Membantu sekolah dalam pengelolaan fasilitas</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <x-footer />
    @endsection
</x-layout>