<div class="container-fluid">
    <div class="jumbotron-fluid">
        <h1 class="display-4" style="text-align: center"><?php echo $lang["TITLE"]; ?></h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../tbl_suroviny.php">Suroviny</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../zoznam_receptov.php">Recepty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../jedalny_listok.php">Jedalne listky</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../sklad.php">Sklad</a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php"><?php echo $lang["HOME"]?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $bc_nazov?></li>
            </ol>
        </nav>
    </div>