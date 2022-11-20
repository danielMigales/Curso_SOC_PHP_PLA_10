<?php

require 'conexion.php';

//recuperar los datos de la petición
$idpaciente = filter_input(INPUT_POST, 'idpaciente', FILTER_VALIDATE_INT);

//baja en la base de datos
try {
	//validar los datos
	if (!$idpaciente) {
		throw new Exception("Se debe seleccionar un paciente\n", 10);
	}

	//DELETE en la abse  de datos
	$sql = "DELETE FROM  paciente WHERE idpaciente = $idpaciente";

	if (!mysqli_query($conexionHospital, $sql)) {
		//texto del error, código de error
		throw new Exception($conexionHospital->error, $conexionHospital->errno);
	}

	//comprobar si existe el paciente
	if ($conexionHospital->affected_rows == 0) {
		throw new Exception("El paciente no existe", 30);
	}

	//mensaje de respuesta
	$mensajes = 'Baja efectuada';

	//redirigir a consulta
	header("Location: hospital.php?consulta");
} catch (Exception $e) {
	$mensajes =  $e->getMessage();
}
