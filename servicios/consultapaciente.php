<?php

		//recuperar id del paciente
		$idpaciente = filter_input(INPUT_POST, 'idpaciente', FILTER_VALIDATE_INT);
		
		//realizar la consulta
		try {
			//validar id informado
			if (!$idpaciente) {
				throw new Exception("Se debe seleccionar un paciente", 10);
			}

			//preparar sentecia SQL
			$sql = "SELECT * FROM paciente WHERE idpaciente = $idpaciente";

			if (!$consulta = mysqli_query($conexionHospital, $sql)) {
				//control de errores
				throw new Exception($conexionHospital->error, $conexionHospital->errno);
			}

			//controlar si la consulta devuelve alguna fila
			if ($consulta->num_rows == 0) {
				throw new Exception("No hay datos", 20);
			}

			//extraer los datos 
			$paciente = mysqli_fetch_assoc($consulta);

			$idpaciente 	= $paciente['idpaciente'];
			$nif 			= $paciente['nif'];
			$nombre 		= $paciente['nombre'];
			$apellidos 		= $paciente['apellidos'];
			$fechaingreso 	= $paciente['fechaingreso'];
			$fechaalta 		= $paciente['fechaalta'];


			
		} catch (Exception $e) {
			$mensajes =  $e->getMessage();
		}

?>