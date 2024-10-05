// NO 1
function countEvenNumbers(nilaiStart, nilaiEnd) {
    let tampungAngka = []

    if (nilaiStart % 2 == 0) {
        tampungAngka.push(nilaiStart)
        nilaiStart += 2;
        while (nilaiStart <= nilaiEnd) {
            tampungAngka.push(nilaiStart)
            nilaiStart += 2;
        }
    } else {
        nilaiStart += 1;
        while (nilaiStart <= nilaiEnd) {
            tampungAngka.push(nilaiStart)
            nilaiStart += 2;
        }
    }

    let output = `(${tampungAngka.join(', ')})`;
    console.log("Output = " + tampungAngka.length + output)
}

countEvenNumbers(2, 3)


// NO 2
// function displayBarang() {
//     const harga = parseInt(document.getElementById("harga").value);
//     const jenis = document.getElementById("jenis").value;

//     if (jenis.toLowerCase() == "elektronik") {
//         document.getElementById("ha").textContent = "Rp." + harga;
//         document.getElementById("d").textContent = "5%";
//         document.getElementById("hsd").textContent = harga * 0.95;
//     } else if (jenis.toLowerCase() == "pakaian") {
//         document.getElementById("ha").textContent = "Rp." + harga;
//         document.getElementById("d").textContent = "20%";
//         document.getElementById("hsd").textContent = "Rp. " + harga * 0.80;
//     } else if (jenis.toLowerCase() == "makanan") {
//         document.getElementById("ha").textContent = "Rp." + harga;
//         document.getElementById("d").textContent = "5%";
//         document.getElementById("hsd").textContent = "Rp. " + harga * 0.95;
//     } else {
//         document.getElementById("ha").textContent = "Rp." + harga;
//         document.getElementById("d").textContent = "5%";
//         document.getElementById("hsd").textContent = "Rp. " + harga;
//     }
//     document.getElementById("jenis").value = ""
//     document.getElementById("harga").value = ""
// }


// NO 3
// function menghitungHari() {
//     const hari = document.getElementById("hari").value
//     const jumlahHari = document.getElementById("keberapa").value

//     const tampungHari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
//     const hariH = tampungHari.indexOf(hari);
//     const sisaHari = jumlahHari % 7;
//     const hari1 = (sisaHari + hariH) % 7

//     document.getElementById("h").textContent = "" + hari;
//     document.getElementById("n").textContent = "" + jumlahHari;
//     document.getElementById("hh").textContent = "" + tampungHari[hari1];

//     document.getElementById("hari").value = ""
//     document.getElementById("keberapa").value = ""

//     // console.log(tampungHari[hari1]);
// }

// menghitungHari("jumat", 1000)