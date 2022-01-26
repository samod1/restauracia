<?php
include "config.php";
$stranka = "suroviny";

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
        <div class="col">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
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
                            <form method="post" autocomplete="on" action="spracovanie/vlozenie_spracovanie.php">
                                <label for="nazovsuroviny">Nazov suroviny</label>
                                <input class="form-control form-control-lg" required autofocus id="nazovsuroviny" name="nazovSuroviny" placeholder="Sem napiste nazov suroviny" type="text">
                                <br>
                                <label>Popis suroviny</label>
                                <textarea class="form-control" name="popis" rows="8" cols="25"></textarea>
                                <label></label>
                                <br>
                                <label>Nazov dodavatela</label>
                                <input type="text" class="form-control form-control-lg" name="dodavatel">
                                <label>Katalogove cislo dodavatela</label>
                                <input type="text" class="form-control form-control-lg" name="katCislo">
                                <br>

                                <label><h4>Hmotnost</h4></label>
                                <div class="row">
                                    <div class="col">
                                        <label>Brutto</label>
                                        <input type="text" name="brutto" class="form-control form-control-lg">
                                    </div>
                                    <div class="col">
                                        <label>Netto</label>
                                        <input type="text" name="netto" class="form-control form-control-lg">
                                    </div>
                                </div>
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
                                <div class="row">
                                    <div class="col">
                                        <label>Mnozstvo</label>
                                        <input class="form-control form-control-lg" type="text" name="mnozstvo" placeholder="125,3">
                                    </div>
                                <br>
                                    <div class="col">
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
                                    </div>
                                </div>
                                <label>Obrazok produktu</label>
                                <input type="file" class="form-control-file">
                                <br>
                                <!--<input required autofocus id="nazovsuroviny" name="katSuroviny">-->

                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Ulozit surovinu">
                                <input class="btn btn-secondary btn-lg btn-block" type="reset" value="Zmazat">
                                <input type="hidden" name="send" value="yes">

                            </form>
</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavriet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#Kategoria">Vytvorit kategoriu surovin</button>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="Kategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vytvorenie novej kategorie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="form-group">
                                <label>Nazov kategorie</label>
                                <br>
                                <input class="form-control form-control-lg" type="text" name="nazov_kategorie">
                                <br>
                                <input value="Uloziť kategóriu" type="submit" class="btn btn-primary btn-lg btn-block">
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
                    { ?>
                        <option value="<?php echo $row["id_kategorie"];?>"
                                <?php
                                if (isset($_POST["kategorie"]) && $_POST["kategoria"] == $row["id_kategorie"])
                                           {
                                                echo "selected";
                                           }?>
                                ><?php echo $row["nazov_kategorie"];?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-2">
                <input name="kategorie" type="submit" value="<?php echo $lang["hladaj"];?>" class="btn btn-primary btn-lg btn-block">
            </div>
            <div class="col-2">
                <input type="reset" class="btn btn-secondary btn-lg btn-block">
            </div>
        </div>
    </form>

<?php
if (isset($_POST["kategorie"]) && $_POST["kategoria"] != "" && $_POST["kategoria"] != "all")
{
    $queryKat = "SELECT nazov_suroviny FROM tbl_suroviny WHERE kategoria_suroviny =".$_POST["kategoria"];
    $resultKat = mysqli_query($conn, $queryKat);
    $pocetRiadkovSur = mysqli_num_rows($resultKat);

    if ($pocetRiadkovSur == 0)
    {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
            <strong>" . $lang["noRecords"] . "</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    else
    {
        $querySur = "SELECT id_suroviny,nazov_suroviny,mnozstvo_sklad,skratka,dodavatel,hmotnost_netto,
       hmotnost_brutto,katalogove_cislo,popis_suroviny, nazov_kategorie FROM tbl_suroviny 
       INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky
       INNER JOIN enum_kategoria_suroviny eks on tbl_suroviny.kategoria_suroviny = eks.id_kategorie
       WHERE kategoria_suroviny =".$_POST["kategoria"];
        $resultSur = mysqli_query($conn,$querySur);
        ?>
        <table class="table table-stripped">
            <thead>
                <th><?php echo $lang["nazov"]; ?></th>
                <th><?php echo $lang["mnozstvo"]; ?></th>
            </thead>

            <tbody>
            <?php
            while ($rowSur = mysqli_fetch_assoc($resultSur))
            { ?>
                    <tr>
                       <!-- <td><a data-toggle="modal" data-target="#message<?php //echo $rowSur['id_suroviny'];?>"><?php //echo $rowSur["nazov_suroviny"];?></a></td>-->
                        <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#message<?php echo $rowSur['id_suroviny'];?>"><?php echo $rowSur["nazov_suroviny"];?></button></td>
                        <td><?php echo $rowSur["mnozstvo_sklad"]." ".$rowSur["skratka"];?></td>
                    </tr>

                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="message<?php echo $rowSur['id_suroviny'];?>" role="dialog" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $lang["detailSur"].": ".$rowSur["nazov_suroviny"];?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="editacia_suroviny.php?id=<?php echo $rowSur["id_suroviny"];?>&edituj=ano" class="btn btn-primary btn-lg btn-block">Upravit informacie</a>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-secondary btn-lg btn-block" href="zmena_hmotnosti.php?id=<?php echo $rowSur["id_suroviny"];?>&zmena=yes">Zmenit hmotnost</a>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-danger btn-lg btn-block" href="spracovanie/zmazat.php?id=<?php echo $rowSur["id_suroviny"]?>&del=surovina">Zmazat surovinu</a>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <h5>Podorobnosti o suroivne</h5>
                                        <p><strong>Kategoria suroviny: </strong><?php echo $rowSur["nazov_kategorie"]?></p>
                                        <p><strong>Popis suroviny: </strong><?php echo $rowSur["popis_suroviny"];?></p>
                                        <p><strong>Dodavatel: </strong> <?php echo $rowSur["dodavatel"];?></p>
                                        <p><strong>Katalogove cislo u dodavatela: </strong><?php echo $rowSur["katalogove_cislo"];?></p>
                                        <p><strong>Hmotnost netto: </strong><?php echo $rowSur["hmotnost_netto"],$rowSur["skratka"];?></p>
                                        <p><strong>Hmotnost brutto: </strong><?php echo $rowSur["hmotnost_brutto"],$rowSur["skratka"];?></p>
                                    </div>
                                    <!--<div class="col">
                                        <h5>Nahladovy obrazok</h5>
                                        <img src="img/br_panenka.jpg" class="img-thumbnail">
                                    </div>-->
                                </div>

                                <h5><?php echo $lang["surRec"]?></h5>
                                <div>
                                    <?php
                                        $queryRec= "SELECT nazov_receptu, id_rec FROM tbl_suroviny_k_receptu INNER JOIN tbl_recept r ON tbl_suroviny_k_receptu.id_rec = r.id_receptu WHERE id_sur=" .$rowSur["id_suroviny"];
                                        $resultRec=mysqli_query($conn,$queryRec);
                                        $pocetRiadkovRec = mysqli_num_rows($resultRec);
                                        if ($pocetRiadkovRec == 0)
                                        {
                                            echo "<div class='alert alert-warning' role='alert'> <strong>Pre tuto surovinu, sa v databaze nenasiel ziaden recept</strong> </div>";
                                        }

                                        else
                                        {
                                                while ($rowRec = mysqli_fetch_assoc($resultRec))
                                                {?>
                                                    <a href="detail_jedla.php?id=<?php echo $rowRec["id_rec"];?>"><?php echo $rowRec["nazov_receptu"];?></a>
                                                <?php }
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

    $queryKat = "SELECT nazov_suroviny FROM tbl_suroviny";
    $resultKat = mysqli_query($conn, $queryKat);
    $pocetRiadkovSur = mysqli_num_rows($resultKat);

    if ($pocetRiadkovSur == 0)
    {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
    <strong>" . $lang["noRecords"] . "</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
      }

      else
      {
      $querySur = "SELECT id_suroviny,nazov_suroviny,mnozstvo_sklad,skratka,dodavatel,hmotnost_netto,
      hmotnost_brutto,katalogove_cislo,popis_suroviny, nazov_kategorie FROM tbl_suroviny
      INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky
      INNER JOIN enum_kategoria_suroviny eks on tbl_suroviny.kategoria_suroviny = eks.id_kategorie";
      $resultSur = mysqli_query($conn,$querySur);
      ?>
    <table class="table table-stripped">
        <thead>
        <th><?php echo $lang["nazov"]; ?></th>
        <th><?php echo $lang["mnozstvo"]; ?></th>
        </thead>

        <tbody>
        <?php
        while ($rowSur = mysqli_fetch_assoc($resultSur))
        { ?>
            <tr>
               <!-- <td><a data-toggle="modal" data-target="#message<?php //echo $rowSur['id_suroviny'];?>"><?php //echo $rowSur["nazov_suroviny"];?></a></td> -->
                <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#message<?php echo $rowSur['id_suroviny'];?>"><?php echo $rowSur["nazov_suroviny"];?></button></td>
                <td><?php echo $rowSur["mnozstvo_sklad"]." ".$rowSur["skratka"];?></td>
            </tr>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="message<?php echo $rowSur['id_suroviny'];?>" role="dialog" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo $lang["detailSur"].": ".$rowSur["nazov_suroviny"];?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <a href="editacia_suroviny.php?id=<?php echo $rowSur["id_suroviny"];?>&edituj=ano" class="btn btn-primary btn-lg btn-block">Upravit informacie</a>
                                </div>
                                <div class="col">
                                    <a class="btn btn-secondary btn-lg btn-block" href="zmena_hmotnosti.php?id=<?php echo $rowSur["id_suroviny"];?>&zmena=yes">Zmenit hmotnost</a>
                                </div>
                                <div class="col">
                                    <a class="btn btn-danger btn-lg btn-block" href="spracovanie/zmazat.php?id=<?php echo $rowSur["id_suroviny"]?>&del=surovina">Zmazat surovinu</a>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <h5>Podorobnosti o suroivne</h5>
                                    <p><strong>Kategoria suroviny: </strong><?php echo $rowSur["nazov_kategorie"]?></p>
                                    <p><strong>Popis suroviny: </strong><?php echo $rowSur["popis_suroviny"];?></p>
                                    <p><strong>Dodavatel: </strong> <?php echo $rowSur["dodavatel"];?></p>
                                    <p><strong>Katalogove cislo u dodavatela: </strong><?php echo $rowSur["katalogove_cislo"];?></p>
                                    <p><strong>Hmotnost netto: </strong><?php echo $rowSur["hmotnost_netto"],$rowSur["skratka"];?></p>
                                    <p><strong>Hmotnost brutto: </strong><?php echo $rowSur["hmotnost_brutto"],$rowSur["skratka"];?></p>
                                </div>
                                <div class="col">
                                    <!-- <h5>Nahladovy obrazok</h5>
                                    <img src="img/br_panenka.jpg" class="img-thumbnail"> -->
                                </div>
                            </div>


                            <div>
                                <?php
                                $queryRec= "SELECT nazov_receptu, id_rec FROM tbl_suroviny_k_receptu INNER JOIN tbl_recept r ON tbl_suroviny_k_receptu.id_rec = r.id_receptu WHERE id_sur=" .$rowSur["id_suroviny"];
                                $resultRec=mysqli_query($conn,$queryRec);
                                $pocetRiadkovRec = mysqli_num_rows($resultRec);
                                if ($pocetRiadkovRec == 0)
                                {
                                   ?>
                                    <div class="alert alert-warning" role="alert">
                                        <strong>Pre tuto surovinu, sa v databaze nenasiel ziaden recept</strong>
                                    </div>
                                    <?php
                                }

                                else
                                {
                                    while ($rowRec = mysqli_fetch_assoc($resultRec))
                                    {?>
                                        <h5><?php echo $lang["surRec"]?></h5>
                                        <a href="detail_jedla.php?id=<?php echo $rowRec["id_rec"];?>"><?php echo $rowRec["nazov_receptu"];?></a>
                                    <?php }
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
?>
</div>
<?php
    include_once "widgets/footer.php";
    mysqli_close($conn);
?>