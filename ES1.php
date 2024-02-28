<?php
// crea il collegamento al databse verifica
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "verifica";

// crea la connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// controlla la connessione
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>esercizio 1</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            $sql = "SELECT descrizione, carico, scarico FROM movimentazione WHERE codice_articolo = '$_GET[codice_articolo]'";
            $result = $conn->query($sql);
            $giacenza = 0;
            if ($result->num_rows > 0) {
                echo "<table><tr><th>Descrizione</th><th>Carico</th><th>Scarico</th><th>Giacenza</th></tr>";
                while($row = $result->fetch_assoc()) {
                  if($row['carico'] != 0)
                    $giacenza += $row['carico'];
                  else
                    $giacenza -= $row['scarico'];
                  echo "<tr><td>".$row['descrizione']."</td><td>".$row['carico']."</td><td>".$row['scarico']."</td><td>".$giacenza."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
        ?>
    </body>
</html


