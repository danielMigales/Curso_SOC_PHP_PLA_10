<?php
	//conexión a la bbdd hospital
	
	//host, usuario, password, base de datos
	if (!$conexionHospital = mysqli_connect('localhost', 'root', '', 'hospital')) {
		throw new Exception("Error de conexión a la base de datos", 99);
	}

	mysqli_set_charset($conexionHospital, "utf8");
?>