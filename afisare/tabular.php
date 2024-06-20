<?php
// Date simulate
$data = [
    ["ID" => 1, "Name" => "John Doe", "Email" => "john@example.com", "Sex" => "Male"],
    ["ID" => 2, "Name" => "Jane Smith", "Email" => "jane@example.com", "Sex" => "Female"],
    ["ID" => 3, "Name" => "Sam Brown", "Email" => "sam@example.com", "Sex" => "Male"]
];

// Verificare dacă butonul de export CSV a fost apăsat
if (isset($_POST['export_csv'])) {
    $filename = "date_exportate.csv";
    // Aceste două linii de cod PHP sunt responsabile pentru setarea anteturilor HTTP necesare pentru a forța browserul să descarce un fișier CSV.
    //Această linie specifică tipul de conținut al răspunsului HTTP ca fiind text/csv, ceea ce indică că urmează să fie trimis un fișier CSV.
    header('Content-Type: text/csv');
    //Acest antet Content-Disposition specifică modul în care răspunsul HTTP trebuie să fie tratat de browser.
    //Folosind attachment, se indică că răspunsul ar trebui descărcat de utilizator și nu afișat în browser.
    //Parametrul filename specifică numele fișierului sugerat pentru descărcare
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    //Funcția fopen() este folosită în PHP pentru a deschide un fișier sau alt tip de resursă
    //În cazul de față, 'php://output' este un stream special predefinit în PHP care permite să fie scris direct în fluxul de ieșire al scriptului PHP.
    $output = fopen('php://output', 'w');
    
    // Afișarea antetului - fputcsv() - Este o funcție încorporată în PHP care formatează o linie în format CSV și o scrie într-un fișier deschis sau în fluxul specificat.
    // array_keys($data[0]) - Această funcție PHP, array_keys(), returnează toate cheile sau numele de coloane dintr-un array asociativ. În cazul nostru, $data[0] este primul rând din setul de date, și array_keys($data[0]) va returna un array cu cheile acestui rând.
    fputcsv($output, array_keys($data[0]));
    
    
    // Afișarea rândurilor
    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    //Exportul efectiv al fișierului CSV se întâmplă atunci când toate datele din $data sunt scrise în fluxul de ieșire (php://output). După ce aceste date sunt trimise, browserul va interpreta răspunsul ca un fișier CSV și va propune utilizatorului să-l descarce cu numele specificat (date_exportate.csv).
    
    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afișare Tabel</title>
</head>
<body>
    <!-- Afișarea Tabelului -->
    <table border="1">
        <tr>
            <?php
            // Afișarea antetului tabelului
            foreach (array_keys($data[0]) as $header) {
                echo "<th>" . $header . "</th>";
            }
            ?>
        </tr>
        <?php
        // Afișarea rândurilor tabelului
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . $cell . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Formular pentru export CSV -->
    <form method="post">
        <button type="submit" name="export_csv">Exportă CSV</button>
    </form>
</body>
</html>
