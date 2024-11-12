// Array untuk nama-nama hari dalam seminggu
const daysOfWeek = [
  "Senin",
  "Selasa",
  "Rabu",
  "Kamis",
  "Jumat",
  "Sabtu",
  "Minggu",
];

function getFutureDay(currentDay, daysFromNow) {
  let currentIndex = daysOfWeek.indexOf(currentDay);
  let futureIndex = (currentIndex + daysFromNow) % daysOfWeek.length;
  return daysOfWeek[futureIndex]; 
}

let today = "Sabtu";
let daysToAdd = 1000;
let futureDay = getFutureDay(today, daysToAdd);

console.log("Hari ini: " + today);
console.log(daysToAdd + " hari yang akan datang: " + futureDay);
