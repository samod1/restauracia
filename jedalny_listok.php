<?php
$nazovSuboru="Jidelny listek";
include "widgets/header.php";
$bc_nazov="Jidelny listek";
include "widgets/navbar.php";
?>
<div class="container-fluid">
    <div class="row">
        <h3>Jidelny listek</h3>
        <div class="col-4">
            <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Vytvorit novy jedalny listok</a>
        </div>
    </div>
    <h4>Seznam aktualnich jidelnych listku</h4>
    <?php
        $conn="";
        include "configDb.php";

        $query = "SELECT id_menu, datum_od, datum_do FROM tbl_menu ORDER BY id_menu ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
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
                <th colspan="2">Datum</th>
                <th colspan="1">Akcia</th>
                <th colspan="1">Priradit jedla k menu</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <tr>
            <td><?php echo $row["datum_od"] ?></td>
            <td><?php echo $row["datum_do"] ?></td>
            <td><a class="btn btn-primary" href="detail_jedalneho_listku.php?menu=<?php echo $row["id_menu"] ?>"><i class="fa fa-search"></i> Detail menu</a></td>
            <td><a class="btn btn-primary" href="priradenie_jedal.php?menu=<?php echo $row["id_menu"] ?>"><i class="fa fa-arrow-right"></i> Priradit jedla</a></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <?php
        }
    ?>
</div>
<?php
mysqli_close($conn);
include "widgets/footer.php";
?>

