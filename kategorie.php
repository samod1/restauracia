<?php
$stranka = "kategorie";
include "config.php";
$conn ="";
include "configDb.php";
$nazovSuboru="Kategorie";
include "widgets/header.php";
$bc_nazov="Kategorie";
include "widgets/navbar.php";
?>
<div class="container-fluid">
    <h3>Kategorie</h3>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#suroviny" type="button" role="tab" aria-controls="suroviny" aria-selected="true">Suroviny</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#recepty" type="button" role="tab" aria-controls="recepty" aria-selected="false">Recepty</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#jednotky" type="button" role="tab" aria-controls="jednotky" aria-selected="false">Jednotky</button>
        </li>
    </ul>



    <div class="tab-content">
        <div class="tab-pane active" id="suroviny" role="tabpanel" aria-labelledby="suroviny">
            <br>
            <h4>Kategorie surovin</h4>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Vytvorit kategoriu surovin
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Vytvorit novu jednotku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" class="form-group">
                                        <label>Nazov kategorie</label>
                                        <br>
                                        <input class="form-control form-control-lg" type="text" name="nazov_kategorie">
                                        <br>
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php
                $query = "SELECT id_kategorie, nazov_kategorie FROM enum_kategoria_suroviny";
                $result = mysqli_query($conn,$query);
                $pocetRiadkov = mysqli_num_rows($result);

                if ($pocetRiadkov != 0)
                {
                    ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nazov kategorie</th>
                                    <th>Pocet surovin v kategorii</th>
                                    <th colspan="2">Akcia</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php

                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $querySur = "SELECT nazov_suroviny FROM tbl_suroviny WHERE kategoria_suroviny= ".$row["id_kategorie"];
                        $resultSur = mysqli_query($conn,$querySur);
                        $pocetSurovin = mysqli_num_rows($resultSur);
                    ?>
                        <tr>
                            <td><?php echo $row["nazov_kategorie"];?></td>
                            <td><?php echo $pocetSurovin; ?></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message<?php echo $row['id_kategorie']?>">Editacia kategorie</button></td>
                            <td><a href="spracovanie/mazanie_kategorii.php?id=<?php echo $row["id_kategorie"]?>&zmazat=ano" class="btn btn-danger">Zmazat</a></td>

                            <!-- Modal -->
                            <div class="modal fade" id="message<?php echo $row["id_kategorie"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editacia kategorie <?php echo $row["nazov_kategorie"]?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                       <p>Formular editacie</p>
                                        <form method="post" class="form-group">
                                            <input type="hidden" name="id" value="<?php echo $row["id_kategorie"];?>">
                                            <label>Nazov kategorie</label>
                                            <input class="form-control form-control-lg" type="text" name="kategoria" value="<?php echo $row["nazov_kategorie"];?>">
                                            <br>
                                            <input class="btn btn-primary btn-lg btn-block" type="submit" name="send" value="Zmenit udaje">
                                        </form>
                                        <?php
                                            if (isset($_POST["send"]))
                                            {
                                                $queryEdit = "UPDATE enum_kategoria_suroviny SET nazov_kategorie = ? WHERE id_kategorie = ? ";
                                                $stmt = mysqli_stmt_init($conn);
                                                mysqli_stmt_prepare($stmt,$queryEdit);
                                                mysqli_stmt_bind_param($stmt, 'si', $_POST["kategoria"],$_POST["id"]);
                                                mysqli_stmt_execute($stmt);
                                                mysqli_stmt_close($stmt);
                                                mysqli_commit($conn);
                                                header("Refresh:0; url:kategorie.php");
                                            }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavriet</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                            </tbody>
                        </table>
                <?php
                }

                else
                {
                    echo "<div class='alert alert-warning' role='alert'>
                    <strong>V databaze sa nenachadzaju ziadne zaznamy</strong>
                    </div>";
                }

            ?>
        </div>
        <div class="tab-pane" id="recepty" role="tabpanel" aria-labelledby="recepty">
            <br>
                <h4>Kategorie receptov</h4>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#typReceptu">
                        Vytvorit kategoriu receptov
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="typReceptu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Vytvorit kategoriu receptov</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" class="form-group">
                                        <label>Nazov kategorie</label>
                                        <br>
                                        <input class="form-control form-control-lg" type="text" name="nazov_kategorie">
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-lg btn-block">

                                        <input type="hidden" name="vlozit" value="yes">
                                        <?php
                                        $idKat=0;
                                        $queryKat="INSERT INTO enum_typ_receptu (id_typu_receptu, nazov_typu_receptu) VALUES (?,?)";
                                        $stmtKat = mysqli_stmt_init($conn);
                                        mysqli_stmt_prepare($stmtKat, $queryKat);
                                        mysqli_stmt_bind_param($stmtKat, 'is', $id, $_POST["nazov_kategorie"]);
                                        mysqli_stmt_execute($stmtKat);
                                        mysqli_stmt_close($stmtKat);
                                        ?>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
                <?php
                $query = "SELECT id_typu_receptu, nazov_typu_receptu FROM enum_typ_receptu";
                $result = mysqli_query($conn,$query);
                $pocetRiadkov = mysqli_num_rows($result);

                if ($pocetRiadkov != 0)
                {
                    ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nazov kategorie</th>
                            <th>Pocet surovin v kategorii</th>
                            <th colspan="2">Akcia</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        while ($row = mysqli_fetch_assoc($result))
                        {
                        $querySur = "SELECT nazov_receptu FROM tbl_recept WHERE typ_receptu= ".$row["id_typu_receptu"];
                        $resultSur = mysqli_query($conn,$querySur);
                        $pocetSurovin = mysqli_num_rows($resultSur);
                        ?>
                        <tr>
                            <td><?php echo $row["nazov_typu_receptu"];?></td>
                            <td><?php echo $pocetSurovin; ?></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message<?php echo $row['id_typu_receptu']?>">Editacia kategorie</button></td>
                            <td><a href="spracovanie/mazanie_kategorii.php?id=<?php echo $row["id_typu_receptu"]?>&zmazat=recept" class="btn btn-danger">Zmazat</a></td>

                            <!-- Modal -->
                            <div class="modal fade" id="message<?php echo $row["id_typu_receptu"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editacia kategorie <?php echo $row["nazov_typu_receptu"]?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Formular editacie</p>
                                            <form method="post" class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $row["id_typu_receptu"];?>">
                                                <label>Nazov kategorie</label>
                                                <input class="form-control form-control-lg" type="text" name="kategoriaRec" value="<?php echo $row["nazov_typu_receptu"];?>">
                                                <br>
                                                <input class="btn btn-primary btn-lg btn-block" type="submit" name="sendRec" value="Zmenit udaje">
                                            </form>
                                            <?php
                                            if (isset($_POST["sendRec"]))
                                            {
                                                $queryEdit = "UPDATE enum_typ_receptu SET nazov_typu_receptu = ? WHERE id_typu_receptu = ? ";
                                                $stmt = mysqli_stmt_init($conn);
                                                mysqli_stmt_prepare($stmt,$queryEdit);
                                                mysqli_stmt_bind_param($stmt, 'si', $_POST["kategoriaRec"],$_POST["id"]);
                                                mysqli_stmt_execute($stmt);
                                                mysqli_stmt_close($stmt);
                                                mysqli_commit($conn);
                                                header("Refresh:0; url:kategorie.php");
                                            }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavriet</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }

                else
                {
                    echo "<div class='alert alert-warning' role='alert'>
                    <strong>V databaze sa nenachadzaju ziadne zaznamy</strong>
                    </div>";
                }

                ?>
        </div>
        <div class="tab-pane" id="jednotky" role="tabpanel" aria-labelledby="jednotky">
                <br>
                <h4>Čísleník jednotiek</h4>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jednotka">
                            Vytvorit novu jednotku
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="jednotka" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Vytvorit novu jednotku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" class="form-group">
                                            <label>Nazov kategorie</label>

                                            <input class="form-control form-control-lg" type="text" name="nazov_kategorie">
                                            <br>
                                            <label>Skratka</label>
                                            <input class="form-control form-control-lg" type="text" name="skratka">
                                            <br>
                                            <input type="submit" class="btn btn-primary btn-lg btn-block">

                                            <input type="hidden" name="vlozit" value="yes">
                                            <?php
                                            $idKat=0;
                                            $queryKat="INSERT INTO enum_jednotka (id_jednotky, jednotka, skratka) VALUES (?,?,?)";
                                            $stmtKat = mysqli_stmt_init($conn);
                                            mysqli_stmt_prepare($stmtKat, $queryKat);
                                            mysqli_stmt_bind_param($stmtKat, 'iss', $id, $_POST["nazov_kategorie"],$_POST["skratka"]);
                                            mysqli_stmt_execute($stmtKat);
                                            mysqli_stmt_close($stmtKat);
                                            ?>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <table class="table table-striped">
                    <thead>
                    <th>Nazov jednotky</th>
                    <th>Pocet surovin s touto jednotkou</th>
                    <th colspan="2">Akcia</th>
                    </thead>
                    <tbody>
                <?php
                    $queryJed = "SELECT id_jednotky, jednotka, skratka FROM enum_jednotka ORDER BY id_jednotky ASC";
                    $resultJed = mysqli_query($conn,$queryJed);
                    while ($row = mysqli_fetch_assoc($resultJed))
                    {
                        $query = "SELECT id_suroviny FROM tbl_suroviny WHERE jednotka=".$row["id_jednotky"];
                        $result = mysqli_query($conn,$query);
                        $pocetRiadkov = mysqli_num_rows($result);
                        ?>
                                    <tr>
                                        <td><?php echo $row["jednotka"]." (".$row["skratka"].")"?></td>
                                        <td><?php echo $pocetRiadkov?></td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message<?php echo $row['id_jednotky']?>">Editacia kategorie</button></td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="message<?php echo $row["id_jednotky"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editacia kategorie <?php echo $row["id_jednotky"]?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Formular editacie</p>
                                                        <form method="post" class="form-group">
                                                            <input type="hidden" name="id" value="<?php echo $row["id_jednotky"];?>">
                                                            <label>Nazov kategorie</label>
                                                            <input class="form-control form-control-lg" type="text" name="jednotka" value="<?php echo $row["jednotka"];?>">
                                                            <br>
                                                            <label>Skratka jednotky</label>
                                                            <input class="form-control form-control-lg" type="text" name="skratka" value="<?php echo $row["skratka"];?>">
                                                            <input class="btn btn-primary btn-lg btn-block" type="submit" name="sendJed" value="Zmenit udaje">
                                                        </form>
                                                        <?php
                                                        if (isset($_POST["sendJed"]))
                                                        {
                                                            $queryEdit = "UPDATE enum_jednotka SET jednotka = ? , skratka=? WHERE id_jednotky = ? ";
                                                            $stmt = mysqli_stmt_init($conn);
                                                            mysqli_stmt_prepare($stmt,$queryEdit);
                                                            mysqli_stmt_bind_param($stmt, 'ssi', $_POST["jednotka"],$_POST["skratka"],$_POST["id"]);
                                                            mysqli_stmt_execute($stmt);
                                                            mysqli_stmt_close($stmt);
                                                            mysqli_commit($conn);
                                                            header("Refresh:0; url:kategorie.php");
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavriet</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <td><a href="spracovanie/mazanie_kategorii.php?id=<?php echo $row["id_jednotky"]?>&zmazat=jednotka" class="btn btn-danger">Zmazat</a></td>
                                    </tr>
                        <?php
                    }
                ?>
                    </tbody>
                </table>
            </div>
</div>
</div>
<?php
    mysqli_close($conn);
include "widgets/footer.php";
?>