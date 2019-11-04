<?php 

include 'conexion.php';

if (!empty($_POST)) 
{

  $alerta=''; 
  if (empty($_POST['nombre']) || empty($_POST['mail']))
  {
      $alerta='<p class="msg_error">Todos los campos son obligatorios</p>';

  }else{
      
      $idUsuario=$_POST['idusuario'];
      $nombre= $_POST['nombre'];
      $contra= md5($_POST['clave']);
      $email= $_POST['mail'];
      $rol=$_POST['rol'];

      $query2=mysqli_query($conexion,"SELECT * FROM usuario 
                                      where (nombre_usuario='$nombre' AND id_usuario!='$idUsuario') or (correo='$email' and id_usuario!='$idUsuario')");

      $resultado= mysqli_fetch_array($query2);

      if ($resultado > 0) {
        
        $alerta='<p class="msg_error">El correo o usuario ya existe.</p>';

      }else{

        if ($rol=="standar" ) {
          $var=2;
        }else {
          $var=1;
        }

        if (empty($_POST['clave'])) {

          $sqlupdate= mysqli_query($conexion,"UPDATE usuario
                                              set nombre_usuario='$nombre', correo='$email', tipo_usuario='$var' where id_usuario='$idUsuario' ");
        }else{
          $sqlupdate= mysqli_query($conexion,"UPDATE usuario
                                              set nombre_usuario='$nombre', correo='$email', contrasena='$contra', tipo_usuario='$var' where id_usuario='$idUsuario'");

        }

        if ($sqlupdate) {
          $alerta='<p class="msg_save">Usuario actualizado correctamente.</p>';

        }else{
          $alerta='<p class="msg_error">Error al Actualizar el usuario.</p>';

        }

      }

    }
}

//mostrar datos

if (empty($_GET['id'])) {
  
  header("Location: usuarios2.php");

}

$iduser=$_GET['id'];

$consulta= mysqli_query($conexion," SELECT u.id_usuario,u.estatus, u.nombre_usuario,u.correo,(u.tipo_usuario) as idtipo, (r.desc_tipo_usuario) as tipo 
                                    from usuario u 
                                    INNER JOIN rol r on r.tipo_usuario= u.tipo_usuario 
                                    where u.id_usuario=$iduser");

$resultado_sql= mysqli_num_rows($consulta);

if ($resultado_sql==0) {
  header("Location: usuarios2.php");
}else{

  $option='';
  while ($data=mysqli_fetch_array($consulta)) {
      
      $id_usuario =$data['id_usuario'];
      $name =$data['nombre_usuario'];
      $correo=$data['correo'];
      $estatus=$data['estatus'];
      $idtipo=$data['idtipo'];
      $tipo=$data['tipo'];

      if ($idtipo==1) {
        $option= '<option value="'.$idtipo.'"select>'.$tipo.'</option>';
      }elseif ($idtipo==2) {
        $option= '<option value="'.$idtipo.'"select>'.$tipo.'</option>';
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
            <li><a href="index2.php">Home</a></li>
            <li><a href="productosB.php">Productos</a></li>
            <li ><a href="usuarios2.php">Usuarios</a></li>
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
      <h2 align="center" class="p3">Editar Usuario:</h2>
      <hr class="registro1">
      <div class="alert" align="center"><?php echo isset($alerta) ? $alerta : '' ?></div>

      <form class="registro1" action="" method="post">
        <input type="hidden" name="idusuario" id="idusuario" value="<?php echo"$id_usuario" ?>">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo "$name" ?>">
        <label for="clave">Nueva Contraseña</label>
        <input type="text" name="clave" id="clave" value="">
        <label for="mail">Correo</label>
        <input type="text" name="mail" id="mail" value="<?php echo "$correo" ?>">
        <label for="rol" >Tipo usuario</label>

        <?php
        $query_rol=mysqli_query($conexion,"SELECT * FROM rol");
        $result_rol=mysqli_num_rows($query_rol);

        ?>

        <select name="rol" id="rol" class="notItemOne">
          <?php
              echo $option; 
              if ($result_rol>0) {
                while ($rol=mysqli_fetch_array($query_rol)) {

                  
          ?>

          <option value="<?php echo $rol["desc_tipo_usuario"] ?>"> <?php echo $rol["desc_tipo_usuario"] ?> </option>


          <?php 
             
                }
              }
          ?>
        </select>
        <br>
        <input type="submit" value="Actualizar Usuario" class="save1">
      </form>
    </div>
</section>
<!--==============================footer=================================-->
<footer>
  <p>Telefono: +54 800 559 6580 &nbsp; Email: <a href="#" class="link">GameLand@gmail.com</a></p>
</footer>
</body>
</html>
