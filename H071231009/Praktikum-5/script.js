let botSums = 0;
let mySums = 0;

let botASCards = 0;
let myASCards = 0;

let cards;
let isCanHit = true;

let uang = document.getElementById("amount");
let uangku = 5000;
let botHiddenCard;

const btnStart = document.getElementById("btn-start");
const btnhold = document.getElementById("btn-hold");
const btntake = document.getElementById("btn-take");

const mySumsElement = document.getElementById("mysum");
const myCardsElement = document.getElementById("myimg");

const myMoney = document.getElementById("depo");
const depositValue = parseInt(myMoney.value);

const botSumsElement = document.getElementById("bot");
const botCardsElement = document.getElementById("botimg");

const resultElement = document.getElementById("notif");

window.onload = () => {
    buildUserCards();
    shuffleCards();
    btntake.disabled = true;
    btnhold.disabled = true;
};

function buildUserCards() {
    let cardTypes = ["C", "D", "H", "S"];
    let cardValues = [
        "A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "K", "Q", "J"
    ];
    cards = [];
    
    for (let type of cardTypes) {
        for (let value of cardValues) {
            cards.push(value + "-" + type);
        }
    }
}

function shuffleCards() {
    for (let i = cards.length - 1; i > 0; i--) {
        let randomIndex = Math.floor(Math.random() * (i + 1));
        [cards[i], cards[randomIndex]] = [cards[randomIndex], cards[i]];
    }
}

btnStart.addEventListener("click", function () {
    const depositValue = parseInt(myMoney.value);
    
    // let uangku = parseInt(uang.textContent)

    if (isNaN(depositValue) || depositValue <= 0) {
        alert("Masukkan depo terlebih dahulu!");
        return;
    }

    if (depositValue < 100) {
        alert("Depo terlalu kecil. Masukkan depo lebih besar dari 99");
        resetDepo();
        return;
    }

    if (depositValue > uangku) {
        alert("Uang kamu tidak cukup. Masukkan depo lebih kecil dari " + uangku);
        resetDepo();
        return;
    }

    resetGame();
    takeCards(2); // Ambil 2 kartu untuk pemain

    // Ambil satu kartu terbuka untuk bot
    let botOpenCard = cards.pop();
    let botOpenCardImg = document.createElement("img");
    botOpenCardImg.src = `/cards/${botOpenCard}.png`;
    botOpenCardImg.style.width = "120px";
    botOpenCardImg.style.margin = "1px";
    botCardsElement.append(botOpenCardImg);

    botSums += getValueOfCard(botOpenCard);
    botASCards += checkASCard(botOpenCard);
    botSumsElement.textContent = botSums; // Tampilkan sum dari kartu terbuka bot

    // Tampilkan satu kartu tertutup untuk bot
    botHiddenCard = document.createElement("img");
    botHiddenCard.src = "/cards/back.png";
    botHiddenCard.style.width = "120px";
    botHiddenCard.style.margin = "1px";
    botCardsElement.append(botHiddenCard);
    
    btntake.disabled = false;
    btnhold.disabled = false;
    btnStart.disabled = true;
    hitunguang(depositValue);
});



function hitunguang(depositValue) {

    uangku = uangku - depositValue;
    uang.textContent = uangku;
}


btntake.addEventListener("click", function () {
    if (!isCanHit) return;
    takeCards(1); 
});

btnhold.addEventListener("click", function () {
    
    botHiddenCard.remove(); 
    
    let hiddenCard = cards.pop(); 
    let hiddenCardImg = document.createElement("img");
    hiddenCardImg.src = `/cards/${hiddenCard}.png`;
    hiddenCardImg.style.width = "120px";
    hiddenCardImg.style.margin = "1px";
    botCardsElement.append(hiddenCardImg); 
   
    botSums += getValueOfCard(hiddenCard);
    botASCards += checkASCard(hiddenCard);
    botSumsElement.textContent = botSums;

    
    takeBotCards();
});


function takeCards(count) {
    // Cek apakah pemain masih diizinkan untuk mengambil kartu
    if (!isCanHit) return;

    for (let i = 0; i < count; i++) {
        let card = cards.pop();
        let cardImg = document.createElement("img");

        cardImg.src = `/cards/${card}.png`;
        cardImg.style.width = "120px"; 
        cardImg.style.margin = "1px";
        myCardsElement.append(cardImg);

        mySums += getValueOfCard(card);
        myASCards += checkASCard(card);

        mySumsElement.textContent = mySums;

        if (mySums > 21) {
            isCanHit = false; 
            
            setTimeout(() => {
                endGame("YOU LOSEE!");
            }, 500); 
            
            return; 
        }
    }
}

function takeBotCards() {
    setTimeout(() => {
        let card = cards.pop();
        let cardImg = document.createElement("img");
        if (botSums < 18) {
            takeBotCards(); 
        } else {
            endGame();
            return;
        }
        cardImg.src = `/cards/${card}.png`;
        cardImg.style.width = "120px"; 
        cardImg.style.margin = "1px";
        botCardsElement.append(cardImg);
        
        botSums += getValueOfCard(card);
        botASCards += checkASCard(card);
        botSumsElement.textContent = botSums;
        
        console.log(`Bot Sum: ${botSums}`);

    }, 500);
}

function endGame(message) {
    isCanHit = false; 

    const depositValue = parseInt(myMoney.value); 

    if (message) {
        alert(message); 
        resultElement.textContent = message; 
    } else {
        let finalMessage = ""; 

        if (mySums > 21) {
            finalMessage = "YOU LOSEE!";
        } else {
            if (botSums > 21 || mySums > botSums) {
                finalMessage = "YOU WINN!";
                uangku += 2 * depositValue; 
            } else if (mySums === botSums) {
                finalMessage = "SERI";
                uangku += depositValue; 
            } else if (mySums < botSums) {
                finalMessage = "YOU LOSEE!";
            }
        }

        uang.textContent = uangku;
        btnStart.disabled = false;

        alert(finalMessage); 
        resultElement.textContent = finalMessage; 
    }
}

function resetGame() {
    botSums = 0;
    mySums = 0;
    botASCards = 0;
    myASCards = 0;
    isCanHit = true;
    
    myCardsElement.innerHTML = "";
    botCardsElement.innerHTML = "";
    mySumsElement.textContent = "";
    botSumsElement.textContent = "";
    resultElement.textContent = "";
    
    buildUserCards();
    shuffleCards();
}

function getValueOfCard(card) {
    let value = card.split("-")[0];
    if (isNaN(value)) {
        return (value === "A") ? 11 : 10; 
    }
    return parseInt(value);
}

function checkASCard(card) {
    return (card[0] === "A") ? 1 : 0;
}

function resetDepo() {
    myMoney.value = ""; 
}
