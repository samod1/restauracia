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
        ?>
        <br>
    <div class="alert alert-warning" role="alert">
        <p><strong>V databaze sa nenachadzaju ziadne recepty</strong></p>
    </div>
<?php
    }
    else
    {
        ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th><?php echo $lang["nReceptu"]?></th>
        <th><?php echo $lang["kategorieRec"]?></th>
        <th><?php echo $lang["alergens"]?></th>
        <th><?php echo $lang["price"]?></th>
        <th colspan="3"><?php echo $lang["action"]?></th>
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
        <td><a class="btn btn-primary" id="zobrazObedy" href="detail_jedla.php?id=<?php echo $row["id_receptu"]; ?>"><?php echo $lang["detailRec"]?></a></td>
        <td><a class="btn btn-primary" id="Priradsuroviny" href="priradenie_surovin.php?id=<?php echo $row["id_receptu"]; ?>"><?php echo $lang["addIng"]?></td>
        <td><a onclick="return confirm('<?php echo $lang["delRecReq"];?>');" class="btn btn-danger" href="../odstranenie_receptu.php?id=<?php echo $row["id_receptu"]?>&zmazat=ano"><?php echo $lang["delRec"]?></a></td>


        <?php
        }}


        ?>
    </tbody>
</table>