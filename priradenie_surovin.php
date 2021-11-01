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
    $queryNazov="SELECT nazov,postup FROM recept WHERE id=".$_GET["id"];
    $resultNazov = mysqli_query($conn, $queryNazov);
    while ($rowNazov = mysqli_fetch_assoc($resultNazov))
        { echo "<h3>Priradenie surovin k receptu ".$rowNazov["nazov"]."</h3>"
            ?>
    <form method="post" class="form-group">
        <div class="row"></div>
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
    </form>
            <form method="get" class="form-group">
                <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="surovina" id="<?php echo $row["nazov_suroviny"]?>" value="<?php echo $row["id_suroviny"] ?>">
                    <label class="form-check-label" for="<?php echo $row["nazov_suroviny"]?>"><?php echo $row["nazov_suroviny"]?></label>
                </div>
                <?php
            }
                ?>
                
                <div class="row">
                    <div class="col">
                        <label for="mnozstvo">Mnozstvi</label>
                        <input class="form-control" type="number" id="mnozstvo">
                    </div>
                    <div class="col">
                        <label>Jednotka</label>
                        <select class="form-control">
                            <option>Kilogram</option>
                            <option>Liter</option>
                        </select>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary btn-lg btn-block">
            </form>
</div>
<?php




        }
}
?>