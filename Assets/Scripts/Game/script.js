// Sélection des éléments HTML
const imgEl = document.querySelector(".character-card img");
const nameEl = document.querySelector(".name");
const cardEl = document.querySelector(".character-card");
const btnSmash = document.querySelector(".btn-smash");
const btnPass = document.querySelector(".btn-pass");
const progressEl = document.querySelector(".progress");

const urlParams = new URLSearchParams(window.location.search);
const listeId = urlParams.get('list_id');

let characters;

// Position actuelle
let index = 0;

// Récupération des concurents depuis la BDD depuis la BDD
fetch('../Scripts/Game/retrieveOpponents.php?list_id=' + listeId)
    .then(response => response.json())
    .then(data => {
        characters = data;
        
        // Mise à jour de l’affichage au début
        updateCharacter();   
    })
    .catch(error => console.error('Error fetching data:', error))
;

// --- CHARGER LE PERSONNAGE SUIVANT ---
function updateCharacter() {
    const character = characters[index];
    
    imgEl.src = character["image_path"];
    nameEl.textContent = character["nom"];

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