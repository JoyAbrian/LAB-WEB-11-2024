const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function menghitungHari() {
    rl.question("Masukkan Hari : " ,(hari) => {
        rl.question("Masukkan jumlah hari yang ingin di cek: ", (jumlahHari)=>{
            jumlahHari = parseInt(jumlahHari);
            const tampungHari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
            const hariH = tampungHari.indexOf(hari);
            const sisaHari = jumlahHari % 7;
            const hari1 = (sisaHari + hariH) % 7
            
            console.log(jumlahHari + " Hari kedepan adalah hari", tampungHari[hari1])
            rl.close();

        })
    });
}

menghitungHari()