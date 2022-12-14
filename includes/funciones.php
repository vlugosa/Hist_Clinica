<?php

define('TEMPLATES_URL',__DIR__. '/templates');
define('FUNCIONES_URL','funciones.php');

function incluirTemplate( $nombre ) {
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