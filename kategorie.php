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
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="Objednavky" data-bs-toggle="tab" data-bs-target="#suroviny" type="button" role="tab" aria-controls="suroviny" aria-selected="true">Suroviny</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="Objednavky" data-bs-toggle="tab" data-bs-target="#recepty" type="button" role="tab" aria-controls="recepty" aria-selected="true">Recepty</button>
        </li>
    </ul>



    <div class="tab-content" role="presentation">
        <div class="tab-pane active" id="suroviny" role="tabpanel" aria-labelledby="suroviny">
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

        <div class="tab-pane active" id="recepty" role="tabpanel" aria-labelledby="recepty">
            <div class="tab-pane active" id="suroviny" role="tabpanel" aria-labelledby="suroviny">
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
    </div>
</div>
<?php
    mysqli_close($conn);
include "widgets/footer.php";
?>