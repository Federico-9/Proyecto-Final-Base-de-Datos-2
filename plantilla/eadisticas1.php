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
      <h1><img src="images/portada.png" alt="" width="375" height="100"></h1>
      <div class="tooltips"><h2 class="login"><a href="registro.php">Registrarse</a>-Log in:</h2>
        <form class="login" action="" method="post">
          <input type="text" class="log" name="nombre" placeholder="usuario"> 
          <input type="password" class="log" name="clave" placeholder="contraseña"> 

          <input type="submit" class="log1" value="Ingresar">
          <div><?php echo isset($alert) ? $alert : '';  ?></div>
        </form>
      </div>
      
    </div>
    <div class="nav-shadow">
      <div>
        <nav>
          <ul class="menu">
            <li ><a href="index.php">Home</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="usuarios.php">Usuarios</a></li>
            <li class="current"><a href="estadisticas.php">Estadisticas</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>
<!--==============================content================================-->
<section id="content">

  <h2 align="center" class="p3">Estadisticas</h2>

  



<div align="center" >
        <table >
          <tr class="columnas">
            <th><strong>ID Empleado</strong></th>
            <th><strong>Nombre</strong></th>
            <th><strong>Ventas</strong></th>
            <th><strong>Acción</strong></th>
          </tr>

          <?php

          include ("conexion.php");


          $sql_contador= mysqli_query($conexion, "SELECT COUNT(*) as cantidad from empleado ");
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


          $sql="SELECT * FROM empleado LIMIT $desde,$por_pagina ";
          $resultados=mysqli_query($conexion,$sql)or die(mysqli_error($conexion));

          while($consulta = mysqli_fetch_array($resultados)) 
          { 
            echo "<tr>";
            echo "<th>".$consulta['id_empleado']."</th>";
            $emple=$consulta['id_empleado'];
            echo "<th>".$consulta ['nombre_empleado']."</th>";

            $sql_consulta1="SELECT COUNT(*) as total from venta where id_empleado=$emple ";
            $resultado=mysqli_query($conexion,$sql_consulta1)or die(mysqli_error($conexion));
            $consulta1=mysqli_fetch_array($resultado);
            $total1=$consulta1['total'];

            echo "<th>".$total1."</th>";

            echo "<th>";

            if ($_SESSION['tipo']==1) {
            ?>

            <a href="ventas " class=link_modificar">Ver mas</a>

            <?php
            }


            echo "</th></tr>";

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



</section>
<!--==============================footer=================================-->
<footer>
  <p>Telefono: +54 800 559 6580 &nbsp; Email: <a href="#" class="link">GameLand@gmail.com</a></p>
</footer>
</body>
</html>