<?php

//ALTA DE PACIENTE

require 'conexion.php';

//recuperar los datos de la petición
$nif = trim(addslashes(filter_input(INPUT_POST, 'nif')));
$nombre = trim(addslashes(filter_input(INPUT_POST, 'nombre')));
$apellidos = trim(addslashes(filter_input(INPUT_POST, 'apellidos')));
$fechaingreso = trim(addslashes(filter_input(INPUT_POST, 'fechaingreso')));

try {
	//validar los datos
	$mensaje = '';

	if (!$nif) {
		$mensaje .= "Nif obligatorio<br>";
	}
	if (!$nombre) {
		$mensaje .= "Nombre obligatorio<br>";
	}
	if (!$apellidos) {
		$mensaje .= "Apellidos obligatorios<br>";
	}
	if (!$fechaingreso) {
		$mensaje .= "Fecha ingreso obligatoria<br>";
	}
	if ($mensaje != '') {
		throw new Exception($mensaje, 10);
	}

	//alta en la base de datos
	//confeccionar INSERT
	$sql = "INSERT INTO paciente VALUES (NULL, '$nif', '$nombre', '$apellidos', '$fechaingreso', NULL)";
	if (!mysqli_query($conexionHospital, $sql)) {
		//comprobación de errores del sgbd
		//esto no funciona en mi version
		if ($conexionHospital->errno == 1062) {
			throw new Exception("El paciente ya existe en la base de datos", 20);
		}
		//texto del error, código de error
		throw new Exception($conexionHospital->error, $conexionHospital->errno);
	} else {
		throw new Exception('Alta efectuada', 30);
	}
} catch (Exception $e) {
	$codigoError = $e->getCode();
	$error =  $codigoError . $e->getMessage();
	//como el error de duplicado salta siempre ignorando el if anterior le añado este mensaje
	if ($codigoError == 1062) {
		$error .= "\nEl paciente ya existe en la base de datos";
	}
}
//mensaje de respuesta
echo $error;
