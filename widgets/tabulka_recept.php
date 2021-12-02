<?php
    $conn="";
    include "configDb.php";
?>
<?php

    $query = "SELECT id_receptu, nazov_receptu, nazov_typu_receptu, alergeny, cena_jedla FROM tbl_recept 
            INNER JOIN enum_typ_receptu ON id_typu_receptu=typ_receptu ORDER BY id_receptu ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
    $result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
    $pocetRiadkov = mysqli_num_rows($result);
    if (!$result) {
        echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
        exit;
    }
    if ($pocetRiadkov == 0) {
        echo "Nemam co zobrazit";
    }
    else
    {
        ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Nazov jedla</th>
        <th>Kategoria jedla</th>
        <th>Alergeny</th>
        <th>Cena jedla</th>
        <th colspan="3">Akcia</th>
    </tr>
    </thead>
    <tbody>
<?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><a id="zobrazObedy" href="detail_jedla.php?id=<?php echo $row["id_receptu"]; ?>"><?php echo $row["nazov_receptu"]?></a></td>
        <td><?php echo $row["nazov_typu_receptu"]?></td>
        <td><?php echo $row["alergeny"]?></td>
        <td><?php echo $row["cena_jedla"]."€"?></td>
        <td><a class="btn btn-primary" id="zobrazObedy" href="detail_jedla.php?id=<?php echo $row["id_receptu"]; ?>"><i class="fa fa-search"></i> Detail jedla</a></td>
        <td><a class="btn btn-primary" id="Priradsuroviny" href="priradenie_surovin.php?id=<?php echo $row["id_receptu"]; ?>"><i class="fa fa-search"></i> Prirad suroviny jedla</a></td>
        <td><a onclick="return confirm('Chcete vymazat tento recept');" class="btn btn-danger" href="../odstranenie_receptu.php?id=<?php echo $row["id_receptu"]?>&zmazat=ano"><i class="fa fa-trash"></i> Odstranit recept</a></td>


        <?php
        }}


        ?>
    </tbody>
</table>