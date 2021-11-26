<?php
$nazovSuboru="Prehlad surovin";
include "widgets/header.php";
$bc_nazov="Prehlad surovin";
include "widgets/navbar.php";
$conn = '';
include "config.php";

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
    <h3>Prehlad surovin</h3>
        </div>
        <div class="col-4">
            <a href="vkladanie_surovin.php" class="btn btn-primary"><i class="fa fa-plus"></i> Pridat novu surovinu</a>
        </div>
    </div>

</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Kategoria</th>
            <th>Akcia</th>
        </tr>
    </thead>
    <tbody
    <?php

$queryKat="SELECT id_kategorie, nazov_kategorie FROM enum_kategoria_suroviny ORDER BY id_kategorie ASC";
$resultKat = mysqli_query($conn,$queryKat);
$pocetRiadkovKat = mysqli_num_rows($resultKat);
if (!$resultKat) {
    echo "Error: Neda sa vykonat prikaz SQL: " . $queryKat . ".<br>" . PHP_EOL;
    exit;
}
if ($pocetRiadkovKat == 0) {

    echo "Nemam co zobrazit";

}
    while ($row = mysqli_fetch_assoc($resultKat)) {
?>
        <tr>
            <td><a href="sur_kat.php?id=<?php echo $row["id_kategorie"];?>"><?php echo $row["nazov_kategorie"]?></a></td>
            <td><a href="mazanie_kategorie.php?id=<?php echo $row["id_kategorie"]?>&zmazat=ano" class="btn btn-danger btn-ml"><i class="fa fa-trash"></i></a> </td>
        </tr>
    <?php }?>
    </tbody>
</table>
</div>

</div>
    </div>
<?php
mysqli_close($conn);
include "widgets/footer.php";
?>