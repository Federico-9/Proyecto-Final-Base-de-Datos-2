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

    header('location: http://localhost/plantilla/stock2B.php');


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
<section id="content" >


    <h2 align="center" class="p3">Lista de Productos Tienda 2:</h2>

    <table class="buscador">
      <tr>
        <td>
    <form method="get" action="buscar_producto.php" class="form_search" >
          <input  type="text" name="busqueda" id="busqueda" placeholder=" Nombre Producto">
          <input type="submit" value="Buscar" class="boton_search">
          
    </form>          

        </td>
      </tr>
    </table>


      <div align="center" >
        <table >
          <tr class="columnas">
            <th><strong>Producto</strong></th>
            <th><strong>Precio</strong></th>
            <th><strong>Tienda2</strong></th>
          </tr>

          <?php

          include ("conexion.php");

          $sql_contador= mysqli_query($conexion, "SELECT COUNT(*) as cantidad from producto");
          $cant=mysqli_fetch_array($sql_contador);
          $total= $cant['cantidad'];


           $por_pagina=5;

           if (empty($_GET['pagina'])) {
             
             $pagina=1;

           }else{

             $pagina=$_GET['pagina'];
           }

          $desde= ($pagina-1) * $por_pagina;
          $total_paginas= ceil($total/$por_pagina);


          $sql="SELECT * FROM producto LIMIT $desde,$por_pagina";
          $resultados=mysqli_query($conexion,$sql)or die(mysqli_error($conexion));

          while($consulta = mysqli_fetch_array($resultados)) 
          { 
            if ($consulta ['stock_tienda_2']!=0) {
            echo "<tr>";
            echo "<th>".$consulta['nombre_producto']."</th>";
            echo "<th>".$consulta ['precio_producto']."</th>";
            echo "<th>".$consulta ['stock_tienda_2']."</th>";
            echo "</tr>";
            }

          }
          ?>

        </table>
</div>

<div class="paginador" >

      <ul>

       <?php 
       if ($pagina !=1) {
      
       ?> 
        <li><a href="?pagina=<?php echo 1 ?>"><<</a></li>
        <li><a href="?pagina=<?php echo $pagina-1 ?>"><</a></li>
<?php
       }
    for ($i=1; $i <= $total_paginas; $i++) { 

        if ($i==$pagina) {

          echo '<li class="pageselected">'.$i.'</li>';
          
        }else{

          echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
        }
        
    }

    if ($pagina != $total_paginas) {

?>
        <li><a href="?pagina=<?php echo $pagina+1 ?>">></a></li>
        <li><a href="?pagina=<?php echo $total_paginas ?>">>></a></li>

      <?php } ?>

      </ul>

</div>




</section>
<!--==============================footer=================================-->
<footer>
  <p>Telefono: +54 800 559 6580 &nbsp; Email: <a href="#" class="link">GameLand@gmail.com</a></p>
</footer>
</body>
</html>