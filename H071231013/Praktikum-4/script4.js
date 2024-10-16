function permainanTebakAngka() {
    const angkaRahasia = Math.floor(Math.random() * 100) + 1; // Menghasilkan angka rahasia acak antara 1 dan 100.
    // Menginisialisasi variabel untuk jumlah tebakan, batas maksimum tebakan, dan menyimpan tebakan pengguna.
    let jumlahTebakan = 0;
    const maksimalTebakan = 10;
    let tebakan;

    console.log("Selamat datang di Permainan Tebak Angka!");
    console.log(`Anda memiliki ${maksimalTebakan} kesempatan untuk menebak.`);

    while (jumlahTebakan < maksimalTebakan) { // Memulai loop yang berjalan selama jumlah tebakan kurang dari batas maksimum.
        jumlahTebakan++; // Meningkatkan jumlah tebakan setiap kali pengguna melakukan tebakan.
        tebakan = parseInt(prompt(`Tebakan ke-${jumlahTebakan}: Masukkan angka antara 1 sampai 100:`)); // Mengambil input tebakan

        // Validasi Angka: Jika tebakan bukan angka, tampilkan pesan untuk memasukkan angka yang valid.
        // Jika tebakan tepat, tampilkan pesan keberhasilan dan jumlah percobaan, lalu keluar dari fungsi.
        // Jika tebakan kurang dari angka rahasia, tampilkan pesan bahwa tebakan terlalu rendah.
        // Jika tebakan lebih dari angka rahasia, tampilkan pesan bahwa tebakan terlalu tinggi.
        // Jika masih ada kesempatan tersisa, tampilkan jumlah kesempatan yang tersisa.
        if (isNaN(tebakan)) {
            console.log("Mohon masukkan angka yang valid.");
        } else if (tebakan === angkaRahasia) {
            console.log(`Selamat! Anda berhasil menebak angka ${angkaRahasia} dengan benar.`);
            console.log(`Anda berhasil menebak dalam ${jumlahTebakan} percobaan.`);
            return; // Keluar dari fungsi jika tebakan benar
        } else if (tebakan < angkaRahasia) {
            console.log("Terlalu rendah! Coba lagi.");
        } else {
            console.log("Terlalu tinggi! Coba lagi.");
        }

        if (jumlahTebakan < maksimalTebakan) {
            console.log(`Sisa kesempatan: ${maksimalTebakan - jumlahTebakan}`);
        }
    }

    console.log(`Maaf, Anda kehabisan kesempatan. Angka rahasianya adalah ${angkaRahasia}.`);
}

// Uncomment baris di bawah ini untuk menjalankan permainan
permainanTebakAngka();