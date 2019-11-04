<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>GameLand</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<script src="js/jquery-1.7.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/FF-cash.js"></script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
<![endif]-->
</head>
<body>
<!--==============================header=================================-->
<header>
  <div class="main">
    <div class="wrap">
    <div class="wrap">
      <h1><img src="images/portada.png" alt="" width="350" height="100"></h1>
      <h1><a href="salir.php"><img src="images/puerta.png"  width="75"  height="75" title="salir"></a></h1>
      <h1><img src="images/user.png"  width="75"  height="75" title="salir"></h1>
      <div class="tooltips">   
        <h2 class="login">Bienvenido: <?php  echo $_SESSION['nombre']; ?></h2>
      </div> 
    </div>
    </div>
    <div class="nav-shadow">
      <div>
        <nav>
          <ul class="menu">
            <li ><a href="index2.php">Home</a></li>
            <li><a href="productosB.php">Productos</a></li>
            <li><a href="usuarios2.php">Usuarios</a></li>
            <li class="current"><a href="estadisticas2.php">Estadisticas</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>
<!--==============================content================================-->
<section id="content">

<?php
include ("conexion.php");

$id_v=$_GET['id'];

$nombre=$_GET['n'];

?>



  <h2 align="center" class="p3">La venta N° <?php echo "$id_v"; ?> del cliente <?php echo "$nombre"; ?> contiene:</h2>

  <div align="center" >
        <table >
          <tr class="columnas">
            <th><strong>Nombre producto</strong></th>
            <th><strong>Precio</strong></th>
            <th><strong>Cantidad</strong></th>
          </tr>

          <?php

          
          $sql="SELECT * FROM detalle_venta where  id_venta=$id_v";
          $resultados=mysqli_query($conexion,$sql)or die(mysqli_error($conexion));

          while($consulta = mysqli_fetch_array($resultados)) 
          { 
            echo "<tr>";

            $nombre_producto=$consulta['id_producto'];

            $sql_nombre="SELECT nombre_producto as namep from producto where id_producto=$nombre_producto ";
            $resultado=mysqli_query($conexion,$sql_nombre)or die(mysqli_error($conexion));
            $consulta_nombre=mysqli_fetch_array($resultado);
            $nombre_p=$consulta_nombre['namep'];

            echo "<th>".$nombre_p."</th>";


            echo "<th>".$consulta['precio_venta']."</th>";
            
            echo "<th>".$consulta ['cantidad_producto']."</th>";

          }
          ?>

        </table>
</div>


</section>


<!--==============================footer=================================-->
<footer>
  <p>Telefono: +54 800 559 6580 &nbsp; Email: <a href="#" class="link">GameLand@gmail.com</a></p>
</footer>
</body>