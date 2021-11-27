<?php
$conn ="";
include "configDb.php";
$nazovSuboru="Detail objednavky";
include "widgets/header.php";
$bc_nazov="Detail objednavky";
include "widgets/navbar.php";


if($_GET["id"]!="")
{

    $query="SELECT Cislo_objednavky,Datum_dorucenia,Datum_splatnosti, Variabilny_symbol, Vybavena, Doklad, Celkova_cena 
            FROM tbl_prijemka WHERE ID_objednavky=".$_GET["id"];
    $result = mysqli_query($conn,$query);
    while ($row=mysqli_fetch_assoc($result))
    {

        if($row["Vybavena"] == 1) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Objednavka</strong> bola uz vybavena
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }

        else
        { ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Objednavka</strong> este nebola vybavena.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php } ?>


    <h3>Objednávka č.<?php echo $row["Cislo_objednavky"];?></h3>
    <table class="table table-striped">
        <thead>
            <th>Datum Dorucenia</th>
            <th>Datum Splatnosti</th>
            <th>Variabilny symbol</th>
            <th>Celkova cena</th>
        </thead>
        <tbody>
            <td><?php echo $row["Datum_dorucenia"]?></td>
            <td><?php echo $row["Datum_splatnosti"]?></td>
            <td><?php echo $row["Variabilny_symbol"]?></td>
            <td><?php echo $row["Celkova_cena"]?>€</td>
        </tbody>
    </table>


<?php
    }
    }
else
{
    echo "nemam co zobrazit";
}
mysqli_close($conn);
include "widgets/footer.php";
?>