@props(['showLogo' => true])

<footer class="bg-gray-800 text-white mt-12 py-6">
    <div class="max-w-7xl mx-auto px-10">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Container Logo di Kiri (berdekatan) -->
            @if($showLogo)
                <div class="flex flex-row items-center gap-4 mb-4 md:mb-0">
                    <img src="/img/logov2.png" alt="Logo SIPRAS" class="h-auto w-40 opacity-90 hover:opacity-100 transition-opacity duration-300">
                    <img src="/img/smk.png" alt="Logo SMKN 1 Cisarua" class="h-auto w-20 opacity-90 hover:opacity-100 transition-opacity duration-300">
                </div>
            @endif

            <!-- Teks di Kanan -->
            <div class="text-center md:text-right">
                <p class="text-sm">Copyright © {{ date('Y') }} SMKN 1 Cisarua</p>
                <p class="text-sm mt-1">Sistem Pengaduan Sarana Sekolah</p>
            </div>
        </div>
    </div>
</footer>