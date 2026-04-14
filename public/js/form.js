// Data ruangan berdasarkan gedung
const ruanganByGedung = {
    'gedung-a': ['A.01.01', 'A.01.02', 'A.01.03', 'A.01.04', 'A.01.05', 'A.01.06', 'A.01.07', 'A.01.08',
        'A.01.09', 'A.01.10', 'A.01.11', 'A.01.12'
    ],
    'gedung-b': ['B.01.13', 'B.01.14', 'B.01.15', 'Ruangan 1', 'B.01.17', 'B.01.18', 'B.01.19'],
    'gedung-c': ['C.01.20', 'C.01.21'],
    'gedung-d': ['D.01.22', 'D.01.23', 'D.01.24'],
    'gedung-e': ['Ruangan 1', 'Ruangan 2'],
    'gedung-f': ['F.01.27', 'F.01.28', 'F.01.29'],
    'gedung-h': ['H.01.32', 'H.01.33'],
    'gedung-i': ['Ruangan 1', 'Ruangan 2', 'Ruangan 3', 'Ruangan 4'],
    'gedung-k': ['Ruangan 1', 'Ruangan 2'],
    'gedung-l': ['Ruangan 1'],
    'gedung-m': ['Ruangan 1', 'Ruangan 2'],
    'gedung-n': ['Ruangan 1'],
    'gedung-o': ['Ruangan 1', 'Ruangan 2'],
    'gedung-p': ['Ruangan 1', ''],
    'gedung-q': ['Aula', 'Q.01.51', 'Q.01.52'],
    'gedung-r': ['Ruangan 1', 'Ruangan 2'],
    'gedung-s': ['Ruangan 1', 'Ruangan 2', 'Ruang 3', 'Ruang 4'],
    'gedung-v': ['AreaCar Lift', 'Area Pengecekan', 'U.1/Lt.1 R01U', 'Ruang Instruktur', 'Ruang Komputer'],
    'gedung-w': ['Ruang praktek FNB', 'Ruang 1', 'Gudang FNB', 'Ruang Instruktur'],
    'gedung-w-lt2': ['Ruangan 1', 'Ruangan 2'],
    'DAK.RKB.Kelas': ['Ruangan 1', 'Ruangan 2', 'Ruangan 3'],
};

// Daftar lokasi yang tidak memerlukan ruangan
const lokasiTanpaRuangan = [
    'DAK.RKB UKS',
    'masjid',
    'perpustakaan',
];

document.addEventListener('DOMContentLoaded', function () {
    const gedungSelect = document.getElementById('gedung');
    const ruanganContainer = document.getElementById('ruangan-container');
    const ruanganSelect = document.getElementById('ruangan');

    if (gedungSelect && ruanganContainer && ruanganSelect) {
        // Event listener untuk perubahan pilihan gedung
        gedungSelect.addEventListener('change', function () {
            const selectedGedung = this.value;

            // Reset ruangan
            ruanganSelect.innerHTML = '<option value="" selected disabled hidden>-- Pilih Ruangan --</option>';

            // Cek apakah gedung yang dipilih memerlukan ruangan
            if (selectedGedung && !lokasiTanpaRuangan.includes(selectedGedung)) {
                // Tampilkan container ruangan
                ruanganContainer.classList.remove('hidden');

                // Isi opsi ruangan berdasarkan gedung
                if (ruanganByGedung[selectedGedung]) {
                    ruanganByGedung[selectedGedung].forEach(ruangan => {
                        if (ruangan.trim() !== '') {
                            const option = document.createElement('option');
                            option.value = ruangan.toLowerCase().replace(/\s+/g, '-');
                            option.textContent = ruangan;
                            ruanganSelect.appendChild(option);
                        }
                    });
                }

                // Wajib diisi jika gedung memerlukan ruangan
                ruanganSelect.required = true;
            } else {
                // Sembunyikan container ruangan
                ruanganContainer.classList.add('hidden');
                ruanganSelect.required = false;
                ruanganSelect.value = '';
            }
        });

        // Trigger change event jika ada nilai yang sudah terpilih
        if (gedungSelect.value) {
            gedungSelect.dispatchEvent(new Event('change'));
        }
    }
});