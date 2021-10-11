<?php
$nazovSuboru="Tabulka surovin";
include "widgets/header.php";
include "widgets/navbar.php";
$conn = '';
include "config.php";

$query = "SELECT tbl_suroviny.id_suroviny, tbl_suroviny.nazov_suroviny, enum_kategoria_suroviny.nazov_kategorie 
        FROM tbl_suroviny INNER JOIN enum_kategoria_suroviny ON tbl_suroviny.kategoria_suroviny=enum_kategoria_suroviny.id_kategorie 
        ORDER BY id_suroviny ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
$result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
$pocetRiadkov = mysqli_num_rows($result);
if (!$result) {
    echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
    exit;
}
if ($pocetRiadkov == 0) {

    echo "Nemam co zobrazit";

}

?>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Nazov suroviny</th>
        <th>Kategoria suroviny</th>
    </tr>
    </thead>
    <?php

    while ($row = mysqli_fetch_assoc($result)) {

    ?>
    <tr>
        <td><?php echo $row["nazov_suroviny"]?></td>
        <td><?php echo $row["nazov_kategorie"]?></td>
        </tr>

<?php
    }
    mysqli_close($conn);
?>
</table>
</div>
