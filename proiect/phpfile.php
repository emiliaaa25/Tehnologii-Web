<?php
// Conectați-vă la baza de date PhpMyAdmin
$servername = "localhost";
$username = "web"; // înlocuiți cu numele de utilizator al bazei de date
$password = "EmiliaAndra"; // înlocuiți cu parola bazei de date
$dbname = "web"; // înlocuiți cu numele bazei de date

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificați conectarea
if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

// Defineți datele de inserat
$id = 123;
$title = "Nume film";
$release_date = "2024-05-06";
$overview = "Descriere film";

// Construiți și executați interogarea SQL pentru inserare
$sql = "INSERT INTO filme (id, title, release_date, overview)
        VALUES ('$id', '$title', '$release_date', '$overview')";

if ($conn->query($sql) === TRUE) {
    echo "Datele au fost inserate cu succes în baza de date";
} else {
    echo "Eroare la inserarea datelor în baza de date: " . $conn->error;
}

// Închideți conexiunea
$conn->close();
?>
