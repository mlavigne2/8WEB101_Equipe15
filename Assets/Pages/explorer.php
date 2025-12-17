<?php
// Connexion à la base de données
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "smashorpassdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération du terme de recherche
$search = "";
if (isset($_GET["q"])) {
    $search = trim($_GET["q"]);
}

// Construction de la requête SQL
$sql = "SELECT id, nom, vignette_path FROM listes";
if ($search !== "") {
    $safe = $conn->real_escape_string($search);
    $sql .= " WHERE nom LIKE '%$safe%'";
}
$sql .= " ORDER BY id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Explorer les listes - SmashOrPass.gg</title>
    <link rel="stylesheet" href="../Styles/style.css" />
</head>

<body>

    <!-- HEADER GLOBAL -->
    <header class="header">
        <div class="logo"><a href="../../index.php">SmashOrPass.gg</a></div>
        <nav>
            <ul class="nav-links">
                <li><a href="../../index.php">Jouer</a></li>
                <li><a href="explorer.php">Explorer</a></li>
                <li><a href="creationListe.html">Créer une liste</a></li>
                <li><a href="compte.html">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <main class="explore-container fade-in">

        <!-- Titre + intro -->
        <section class="explore-header">
            <h1>Explorer les listes</h1>
            <p>Recherchez et filtrez les listes Smash or Pass créées par la communauté.</p>
        </section>

        <!-- Barre de recherche -->
        <section class="search-filters">
            <form id="exploreForm" method="get" action="explorer.php">
                <div class="search-bar">
                    <input 
                        type="search" 
                        name="q" 
                        id="search" 
                        placeholder="Rechercher une liste..."
                        value="<?php echo htmlspecialchars($search); ?>"
                    />
                    <button type="submit" class="btn-primary">Rechercher</button>
                </div>
            </form>
        </section>

        <!-- Résultats -->
        <section class="explore-results">
            <h2>
                <?php
                if ($search !== "") {
                    echo "Résultats pour « " . htmlspecialchars($search) . " »";
                } else {
                    echo "Toutes les listes";
                }
                ?>
            </h2>

            <div class="cards">

            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // Construire le chemin réel vers la vignette
                    $vignette = "../" . $row["vignette_path"];
            ?>

                <article class="card explore-card">

                    <a href="game.html?list_id=<?php echo $row["id"]; ?>">

                        <!-- Image bien proportionnée -->
                        <div class="thumb-wrapper">
                            <img src="<?php echo htmlspecialchars($vignette); ?>" 
                                 alt="Vignette de la liste"
                                 class="card-thumb">
                        </div>

                        <h3><?php echo htmlspecialchars($row["nom"]); ?></h3>

                    </a>

                    <button class="btn-primary"
                            onclick="location.href='game.html?list_id=<?php echo $row['id']; ?>'">
                        Voir la liste
                    </button>

                </article>

            <?php
                }
            } else {
                echo "<p>Aucune liste trouvée.</p>";
            }

            $conn->close();
            ?>

            </div>
        </section>

    </main>

    <footer class="footer">
        © 2025 SmashOrPass.gg
    </footer>

</body>
</html>
