function countEvenNumbers(start, end) {
    // Memastikan start dan end adalah bilangan bulat
    start = Math.floor(start);
    end = Math.floor(end);
    
    // Memastikan start tidak lebih besar dari end
    if (start > end) {
        [start, end] = [end, start]; // Menukar nilai jika start lebih besar
    }
    
    
    let evenNumbers = []; // array kosong yang akan menyimpan semua bilangan genap yang ditemukan dalam rentang tersebut.
    
    for (let i = start; i <= end; i++) { // Mengiterasi nilai i dari start hingga end.
        if (i % 2 === 0) { // Setiap kali i habis dibagi 2 (i % 2 === 0), artinya i adalah bilangan genap
           
            evenNumbers.push(i); // Bilangan genap ditambahkan ke array evenNumbers menggunakan fungsi push()
        }
    }
    
    return `${evenNumbers.length} (${evenNumbers.join(', ')})`; // Fungsi mengembalikan jumlah dan daftar bilangan genap dipisahkan koma.
}

// Contoh penggunaan
console.log(countEvenNumbers(1, 10)); // Fungsi `countEvenNumbers(1, 10)` menghasilkan "5 (2, 4, 6, 8, 10)".
// Output: 5 (2, 4, 6, 8, 10)