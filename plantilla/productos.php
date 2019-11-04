<?php 

$alert='';
include 'conexion.php';
session_start();
if (!empty($_POST)) {
 
if (empty($_POST['nombre']) || empty($_POST['clave']))
{
    $alert='ingrese su usuario y clave';
}else{

  $user = $_POST['nombre'];
  $pass = md5($_POST['clave']);

  $sql2="SELECT * FROM usuario WHERE nombre_usuario='$user' AND contrasena='$pass' AND estatus=1";

  $newquery= mysqli_query($conexion,$sql2)or die(mysqli_error($conexion));
  $result=mysqli_num_rows($newquery);

  if($result >0){

    $data = mysqli_fetch_array($newquery);
    print_r($data);
    $_SESSION['active'] =true;
    $_SESSION['iduser'] =$data['id_usuario'];
    $_SESSION['nombre'] =$data['nombre_usuario'];
    $_SESSION['pass'] =  $data['contrasena'];
    $_SESSION['correo'] =$data['correo'];
    $_SESSION['tipo']=$data['tipo_usuario'];

    header('location: http://localhost/plantilla/productosB.php');


  }else{

    $alert='El usuario o contraseña estan incorrectas';
    session_destroy();
    
   }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>GameLand | Productos</title>
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
        <div class="tooltips"><h2 class="login"><a href="registro.php">Registrarse</a>-Log in:</h2>
        <form action="" method="post">
          <input type="text" class="log" name="nombre" placeholder="usuario"> 
          <input type="password" class="log" name="clave" placeholder="contraseña"> 
          <input type="submit" class="log1" value="ingresar">
          <div><?php echo isset($alert) ? $alert : '';  ?></div>
        </form>
      </div>
    </div>
    <div class="nav-shadow">
      <div>
        <nav>
          <ul class="menu" >
            <li><a href="index.php">Home</a></li>
            <li class="current"><a href="productos.php">Productos</a></li>
            <li><a href="usuarios.php">Usuarios</a></li>
            <li><a href="estadisticas.php">Estadisticas</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <div class="header-content header-subpages"></div>
</header>
<!--==============================content================================-->
<section id="content" class="content-subpages">
  <div>
    <div class="wrap">
      <div class="col-3 border-2 block-2">
        <h2 class="p3">Nuevos Productos</h2>
        <div class="wrap"> <img src="images/2080ti.jpg" width="190" height="165" alt="" class="img-indent img-radius">
          <div class="extra-wrap">
            <p class="p4">Nueva RTX 2080ti</p>
            <p>Lo último de tope de gama que ha puesto a la venta el fabricante de tarjetas gráfica NVIDIA.La nueva arquitectura Turing trae consigo nuevas tecnologias como DLSS y RayTraicing. </p>
          </div>
        </div>
      </div>
      <div class="col-4 block-2">
        <div class="wrap top-4"> <img src="images/2060.jpg" width="190" height="165" alt="" class="img-indent img-radius">
          <div class="extra-wrap">
            <p class="p4">Nueva RTX 2060</p>
            <p>Una de las mejoeres tarjetas gráficas del momento, por su relación calidad precio. Disfruta de las últimas tecnologias de NVIDIA en esta nueva GPU de gama media-alta.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="wrap top-5">
      <div class="col-1 border-2">
        <h2 class="p3">Productos mas populares:</h2>
        <div class="wrap block-3">
          <div class="wrap"> <img src="images/ryzen3.png" width="75" height="75" alt="" class="img-indent img-radius">
            <div class="extra-wrap">
              <p class="p4">Amd Ryzen R3 2200g</p>
              <p>Una APU excelente:4 nucleos, 4 hilos y con una gráfica integrada excelente para jugar eSports y juegso no muy demandanes graficamente.</p>
            </div>
          </div>
          <div class="wrap last"> <img src="images/ryzen5.png" width="75" height="75" alt="" class="img-indent img-radius">
            <div class="extra-wrap">
              <p class="p4">Amd Ryzen R5 2400g</p>
              <p>Excelente Apu, mejora algunos aspectos de su modelo anterior, el doble de hilos, mejores gráficos integrados y mas frecuencias en el procesador.</p>
            </div>
          </div>
        </div>
        <div class="wrap block-3 top-6">
          <div class="wrap"> <img src="images/1050.jpg" width="75" height="75" alt="" class="img-indent img-radius">
            <div class="extra-wrap">
              <p class="p4">GTX 1050ti</p>
              <p>Sit amet, consectetuer adipiscing elitsed diam nonummy nibh.</p>
            </div>
          </div>
          <div class="wrap last"> <img src="images/8100.jpg" width="75" height="75" alt="" class="img-indent img-radius">
            <div class="extra-wrap">
              <p class="p4">Intel i3 8100</p>
              <p>Sit amet, consectetuer adipiscing elitsed diam nonummy nibh.</p>
            </div>
          </div>
        </div>
        <div align="center"><a href="productos2.php"><button type="submit" class="log1" >Ver mas</button></a></div></div>
      <div class="col-2">
        <h2 class="p2">Tipos de productos:</h2>
        <ul class="list-1">
          <li>Procesadores</li>
          <li>Placas base</li>
          <li>RAM</li>
          <li>Disco Duro</li>
          <li>Placas de video</li>
          <li>Fuentes de alimentación</li>
          <li>gabinetes</li>
        </ul>
        <a href="productos2.php" class="log1">Todos los Productos</a> </div>
    </div>
  </div>
</section>
<!--==============================footer=================================-->
<footer>
  <p>Telefono: +54 800 559 6580 &nbsp; Email: <a href="#" class="link">GameLand@gmail.com</a></p>
</footer>
</body>
</html>
