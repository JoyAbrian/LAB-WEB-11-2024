const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function displayBarang() {
    rl.question("Masukkan Harga Barang : ", (harga) => {
        rl.question("Masukkan Jenis Barang (Elektronik, Pakaian, Makanan, Lainnya) : ", (jenis) => {
            harga = parseInt(harga)
            jenis = jenis.toLowerCase()

            if (jenis == "elektronik") {
                console.log("Harga Awal : Rp." + harga)
                console.log("Diskon : 10%")
                console.log("Harga setelah diskon : Rp." + harga * 0.9)
                rl.close();
            } else if (jenis == "pakaian") {
                console.log("Harga Awal : Rp." + harga)
                console.log("Diskon : 20%")
                console.log("Harga setelah diskon : Rp." + harga * 0.8)
                rl.close();
            } else if (jenis == "makanan") {
                console.log("Harga Awal : Rp." + harga)
                console.log("Diskon : 5%")
                console.log("Harga setelah diskon : Rp." + harga * 0.95)
                rl.close();
            } else {
                console.log("Harga Awal : Rp." + harga)
                console.log("Diskon : Tidak Ada Diskon")
                console.log("Harga setelah diskon : Rp." + harga)
                rl.close();
            }
        })
    })
}

displayBarang()