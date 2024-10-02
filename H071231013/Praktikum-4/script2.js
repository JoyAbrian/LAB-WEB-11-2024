function hitungDiskon(harga, jenis) {
    if (isNaN(harga) || harga <= 0) {
        throw new Error("Harga harus berupa angka positif.");
    } // Mengecek apakah harga adalah angka positif. Jika tidak, lempar error.

    let diskon = 0;
    switch (jenis.toLowerCase()) {
        case 'elektronik':
            diskon = 0.1;
            break;
        case 'pakaian':
            diskon = 0.2;
            break;
        case 'makanan':
            diskon = 0.05;
            break;
        case 'lainnya':
            diskon = 0;
            break;
        default:
            throw new Error("Jenis barang tidak valid. Pilihan yang tersedia: Elektronik, Pakaian, Makanan, Lainnya.");
    } // Menentukan diskon berdasarkan jenis barang. Jika jenis tidak valid, lempar error.

    // Menghitung besar diskon dan harga setelah diskon.
    let besaranDiskon = harga * diskon;
    let hargaAkhir = harga - besaranDiskon;
    
    console.log(`Harga awal: Rp${harga}`);
    console.log(`Diskon: ${diskon * 100}%`);
    console.log(`Harga setelah diskon: Rp${hargaAkhir.toFixed(0)}`);
}

// Menerima input dari pengguna, memanggil fungsi hitungDiskon, dan menangani error jika terjadi kesalahan.
let harga, jenis;

try {
    harga = parseFloat(prompt("Masukkan harga barang:"));
    jenis = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya):");

    // Memanggil fungsi
    hitungDiskon(harga, jenis);
} catch (error) {
    console.error("Terjadi kesalahan:", error.message);
}