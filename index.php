<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smashorpassdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Echo de la page partie 1
echo '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmashOrPass.gg – Accueil</title>
    <link rel="stylesheet" href="./Assets/Styles/style.css">
</head>

<body>
    <header class="header">
        <div class="logo">SmashOrPass.gg</div>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Jouer</a></li>
                <li><a href="#">Explorer</a></li>
                <li><a href="./Assets/Pages/creationListe.html">Créer une liste</a></li>
                <li><a href="#">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>Vote. Partage. Classe.</h1>
        <p>La plateforme dédiée pour créer et jouer à des listes Smash or Pass.</p>
';

// Récupération d'un id de liste aléatoire
$sql = "SELECT * FROM listes ORDER BY RAND() LIMIT 1;";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                <a href="./Assets/Pages/game.html?list_id='.$row["id"].'" class="btn-primary">Commencer à jouer</a>
            </section>

            <section class="featured">
                <h2>Listes disponibles</h2>
                <div class="cards">
        ';
    }
} else {
    echo "0 results";
}

// Récupération et affichage des listes depuis la base de données
$sql = "SELECT id, nom, vignette_path FROM listes";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="card">
            <a href="./Assets/Pages/game.html?list_id='.$row["id"].'">
                <img src="./Assets/'.$row["vignette_path"].'" alt="Vignette de la liste">
                <p>'.$row["nom"].'</p>
            </a>
        </div>';
    }
} else {
    echo "0 results";
}

$conn->close();

// Echo de la page partie 2
echo '</div>
    </section>

    <footer class="footer">
        © 2025 SmashOrPass.gg
    </footer>
</body>
</html>';
?>