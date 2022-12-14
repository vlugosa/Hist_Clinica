<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base
$db = ConectarDB();

use App\TblPersonal;
TblPersonal::setDB($db);

use App\TblPaciente;
TblPaciente::setDB($db);

use App\TblUsuarios;
TblUsuarios::setDB($db);

use App\CatPerfilUsuarios;
CatPerfilUsuarios::setDB($db);

use App\CatPuestos;
CatPuestos::setDB($db);

//use App\UsuariosSistema;

//$propiedad = new Propiedad;

//$usuariossistema = new UsuariosSistema;

//var_dump($propiedad);