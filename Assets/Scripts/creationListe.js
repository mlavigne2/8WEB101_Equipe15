// Récupération des éléments du DOM
const combatType = document.getElementById('combatType');
const opponentsSpace = document.getElementById('opponentsSpace');
const buttonAjoutDansListe = document.getElementById('buttonAjoutDansListe');

// Variables logiques
let compteurCombats = 1;

// Modèles HTML pour les ajouts
const random = `
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required/>
    
    <label for="image">Image :</label>
    <input type="file" id="image" name="image" required/>`;

function buildPrecise(count) {
    return `
    <fieldset>
        <legend>Combat n°${count} :</legend>

        <fieldset>
            <legend>Premier concurrent</legend>
            <label for="nom${count + "_1"}">Nom :</label>
            <input type="text" id="nom${count + "_1"}" name="nom${count + "_1"}" required/>

            <label for="image${count + "_1"}">Image :</label>
            <input type="file" id="image${count + "_1"}" name="image${count + "_1"}" required/>
        </fieldset>

        <fieldset>
            <legend>Deuxième concurrent</legend>
            <label for="nom${count + "_2"}">Nom :</label>
            <input type="text" id="nom${count + "_2"}" name="nom${count + "_2"}" required/>

            <label for="image${count + "_2"}">Image :</label>
            <input type="file" id="image${count + "_2"}" name="image${count + "_2"}" required/>
        </fieldset>
    </fieldset>`;
}

// Construction du form en fct du type de combat
buttonAjoutDansListe.addEventListener('click', function(event) {
    if (combatType.checked) {
        opponentsSpace.innerHTML += random;
    }
    else {
        opponentsSpace.innerHTML += buildPrecise(compteurCombats);
        compteurCombats++;
    }
});