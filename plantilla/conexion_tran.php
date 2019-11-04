<?php

function insertarSQL($query){

	$mysqli= new mysqli("localhost","root","", "gameland");

	if (mysqli_connect_errno()) {
		header ("Location: http://localhost/plantilla/agregar_producto.php%20?%20exito=3");
	}

	$mysqli->autocommit(FALSE);
	$mysqli->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);

	if ($mysqli->query($query)) {

		if ($mysqli->commit()) {

			header ("Location: http://localhost/plantilla/agregar_producto.php%20?%20exito=1");
		}else {
			
			header ("Location: http://localhost/plantilla/agregar_producto.php%20?%20exito=2");
		}
		

	}else{

		$mysqli->rollback();
		header ("Location: http://localhost/plantilla/agregar_producto.php%20?%20exito=2");
	}

}


?>