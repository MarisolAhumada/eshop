<?php 
session_start();
if (isset($_SESSION['userSession'])=="") {
	header("Location: login.php");
}
require __DIR__  . '/vendor/autoload.php';
include ('public/header.php');
include ('public/sidebar.php');
include ('public/top.php');
include ('public/footer.php');
include ('db/dbcon.php');
$titulo = "Mi carrito";
$user_id = $_SESSION['userSession'];
$sql = "SELECT carrito.id as id, inventario.id as prod, inventario.nombre as nombre, inventario.precio as precio FROM carrito join inventario on inventario.id = carrito.producto WHERE user_id = $user_id"; //inventario en general
$result = mysqli_query($DBcon,$sql); //inventario en general
if(isset($_POST['eliminar'])) {
    $id = strip_tags($_POST['id']);
    $query = "DELETE FROM carrito WHERE id = $id";
    if ($DBcon->query($query)) {
      $msg_eliminar = "<div class='alert alert-success'>
         <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Elemento eliminado correctamente <a href=carrito.php>  Actualizar</a>.
        </div>";
     }else {
      $msg_eliminar = "<div class='alert alert-danger'>
         <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Ocurrio un error, vuelva a intentarlo.  
        </div>";
     }
} 
?>
<?php  
  MercadoPago\SDK::setClientId("794865369556013");
  MercadoPago\SDK::setClientSecret("swoipxxQzVFyU3A4q6PjHjMMxFuE6qkK");
?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo $titulo ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"><?php echo $titulo ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        

            <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Elementos en su carrito</strong>
                        </div>
                        <div class="card-body">
                        <?php if (isset($msg_eliminar)) {
                            echo $msg_eliminar;
                            }
                            ?>
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Id de producto</th>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Precio</th>
                                  <th scope="col">Opciones</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              $total = 0;
                              $id;
                              $descripcion = '';
                                    while($row = mysqli_fetch_array($result)){
                                        $precio = $row['precio'];
                                        $id = $row['id'];
                                        $descripcion .= $row['nombre'];
                                        $descripcion .= ', ';
                                    echo "
                                    <form method='post' name='eliminar'>
                                    <tr>
                                    <td><input type='text' id=nombre' name='id' placeholder='id' value='".$row['id']."' readonly> </td>
                                        <td>".$row['nombre']."</td>
                                        <td>$".$row['precio']."</td>
                                        
                                        
                                    ";
                                    $total += $precio;
                                    echo"
                                    <td><button type='submit' class='btn btn-danger' name='eliminar'>
                                    <i class='fa fa-minus'></i> Quitar
                                    </button></form><td>";
                                    echo"</td>
                                    </tr>";
                                    }

                                    $rowcount=mysqli_num_rows($result);
                                    if ($rowcount > 0) {
                                        $preference = new MercadoPago\Preference();
                                        # Create an item object
                                        $item = new MercadoPago\Item();
                                        $item->id = "$id";
                                        $item->title = "$descripcion";
                                        $item->quantity = 1;
                                        $item->currency_id = "MXN";
                                        $item->unit_price = $total;
                                        # Create a payer object
                                        $payer = new MercadoPago\Payer();
                                        $payer->email = "daniel.nuld@gmail.com";
                                        # Setting preference properties
                                        $preference->items = array($item);
                                        $preference->payer = $payer;
                                        # Save and posting preference
                                        $preference->save();
                                        
                                     echo"<a href='$preference->init_point' class='btn btn-warning' role='button' ><center>Proceder al pago</center></a>";
                                      }

                                    
                                ?>
                              </tbody>
                            </table>
                            <?php echo " Total del pedido: $ $total"; ?>
                        </div>
                    </div>
            </div>
            </div>
            