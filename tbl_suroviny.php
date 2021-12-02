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
    <div class="col"><a href="vkladanie_surovin.php" class="btn btn-primary btn-lg"><?php echo $lang["novaSur"]?></a> </div>
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
        $querySur = "SELECT id_suroviny,nazov_suroviny,Mnozstvo,skratka FROM tbl_suroviny INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky WHERE kategoria_suroviny =". $_POST["kategoria"];
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
                <td><?php echo $rowSur["Mnozstvo"]." ".$rowSur["skratka"];?></td>
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
                                <?php echo $lang["mnozstvo"].": ".$rowSur["Mnozstvo"],$rowSur["skratka"];?>
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
    $querySur = "SELECT id_suroviny,nazov_suroviny,Mnozstvo,skratka FROM tbl_suroviny INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky";
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
                        <td><?php echo $rowSur["nazov_suroviny"];?></td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message<?php echo $rowSur['id_suroviny'];?>">Detail</button></td>
                        <td><?php echo $rowSur["Mnozstvo"]." ".$rowSur["skratka"];?></td>
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
                                <?php echo $lang["mnozstvo"].": ".$rowSur["Mnozstvo"],$rowSur["skratka"];?>
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
?>
</div>
<?php
    include_once "widgets/footer.php";
    mysqli_close($conn);
?>