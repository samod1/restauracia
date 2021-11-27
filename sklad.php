<?php
$conn ="";
include "configDb.php";
$nazovSuboru="Sklad";
include "widgets/header.php";
$bc_nazov="Sklad";
include "widgets/navbar.php";

?>
<div class="container-fluid">
    <h3>Modul skladovych zasob</h3>
    <br>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="Objednavky" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Objednavky</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sklad" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Skladove zasoby</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="Objednavky">
            <div class="container-fluid">
                <br>
                <h4>Objednavky</h4>
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary" href="prijemka.php">Vytvorit novu prijemku</a>
                    </div>
                </div>
                <br>
                <?php
                    $query="SELECT ID_objednavky, Cislo_objednavky, Datum_dorucenia, Datum_splatnosti, Celkova_cena,Variabilny_symbol, Vybavena FROM tbl_prijemka ORDER BY ID_objednavky ASC";
                    $result = mysqli_query($conn,$query);
                    $pocetRiadkov = mysqli_num_rows($result);
                    if ($pocetRiadkov == 0)
                    {
                        echo "Nemam co zobrazit";
                    }
                    else
                    {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cislo objednavky</th>
                            <th>Datum dodania</th>
                            <th>Datum splatnosti</th>
                            <th>Variabilny symbol</th>
                            <th>Celkova cena</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($row=mysqli_fetch_assoc($result))
                    {
                    ?>
                        <tr>
                            <td><?php echo $row["Cislo_objednavky"];?></td>
                            <td><?php echo $row["Datum_dorucenia"];?></td>
                            <td><?php echo $row["Datum_splatnosti"];?></td>
                            <td><?php echo $row["Variabilny_symbol"];?></td>
                            <td><?php echo $row["Celkova_cena"]."€";?></td>
                            <td><?php

                                    if($row["Vybavena"] == 1) {
                                        echo "<button class='btn btn-success' disabled>Ukoncena</button>";
                                    }

                                    else
                                    {
                                        echo"<button class='btn btn-danger' disabled>Aktivna</button>";
                                    }
                                ?>
                            </td>
                            <td><a href="detail_objednavky.php?id=<?php echo $row['ID_objednavky'];?>" class="btn btn-primary">Detail</a></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php } ?>
            </div>


        </div>
        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="sklad">
            <div class="container-fluid">
                <br>
                <h4>Skladove zasoby</h4>
                <!-- TODO zaanalyzovat -->
                <table class="table table-striped">
                    <?php
                        $query="SELECT nazov_suroviny,Mnozstvo,skratka 
                                FROM tbl_suroviny 
                                INNER JOIN enum_jednotka ej on tbl_suroviny.jednotka = ej.id_jednotky
                                ORDER BY  id_suroviny ASC";
                        $result=mysqli_query($conn,$query);
                        $pocetRiadkov = mysqli_num_rows($result);
                        if($pocetRiadkov !=0)
                        {

                    ?>
                    <thead>
                        <th>Nazov suroviny</th>
                        <th>Mnozstvo</th>
                    </thead>
                    <tbody>
                    <?php
                            while ($row=mysqli_fetch_assoc($result))
                            {
                    ?>
                        <td><?php echo $row["nazov_suroviny"];?></td>
                        <td><?php echo $row["Mnozstvo"]." ".$row["skratka"]; ?></td>
                    </tbody>
                    <?php
                        }}
                        else
                        {
                            echo "Nulovy pocet riadkov musite zadat surovinu";
                        }
                    ?>
                </table>
            </div>
        </div>
</div>
<?php
include "widgets/footer.php";
mysqli_close($conn);
?>