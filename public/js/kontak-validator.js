// Validasi input nomor kontak
document.addEventListener('DOMContentLoaded', function () {
    const kontakInput = document.getElementById('kontak');

    if (kontakInput) {
        kontakInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
});

// Fungsi global untuk validasi form
window.validateKontak = function (kontakValue) {
    if (!kontakValue) {
        return { valid: false, message: 'Nomor kontak harus diisi' };
    }

    if (!/^\d+$/.test(kontakValue)) {
        return { valid: false, message: 'Nomor kontak hanya boleh berisi angka' };
    }

    if (kontakValue.length < 10) {
        return { valid: false, message: 'Nomor kontak minimal 10 digit' };
    }

    return { valid: true, message: '' };
};