<?php
include "../widgets/header.php";
$conn="";
include "../configDb.php";

if ($_GET["zmazat"] == "ano" && $_GET["id"]!="")
{
    $query="SELECT nazov_suroviny FROM tbl_suroviny WHERE kategoria_suroviny=".$_GET["id"];
    $result = mysqli_query($conn,$query);
    $pocetRiadkov = mysqli_num_rows($result);

    if ($pocetRiadkov == 0)
    {
        $queryDel = "DELETE FROM enum_kategoria_suroviny WHERE id_kategorie=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$queryDel);
        mysqli_stmt_bind_param($stmt, 'i', $_GET["id"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_commit($conn);
        header("Refresh:3; url:../kategorie.php",true, 200);
    }

    else
    {
        $nazovSuboru = "Vymazanie neuspesne!";
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Chyba!</h4>
            <strong>Vami zvolena kategoria sa neda vymazat z dovodu:</strong> V kategorii sa nachadzaju uz suroviny.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
        header("Refresh:3; url:../kategorie.php",true, 400);
    }

}

if ($_GET["zmazat"] == "recept" && $_GET["id"]!="")
{
    $query="SELECT nazov_receptu FROM tbl_recept WHERE typ_receptu=".$_GET["id"];
    $result = mysqli_query($conn,$query);
    $pocetRiadkov = mysqli_num_rows($result);

    if ($pocetRiadkov == 0)
    {
        $queryDel = "DELETE FROM enum_typ_receptu WHERE id_typu_receptu=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$queryDel);
        mysqli_stmt_bind_param($stmt, 'i', $_GET["id"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_commit($conn);
        header("Refresh:0; url:../kategorie.php",true, 200);
    }

    else
    {
        $nazovSuboru = "Vymazanie neuspesne!";
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Chyba!</h4>
            <strong>Vami zvolena kategoria sa neda vymazat z dovodu:</strong> V kategorii sa nachadzaju uz recepty.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
        header("Refresh:0; url:../kategorie.php",true, 400);
    }

}

if ($_GET["zmazat"] == "jednotka" && $_GET["id"]!="")
{
    $query="SELECT nazov_suroviny FROM tbl_suroviny WHERE jednotka=".$_GET["id"];
    $result = mysqli_query($conn,$query);
    $pocetRiadkov = mysqli_num_rows($result);

    if ($pocetRiadkov == 0)
    {
        $queryDel = "DELETE FROM enum_jednotka WHERE id_jednotky=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$queryDel);
        mysqli_stmt_bind_param($stmt, 'i', $_GET["id"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_commit($conn);
        header("Refresh:0; url:../kategorie.php",true, 200);
    }

    else
    {
        $nazovSuboru = "Vymazanie neuspesne!";
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Chyba!</h4>
            <strong>Vami zvolena kategoria sa neda vymazat z dovodu:</strong> V kategorii sa nachadzaju uz suroviny.
        </div>
        <?php
        header("Refresh:3; url:../kategorie.php",true, 400);
    }
}

?>