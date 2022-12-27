<?php

// Conectar a la base de datos Mysqli
$db = new mysqli('localhost','root','V3ct4r_l5g4','bdExpClinico');

// Creamos el Query
$query = "SELECT cUnidadMedica,cNombre FROM tblPaciente";

// Lo preparamos
$stmt = $db->prepare($query);

// Lo ejecutamos
$stmt->execute();

// Creamos la variable
$stmt->bind_result($unidadMedica,$nombre);

// Asignamos el resultado
//$stmt->fetch();

// Imprimir resultado
//var_dump($unidadMedica);
//echo "<br>";
//var_dump($nombre);

//echo "<br>";

// Imprimir resultado
while ($stmt->fetch()) {
    var_dump($nombre);
    echo "<br />";
}