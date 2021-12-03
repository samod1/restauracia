<?php
include "config.php";
$conn ="";
include "configDb.php";
$nazovSuboru="Detail jedla";
include "widgets/header.php";
$bc_nazov="Detail jedla";
include "widgets/navbar.php";
$jeden_Host="1";
?>

<?php
if ($_GET["id"] != "") {
    $queryNazov= "SELECT nazov_receptu FROM tbl_recept WHERE id_receptu=" .$_GET["id"];
    $resultNazov = mysqli_query($conn, $queryNazov);
    while ($rowNazov = mysqli_fetch_assoc($resultNazov))
    { ?>

<div class='container-fluid'>
    <div class='row'>
        <div class='col-4'>
            <h3><?php echo $lang["detailRec"]." ";?> <?php echo $rowNazov["nazov_receptu"];} ?> </h3>
        </div>
        <div class='col-2'>
            <a href='editacia_receptu.php?id=<?php echo $_GET["id"] ?>' class='btn btn-primary'><?php echo $lang["edit"];?></a>
        </div>
        <div class='col-2'>
            <a href='odstranenie_receptu.php?<?php echo $_GET["id"];?>&zmazat=ano' class='btn btn-danger' onclick="return confirm('<?php echo $lang['delRecReq'];?>');"><?php echo $lang["del"];?></a>
        </div>
        <div class="col-2">
            <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button"
                            aria-expanded="false" aria-controls="multiCollapseExample1"><?php echo $lang["calc"];?></a>
        </div>
        <div class="col-2">
            <button onclick="window.print()" class="btn btn-primary"><?php echo $lang["print"];?></button>
        </div>
    </div>

            <br>
            <div class="row">
                <br>
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body">
                            <form method="post" class="form-group">
                                <label><?php echo $lang["guest"];?></label>
                                <input class="form-control" type="number" name="pocetHostu" value="1">
                                <br>
                                <input type="submit" class="btn btn-primary btn-lg" value="<?php echo $lang["calc"];?>">
                                <input type="hidden" name="prepocitat" value="yes">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <h4><?php echo $lang["calcH"];?>
        <?php
        if($_POST["prepocitat"]=="yes")
        {
            echo $_POST["pocetHostu"];
        }

        else
        {
            echo "1";
        }

        ?> <?php echo $lang["portions"];?></h4>
    <table class='table tbl-stripped'>
        <thead class='table thead-light'>
        <tr>
            <th><?php echo $lang["recSur"];?></th>
            <th><?php echo $lang["amount"];?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $querySur="SELECT nazov_suroviny ,mnozstvo, enum_jednotka.skratka FROM tbl_suroviny_k_receptu INNER JOIN tbl_suroviny ON tbl_suroviny_k_receptu.id_sur = tbl_suroviny.id_suroviny INNER JOIN enum_jednotka ON tbl_suroviny_k_receptu.jednotka = enum_jednotka.id_jednotky WHERE id_rec =".$_GET["id"];
        $resultSur= mysqli_query($conn,$querySur);
        $pocetRiadkov = mysqli_num_rows($resultSur);

        if (!$resultSur) {
            echo "Error: Neda sa vykonat prikaz SQL: " . $querySur . ".<br>" . PHP_EOL;
            exit;
        }
        if ($pocetRiadkov == 0) {
            echo "Nemam co zobrazit";
        }
        while ($rowSuroviny = mysqli_fetch_assoc($resultSur)) {
            ?>
            <tr>
                <td><?php echo $rowSuroviny["nazov_suroviny"]; ?></td>

                    <?php
                    if ($_POST["prepocitat"]=="yes")
                    {

                            echo "<td>" . $_POST["pocetHostu"]*$rowSuroviny["mnozstvo"]." ".$rowSuroviny["skratka"]."</td>";
                    }

                    else
                    {
                        echo "<td>".$jeden_Host*$rowSuroviny["mnozstvo"]." ".$rowSuroviny["skratka"]."</td>";
                    }
                ?>


            </tr>
        <?php } ?>
        </tbody>
    </table>

            <h4><?php echo $lang["postup"];?></h4>
            <?php

            $queryNazov= "SELECT postup_receptu FROM tbl_recept WHERE id_receptu=" .$_GET["id"];
            $resultNazov = mysqli_query($conn, $queryNazov);
            while ($rowNazov = mysqli_fetch_assoc($resultNazov))
            { ?>
                <p> <?php echo $rowNazov["postup_receptu"]; ?> </p>
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
