const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const angkaKomputer = Math.floor(Math.random() * 100) + 1;
let totalTebakan = 0;  

console.log("Tebak angka antara 1 hingga 100!");

function tebakTebakanAngka() {
    rl.question('Masukkan tebakan Anda: ', (angkaUser) => {
        totalTebakan++;
        angkaUser = parseInt(angkaUser); 


        if (isNaN(angkaUser)) {
            console.log('Harap masukkan angka yang valid!');
            tebakTebakanAngka();
        } else {
            if (angkaUser > angkaKomputer) {
                console.log('Terlalu tinggi!');
                tebakTebakanAngka();
            } else if (angkaUser < angkaKomputer) {
                console.log('Terlalu rendah!');
                tebakTebakanAngka();
            } else {
                console.log('Selamat! Anda menebak angka yang benar: ' + angkaKomputer);
                console.log('Jumlah tebakan: ' + totalTebakan);
                rl.close();
            }
        }
    });
}
tebakTebakanAngka();
