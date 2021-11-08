<?php
$conn ="";
include "config.php";
$nazovSuboru="Priradenie surovin";
include "widgets/header.php";
$bc_nazov="Priradenie surovin";
include "widgets/navbar.php";
?>
<div class="jumbotron-fluid">

<?php


if ($_GET["id"] != "") {

    $id_receptu=$_GET["id"];

    $queryNazov="SELECT nazov,postup FROM restauracia.recept WHERE id=".$_GET["id"];
    $resultNazov = mysqli_query($conn, $queryNazov);
    while ($rowNazov = mysqli_fetch_assoc($resultNazov))
        {
            echo "<h3>Priradenie surovin k receptu ".$rowNazov["nazov"]."</h3>"
            ?>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#pridaneSuroviny" aria-expanded="false" aria-controls="multiCollapseExample2">Tabulka pridanych surovin</button>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#KategorieSurovin" aria-expanded="false" aria-controls="multiCollapseExample2">Kategorie surovin</button>
            <br><br>
    <?php



    ?>
    <div class="collapse multi-collapse" id="pridaneSuroviny">
        <h4>Suroviny v tomto recepte</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nazov suroviny</th>
                    <th>Mnozstvo</th>
                    <th>Akcia</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $querySur="SELECT nazov_suroviny ,mnozstvo, enum_jednotka.skratka FROM restauracia.suroviny_k_receptu 
        INNER JOIN restauracia.tbl_suroviny ON suroviny_k_receptu.id_sur = tbl_suroviny.id_suroviny
        INNER JOIN restauracia.enum_jednotka ON suroviny_k_receptu.jednotka = enum_jednotka.id_jednotky
        WHERE id_rec =".$id_receptu;
            $resultSur= mysqli_query($conn, $querySur);
            $pocetRiadkov = mysqli_num_rows($resultSur);
            if (!$resultSur) {
                echo "Error: Neda sa vykonat prikaz SQL: " . $querySur . ".<br>" . PHP_EOL;
                exit;
            }
            if ($pocetRiadkov == 0) {
                echo "Nemam co zobrazit";
            }
            while ($rowSur = mysqli_fetch_assoc($resultSur))
            {
            ?>

            <tr>
                <td><?php echo $rowSur["nazov_suroviny"]?></td>
                <td><?php echo $rowSur["mnozstvo"], " ", $rowSur["skratka"]?></td>
                <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> Odstranit</a></td>

            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>


    <div class="collapse multi-collapse" id="KategorieSurovin">
    <form method="post" class="form-group">
        <div class="row"></div>
        <div class="row">
            <div class="col">
                <?php
                    $queryKat="SELECT id_kategorie, nazov_kategorie FROM restauracia.enum_kategoria_suroviny ORDER BY nazov_kategorie ASC";
                    $resultKat= mysqli_query($conn,$queryKat);
                ?>
                    <select class="form-control form-control-lg" name="kategoria">
                        <?php while ($rowKat = mysqli_fetch_assoc($resultKat))
                        {
                            ?>
                        <option value="<?php echo $rowKat["id_kategorie"]?>"><?php echo $rowKat["nazov_kategorie"]?></option>
                            <?php
                        }
                        ?>
                    </select>

            </div>
            <div class="col">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Zobraz suroviny">
                <input type="hidden" name="zobraz" value="yes">
            </div>
        </div>
    </form>
    </div>
        <?php
            $query = "SELECT id_suroviny,nazov_suroviny,kategoria_suroviny FROM restauracia.tbl_suroviny WHERE kategoria_suroviny =" .$_POST["kategoria"] ;  //uspodiadaj ASC od najmensieho po najvacsi
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


            <form class="form-group" method="post">
                <label>Suroviny</label>
                <select name="surovina" class="form-control">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row["id_suroviny"]?>"><?php echo $row["nazov_suroviny"]?></option>
                        <?php
                    }
                    ?>
                </select>

                <div class="row">
                    <div class="col">
                        <label for="mnozstvo">Mnozstvi</label>
                        <input class="form-control" type="number" id="mnozstvo" name="mnozstvo">
                    </div>
                    <div class="col">
                        <label>Jednotka</label>
                        <?php
                            $queryJednotka="SELECT id_jednotky, jednotka FROM restauracia.enum_jednotka ORDER BY id_jednotky ASC";
                            $resultJednotka = mysqli_query($conn, $queryJednotka); // mysqli_query - vykona prikaz
                            $pocetRiadkov = mysqli_num_rows($resultJednotka);
                        if (!$resultJednotka) {
                            echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
                            exit;
                        }
                        if ($pocetRiadkov == 0) {
                            echo "Nemam co zobrazit";
                        }
                        ?>
                        <select class="form-control" name="jednotka">
                            <?php while ($row = mysqli_fetch_assoc($resultJednotka)) { ?>
                            <option value="<?php echo $row["id_jednotky"]; ?>"><?php echo $row["jednotka"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-primary btn-lg" value="Ulozit">
                        <input type="hidden" name="save" value="yes">
                    </div>
                    <div class="col">
                        <input type="reset" class="btn btn-secondary btn-lg" value="Reset">
                    </div>
                </div>
            </form>
</div>
<?php
}
}
    if ($_POST["save"] == "yes") {

        //jednotky

        $id = 0;
        echo $id_receptu;
        $id_suroviny= $_POST["surovina"];
        $mnozstvo = $_POST["mnozstvo"];
        $jednotka = $_POST["jednotka"];


        $query = "INSERT INTO restauracia.suroviny_k_receptu (id_rec_sur, id_sur, id_rec, mnozstvo, jednotka) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, 'iiisi', $id,$id_suroviny, $id_receptu, $mnozstvo, $jednotka);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

mysqli_close($conn);
include "widgets/footer.php";
?>