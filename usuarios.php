<?php
include 'includes/config/database.php';

$email = "correo@correo.com";
$pass = "123456";
$PerfilesUser = 2;
$tblPersonal_id = 1;
$catPuestos_id = 1;

$passHash = password_hash($pass, PASSWORD_DEFAULT);

// Insertar en la base de datos
//$sql="INSERT INTO usuarios (cUsuario,cPassword) VALUES (:email,:passHash)";
$sql="INSERT INTO tblUsuarios (cUsuario,cPassword,idPerfilesUser,tblPersonal_id,catPuestos_id) VALUES (:email,:passHash,
:PerfilesUser,:tblPersonal_id,:catPuestos_id )";

$query_run = $conn->prepare($sql);

$data = [
    ':email' => $email,
    ':passHash' => $passHash,
    ':PerfilesUser' => $PerfilesUser,
    ':tblPersonal_id' => $tblPersonal_id,
    ':catPuestos_id' => $catPuestos_id
];

$query_execute = $query_run->execute($data);

?>