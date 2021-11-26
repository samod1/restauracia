<?php
$nazovSuboru="Prehlad surovin";
include "widgets/header.php";
$bc_nazov="Prehlad surovin";
include "widgets/navbar.php";
$conn = '';
include "config.php";

if ($_GET["id"]!="")
{
 $query="SELECT nazov_suroviny, id_suroviny FROM tbl_suroviny WHERE kategoria_suroviny=".$_GET["id"]." ORDER BY id_suroviny ASC";
 $result= mysqli_query($conn,$query);
 $pocetRiadkov = mysqli_num_rows($result);

 if($pocetRiadkov == 0)
 { ?>
     <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Momentalne sa tu nenachadzaju ziadne zaznamy</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
<?php
 }

 else
 {?>
     <table class="table table-striped">
         <thead>
            <th>Nazov kategorie</th>
         </thead>
         <?php
            while ($row=mysqli_fetch_assoc($result))
            {
         ?>
         <tbody>
         <td><a href="receptySuroviny.php?id=<?php echo $row['id_suroviny'];?>"><?php echo $row['nazov_suroviny']; ?></a></td>
         </tbody>
                <?php }?>
     </table>
<?php
 }
}

else
{
    echo "ERR";
}
?>