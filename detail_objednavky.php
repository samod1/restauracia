<?php
$conn ="";
$stranka = "sklad";
include "configDb.php";
include "config.php";
$nazovSuboru="Detail objednavky";
include "widgets/header.php";
$bc_nazov="Detail objednavky";
include "widgets/navbar.php";


echo "<div class='container-fluid'>";
if($_GET["id"]!="")
{

    $query="SELECT Cislo_objednavky,Datum_dorucenia,Datum_splatnosti, Variabilny_symbol, Vybavena, Doklad, Celkova_cena 
            FROM tbl_prijemka WHERE ID_objednavky=".$_GET["id"];
    $result = mysqli_query($conn,$query);
    while ($row=mysqli_fetch_assoc($result))
    {

        if($row["Vybavena"] == 1) {
        ?>
                <br>
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
            <br>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Objednavka</strong> este nebola vybavena.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php } ?>

    <div class="row">
        <div class="col-md">
            <h3>Objednávka č.<?php echo $row["Cislo_objednavky"];?></h3>
        </div>
    <?php
    if ($row["Vybavena"] == 0)
    {
    ?>
        <div class="col-md"></div>
            <div class="col-md">
                <form method="post" onsubmit="alert('Naozaj je prijemka spravne dodana, a su vsetky tovary dodane správne')">
                    <input type="hidden" name="vybavena" value="1">
                    <input type="submit" class="btn btn-primary" name="check" value="Oznacit objednavku ako vybavenu">
                </form>
                <?php
                $query = "UPDATE tbl_prijemka SET Vybavena=? WHERE ID_objednavky=".$_GET["id"];
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$query);
                mysqli_stmt_bind_param($stmt, "i", $_POST["vybavena"]);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                ?>
            </div>

    </div>
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
    ?>
    <h4>Produkty v objednavke</h4>
    <?php
    $query = "SELECT nazov_suroviny ,EAN,mnozstvo,datum_spotreby, mnozstvo FROM tbl_veci_v_prijemke INNER JOIN tbl_suroviny ON tbl_suroviny.id_suroviny = tbl_veci_v_prijemke.id_suroviny WHERE id_prijemka =".$_GET["id"];
    $result = mysqli_query($conn,$query);
    $pocetRiadkov = mysqli_num_rows($result);

    if($pocetRiadkov != 0)
    { ?>
          <table class="table table-stripped">
              <thead>
              <tr>
                  <th>Nazov polozky</th>
                  <th>EAN</th>
                  <th>Datum spotreby</th>
              </tr>
              </thead>
          </table>
    <?php }
    else
    {
        ?>
        <div class="alert alert-warning" role="alert">
            V tejto prijemke sa nenachadzaju ziadne zaznamy
        </div>
        <button type="button" class="btn btn-primary btn-lg btn-block">Pridaj prvu polozku objednavky</button>
        <?php
    }

    ?>
<?php

    ?>




<?php
}
else
{
    echo "nemam co zobrazit";
}
mysqli_close($conn);
include "widgets/footer.php";
?>

</div>
