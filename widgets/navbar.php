<div class="container-fluid">
    <div class="jumbotron-fluid">
        <h1 class="display-4" style="text-align: center">Restaurace</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar nav">
                <li class="nav-item"><a class="nav-link" href="../index.php">Domov</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="../tbl_suroviny.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Suroviny
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../tbl_suroviny.php">Vkladanie surovin</a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="../zoznam_receptov.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Recepty</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../new_recept.php">Vytvorit novy recept</a>
                    </div>
                </li>
            </ul>
        </nav>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Domov</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $bc_nazov?></li>
            </ol>
        </nav>
    </div>