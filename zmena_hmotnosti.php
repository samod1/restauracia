<?php
    include "config.php";
    $conn="";
    include "configDb.php";

    $nazovSuboru = "Zmena hmotnosti";
    include "widgets/header.php";

    $bc_nazov = "Zmena hmotnosti";
    include "widgets/navbar.php";

    if ($_GET["id"]!= "" && $_GET["zmena"]=="yes")
    {

        $querySur = "SELECT id_suroviny,nazov_suroviny,mnozstvo_sklad,skratka FROM tbl_suroviny INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky WHERE id_suroviny =".$_GET["id"];
        $resultSur = mysqli_query($conn,$querySur);

        while ($rowSur = mysqli_fetch_assoc($resultSur))
        {




?>
                <h6><?php echo "Povodna hmotnost: ".$rowSur["mnozstvo_sklad"]." ".$rowSur["skratka"];?></h6>
                <div>
                    <form method="post" class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="zmena">
                            <label class="form-check-label">Ubytok</label>
                        </div>
                        <br>
                        <label>Prirastok v sklade</label>
                        <input type="text" name="hmotnost" class="form-control form-control-lg">
                        <br>
                        <input type="submit" value="Pridat hodnotu" class="btn btn-primary btn-lg btn-block">
                        <input type="hidden" name="zmenit" value="yes">
                    </form>

                    <?php
                    if ($_POST["zmenit"]=="yes")
                    {
                        if (isset($_POST["zmena"]))
                        {
                            $hmotnostMinus = $rowSur["mnozstvo_sklad"] - $_POST["hmotnost"];
                            $query = "UPDATE tbl_suroviny SET mnozstvo_sklad = ? WHERE id_suroviny=?";
                            $stmt = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt, $query);
                            mysqli_stmt_bind_param($stmt, 'ii', $hmotnostMinus,$rowSur["id_suroviny"]);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            header("Location: tbl_suroviny.php");
                        }

                        else
                        {
                            $hmotnostPlus = $rowSur["mnozstvo_sklad"] + $_POST["hmotnost"];
                            $query = "UPDATE tbl_suroviny SET mnozstvo_sklad = ? WHERE id_suroviny=?";
                            $stmt = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt, $query);
                            mysqli_stmt_bind_param($stmt, 'ii', $hmotnostPlus,$rowSur["id_suroviny"]);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            header("Location: tbl_suroviny.php");
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

<?php
        }
    }
    else
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              <strong>Chyba 400</strong> Nespravny odkaz
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
</div>";
    }
    mysqli_close($conn);
        ?>