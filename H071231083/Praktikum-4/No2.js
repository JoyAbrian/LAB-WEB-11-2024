const prompt = require("prompt-sync")();

function hitungDiskon(harga, jenisBarang) {
  let persentaseDiskon = 0;
  switch (jenisBarang.toLowerCase()) {
    case "elektronik":
      persentaseDiskon = 10;
      break;
    case "pakaian":
      persentaseDiskon = 20;
      break;
    case "makanan":
      persentaseDiskon = 5;
      break;
    default:
      persentaseDiskon = 0;
  }

  const diskon = harga * (persentaseDiskon / 100);
  const hargaSetelahDiskon = harga - diskon;

  return { persentaseDiskon, hargaSetelahDiskon };
}

function main() {
  const hargaInput = prompt("Masukkan harga barang: ");
  const harga = parseInt(hargaInput);

  if (isNaN(harga) || harga <= 0) {
    console.log("Input harga tidak valid! Silahkan masukkan angka yang benar.");
    main();
  } else {
    askForJenisBarang(harga);
  }
}

const askForJenisBarang = (harga) => {
  const jenisInput = prompt(
    "Masukkan jenis barang (elektronik/pakaian/makanan/Lainnya): "
  );

  if (!isNaN(jenisInput)) {
    console.log("Jenis barang tidak valid! Silakan masukkan yang benar.");
    askForJenisBarang(harga);
    return;
  }

  const jenisBarang = jenisInput;

  if (["elektronik", "pakaian", "makanan"].includes(jenisBarang)) {
    const { persentaseDiskon, hargaSetelahDiskon } = hitungDiskon(
      harga,
      jenisBarang
    );
    console.log(`Harga awal: Rp${harga}`);
    console.log(`Diskon: ${persentaseDiskon}%`);
    console.log(`Harga setelah diskon: Rp${hargaSetelahDiskon}`);
  } else {
    const { persentaseDiskon, hargaSetelahDiskon } = hitungDiskon(
      harga,
      jenisBarang
    );

    console.log(`Harga awal: Rp${harga}`);
    console.log(`Diskon: ${persentaseDiskon}%`);
    console.log(`Harga setelah diskon: Rp${hargaSetelahDiskon}`);
  }
};

main();
