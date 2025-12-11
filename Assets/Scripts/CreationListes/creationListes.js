// Récupération des éléments du DOM
const combatMode = document.getElementById('combat-mode');
const opponentsSpace = document.getElementById('opponentsSpace');
const buttonAjoutDansListe = document.getElementById('buttonAjoutDansListe');

// Variables logiques
let compteurConcurrents = 1;
let combatModeHasBeenChecked = false;

// Modèles HTML pour les ajouts
function addOpponent(count) {
    return `
    <section>
        <label for="nom${count}">Nom :</label>
        <input type="text" name="nom${count}" required id="nom${count}"/>
        
        <label for="image${count}">Image :</label>
        <input type="file" accept="image/*" name="image${count}" required id="image${count}"/>
    </section>
`;
}

/*function buildCombat(count) {
    return `
    <fieldset>
        <legend>Combat n°${count} :</legend>

        <fieldset>
            <legend>Premier concurrent</legend>
            <label for="nom${count + "_1"}">Nom :</label>
            <input type="text" id="nom${count + "_1"}" name="nom${count + "_1"}" required/>

            <label for="image${count + "_1"}">Image :</label>
            <input type="file" accept="image/*" id="image${count + "_1"}" name="image${count + "_1"}" required/>
        </fieldset>

        <fieldset>
            <legend>Deuxième concurrent</legend>
            <label for="nom${count + "_2"}">Nom :</label>
            <input type="text" accept="image/*" id="nom${count + "_2"}" name="nom${count + "_2"}" required/>

            <label for="image${count + "_2"}">Image :</label>
            <input type="file" accept="image/*" id="image${count + "_2"}" name="image${count + "_2"}" required/>
        </fieldset>
    </fieldset>`;
}*/


// vérification du mode combat
/*combatMode.addEventListener('change', function(event) {
    if ((combatMode.checked === true && combatModeHasBeenChecked === false) || (combatMode.checked === false && combatModeHasBeenChecked === true)) {
        let p = confirm("Le mode combat et le mode classique ne sont pas compatible. Le formulaire va donc être réinitialisé si vous cliquez sur OK.");

        if (p === true) {
            opponentsSpace.innerHTML = "";
            compteurConcurrents = 1;
            combatModeHasBeenChecked = combatMode.checked;
        }
        else {
            combatMode.checked = !combatMode.checked;
        }
    }
});*/

// Construction du form en fct du type de combat
buttonAjoutDansListe.addEventListener('click', function(event) {
    opponentsSpace.insertAdjacentHTML("beforeend", addOpponent(compteurConcurrents));
    compteurConcurrents++;

    /*if (combatMode.checked) {
        opponentsSpace.innerHTML += buildCombat(compteurConcurrents);
        compteurConcurrents++;
    }
    else {
        opponentsSpace.innerHTML += addOpponent(compteurConcurrents);
    }*/
});