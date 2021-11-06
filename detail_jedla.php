<?php
$conn ="";
include "config.php";
$nazovSuboru="Detail jedla";
include "widgets/header.php";
$bc_nazov="Detail jedla";
include "widgets/navbar.php";
?>

<?php
if ($_GET["id"] != "") {
    $queryNazov="SELECT nazov FROM restauracia.recept WHERE id=".$_GET["id"];
    $resultNazov = mysqli_query($conn, $queryNazov);
    while ($rowNazov = mysqli_fetch_assoc($resultNazov))
    { ?>

<div class='container-fluid'>
    <div class='row'>
        <div class='col-8'>
            <h3>Detail jedla: <?php echo $rowNazov["nazov"];} ?> </h3>
        </div>
        <div class='col'>
            <a href='editacia_receptu.php?id=<?php echo $_GET["id"] ?>' class='btn btn-primary'><i class='fa fa-pencil'></i> Edituj</a>
        </div>
        <div class='col'>
            <a href='#' class='btn btn-danger 'onclick='return confirm('Naozaj chces vykonat tieto zmeny ?');'><i class='fa fa-trash'></i> Zmazat</a>
        </div>
     </div>

    <h4>Suroviny prepocet na jednu osobu</h4>
    <table class='table tbl-stripped'>
        <thead class='table thead-light'>
        <tr>
            <th>Surovina</th>
            <th>Mnozstvo</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $querySuroviny="SELECT nazov_suroviny ,mnozstvo, enum_jednotka.skratka FROM restauracia.suroviny_k_receptu 
        INNER JOIN restauracia.tbl_suroviny ON suroviny_k_receptu.id_sur = tbl_suroviny.id_suroviny
        INNER JOIN restauracia.enum_jednotka ON suroviny_k_receptu.jednotka = enum_jednotka.id_jednotky
        WHERE id_rec =".$_GET["id"];
        $resultSuroviny= mysqli_query($conn,$querySuroviny);
        $pocetRiadkov = mysqli_num_rows($resultSuroviny);

        if (!$resultSuroviny) {
            echo "Error: Neda sa vykonat prikaz SQL: " . $querySuroviny . ".<br>" . PHP_EOL;
            exit;
        }
        if ($pocetRiadkov == 0) {
            echo "Nemam co zobrazit";
        }
        while ($rowSuroviny = mysqli_fetch_assoc($resultSuroviny)) {
            ?>
            <tr>
                <td><?php echo $rowSuroviny["nazov_suroviny"]; ?></td>
                <td><?php echo $rowSuroviny["mnozstvo"]." ".$rowSuroviny["skratka"]; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

            <h4>Postup</h4>
            <?php

            $queryNazov="SELECT postup FROM restauracia.recept WHERE id=".$_GET["id"];
            $resultNazov = mysqli_query($conn, $queryNazov);
            while ($rowNazov = mysqli_fetch_assoc($resultNazov))
            { ?>
                <p> <?php echo $rowNazov["postup"]; ?> </p>
    <?php } ?>
            </div>



<?php
    }
?>

</div>
<?php
mysqli_close($conn);
include "widgets/footer.php";
?>
