<?php
function uploadOnServeur(string $baseFolder, string $nomEnregistrement, string $nomTemporaire, string $listName) : array {
    // Check si le dossier cible n'a pas déjà été défini
    if ($baseFolder === "Images/Listes/") {
        // Check si un dossier avec le nom de la liste existe déjà, si oui en crée un autre et le crée sinon.
        if (!is_dir("../../Images/Listes/{$listName}")) {
            mkdir("../../Images/Listes/{$listName}", 0777, true);
            $baseFolder = "Images/Listes/{$listName}";
        } else {
            $folder_path = "Images/Listes/{$listName}";
            $compteur = 1;

            while (is_dir("../../{$folder_path}")) {
                $folder_path .= $compteur;
                $compteur++;
            }

            mkdir("../../{$folder_path}", 0777, true);
            $baseFolder = $folder_path;
        }
    }
    
    if (is_file("../../{$baseFolder}/{$nomEnregistrement}")) {
        $compteur = 1;

        while (is_file("../../{$baseFolder}/{$nomEnregistrement}")) {
            $nomEnregistrement = $compteur.$nomEnregistrement;
            $compteur++;
        }
    }

    // Upload des images dans le répertoire de la liste
    if (move_uploaded_file($nomTemporaire, "../../{$baseFolder}/{$nomEnregistrement}")) {
        return [$baseFolder, "{$baseFolder}/{$nomEnregistrement}"];
    } else {
        throw new Exception("Echec du transfert du fichier '$nomEnregistrement' sur le serveur au chemin {$baseFolder}.", 1);
        return [$baseFolder, "{$baseFolder}/{$nomEnregistrement}"];
    }
}

// Si le formulaire à été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dossierBase = "Images/Listes/";

    // Récupération des champs du formulaire
    // Récupération des champs généraux de la liste
    if (isset($_POST['list-name'])) {
        $listName = filter_input(INPUT_POST, 'list-name', FILTER_SANITIZE_STRING);
    }

    if (isset($_FILES["list-vignette"]) && $_FILES["list-vignette"]["error"] == 0) {
        $nomFichier = "vignette_liste_".$listName;
        $nomTemporaire = $_FILES["list-vignette"]["tmp_name"];
        $fileExtension = pathinfo($_FILES["list-vignette"]["name"], PATHINFO_EXTENSION);
        $nomFichier .= ".".$fileExtension;
    } else {
        throw new Exception("Erreur lors du téléchargement du fichier : " . $_FILES["list-vignette"]["error"], 1);
    }

    /*if (isset($_POST['combat-mode'])) {
        $combatMode = True;
    } else {
        $combatMode = False;
    }*/
    $combatMode = False;


    // Upload de la vignette de la liste
    $retour = uploadOnServeur($dossierBase, $nomFichier, $nomTemporaire, $listName);
    $dossierBase = $retour[0];
    $dossierCible = $retour[1];


    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smashorpassdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Préparation et exécution de la requête d'insertion
    $listeInsertQuery = $conn->prepare("INSERT INTO listes (nom, vignette_path, combat_mode) VALUES (?, ?, ?)");
    $vignettePath = $dossierCible;
    $listeInsertQuery->bind_param("sss", $listName, $vignettePath, $combatMode);

    // Insertion des données dans la base de données
    $listeInsertQuery->execute();
    $result = $listeInsertQuery->get_result();
    // Récupéreration de l'ID inséré
    $insertedIdListe = $listeInsertQuery->insert_id;

    // Fermeture de la requête
    $listeInsertQuery->close();


    // Préparation de la requête d'insertion des concurrents
    $concurrentInsertQuery = $conn->prepare("INSERT INTO items (nom, image_path, nb_smash, nb_pass) VALUES (?, ?, ?, ?)");
    // Préparation de la requête d'insertion dans la table d'association entre les listes et les concurrents
    $listeContentInsertQuery = $conn->prepare("INSERT INTO listes_content (id_liste, id_item1) VALUES (?, ?)");

    // Récupération des concurrents et insertion dans la base de données
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'nom') === 0) {
            $idConcurrent = $key;
            $nomConcurrent = filter_var($value, FILTER_SANITIZE_STRING);
            
            $idImage = "image".substr($idConcurrent, 3);
            if (isset($_FILES[$idImage]) && $_FILES[$idImage]["error"] == 0) {
                $nomFichier = $nomConcurrent;
                $nomTemporaire = $_FILES[$idImage]["tmp_name"];
                $fileExtension = pathinfo($_FILES[$idImage]["name"], PATHINFO_EXTENSION);
                $nomFichier .= ".".$fileExtension;
            } else {
                throw new Exception("Erreur lors du téléchargement du fichier : " . $_FILES[$idImage]["error"], 1);
            }

            // Upload de l'image du concurrent
            $retour = uploadOnServeur($dossierBase, $nomFichier, $nomTemporaire, $listName);
            $dossierBase = $retour[0];
            $dossierCible = $retour[1];
            
            // Bind parameters
            $dossierImageConcurrent = "../{$dossierCible}";
            $nbSmash = 0;
            $nbPass = 0;
            $concurrentInsertQuery->bind_param("ssss", $nomConcurrent, $dossierImageConcurrent, $nbSmash, $nbPass);

            // Insertion des données dans la base de données
            $concurrentInsertQuery->execute();

            // Récupéreration de l'ID inséré
            $insertedIdConccurent = $concurrentInsertQuery->insert_id;

            // Insertion dans la table d'association entre les listes et les concurrents
            $listeContentInsertQuery->bind_param("ss", $insertedIdListe, $insertedIdConccurent);
            $listeContentInsertQuery->execute();
        }
        
    }

    // Fermeture des requêtes et de la connexion
    $concurrentInsertQuery->close();
    $listeContentInsertQuery->close();
    $conn->close();

} else {
    echo "Aucune donnée POST reçue";
}

?>