<?php 
include ('public/header.php');
include ('public/sidebar.php');
include ('public/top.php');
include ('public/footer.php');
$id = $_GET['id'];
$sql = "SELECT * FROM inventario WHERE categoria = $id"; 
$result = mysqli_query($DBcon,$sql); 

$nombre ="";
$sql1 = "SELECT * FROM categorias WHERE id = $id"; 
$result1 = mysqli_query($DBcon,$sql1);
while($row = mysqli_fetch_array($result1)){
$nombre =  $row['nombre'];
}

$subcategoria ="";
$sql2 = "SELECT * FROM subcategorias WHERE categoria = $id"; 
$result2 = mysqli_query($DBcon,$sql2);
$titulo = "Productos para $nombre";
?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo"$titulo"; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <strong>Subcategorias </strong>
            </div>
            <div class="card-body">
            <?php 
                               while($row = mysqli_fetch_array($result2)){
                                $nombre =  $row['nombre'];
                                $id_subcategoria =  $row['id'];
                                
                                echo"<a href='subcategoria.php?id=$id_subcategoria' class='btn btn-outline-primary'>$nombre</a>";
                            }
            ?>
            </div>
        </div><!-- /# card -->


        <div class="content mt-3">
            <?php 
                while($row = mysqli_fetch_array($result)){
                    $id = $row['id'];
                    $nombre = $row['nombre']; 
                    $desc = $row['descripcion']; 
                    $precio = $row['precio']; 
                    $imagen = $row['imagen']; 

echo"<div class='col-md-4'>
        <div class='card'>
        <div class='card-header'>
        <i class='fa fa-circle'></i><strong class='card-title pl-2'>$nombre</strong>
        </div>
        <div class='card-body'>
        <div class='mx-auto d-block'>
        <img class=' mx-auto d-block' src='$imagen' width='350' height='400' alt='$desc'>
        <div class='location text-sm-center'><i class='fa fa-circle'></i> $desc</div>
        </div>
        <hr>
        <div class='card-text text-sm-center'>
        <a href='#'><i class='fa fa-dollar pr-1'> $precio</i></a>
        <a href='addcart.php?id=$id' class='btn btn-outline-primary'><i class='fa fa-cart'></i>Agregar al carrito</a>
        </div>
        </div>
        </div>
        </div>
";

                }
            ?>                            
        </div> <!-- .content -->
    </div><!-- /#right-panel -->




