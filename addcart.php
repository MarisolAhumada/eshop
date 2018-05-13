<?php
session_start();
include ('db/dbcon.php');
if (isset($_SESSION['userSession'])=="") {
	header("Location: login.php");
}
else{
    $user_id = $_SESSION['userSession'];
    $id = $_GET['id'];
    $prod = "";
    $sql = "SELECT * FROM inventario WHERE id = $id"; 
    $result = mysqli_query($DBcon,$sql);
    while($row = mysqli_fetch_array($result)){
        $prod = $row['id'];
        $user_id = $_SESSION['userSession'];
    }
    $sql1 = "INSERT INTO carrito(producto,user_id) VALUES('$prod','$user_id')"; 
    if ($DBcon->query($sql1)){
        echo "producto agregado  <a href='carrito.php'>Ver carrito</a>";
    }
}

?>