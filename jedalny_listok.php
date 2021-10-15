<?php
$nazovSuboru="Jidelny listek";
include "widgets/header.php";
$bc_nazov="Jidelny listek";
include "widgets/navbar.php";
?>
<div class="container-fluid">
    <h3>Jidelny listek</h3>
    <h4>Seznam aktualnich jidelnych listku</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="2">Datum</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>18.10.2021</td>
                <td>24.10.2021</td>
                <td><a href="detail_jedalneho_listku.php" class="btn btn-primary"><i class="fa fa-search"></i> Detail menu</a></td>
            </tr>
        <tr>
            <td>25.10.2021</td>
            <td>31.10.2021</td>
            <td><a href="detail_jedalneho_listku.php" class="btn btn-primary"><i class="fa fa-search"></i> Detail menu</a></td>
        </tr>
        </tbody>
    </table>
</div>
<?php
include "widgets/footer.php";
?>

