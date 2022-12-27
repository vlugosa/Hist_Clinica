<?php

define('TEMPLATES_URL',__DIR__. '/templates');
define('FUNCIONES_URL','funciones.php');

function incluirTemplate( $nombre ) {
    //debuguear(TEMPLATES_URL . "/${nombre}.php");
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : bool {
    if (!isset($_SESSION)) {
        session_start();
    }
    if(!isset($_SESSION['login'])) {
        $_SESSION['login'] = false;
    }
    //($_SESSION['login']);
    $auth = $_SESSION['login'];

    if ($auth) {
        return true;
    }
    return false;
}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s ($html) : string {
    $s = htmlspecialchars($html);
    //debuguear($s);
    return $s;
}

function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}