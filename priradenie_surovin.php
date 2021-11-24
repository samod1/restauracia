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
$id_receptu=$_GET["id"];

if ($id_receptu != "") {

    $queryNazov="SELECT nazov FROM recept WHERE id=".$_GET["id"];
    $resultNazov = mysqli_query($conn, $queryNazov);
    while ($rowNazov = mysqli_fetch_assoc($resultNazov))
        {
            echo "<h3>Priradenie surovin k receptu ".$rowNazov["nazov"]."</h3>";
            }?>
        <div class="row">
            <div class="col">
                <button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="collapse" data-target="#pridaneSuroviny" aria-expanded="false" aria-controls="multiCollapseExample2">Tabulka pridanych surovin</button>
            </div>
            <div class="col">
                <button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="collapse" data-target="#KategorieSurovin" aria-expanded="false" aria-controls="multiCollapseExample2">Kategorie surovin</button>
                <br>
            </div>
        </div>


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
            $querySur="SELECT nazov_suroviny ,kategoria_suroviny,mnozstvo, enum_jednotka.skratka FROM suroviny_k_receptu 
        INNER JOIN tbl_suroviny ON suroviny_k_receptu.id_sur = tbl_suroviny.id_suroviny
        INNER JOIN enum_jednotka ON suroviny_k_receptu.jednotka = enum_jednotka.id_jednotky
        WHERE id_rec =".$id_receptu." ORDER BY kategoria_suroviny ASC " ;
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
        <div class="row">
            <div class="col">
                <?php
                    $queryKat="SELECT id_kategorie, nazov_kategorie FROM enum_kategoria_suroviny ORDER BY nazov_kategorie ASC";
                    $resultKat= mysqli_query($conn,$queryKat);
                ?>
                    <select class="form-control form-control-lg" name="kategoria">
                        <?php while ($rowKat = mysqli_fetch_assoc($resultKat))
                        {
                            ?>
                        <option value="<?php echo $rowKat["id_kategorie"];?>"><?php echo $rowKat["nazov_kategorie"];?></option>
                            <?php
                        }
                        ?>
                    </select>

            </div>
            <div class="col">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Zobraz suroviny">
            </div>
        </div>
    </form>
    </div>
        <?php
            $query = "SELECT id_suroviny,nazov_suroviny,kategoria_suroviny FROM tbl_suroviny WHERE kategoria_suroviny =" .$_POST["kategoria"] ;  //uspodiadaj ASC od najmensieho po najvacsi
            $result = mysqli_query($conn, $query); // mysqli_query - vykona prikaz
            /*$pocetRiadkov = mysqli_num_rows($result);
            if (!$result) {
                echo "Error: Neda sa vykonat prikaz SQL: " . $query . ".<br>" . PHP_EOL;
                exit;
            }
            if ($pocetRiadkov == 0) {
                echo "Nemam co zobrazit";
            }*/
        ?>


            <form class="form-group" method="post" action="ulozenie_suroviny.php">
                <input type="hidden" name="id_rec" value="<?php echo $id_receptu;?>">

                <label for="surovina">Suroviny</label>
                <select id="surovina" name="surovina" class="form-control form-control-lg">
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
                        <input class="form-control form-control-lg" type="text" id="mnozstvo" name="mnozstvo" placeholder="cislo zadavajte s bodkov">
                    </div>
                    <div class="col">
                        <label>Jednotka</label>
                        <?php
                            $queryJednotka="SELECT id_jednotky, jednotka FROM enum_jednotka ORDER BY id_jednotky ASC";
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
                        <select class="form-control form-control-lg" name="jednotka">
                            <?php while ($row = mysqli_fetch_assoc($resultJednotka)) { ?>
                            <option value="<?php echo $row["id_jednotky"]; ?>"><?php echo $row["jednotka"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Ulozit">
                        <input type="hidden" name="save" value="yes">
                    </div>
                    <div class="col">
                        <input type="reset" class="btn btn-secondary btn-lg btn-block" value="Reset">
                    </div>
                </div>
            </form>
</div>
<?php

}

mysqli_close($conn);
include "widgets/footer.php";
?>