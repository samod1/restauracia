<?php
include "config.php";
$conn="";
include "configDb.php";
$stranka = "listky";
$nazovSuboru = "Jidelny listek";
include "widgets/header.php";
$bc_nazov = "Jidelny listek";
include "widgets/navbar.php";
?>
<div class="container-fluid">
    <h3>Jedálny lístok
        <?php
        $query = "SELECT id_menu, datum_od, datum_do, pocet_hosti FROM tbl_menu WHERE id_menu=".$_GET["menu"]." ORDER BY id_menu ASC";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result))
        {
            echo $row["datum_od"]. " - ".$row["datum_do"];
        }

        ?>
    </h3>
    <div class="row">
        <div class="col-6">
            <h4>
                Prepokladany pocet hosti:
                <?php
                $query = "SELECT id_menu, datum_od, datum_do, pocet_hosti FROM tbl_menu WHERE id_menu=".$_GET["menu"]." ORDER BY id_menu ASC";
                $result = mysqli_query($conn,$query);
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo $row["pocet_hosti"];
                }

                ?>
            </h4>
        </div>
        <div class="col-6">
            <button onclick="window.print()" class="btn btn-primary btn-lg btn-block"><i class="fa fa-print"></i> Tlacit menu</button>
        </div>
    </div>

    <br>
    <h5>Podávané jedlá</h5>
    <table class="table table-stripped">
        <tbody>
        <tr>
            <th colspan="2" class="table-active" style="text-align: center">
                <?php
                    $queryDni = "SELECT den FROM enum_dni where Jazyk='SK' AND id_dna=1";
                    $resultDni = mysqli_query($conn,$queryDni);
                    while ($row = mysqli_fetch_assoc($resultDni))
                    {
                        echo $row["den"];
                    }
                ?>
            </th>
        </tr>
        <tr>
            <?php
                $query = "SELECT nevari_sa FROM tbl_jedla_menu WHERE id_menu = 1 AND den = 1";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result))
                {
                    if ($row["nevari_sa"] == 1)
                    {
                        echo "
                                <tr rowspan=4>
                                       <td colspan='1' style='text-align: center'>V tento den sa nevari</td>                                               
                                </tr>";
                    }
                    else
                    {
                        echo "<tr>";
                        echo "<th>Polievka</th>";
                        $query = "SELECT nazov_receptu FROM tbl_jedla_menu INNER JOIN tbl_recept tr on tbl_jedla_menu.polievka = tr.id_receptu WHERE id_menu=".$_GET["menu"]." AND den=1";
                        $result = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo "<td>". $row["nazov_receptu"]."</td>";
                        }
                    }
                }
                ?>
        </tr>
        <tr>
            <?php
            $query = "SELECT nevari_sa FROM tbl_jedla_menu WHERE id_menu = 1 AND den = 1";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row["nevari_sa"] == 1)
                {
                    echo "
                                <tr rowspan=4>
                                       <td colspan='1' style='text-align: center'>V tento den sa nevari</td>                                               
                                </tr>";
                }
                else
                {
                    echo "<tr>";
                    echo "<th>Menu 1</th>";
                    $query = "SELECT nazov_receptu FROM tbl_jedla_menu INNER JOIN tbl_recept tr on tbl_jedla_menu.menu1 = tr.id_receptu WHERE id_menu=".$_GET["menu"]." AND den=1";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<td>". $row["nazov_receptu"]."</td>";
                    }
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            $query = "SELECT nevari_sa FROM tbl_jedla_menu WHERE id_menu = 1 AND den = 1";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row["nevari_sa"] == 1)
                {
                    echo "
                                <tr rowspan=4>
                                       <td colspan='1' style='text-align: center'>V tento den sa nevari</td>                                               
                                </tr>";
                }
                else
                {
                    echo "<tr>";
                    echo "<th>Menu 2</th>";
                    $query = "SELECT nazov_receptu FROM tbl_jedla_menu INNER JOIN tbl_recept tr on tbl_jedla_menu.menu2 = tr.id_receptu WHERE id_menu=".$_GET["menu"]." AND den=1";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<td>". $row["nazov_receptu"]."</td>";
                    }
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            $query = "SELECT nevari_sa FROM tbl_jedla_menu WHERE id_menu = 1 AND den = 1";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row["nevari_sa"] == 1)
                {
                    echo "
                                <tr rowspan=4>
                                       <td colspan='1' style='text-align: center'>V tento den sa nevari</td>                                               
                                </tr>";
                }
                else
                {
                    echo "<tr>";
                    echo "<th>Menu 3</th>";
                    $query = "SELECT nazov_receptu FROM tbl_jedla_menu INNER JOIN tbl_recept tr on tbl_jedla_menu.menu3 = tr.id_receptu WHERE id_menu=".$_GET["menu"]." AND den=1";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<td>". $row["nazov_receptu"]."</td>";
                    }
                }
            }
            ?>
        </tr>

        <!-- Utorok -->
        <tr>
            <th colspan="2" class="table-active" style="text-align: center">
                <?php
                $queryDni = "SELECT den FROM enum_dni where Jazyk='SK' AND id_dna=1";
                $resultDni = mysqli_query($conn,$queryDni);
                while ($row = mysqli_fetch_assoc($resultDni))
                {
                    echo $row["den"];
                }
                ?>
            </th>
        </tr>
        <tr>
            <?php
            $query = "SELECT nevari_sa FROM tbl_jedla_menu WHERE id_menu =". $_GET['id']." AND den = 2";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row["nevari_sa"] == 1)
                {
                    echo "
                                <tr rowspan=4>
                                       <td colspan='1' style='text-align: center'>V tento den sa nevari</td>                                               
                                </tr>";
                }
                else
                {
                    echo "<tr>";
                    echo "<th>Polievka</th>";
                    $query = "SELECT nazov_receptu FROM tbl_jedla_menu INNER JOIN tbl_recept tr on tbl_jedla_menu.polievka = tr.id_receptu WHERE id_menu=".$_GET["menu"]." AND den=1";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<td>". $row["nazov_receptu"]."</td>";
                    }
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            $query = "SELECT nevari_sa FROM tbl_jedla_menu WHERE id_menu = 1 AND den = 1";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row["nevari_sa"] == 1)
                {
                    echo "
                                <tr rowspan=4>
                                       <td colspan='1' style='text-align: center'>V tento den sa nevari</td>                                               
                                </tr>";
                }
                else
                {
                    echo "<tr>";
                    echo "<th>Menu 1</th>";
                    $query = "SELECT nazov_receptu FROM tbl_jedla_menu INNER JOIN tbl_recept tr on tbl_jedla_menu.menu1 = tr.id_receptu WHERE id_menu=".$_GET["menu"]." AND den=1";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<td>". $row["nazov_receptu"]."</td>";
                    }
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            $query = "SELECT nevari_sa FROM tbl_jedla_menu WHERE id_menu = 1 AND den = 1";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row["nevari_sa"] == 1)
                {
                    echo "
                                <tr rowspan=4>
                                       <td colspan='1' style='text-align: center'>V tento den sa nevari</td>                                               
                                </tr>";
                }
                else
                {
                    echo "<tr>";
                    echo "<th>Menu 2</th>";
                    $query = "SELECT nazov_receptu FROM tbl_jedla_menu INNER JOIN tbl_recept tr on tbl_jedla_menu.menu2 = tr.id_receptu WHERE id_menu=".$_GET["menu"]." AND den=1";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<td>". $row["nazov_receptu"]."</td>";
                    }
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            $query = "SELECT nevari_sa FROM tbl_jedla_menu WHERE id_menu = 1 AND den = 1";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row["nevari_sa"] == 1)
                {
                    echo "
                                <tr rowspan=4>
                                       <td colspan='1' style='text-align: center'>V tento den sa nevari</td>                                               
                                </tr>";
                }
                else
                {
                    echo "<tr>";
                    echo "<th>Menu 3</th>";
                    $query = "SELECT nazov_receptu FROM tbl_jedla_menu INNER JOIN tbl_recept tr on tbl_jedla_menu.menu3 = tr.id_receptu WHERE id_menu=".$_GET["menu"]." AND den=1";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<td>". $row["nazov_receptu"]."</td>";
                    }
                }
            }
            ?>
        </tr>

        </tbody>
    </table>
</div>
<?php
include "widgets/footer.php";
?>
