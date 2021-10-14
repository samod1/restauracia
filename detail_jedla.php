<?php
$conn ="";
include "config.php";
$nazovSuboru="Detail jedla";
include "widgets/header.php";
$bc_nazov="Detail jedla";
include "widgets/navbar.php";
?>

<?php
if ($_GET["id"] != "") {
    $queryNazov="SELECT nazov,postup FROM recept WHERE id=".$_GET["id"];
    $resultNazov = mysqli_query($conn, $queryNazov);
    while ($rowNazov = mysqli_fetch_assoc($resultNazov))
    {
        echo "<div class='container-fluid'><h3>Detail jedla: " . $rowNazov["nazov"] . "</h3>
        <h4>Suroviny</h4>
        <table class='table Stable-stripped'>
            <thead>
                <td>
                    <th>Surovina</th>
                    <th>Mnozstvo</th>
                </td>
            </thead>        
        </table>
        <h4>Postup</h4>
        <p>".$rowNazov["postup"]."</p>
        </div>
</div>";
    }
}
?>
</div>
