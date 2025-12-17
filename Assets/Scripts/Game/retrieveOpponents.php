<?php
if (isset($_GET['list_id'])) {
    $listId = filter_input(INPUT_GET, 'list_id', FILTER_SANITIZE_STRING);
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smashorpassdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Requête pour récupérer les id des concurrents
$sql = "SELECT id_item1 FROM listes_content WHERE id_liste = {$listId};";
$result = mysqli_query($conn, $sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Requête pour récupérer les infos des concurrents
$concurrents = array();

foreach ($data as $key => $value) {
    $valueToGet = $value['id_item1'];

    $sql = "SELECT nom, image_path FROM items WHERE id = {$valueToGet};";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $concurrents[] = $row;
        }
    }
}

header('Content-Type: application/json');
echo json_encode($concurrents);
?>