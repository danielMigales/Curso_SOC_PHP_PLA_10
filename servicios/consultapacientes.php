<?php
	//realizar la consulta

	require 'conexion.php';
	
	//prepare sentecia SQL
	$sql = "SELECT * FROM paciente ORDER BY nombre, apellidos";

	if (!$consulta = mysqli_query($conexionHospital, $sql)) {
		//control de errores
		throw new Exception($conexionHospital->error, $conexionHospital->errno);
	}

	//controlar si la consulta devuelve alguna fila
	if ($consulta->num_rows == 0) {
		throw new Exception("No hay datos", 20);
	}

	//extraer los datos 
	$pacientes = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
	
	$respuesta = ['00', $pacientes];

	//$respuesta = [$codigo_error, $mensaje_error];

	echo json_encode($respuesta);
	
?>