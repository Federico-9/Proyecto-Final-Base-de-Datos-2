<?php 

if (!empty($_POST)) {

$alerta=''; 
if (empty($_POST['nombre']) || empty($_POST['clave']) || empty($_POST['mail']))
{
    $alerta='<p class="msg_error">Todos los campos son obligatorios</p>';

}else{
    include 'conexion.php';
    $nombre= $_POST['nombre'];
    $clave= md5($_POST['clave']);
    $email= $_POST['mail'];

    $query2=mysqli_query($conexion,"SELECT * FROM usuario where nombre_usuario= '$nombre' or correo = '$email'");
    $resultado= mysqli_fetch_array($query2);

    if ($resultado > 0) {
      
      $alerta='<pclass="msg_error">El correo o usuario ya existe.</p>';

    }else{
      $tipo=2;
      $estatu=1;

      $query_insert= mysqli_query($conexion,"INSERT INTO usuario(nombre_usuario,tipo_usuario,contrasena,estatus,correo)
        values('$nombre','$tipo','$clave','$estatu','$email')");

      if ($query_insert) {
        $alerta='<p class="msg_save">Usuario creado correctamente.</p>';
      }else{
        $alerta='<p class="msg_error">Error al crear el usuario.</p>';

      }

    }

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
      <h1><img src="images/portada.png" alt="" width="375" height="100"></h1>
    </div>
    <div class="nav-shadow">
      <div>
        <nav>
          <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li ><a href="usuarios.php">Usuarios</a></li>
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
    <div class="form_register">
      <h2 align="center" class="p3">Registro Usuario:</h2>
      <hr class="registro1">
      <div class="alert" align="center"><?php echo isset($alerta) ? $alerta : '' ?></div>
      <form class="registro1" action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" >
        <label for="clave">Contraseña</label>
        <input type="password" name="clave" id="clave" >
        <label for="mail">Correo</label>
        <input type="text" name="mail" id="mail" >
        <input type="submit" value="Crear Usuario" class="save1">
      </form>
    </div>
</section>
<!--==============================footer=================================-->
<footer>
  <p>Telefono: +54 800 559 6580 &nbsp; Email: <a href="#" class="link">GameLand@gmail.com</a></p>
</footer>
</body>
</html>
