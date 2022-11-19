<?php
//constantes
const SECCIONES = ['index', 'alta', 'consulta', 'mantenimiento'];

//carga de sección de contenido por defecto
$seccion = 'index';

try {
    //conexión bbdd
    require_once "servicios/conexion.php";

    //verificar si se ha pulsado sobre los enlaces para cargar la sección corespondiente previa validación que sea una sección válida
    if (sizeof($_GET) > 0) {
        $enlace = array_keys($_GET);

        if (in_array($enlace[0], SECCIONES)) {
            $seccion = $enlace[0];
        }
    }
} catch (Exception $e) {
    $mensajes =  $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hospital</title>
    <link rel="stylesheet" type="text/css" href="css/hospital.css">
    <!--script type="text/javascript" src='js/inicio.js'></script-->
</head>

<body>
    <div class="container">
        <header>
            <h1 id="title">HOSPITAL</h1>
        </header>
        <nav>
            <h3>Menu opciones:</h3>
            <a href="?consulta">Consulta pacientes</a><br><br>
            <a href="?alta">Alta paciente</a><br><br>
            <a href="?mantenimiento">Baja/modificación paciente</a>
            <br><br>
        </nav>

        <section id='contenido'>
            <div>
                <?php include("secciones/$seccion.html"); ?>
            </div>
        </section>
    </div>
</body>

</html>