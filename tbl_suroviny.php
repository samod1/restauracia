<?php
$nazovSuboru="Prehlad surovin";
include "widgets/header.php";
$bc_nazov="Prehlad surovin";
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
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
    <h2>Prehlad surovin</h2>
        </div>
        <div class="col-4">
            <a href="vkladanie_surovin.php" class="btn btn-primary"><i class="fa fa-plus"></i> Pridat novu surovinu</a>
        </div>
    </div>
</div>
</div>
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
    $queryKat="SELECT id_kategorie, nazov_kategorie FROM enum_kategoria_suroviny ORDER BY id_kategorie ASC";
    $resultKat = mysqli_query($conn,$queryKat);
    $pocetRiadkovKat = mysqli_num_rows($resultKat);
    if (!$result) {
        echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
        exit;
    }
    if ($pocetRiadkovKat == 0) {

        echo "Nemam co zobrazit";

    }

?>
</table>
<div class="row">
    <div class="col-4">
<h2>Kategorie surovin</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Kategoria</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($resultKat)) {

    ?>
        <tr>

            <td><?php echo $row["nazov_kategorie"]?></td>
        </tr>
    <?php }?>
    </tbody>
</table>
</div>
    <div class="col-8">
        <h2>Seznam alergenu</h2>
    </div>
</div>
