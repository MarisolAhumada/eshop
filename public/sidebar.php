<?
include ('db/dbcon.php');
$sql = "SELECT * FROM categorias"; 
$result = mysqli_query($DBcon,$sql); 
?>
<body>
        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">ESHOP</a>
                <a class="navbar-brand hidden" href="./">ESHOP</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-home"></i>Inicio </a>
                    </li>
                    <?php 
                    echo "<h3 class='menu-title'>Categorias</h3><!-- /.menu-title -->
                    <li class='menu-item-has-children dropdown'>
                    ";
                               while($row = mysqli_fetch_array($result)){
                                $id = $row['id'];
                                $nombre = $row['nombre']; 
                                //echo'<option value="'.$id.'">'.$nombre.'</option>';
                                echo"  <a href='categoria.php?id=$id' aria-haspopup='true' aria-expanded='false'> <i class='menu-icon fa fa-square'></i>$nombre<Table></Table></a>";
                            }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
