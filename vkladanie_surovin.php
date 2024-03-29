<?php
include "config.php";
    $nazovSuboru="Vkladanie surovin";
    include "widgets/header.php";
    $bc_nazov = "Vkladanie surovin";
    include "widgets/navbar.php";
    $conn="";
    include "configDb.php";
?>
<div class="jumbotron-fluid">
    <div class="row">
        <div class="col-8">
            <h2>Vkladanie surovin</h2>
        </div>

    <div class="col-6">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Vytvorit novu kategoriu</button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vytvorenie novej kategorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-control form-control-lg">
                        <label>Nazev kategorie</label>
                        <br>
                        <input class="form-group" type="text" name="nazov_kategorie">
                        <input type="submit" class="btn btn-primary btn-lg btn-block">
                        <input type="hidden" name="vlozit" value="yes">
                        <?php
                            $idKat=0;
                            $queryKat="INSERT INTO enum_kategoria_suroviny (id_kategorie,nazov_kategorie) VALUES (?,?)";
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
}

//include "tbl_suroviny.php";

mysqli_close($conn);
include "widgets/footer.php"
?>
</div>
