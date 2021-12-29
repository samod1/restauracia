<?php
$conn="";
include "../configDb.php";

if ($_GET["del"] == "surovina" && $_GET["id"] != "") {

    $queryRecSur="SELECT id_rec FROM tbl_suroviny_k_receptu WHERE id_sur=". $_GET["id"];
    $resultRecSur= mysqli_query($conn,$queryRecSur);
    $pocetRiadkov = mysqli_num_rows($resultRecSur);

    if ($pocetRiadkov == 0)
    {
        $id = $_GET["id"];
        $query = "DELETE FROM tbl_suroviny WHERE id_suroviny=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Refresh:3; url=../tbl_suroviny.php',true , 200);
    }

    else
    {
        //teraz ak neplati podmienka
        //tuto sa budu vymazavat zaznamy z rec_sur

        while ($row=mysqli_fetch_assoc($resultRecSur))
        {
            $query = "DELETE FROM tbl_suroviny_k_receptu WHERE id_sur=".$_GET["id"];
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}
mysqli_close($conn);