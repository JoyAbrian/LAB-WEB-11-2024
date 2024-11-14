const prompt = require("prompt-sync")(); // Importing prompt-sync

const angkaAcak = Math.floor(Math.random() * 100) + 1;
let percobaan = 0;

const tebakAngka = () => {
  const input = prompt("Masukkan salah satu angka dari 1 sampai 100: ");
  const tebakan = parseInt(input);
  percobaan++;

  if (isNaN(tebakan)) {
    console.log(
      "Tipe data yang dimasukkan tidak valid, silakan masukkan angka antara 1 - 100."
    );
    tebakAngka();
  } else if (tebakan < 1 || tebakan > 100) {
    console.log("Angka harus antara 1 dan 100. Silakan coba lagi.");
    tebakAngka();
  } else if (tebakan > angkaAcak) {
    console.log("Terlalu tinggi! Coba lagi.");
    tebakAngka();
  } else if (tebakan < angkaAcak) {
    console.log("Terlalu rendah! Coba lagi.");
    tebakAngka();
  } else {
    console.log(
      `Selamat! Kamu berhasil menebak angka ${angkaAcak} dengan benar dalam ${percobaan} percobaan.`
    );
  }
};

tebakAngka(); // Mulai permainan