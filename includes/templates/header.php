<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
//var_dump($auth);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!--<meta charset="UTF-8">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente Electronico</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
<header class="header inicio">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/Hist_Clinica/AltaPaciente.php">
                    <img src="build/img/Historia Clinica.svg" alt="Logotipo de Historia Clinica">
                </a>
                <nav class="navegacion">
                    <a href="Consulta_Hist.php">Consulta Hist</a>
                    <a href="AltaPersonal.php">Alta Personal</a>
                    <a href="AltaUsuarioSist.php">Alta Usuarios Sistema</a>
                    <?php if ($auth): ?>
                        <a href="cerrar-session.php">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div><!-- Cierre de barra-->
        </div>
    </header>