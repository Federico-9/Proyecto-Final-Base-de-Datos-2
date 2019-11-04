<?php 
session_start();
include 'conexion.php';
require_once "conexion_tran.php";

if (!empty($_POST)) {

    $producto=$_POST['producto'];
    $precio= $_POST['precio'];
    $tienda1=$_POST['tienda1'];
    $tienda2=$_POST['tienda2'];
    $tienda3=$_POST['tienda3'];
    $tipo=$_POST['tipo'];

    if ($tipo=='procesador') {
      $contador=1;
    }elseif ($tipo=='plca base') {
      $contador=2;
    }elseif ($tipo=='memoria ram') {
      $contador=3;
    }elseif ($tipo=='disco duro') {
      $contador=4;
    }elseif ($tipo=='palca de video') {
      $contador=5;
    }elseif ($tipo=='fuente de alimentacion') {
      $contador=6;
    }elseif ($tipo=='gabinete') {
      $contador=7;
    }elseif ($tipo=='teclado') {
      $contador=8;
    }elseif ($tipo=='mouse') {
      $contador=9;
    }

  
    $query="INSERT INTO producto  (nombre_producto, precio_producto, tipo_producto , stock_tienda_1, stock_tienda_2, stock_tienda_3)
                            VALUES('$producto','$precio','$contador','$tienda1','$tienda2','$tienda3')";

    insertarSQL($query);         

}

$alerta=''; 

        if ($_GET['exito']==1) {

          $alerta='<p class="msg_save">Prodcuto añadido con exito.</p>';

        }elseif ($_GET['exito']==2){

          $alerta='<p class="msg_error">Error al añadir producto.</p>';

        }elseif ($_GET['exito']==3){

          $alerta='<p class="msg_error">Error en la conexion.</p>';

        }

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
      <h1><img src="images/portada.png" alt="" width="350" height="100"></h1>
      <h1><a href="salir.php"><img src="images/puerta.png"  width="75"  height="75" title="salir"></a></h1>
      <h1><img src="images/user.png"  width="75"  height="75" title="salir"></h1>
      <div class="tooltips">   
        <h2 class="login">Bienvenido: <?php  echo $_SESSION['nombre']; ?></h2>
      </div>
    </div>
    <div class="nav-shadow">
      <div>
        <nav>
          <ul class="menu">
            <li><a href="index2.php">Home</a></li>
            <li><a href="productos2.php">Productos</a></li>
            <li ><a href="usuarios2.php">Usuarios</a></li>
            <li><a href="estadisticas2.php">Estadisticas</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <div class="header-content header-subpages"></div>
</header>
<!--==============================content================================-->
<section id="content" >
    <div class="form_register">
      <h2 align="center" class="p3">Añadir Producto:</h2>
      <hr class="registro1">
      <div class="alert" align="center"><?php echo isset($alerta) ? $alerta : '' ?></div>

      <form class="registro1" action="" method="post">
        <label for="producto">Nombre Producto</label>
        <input type="text" name="producto" id="producto" >
        <label for="prico">Precio</label>
        <input type="number" name="precio" id="precio" >
        <label for="tienda1">Stock Tienda1</label>
        <input type="number" name="tienda1" id="tienda1" >
        <label for="tienda2">Stock Tienda2</label>
        <input type="number" name="tienda2" id="tienda2" >
        <label for="mail">Stock Tienda3</label>
        <input type="number" name="tienda3" id="tienda3" >
        <label for="tipo">Tipo Producto</label>

        <?php
        $query_tipo=mysqli_query($conexion,"SELECT * FROM tipo_producto");
        $result_tipo=mysqli_num_rows($query_tipo);

        ?>

        <select name="tipo" id="tipo" class="notItemOne">
          <option disabled selected value></option>
          <?php
              echo $option; 
              if ($result_tipo>0) {
                while ($tipo=mysqli_fetch_array($query_tipo)) {

                  
          ?>

          <option value="<?php echo $tipo["desc_tipo_producto"]; ?>"> <?php echo $tipo["desc_tipo_producto"] ?> </option>


          <?php 
             
                }
              }
          ?>
        <br>
        <input type="submit" value="Añadir Producto" class="save1">
      </form>
    </div>
</section>
<!--==============================footer=================================-->
<footer>
  <p>Telefono: +54 800 559 6580 &nbsp; Email: <a href="#" class="link">GameLand@gmail.com</a></p>
</footer>
</body>
</html>