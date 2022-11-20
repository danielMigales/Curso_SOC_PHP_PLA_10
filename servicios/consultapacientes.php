<?php
//realizar la consulta

require 'conexion.php';

try {
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

	//incorporar el json de respuesta
	$respuesta = ['30', $pacientes];
} catch (Exception $e) {
	$codigoError = $e->getCode();
	$mensajeError = $e->getMessage();
	$respuesta =  [$codigoError, $mensajeError];
}

echo json_encode($respuesta);
