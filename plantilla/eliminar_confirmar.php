<?php 
session_start();
include 'conexion.php';
if (!empty($_POST)) {
  
  $idusuario= $_POST['idusuario'];
  $query_delete= mysqli_query($conexion,"UPDATE usuario set estatus='0' where id_usuario=$idusuario ");
  header("Location: usuarios2.php");
}

if (empty($_REQUEST['id'])) {
  header("Location: usuarios2.php");
}else{

  
  $idusuario=$_REQUEST['id'];
  $query3=mysqli_query($conexion,"SELECT nombre_usuario, correo from usuario where id_usuario=$idusuario");

  $result2=mysqli_num_rows($query3);


  if ($result2>0) {
    while ($data = mysqli_fetch_array($query3)) {
      $nombre= $data['nombre_usuario'];
      $correo= $data['correo']; 
      }
  }else{
    header("Location: usuarios2.php");
  }
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
            <li><a href="productosB.php">Productos</a></li>
            <li class="current"><a href="usuarios2.php">Usuarios</a></li>
            <li><a href="estadisticas.php">Estadisticas</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <div class="header-content header-subpages"></div>
</header>

<!--==============================content================================-->
<section id="content" >

    <div class="data_delete">
      <h2 align="center">¿Esta seguro que desea eliminar este usuario?</h2>
      <p align="center">Nombre: <span><?php echo $nombre; ?></span> </p>
      <p align="center">Correo: <span><?php echo $correo; ?></span> </p>

      <form method="post" action="">
        <input type="hidden" name="idusuario" value=" <?php  echo $idusuario ?> ">
        <a href="usuarios2.php" class="btn_cancelar">Cancelar</a>
        <input type="submit" class="btn_ok" value="Aceptar">

      </form>

    </div>


</section>

<footer>
  <p>Telefono: +54 800 559 6580 &nbsp; Email: <a href="#" class="link">GameLand@gmail.com</a></p>
</footer>
</body>
</html>
