// Tugas 3: Menentukan hari
    // Mendefinisikan array hariDalamSeminggu berisi nama-nama hari dalam seminggu.
function tentukanHari(hariIni, jumlahHari) {
    const hariDalamSeminggu = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];


    const indexHariIni = hariDalamSeminggu.indexOf(hariIni); // Menemukan indeks dari hariIni dalam array hariDalamSeminggu.
    const indexHariTarget = (indexHariIni + jumlahHari) % 7; // Menghitung indeks target dan memakai modulus 7 agar tetap dalam seminggu.
    return hariDalamSeminggu[indexHariTarget]; // Mengembalikan nama hari target berdasarkan indeks yang dihitung.
}

console.log(tentukanHari('Sabtu', 13)); // Menghitung hari 1000 hari setelah 'Jumat', hasilnya 'Kamis'.