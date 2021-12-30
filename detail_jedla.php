<?php
$stranka = "recepty";
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
        <div class="col-2">
            <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button"
                            aria-expanded="false" aria-controls="multiCollapseExample1"><?php echo $lang["calc"];?></a>
        </div>
        <div class="col-2">
            <button onclick="window.print()" class="btn btn-primary"><?php echo $lang["print"];?></button>
        </div>
        <div class='col-2'>
            <a href='odstranenie_receptu.php?id=<?php echo $_GET["id"];?>&zmazat=ano' class='btn btn-danger' onclick="return confirm('<?php echo $lang['delRecReq'];?>');"><?php echo $lang["del"];?></a>
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
                                <input type="submit" class="btn btn-primary btn-lg" value="<?php echo $lang["calc"];?>" name="prepocitanie">
                                <input type="hidden" name="prepocitat" value="yes">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <h4><?php echo $lang["calcH"];?>
        <?php
        if(isset($_POST["prepocitanie"]) && $_POST["prepocitat"]=="yes")
        {
            echo $_POST["pocetHostu"];
        }

        else
        {
            echo "1";
        }

        ?> <?php echo $lang["portions"];?></h4>
        <?php
        $querySur="SELECT nazov_suroviny ,mnozstvo, enum_jednotka.skratka, id_rec_sur, id_rec FROM tbl_suroviny_k_receptu INNER JOIN tbl_suroviny ON tbl_suroviny_k_receptu.id_sur = tbl_suroviny.id_suroviny INNER JOIN enum_jednotka ON tbl_suroviny.jednotka = enum_jednotka.id_jednotky WHERE id_rec =".$_GET["id"];
        $resultSur= mysqli_query($conn,$querySur);
        $pocetRiadkov = mysqli_num_rows($resultSur);

        if (!$resultSur) {
            echo "Error: Neda sa vykonat prikaz SQL: " . $querySur . ".<br>" . PHP_EOL;
            exit;
        }
        if ($pocetRiadkov == 0) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Pre tento recept sa nenasli ziadne suroviny.</strong>
                </div>";?>
                <br>
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#message<?php echo $_GET['id'];?>">Priradit prvu surovinu</button>

            <!-- Modal pre priradenie surovin -->
            <div class="modal fade bd-example-modal-lg" id="message<?php echo $_GET['id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Priradenie surovin k receptu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <!-- Formular pre pridanie suroviny -->
                            <form class="form-group" method="post" action="spracovanie/ulozenie_suroviny.php">
                                <input type="hidden" name="id_rec" value="<?php echo $_GET["id"];?>">

                                <label for="surovina"><?php echo $lang["recSurPl"];?></label>
                                <select id="surovina" name="surovina" class="form-control form-control-lg">
                                <?php
                                        $query="SELECT id_suroviny, nazov_suroviny FROM tbl_suroviny ORDER BY nazov_suroviny ASC";
                                        $result = mysqli_query($conn,$query);
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value="<?php echo $row["id_suroviny"]?>"><?php echo $row["nazov_suroviny"]?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                        <label for="mnozstvo"><?php echo $lang["amount"];?></label>
                                        <input class="form-control form-control-lg" type="text" id="mnozstvo" name="mnozstvo" placeholder="cislo zadavajte s bodkov">
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo $lang["saveSur"];?>" name="priradit">
                                        <input type="hidden" name="save" value="yes">
                                    </div>
                                    <div class="col">
                                        <input type="reset" class="btn btn-secondary btn-lg btn-block" value="<?php echo $lang["reset"];?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        else
        {
        ?>
        <table class='table tbl-stripped'>
            <thead class='table thead-light'>
            <tr>
                <th><?php echo $lang["recSur"];?></th>
                <th><?php echo $lang["amount"];?></th>
                <th>Akcia</th>
            </tr>
            </thead>
            <tbody>
        <?php
        while ($rowSuroviny = mysqli_fetch_assoc($resultSur)) {
            ?>
            <tr>
                <td><?php echo $rowSuroviny["nazov_suroviny"]; ?></td>

                    <?php
                    if (isset($_POST["prepocitanie"]) && $_POST["prepocitat"]=="yes")
                    {

                            echo "<td>" . $_POST["pocetHostu"]*$rowSuroviny["mnozstvo"]." ".$rowSuroviny["skratka"]."</td>";
                    }

                    else
                    {
                        echo "<td>".$jeden_Host*$rowSuroviny["mnozstvo"]." ".$rowSuroviny["skratka"]."</td>";
                    }
                ?>
                <td><a href="odstranenie_suroviny.php?id=<?php echo $rowSuroviny["id_rec_sur"]?>&zmazat=ano" class="btn btn-danger">Odstranit</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#message<?php echo $_GET['id'];?>">Priradit surovinu</button>

            <!-- Modal pre priradenie surovin -->
            <div class="modal fade bd-example-modal-lg" id="message<?php echo $_GET['id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Priradenie surovin k receptu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formular pre pridanie suroviny -->
                            <form class="form-group" method="post" action="spracovanie/ulozenie_suroviny.php">
                                <input type="hidden" name="id_rec" value="<?php echo $_GET["id"];?>">

                                <label for="surovina"><?php echo $lang["recSurPl"];?></label>
                                <select id="surovina" name="surovina" class="form-control form-control-lg">
                                    <?php
                                    $query="SELECT id_suroviny, nazov_suroviny FROM tbl_suroviny ORDER BY nazov_suroviny ASC";
                                    $result = mysqli_query($conn,$query);
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row["id_suroviny"]?>"><?php echo $row["nazov_suroviny"]?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <label for="mnozstvo"><?php echo $lang["amount"];?></label>
                                <input class="form-control form-control-lg" type="text" id="mnozstvo" name="mnozstvo" placeholder="cislo zadavajte s bodkov">
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo $lang["saveSur"];?>" name="priradit">
                                        <input type="hidden" name="save" value="yes">
                                    </div>
                                    <div class="col">
                                        <input type="reset" class="btn btn-secondary btn-lg btn-block" value="<?php echo $lang["reset"];?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <?php } ?>
<br>
            <h4><?php echo $lang["postup"];?></h4>
            <?php

            $queryNazov= "SELECT postup_receptu FROM tbl_recept WHERE id_receptu=" .$_GET["id"];
            $resultNazov = mysqli_query($conn, $queryNazov);
            while ($rowNazov = mysqli_fetch_assoc($resultNazov))
            { ?>
                <p style="text-align: justify"> <?php echo $rowNazov["postup_receptu"]; ?> </p>
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
