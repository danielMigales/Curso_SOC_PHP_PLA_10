<?php
	if (isset($_POST['modificacion'])) {
		//recuperar los datos de la petición
		$idpaciente = filter_input(INPUT_POST, 'idpaciente', FILTER_VALIDATE_INT);
		$nif = trim(addslashes(filter_input(INPUT_POST, 'nif')));
		$nombre = trim(addslashes(filter_input(INPUT_POST, 'nombre')));
		$apellidos = trim(addslashes(filter_input(INPUT_POST, 'apellidos')));
		$fechaingreso = trim(addslashes(filter_input(INPUT_POST, 'fechaingreso')));
		$fechaalta = trim(addslashes(filter_input(INPUT_POST, 'fechaalta')));

		//validar los datos
		try {
			$mensaje = '';
			if (!$idpaciente) {
				throw new Exception("Se debe seleccionar un paciente\n", 10);
			}
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
			
			//UPDATE en la abse  de datos
			$sql = "UPDATE paciente SET nif='$nif', nombre='$nombre', apellidos='$apellidos', fechaingreso='$fechaingreso', fechaalta='$fechaalta' WHERE idpaciente = $idpaciente";

			if (!mysqli_query($conexionHospital, $sql)) {
				//comprobación de errores del sgbd
				if ($conexionHospital->errno == 1062) {
					throw new Exception("El paciente ya existe en la base de datos", 20);
				}
				//texto del error, código de error
				throw new Exception($conexionHospital->error, $conexionHospital->errno);
			}

			//comprobar si se han modificado datos o existe el paciente
			if ($conexionHospital->affected_rows == 0) {
				throw new Exception("El paciente no existe o no se han modificado datos", 30);
			}

			//mensaje de respuesta
			$mensajes = 'Modificación efectuada';
			
		} catch (Exception $e) {
			$mensajes =  $e->getMessage();
		}
	}
?>