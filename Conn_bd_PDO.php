<?php

// Conectar a la BD con PDO
$db = new PDO('mysql:host=localhost; dbname=bdExpClinico', 'root', 'V3ct4r_l5g4');

// Creamos el Query
$query = "SELECT nNumExpediente,cNombre FROM tblPaciente";

// Consultar la base de datos
//$pacientes = $db->query($query)->fetchAll();

// Consultar la base de datos con sentencia preparada
$stmt = $db->prepare($query);

// Ejecutar sentencia
$stmt->execute();

//obtener resultado de consulta
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $paciente) {
    echo $paciente['cNombre'];
    echo "<br />";
}
//var_dump($resultado);