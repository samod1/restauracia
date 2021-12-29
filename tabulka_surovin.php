<?php
$conn="";
    // Import the file where we defined the connection to Database.
    include "configDb.php";

    $per_page_record = 10;  // Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    }
    else {
        $page=1;
    }

    $start_from = ($page-1) * $per_page_record;

    $query = "SELECT tbl_suroviny.id_suroviny, tbl_suroviny.nazov_suroviny, enum_kategoria_suroviny.nazov_kategorie 
        FROM tbl_suroviny INNER JOIN enum_kategoria_suroviny ON tbl_suroviny.kategoria_suroviny=enum_kategoria_suroviny.id_kategorie 
        ORDER BY id_suroviny ASC LIMIT $start_from, $per_page_record";
    $rs_result = mysqli_query ($conn, $query);
    ?>

    <div class="container-fluid">
        <br>
        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nazov suroviny</th>
                    <th>Kategoria suroviny</th>
                    <th colspan="2">Akcia</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_array($rs_result)) {
                    // Display each field of the records.
                    ?>
                    <tr>
                        <td><?php echo $row["nazov_suroviny"]; ?></td>
                        <td><?php echo $row["nazov_kategorie"]?></td>
                        <td><a href="spracovanie/zmazat.php?id=<?php echo $row[" class="btn btn-danger btn-ml"><i class="fa fa-trash"></i></a></td>
                        <td><a href="editacia_suroviny.php?id=<?php echo $row["id_suroviny"];?>&edituj=ano" class="btn btn-secondary btn-ml"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php
                $query = "SELECT COUNT(*) FROM tbl_suroviny";
                $rs_result = mysqli_query($conn, $query);
                $row = mysqli_fetch_row($rs_result);
                $total_records = $row[0];

                echo "</br>";
                // Number of pages required.
                $total_pages = ceil($total_records / $per_page_record);
                $pagLink = "";

                if($page>=2){
                    echo "<li class='page-item'><a class='page-link' href='tbl_suroviny.php?page=".($page-1)."'>  Predchádzajúca </a></li>";
                }

                for ($i=1; $i<=$total_pages; $i++) {
                    if ($i == $page) {
                        $pagLink .= "<li class='page-item active'><a class = 'page-link' href='tbl_suroviny.php?page=".$i."'>".$i." </a></li>";
                    }
                    else  {
                        $pagLink .= "<li class='page-item'><a class='page-link' href='tbl_suroviny.php?page=".$i."'>".$i."</a></li>";
                    }
                }
                echo $pagLink;

                if($page<$total_pages){
                    echo "<li class='page-item'><a class='page-link' href='tbl_suroviny.php?page=".($page+1)."'>  Nasledujúca </a></li>";
                }

                ?>
            </ul>
            </nav>
        </div>
    </div>
</center>
</body>
</html>