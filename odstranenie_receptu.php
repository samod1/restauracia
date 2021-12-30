<?php
$conn="";
include "configDb.php";

if ($_GET["zmazat"] == "ano" && isset($_GET["id"]))
{

    $query="SELECT id_rec_sur FROM tbl_suroviny_k_receptu WHERE id_rec=".$_GET["id"];
    $result = mysqli_query($conn,$query);
    $pocetRiadkov = mysqli_num_rows($result);

    if($pocetRiadkov == 0)
    {
        $query = "DELETE FROM tbl_recept WHERE id_receptu=". $_GET["id"];
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Refresh:3; url=zoznam_receptov.php', true, 200);
    }

    else
    {
        while ($row= mysqli_fetch_assoc($result))
        {
            $querySuroviny = "DELETE FROM tbl_suroviny_k_receptu WHERE id_rec=".$_GET["id"];
            $stmtSuroviny = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmtSuroviny, $querySuroviny);
            mysqli_stmt_execute($stmtSuroviny);
            mysqli_stmt_close($stmtSuroviny);
        }
    }
}
mysqli_close($conn);
