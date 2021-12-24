<?php
include "config.php";

$nazovSuboru= $lang["suroviny"];
include "widgets/header.php";

$bc_nazov= $lang["suroviny"];
include "widgets/navbar.php";

$conn = "";
include "configDb.php";
?>
<div class="container-fluid">
    <h3><?php echo $lang["suroviny"];?></h3>
<div class="row">
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
            Vytvorit surovinu
        </button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vytvorit novu surovinu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
<form method="post" autocomplete="on">
    <label for="nazovsuroviny">Nazev suroviny</label>
    <input class="form-control form-control-lg" required autofocus id="nazovsuroviny" name="nazovSuroviny" placeholder="Sem napiste nazov suroviny" type="text">
    <br>

    <label for="nazovsuroviny">kategoria suroviny</label>
    <?php
        $query = "SELECT id_kategorie, nazov_kategorie FROM enum_kategoria_suroviny order by id_kategorie ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
        $result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
        $pocetRiadkov = mysqli_num_rows($result);
        if (!$result) {
            echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
            exit;
        }
        if ($pocetRiadkov == 0) {

            echo "Nemam co zobrazit";
        }
        //TODO jazykove mutacie
    ?>

    <select name="katSuroviny" class="form-control form-control-lg" required autofocus>
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <option value="<?php echo $row["id_kategorie"]?>"><?php echo $row["nazov_kategorie"]?></option>
    <?php
            }
    ?>
    </select>
    <label>Mnozstvo</label>
    <input class="form-control form-control-lg" type="text" name="mnozstvo" placeholder="125,3">
    <br>
    <?php
        $queryJed="SELECT id_jednotky, jednotka FROM enum_jednotka ORDER BY skratka ASC";
        $resultJed=mysqli_query($conn,$queryJed);
    ?>
    <label>Merna jednotka</label>
    <select name="jednotka" class="form-control form-control-lg">
        <?php
            while ($rowJed=mysqli_fetch_assoc($resultJed))
        {?>
        <option value="<?php echo $rowJed["id_jednotky"];?>"><?php echo $rowJed["jednotka"];?></option>
        <?php }?>
    </select>
    <br>
    <!--<input required autofocus id="nazovsuroviny" name="katSuroviny">-->

    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Ulozit surovinu">
    <input class="btn btn-secondary btn-lg btn-block" type="reset" value="Zmazat">
    <input type="hidden" name="send" value="yes">

</form>
</div>
<?php
//vkladanie udajov do DB
if ($_POST["send"] == "yes") {

    $id = 0;
    $query = "INSERT INTO tbl_suroviny (id_suroviny,nazov_suroviny,kategoria_suroviny,mnozstvo_sklad,jednotka) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'isiis', $id, $_POST["nazovSuroviny"],$_POST["katSuroviny"],$_POST["mnozstvo"],$_POST["jednotka"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavriet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <form method="post" class="form-group">
        <div class="row">
            <label><?php echo $lang["kat_suroviny"];?></label>
            <div class="col-8">
                <select name="kategoria" class="form-control form-control-lg">
                    <option value="all"><?php echo $lang["all"]?></option>
                    <?php
                    $query="SELECT id_kategorie,nazov_kategorie FROM enum_kategoria_suroviny ORDER BY nazov_kategorie ASC";
                    $result = mysqli_query($conn,$query);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        ?>
                        <option value="<?php echo $row["id_kategorie"];?>"><?php echo $row["nazov_kategorie"];?></option>
                        <?php
                    }
                    ?>
                </select>
                <!-- TODO upravit databazu -->
            </div>
            <div class="col-2">
                <input type="submit" value="<?php echo $lang["hladaj"];?>" class="btn btn-primary btn-lg">
            </div>
            <div class="col-2">
                <input type="reset" class="btn btn-secondary btn-lg">
            </div>
        </div>
    </form>



<?php
if ($_POST["kategoria"] != "" && $_POST["kategoria"]!="all")
{
    $queryKat = "SELECT nazov_suroviny FROM tbl_suroviny";
    $resultKat = mysqli_query($conn,$queryKat);
    $pocetRiadkovSur = mysqli_num_rows($resultKat);

    if ($pocetRiadkovSur == 0)
    {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
            <strong>".$lang["noRecords"]."</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    else
    {
        $querySur = "SELECT id_suroviny,nazov_suroviny,mnozstvo_sklad,skratka FROM tbl_suroviny INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky WHERE kategoria_suroviny =" . $_POST["kategoria"];
        $resultSur = mysqli_query($conn,$querySur);
        ?>
        <table class="table table-stripped">
            <thead>
                <th colspan="2"><?php echo $lang["nazov"]; ?></th>
                <th><?php echo $lang["mnozstvo"]; ?></th>
            </thead>

            <tbody>
            <?php
            while ($rowSur = mysqli_fetch_assoc($resultSur))
            { ?>
                    <tr>
                <td><a data-toggle="modal" data-target="#message<?php echo $rowSur['id_suroviny'];?>"><?php echo $rowSur["nazov_suroviny"];?></a></td>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message<?php echo $rowSur['id_suroviny'];?>">Detail</button></td>
                <td><?php echo $rowSur["mnozstvo_sklad"]." ".$rowSur["skratka"];?></td>
                    </tr>
                <!-- Modal -->
                <div class="modal fade" id="message<?php echo $rowSur['id_suroviny'];?>" role="dialog" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $lang["detailSur"].": ".$rowSur["nazov_suroviny"];?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php echo $lang["mnozstvo"].": ".$rowSur["mnozstvo_sklad"],$rowSur["skratka"];?>
                                <h6><?php echo $lang["surRec"]?></h6>
                                <div>
                                    <?php
                                        $queryRec= "SELECT nazov_receptu, id_rec FROM tbl_suroviny_k_receptu INNER JOIN tbl_recept r ON tbl_suroviny_k_receptu.id_rec = r.id_receptu WHERE id_sur=" .$rowSur["id_suroviny"];
                                        $resultRec=mysqli_query($conn,$queryRec);
                                        $pocetRiadkovRec = mysqli_num_rows($resultRec);
                                        if ($pocetRiadkovRec == 0)
                                        {
                                            echo "<h6>".$lang["noRec"]."</h6>";
                                        }

                                        else
                                        {
                                                while ($rowRec = mysqli_fetch_assoc($resultRec))
                                                {
                                                    echo $rowRec["nazov_receptu"];
                                                }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-lg btn-block" data-dismiss="modal"><?php echo $lang["close"]?></button>
                            </div>
                        </div>
                    </div>
            </div>
            <?php } ?>
            </tbody>
        </table>
            <?php
    }
}

else
{
    $querySur = "SELECT id_suroviny,nazov_suroviny,mnozstvo_sklad,skratka FROM tbl_suroviny INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky";
    $resultSur = mysqli_query($conn,$querySur);
    ?>
    <table class="table table-stripped">
        <thead>
            <th colspan="3"><?php echo $lang["nazov"]; ?></th>
            <th><?php echo $lang["mnozstvo"]; ?></th>
            <th colspan="2">Akcia</th>
        </thead>


        <tbody>
            <?php
            while ($rowSur = mysqli_fetch_assoc($resultSur))
            { ?>
                    <tr>
                        <td><?php echo $rowSur["nazov_suroviny"];?></td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message<?php echo $rowSur['id_suroviny'];?>">Detail</button></td>
                        <td><a class="btn btn-secondary" href="zmena_hmotnosti.php?id=<?php echo $rowSur["id_suroviny"];?>&zmena=yes">Zmenit mnozstvo</a></td>
                        <td><?php
                            if ($rowSur["mnozstvo_sklad"] <= 0)
                            {
                                echo "<p class='font-weight-bold text-danger'>". $rowSur["mnozstvo_sklad"]." ".$rowSur["skratka"]."</p>";?>

                            <?php
                            }
                            else
                            {
                                echo $rowSur["mnozstvo_sklad"]." ".$rowSur["skratka"];
                            }
                            ?></td>

                        <td><a href="editacia_suroviny.php?id=<?php echo $rowSur["id_suroviny"];?>&edituj=ano" class="btn btn-secondary">Edituj</a></td>
                        <td><a href="zmazat.php?id=<?php echo $rowSur["id_suroviny"];?>&del=surovina" class="btn btn-danger">Zmazat</a></td>

                    </tr>

                <!-- Modal suroviny obsiahnute v receptoch -->
                <div class="modal fade" id="message<?php echo $rowSur['id_suroviny'];?>" role="dialog" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $lang["detailSur"].": ".$rowSur["nazov_suroviny"];?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                echo $lang["mnozstvo"].": ".$rowSur["mnozstvo_sklad"],$rowSur["skratka"];?>
                                <h6><?php echo $lang["surRec"]?></h6>
                                <div>
                                    <?php
                                    $queryRec= "SELECT nazov_receptu, id_rec FROM tbl_suroviny_k_receptu INNER JOIN tbl_recept r ON tbl_suroviny_k_receptu.id_rec = r.id_receptu WHERE id_sur=" .$rowSur["id_suroviny"];
                                    $resultRec=mysqli_query($conn,$queryRec);
                                    $pocetRiadkovRec = mysqli_num_rows($resultRec);
                                    if ($pocetRiadkovRec == 0)
                                    {
                                        echo "<h6>".$lang["noRec"]."</h6>";
                                    }
                                    else
                                    {
                                        while ($rowRec = mysqli_fetch_assoc($resultRec))
                                        { ?>
                                            <a href="detail_jedla.php?id=<?php echo $rowRec["id_rec"];?>"><?php echo $rowRec["nazov_receptu"]?></a>
                                      <?php  }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-lg btn-block" data-dismiss="modal"><?php echo $lang["close"]?></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </tbody>
    </table>

<?php
}
?>
</div>
<?php
    include_once "widgets/footer.php";
    mysqli_close($conn);
?>