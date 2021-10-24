<?php
$conn="";
include "config.php";
$nazovSuboru="Prehlad receptov";
include "widgets/header.php";

$bc_nazov = "Prehlad receptov";
include "widgets/navbar.php";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
    <h3>Zoznam receptov</h3>
</div>
        <div class="col-4">
            <a href="new_recept.php" class="btn btn-primary"><i class="fa fa-plus"></i> Vytvorit novy recept</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nazov jedla</th>
                <th>Kategoria jedla</th>
                <th>Alergeny</th>
                <th colspan="2">Akcia</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT id, nazov, nazov_typu_receptu FROM recept 
            INNER JOIN typ_receptu ON id_typu_receptu=typ_receptu ORDER BY id ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
            $result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
            $pocetRiadkov = mysqli_num_rows($result);
            if (!$result) {
                echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
                exit;
            }
            if ($pocetRiadkov == 0) {

                echo "Nemam co zobrazit";

            }
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
        <tr>
            <td><a id="zobrazObedy" href="detail_jedla.php?id=<?php echo $row["id"]; ?>"><?php echo $row["nazov"]?></a></td>
            <td><?php echo $row["nazov_typu_receptu"]?></td>
            <td><?php echo /*$row["nazov"]*/"1,2,4"?></td>
            <td><a class="btn btn-primary" id="zobrazObedy" href="detail_jedla.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-search"></i> Detail jedla</a></td>
            <td><a class="btn btn-primary" id="Priradsuroviny" href="priradenie_surovin.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-search"></i> Prirad suroviny jedla</a></td>


        <?php
            }
        ?>
        </tbody>
    </table>
</div>
<?php
mysqli_close($conn);
include "widgets/footer.php";
?>
