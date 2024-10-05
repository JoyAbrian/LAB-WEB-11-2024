function countEvenNumbers(start, end) {
    let jumlah = 0;
    let genap = [];
    for (let i = start; i <= end; i ++ ) {
        if (i % 2 === 0) {
            jumlah++;
            genap.push(i);
        }
    }   
    return `${jumlah}(${genap.join(', ')})`; 
} 
console.log(`Output : ${countEvenNumbers(1,10)}`);
