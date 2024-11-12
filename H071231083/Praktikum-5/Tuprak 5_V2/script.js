const blackJackCards = [
  { name: "10-C", src: "cards/10-C.png", value: 10 },
  { name: "10-D", src: "cards/10-D.png", value: 10 },
  { name: "10-H", src: "cards/10-H.png", value: 10 },
  { name: "10-S", src: "cards/10-S.png", value: 10 },
  { name: "2-C", src: "cards/2-C.png", value: 2 },
  { name: "2-D", src: "cards/2-D.png", value: 2 },
  { name: "2-H", src: "cards/2-H.png", value: 2 },
  { name: "2-S", src: "cards/2-S.png", value: 2 },
  { name: "3-C", src: "cards/3-C.png", value: 3 },
  { name: "3-D", src: "cards/3-D.png", value: 3 },
  { name: "3-H", src: "cards/3-H.png", value: 3 },
  { name: "3-S", src: "cards/3-S.png", value: 3 },
  { name: "4-C", src: "cards/4-C.png", value: 4 },
  { name: "4-D", src: "cards/4-D.png", value: 4 },
  { name: "4-H", src: "cards/4-H.png", value: 4 },
  { name: "4-S", src: "cards/4-S.png", value: 4 },
  { name: "5-C", src: "cards/5-C.png", value: 5 },
  { name: "5-D", src: "cards/5-D.png", value: 5 },
  { name: "5-H", src: "cards/5-H.png", value: 5 },
  { name: "5-S", src: "cards/5-S.png", value: 5 },
  { name: "6-C", src: "cards/6-C.png", value: 6 },
  { name: "6-D", src: "cards/6-D.png", value: 6 },
  { name: "6-H", src: "cards/6-H.png", value: 6 },
  { name: "6-S", src: "cards/6-S.png", value: 6 },
  { name: "7-C", src: "cards/7-C.png", value: 7 },
  { name: "7-D", src: "cards/7-D.png", value: 7 },
  { name: "7-H", src: "cards/7-H.png", value: 7 },
  { name: "7-S", src: "cards/7-S.png", value: 7 },
  { name: "8-C", src: "cards/8-C.png", value: 8 },
  { name: "8-D", src: "cards/8-D.png", value: 8 },
  { name: "8-H", src: "cards/8-H.png", value: 8 },
  { name: "8-S", src: "cards/8-S.png", value: 8 },
  { name: "9-C", src: "cards/9-C.png", value: 9 },
  { name: "9-D", src: "cards/9-D.png", value: 9 },
  { name: "9-H", src: "cards/9-H.png", value: 9 },
  { name: "9-S", src: "cards/9-S.png", value: 9 },
  { name: "A-C", src: "cards/A-C.png", value: 11 },
  { name: "A-D", src: "cards/A-D.png", value: 11 },
  { name: "A-H", src: "cards/A-H.png", value: 11 },
  { name: "A-S", src: "cards/A-S.png", value: 11 },
  { name: "J-C", src: "cards/J-C.png", value: 10 },
  { name: "J-D", src: "cards/J-D.png", value: 10 },
  { name: "J-H", src: "cards/J-H.png", value: 10 },
  { name: "J-S", src: "cards/J-S.png", value: 10 },
  { name: "K-C", src: "cards/K-C.png", value: 10 },
  { name: "K-D", src: "cards/K-D.png", value: 10 },
  { name: "K-H", src: "cards/K-H.png", value: 10 },
  { name: "K-S", src: "cards/K-S.png", value: 10 },
  { name: "Q-C", src: "cards/Q-C.png", value: 10 },
  { name: "Q-D", src: "cards/Q-D.png", value: 10 },
  { name: "Q-H", src: "cards/Q-H.png", value: 10 },
  { name: "Q-S", src: "cards/Q-S.png", value: 10 },
];

// Mendeklarasikan variabel
let playerMoney = 0;
let playerDeck = [];
let playerSum = 0;
let betAmount = 0;
let botDeck = [];
let botSum = 0;
let roundCount = 0;
let totalEarnings = 0; // Menyimpan total uang yang didapatkan

let deck = [];

// Elemen DOM
const inputDeposito = document.getElementById("inputDeposito");
const modalStart = new bootstrap.Modal(document.getElementById("modalStart")); 

// Tombol
const buttonStart = document.getElementById("buttonStart");
const buttonHit = document.getElementById("buttonHit");
const buttonHold = document.getElementById("buttonHold");
const buttonBet = document.getElementsByClassName("buttonBet");

// Elemen Teks yg menampilkan taruhan, jumlah, dan uang pemain
const textPlayerBet = document.getElementById("textPlayerBet");
const textPlayerSums = document.getElementById("textPlayerSums");
const textPlayerMoney = document.getElementById("textPlayerMoney");

// Container Dek. tempat kartu akan ditampilkan
const botDeckContainer = document.getElementById("botDeckContainer");
const playerDeckContainer = document.getElementById("playerDeckContainer");

const textBotSums = document.getElementById("textBotSums");

modalStart.show();

// Mulai permainan
const startGame = () => {
  playerMoney = parseInt(inputDeposito.value);
  if (playerMoney < 100) {
    alert("Deposito minimal $100.");
    return;
  }
  modalStart.hide();
  startTurn();
};

// Mulai putaran
const startTurn = () => {
  deck = shuffle(blackJackCards.slice());
  playerDeck = [];
  playerSum = 0;
  betAmount = 0;
  botDeck = [];
  botSum = 0;
  playerDeckContainer.innerHTML = "";
  botDeckContainer.innerHTML = "";

  addPlayerDeck(getCard());
  addPlayerDeck(getCard());
  addBotDeck(getCard());

  setPlayerMoney(playerMoney);
  setPlayerBet(betAmount);

  disableHitHold(true);
  disableBetButton(false);
};

// Status tombol
const disableHitHold = (disable) => {
  buttonHit.disabled = disable;
  buttonHold.disabled = disable;
};

const disableBetButton = (disable) => {
  const buttonsArray = Array.from(buttonBet);
  buttonsArray.forEach((button) => {
    button.disabled = disable;
  });
};

// Untuk mengacak urutan elemen di dalam array cards
const shuffle = (cards) => {
  for (let i = 0; i < cards.length; i++) {
    const j = Math.floor(Math.random() * (i + 1));
    [cards[i], cards[j]] = [cards[j], cards[i]];
  }
  return cards;
};

const getCard = () => {
  return deck.pop();
};

const hit = () => {
  disableBetButton(true);
  addPlayerDeck(getCard());
  if (playerSum > 21) {
    displayModal("modalKalah");
    disableHitHold(true);
  }
};

// Logika Bot
const delay = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
const addBotDeckWithDelay = async (card) => {
  addBotDeck(card);
  await delay(500);
  if (botSum < 17) {
    const nextCard = getCard();
    await addBotDeckWithDelay(nextCard);
  } else {
    finalizeHold();
  }
};

const hold = async () => {
  disableBetButton(true);
  const card = getCard();
  await addBotDeckWithDelay(card);
};

// Menentukan hasil
const finalizeHold = () => {
  if (botSum > 21) {
    displayModal("modalMenang");
    totalEarnings += betAmount * 2; // Tambah ke total earnings
    setPlayerMoney((playerMoney += betAmount * 2));
  } else {
    if (playerSum > botSum) {
      displayModal("modalMenang");
      totalEarnings += betAmount * 2; // Tambah ke total earnings
      setPlayerMoney((playerMoney += betAmount * 2));
    } else if (playerSum < botSum) {
      displayModal("modalKalah");
    } else {
      displayModal("modalSeri");
      totalEarnings += betAmount; // Tambah ke total earnings
      setPlayerMoney((playerMoney += betAmount));
    }
  }

  if (checkGameOver()) {
    return;
  }

  roundCount++;
  console.log(roundCount);

  if (roundCount >= 10) {
    showContinueModal();
  } else {
    disableHitHold(true);
    disableBetButton(false);
  }
};

// Fungsi untuk memeriksa apakah game over
const checkGameOver = () => {
  if (playerMoney <= 0) {
    displayModal("modalGameOver");
    disableHitHold(true);
    disableBetButton(true);
    return true;
  }
  return false;
};

// Menempatkan taruhan
const placeBet = (amount) => {
  if (amount < 100) {
    alert("Taruhan minimal $100.");
    return;
  }
  if ((playerMoney -= amount) < 0) {
    playerMoney += amount;
    alert("Uang tidak cukup");
  } else {
    betAmount += amount;
    setPlayerMoney(playerMoney);
    setPlayerBet(betAmount);
    disableHitHold(false);
    checkGameOver();
  }
};

// Menampilkan modal
function displayModal(modalId) {
  const modal = new bootstrap.Modal(document.getElementById(modalId));
  modal.show();

  modal._element.addEventListener("hidden.bs.modal", function () {
    startTurn();
  });
}

const addPlayerDeck = (card) => {
  playerDeck.push(card);
  const img = document.createElement("img");
  img.src = card.src;
  img.alt = card.name;
  img.width = 100;
  img.classList.add("mx-1");
  img.classList.add("swipe-down");
  playerDeckContainer.appendChild(img);
  setPlayerSum(card);
};

// Manambah kartu ke dek
const addBotDeck = (card) => {
  botDeck.push(card);
  const img = document.createElement("img");
  img.src = card.src;
  img.alt = card.name;
  img.width = 100;
  img.classList.add("mx-1");
  img.classList.add("swipe-down");
  botDeckContainer.appendChild(img);
  setBotSum(card);

  if (botDeck.length <= 1) {
    const backImg = document.createElement("img");
    backImg.src = "cards/BACK.png";
    backImg.alt = "Flipped";
    backImg.width = 100;
    backImg.classList.add("mx-1");
    backImg.classList.add("swipe-down");
    botDeckContainer.appendChild(backImg);
  } else {
    const backImg = botDeckContainer.querySelector('img[src="cards/BACK.png"]');
    if (backImg) {
      botDeckContainer.removeChild(backImg);
    }
  }
};

// untuk memperbarui elemen tampilan di halaman web dengan data terbaru terkait permainan kartu (seperti jumlah uang, taruhan, dan nilai kartu).
const setPlayerMoney = (text) => {
  textPlayerMoney.textContent = text;
};
const setPlayerBet = (text) => {
  textPlayerBet.textContent = text;
};
const setPlayerSum = (card) => {
  playerSum += getCardValue(playerSum, card);
  textPlayerSums.textContent = playerSum;
};
const setBotSum = (card) => {
  botSum += getCardValue(botSum, card);
  textBotSums.textContent = botSum;
};

// Perhitungan kartu
const getCardValue = (currentSum, card) => {
  if (card.value === 11) {
    return currentSum + 11 > 21 ? 1 : 11;
  }
  return parseInt(card.value);
};

// Fungsi untuk menampilkan modal melanjutkan permainan
const showContinueModal = () => {
  const modal = new bootstrap.Modal(document.getElementById("modalContinue"));
  modal.show();

  // Handle continue button
  const continueButton = document.getElementById("continueButton");
  continueButton.onclick = continuePlaying;

  // Handle stop button
  const stopButton = document.getElementById("stopButton");
  stopButton.onclick = endGame;
};

// Fungsi untuk melanjutkan permainan
const continuePlaying = () => {
  roundCount = 0; // Reset hitungan putaran
  const modal = bootstrap.Modal.getInstance(
    document.getElementById("modalContinue")
  );
  modal.hide();
  startTurn(); // Mulai putaran baru
};

// Fungsi untuk mengakhiri permainan
const endGame = () => {
  alert(
    `Terima kasih telah bermain! Total uang yang didapatkan: $${totalEarnings}`
  );
  window.location.reload(); // Mengulang halaman untuk memulai permainan dari awal
};
