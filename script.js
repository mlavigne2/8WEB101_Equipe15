// --- LISTE DE PERSONNAGES (exemple simple) ---
const characters = [
    {
        name: "Mario",
        img: "img/Mario.jpg"
    },
    {
        name: "Pikachu",
        img: "img/Pikachu.jpg"
    },
    {
        name: "Pringles crème sûre et oignon",
        img: "img/Pringles.jpg"
    }
];

// Position actuelle
let index = 0;

// Sélection des éléments HTML
const imgEl = document.querySelector(".character-card img");
const nameEl = document.querySelector(".name");
const cardEl = document.querySelector(".character-card");
const btnSmash = document.querySelector(".btn-smash");
const btnPass = document.querySelector(".btn-pass");
const progressEl = document.querySelector(".progress");

// Mise à jour de l’affichage au début
updateCharacter();

// --- CHARGER LE PERSONNAGE SUIVANT ---
function updateCharacter() {
    const character = characters[index];
    
    imgEl.src = character.img;
    nameEl.textContent = character.name;

    progressEl.textContent = `${index + 1} / ${characters.length}`;
}

// --- ANIMATION AVEC SMASH ---
btnSmash.addEventListener("click", () => {
    if (cardEl.classList.contains("smash-animation") || 
        cardEl.classList.contains("pass-animation")) return;

    cardEl.classList.add("smash-animation");

    setTimeout(() => {
        moveNext();
    }, 500); // durée correspond au CSS
});

// --- ANIMATION AVEC PASS ---
btnPass.addEventListener("click", () => {
    if (cardEl.classList.contains("smash-animation") || 
        cardEl.classList.contains("pass-animation")) return;

    cardEl.classList.add("pass-animation");

    setTimeout(() => {
        moveNext();
    }, 500);
});

// --- LOGIQUE : PASSER AU PERSONNAGE SUIVANT ---
function moveNext() {
    // Retirer l’animation pour permettre la suivante
    cardEl.classList.remove("smash-animation", "pass-animation");

    // Avancer dans la liste
    index++;

    if (index >= characters.length) {
        endScreen();
        return;
    }

    updateCharacter();
}

// --- ÉCRAN DE FIN ---
function endScreen() {
    imgEl.src = "";
    nameEl.textContent = "Fin de la liste ! Merci d’avoir joué ❤️";
    progressEl.textContent = "Complété";

    btnSmash.style.display = "none";
    btnPass.style.display = "none";
}
