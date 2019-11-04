<?php 
session_start();
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
          <ul class="menu" >
            <li><a href="index2.php">Home</a></li>
            <li><a href="productos2B.php">Productos</a></li>
            <li class="current"><a href="usuarios2B.php">Usuarios</a></li>
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
    <?php

    $busqueda1=strtolower($_REQUEST['busqueda']);

    if (empty($busqueda1)) {
      header("location:usuarios.php");
    }

    ?>
    <h2 align="center" class="p3">Lista de Productos</h2>

    <table class="buscador">
      <tr>
        <td>
    <form method="get" action="buscar_usuario.php" class="form_search" >
          <input  type="text" name="busqueda" id="busqueda" placeholder="" value="<?php echo $busqueda1; ?>">
          <input type="submit" value="Buscar" class="boton_search">
          
    </form>          

        </td>
      </tr>
    </table>


      <div align="center" >
        <table >
          <tr class="columnas">
            <th><strong>ID usuariio</strong></th>
            <th><strong>Nombre</strong></th>
            <th><strong>Correo</strong></th>
            <th><strong>Tipo Usuario</strong></th>
            <th><strong>Acciones</strong></th>
          </tr>

          <?php

          include ("conexion.php");

          $sql_contador= mysqli_query($conexion,"SELECT COUNT(*) as cantidad from usuario WHERE nombre_usuario LIKE '%$busqueda1%'");
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


          $sql="SELECT * FROM usuario WHERE nombre_usuario LIKE '%$busqueda1%' LIMIT $desde,$por_pagina";
          $resultados=mysqli_query($conexion,$sql)or die(mysqli_error($conexion));

          while($consulta = mysqli_fetch_array($resultados)) 
          { 
            echo "<tr>";
            echo "<th>".$consulta['id_usuario']."</th>";
            echo "<th>".$consulta ['nombre_usuario']."</th>";
            echo "<th>".$consulta ['correo']."</th>";
            echo "<th>".$consulta ['tipo_usuario']."</th>";
            echo "<th></th>";
            echo "</tr>";
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