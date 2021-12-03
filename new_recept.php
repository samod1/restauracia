<?php
include "config.php";
$conn="";
include "configDb.php";

$nazovSuboru="Novy recept";
include "widgets/header.php";

$bc_nazov = "Novy recept";
include "widgets/navbar.php";
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h2><?php echo $lang["newRec"];?></h2>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><?php echo $lang["newKat"];?></button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang["newKat"];?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="form-control form-control-lg">
                                <label><?php echo $lang["nazovKat"];?></label>
                                <br>
                                <input class="form-group" type="text" name="nazov_kategorie">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo $lang["newKat"];?>">
                                <input type="hidden" name="vlozit" value="yes">

                                <?php
                                $idKat=0;
                                $queryKat= "INSERT INTO enum_typ_receptu (id_typu_receptu,nazov_typu_receptu) VALUES (?,?)";
                                $stmtKat = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmtKat, $queryKat);
                                mysqli_stmt_bind_param($stmtKat, 'is', $id, $_POST["nazov_kategorie"]);
                                mysqli_stmt_execute($stmtKat);
                                mysqli_stmt_close($stmtKat);
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<form method="post" class="form-group">
    <label for="nazovReceptu"><?php echo $lang["nazovRec"];?></label>
    <input class="form-control form-control-lg" required autofocus type="text" name="nazovReceptu">
    <br>
    <label for="typ_kuchyna"><?php echo $lang["kategorieRec"];?></label>

    <?php
    $query = "SELECT id_typu_receptu, nazov_typu_receptu FROM enum_typ_receptu ORDER BY id_typu_receptu ASC ";  //uspodiadaj ASC od najmensieho po najvacsi
    $result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
    $pocetRiadkov = mysqli_num_rows($result);
    if (!$result) {
        echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
        exit;
    }
    if ($pocetRiadkov == 0) {

        echo "Nemam co zobrazit";
    }
    ?>

    <select name="typKuchyne" class="form-control form-control-lg" required autofocus>
        <?php

        while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <option value="<?php echo $row["id_typu_receptu"]?>"><?php echo $row["nazov_typu_receptu"]?></option>
        <?php
        }
        ?>
    </select>
    <br>
    <label><?php echo $lang["postup"];?></label>
    <textarea class="form-control" rows="10" name="postupReceptu"></textarea>
    <label for="alergeny"><?php echo $lang["alergens"];?></label>
    <input class="form-control form-control-lg" required autofocus type="text" name="alergeny">
    <label><?php echo $lang["price"];?></label>
    <input class="form-control form-control-lg" type="text" name="cena" placeholder="<?php echo $lang["cenaJedla"];?>">
    <br>
    <input class="btn btn-primary btn-lg btn-block"type="submit" value="<?php echo $lang["saveRec"];?>">
    <input type="hidden" name="send" value="yes">
</form>
</div>
<?php
//vkladanie udajov do DB
if ($_POST["send"] == "yes") {

    $id = 0;
    $query = "INSERT INTO tbl_recept (id_receptu,nazov_receptu,postup_receptu,typ_receptu,alergeny,cena_jedla) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'ississ', $id, $_POST["nazovReceptu"],$_POST["postupReceptu"],$_POST["typKuchyne"],$_POST["alergeny"],$_POST["cena"] );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: zoznam_receptov.php");
    exit;
}



mysqli_close($conn);
include "widgets/footer.php";
?>