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

$id_emple=$_GET['id'];

$name=$_GET['n'];

?>



  <h2 align="center" class="p3">Ventas del Empleado: <?php echo "$name"; ?> </h2>

  <div align="center" >
        <table >
          <tr class="columnas">
            <th><strong>ID Venta</strong></th>
            <th><strong>Fecah venta</strong></th>
            <th><strong>Hora venta</strong></th>
            <th><strong>Tienda</strong></th>
            <th><strong>Cliente</strong></th>
            <th><strong>Acción</strong></th>
          </tr>

          <?php

          
          $sql="SELECT * FROM venta where  id_empleado=$id_emple";
          $resultados=mysqli_query($conexion,$sql)or die(mysqli_error($conexion));

          while($consulta = mysqli_fetch_array($resultados)) 
          { 
            echo "<tr>";

            echo "<th>".$consulta['id_venta']."</th>";

            $id_final=$consulta['id_venta'];		

            echo "<th>".$consulta['fecha_venta']."</th>";
            
            echo "<th>".$consulta ['hora_venta']."</th>";

            echo "<th> Gameland".$consulta ['id_tienda']."</th>";

            $id_client=$consulta ['id_cliente'];

            $sql_nombre="SELECT nombre_cliente as namec from cliente where id_cliente=$id_client ";
            $resultado=mysqli_query($conexion,$sql_nombre)or die(mysqli_error($conexion));
            $consulta_nombre=mysqli_fetch_array($resultado);
            $nombre_final=$consulta_nombre['namec'];

            echo "<th>".$nombre_final."</th>";

            echo "<th>"

            ?>

            
            <a href=" detalle_venta.php? id= <?php echo($id_final) ?>&n=<?php echo($nombre_final) ?> " class=link_modificar">Ver mas</a>

            <?php

            echo "</th></tr>";

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