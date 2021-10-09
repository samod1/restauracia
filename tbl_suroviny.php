<?php
$conn = '';
include "config.php";

$query = "SELECT tbl_suroviny.id_suroviny ,tbl_suroviny.nazov_suroviny, tbl_suroviny.priezvisko,Student.fakulta FROM Student order by id ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
$result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
$pocetRiadkov = mysqli_num_rows($result);
if (!$result) {
    echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
    exit;
}
if ($pocetRiadkov == 0) {

    echo "Nemam co zobrazit";

}