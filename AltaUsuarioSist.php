<?php
require 'includes/app.php';

use App\TblUsuarios;
use App\CatPerfilUsuarios;
use App\TblPersonal;
use App\CatPuestos;

$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}

// Implementar metodo para obtener todos las consultas de pacientes
$catperfilUsuario = CatPerfilUsuarios::findRegPerfil();
$tblpersonal = TblPersonal::all();
$catpuestos = CatPuestos::all();
// Arreglo con mensaje de errores
$errores = TblUsuarios::getErrores();

$cUsuario = "";
$cPassword = "";
$idPerfilesUser = "";
$tblPersonal_id = "";
$catPuestos_id = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuariossistema = new TblUsuarios($_POST);

    $cUsuario = $_POST['cUsuario'];
    $cPassword = $_POST['cPassword'];
    $idPerfilesUser = $_POST['idPerfilesUser'];
    $tblPersonal_id = $_POST['tblPersonal_id'];
    $catPuestos_id = $_POST['catPuestos_id'];

    $errores = $usuariossistema->validar();
    //debuguear($errores);
    if (empty($errores)) {
        $id = $usuariossistema->guardarUsuario();
        header("Location: /Hist_Clinica/Consulta_Hist.php");
    }

    //debuguear($usuariossistema);
/*     if (!$cNombre) {
        $errores[] = "Debes capturar el nombre del usuario";
    }

    if (!$cMovil) {
        $errores[] = "Debes capturar el teléfono movil del usuario";
    }

    if (!$cColonia) {
        $errores[] = "Debes capturar la colonia del usuario";
    }

    if (!$cDireccion) {
        $errores[] = "Debes capturar la dirección del usuario";
    } */

    //debuguear($usuariossistema);

    //$usuariossistema = guardar();
}


incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Alta Usuario Sistema</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

<form class="formulario" method="POST">
<fieldset>
    <legend>Información del usuario</legend>

    <label for="cUsuario">Usuario</label>
    <input type="email" name="cUsuario" id="cUsuario" placeholder="E-MAIL" value = "<?php echo $cUsuario; ?>">

    <label for="cPassword">Password</label>
    <input type="password" name="cPassword" id="cPassword" placeholder="Password" >

    <label for="idPerfilesUser">Perfil de usuario</label>
    <select name="idPerfilesUser" id="idPerfilesUser">
    <option value="">-- Seleccione --</option>
        <?php foreach($catperfilUsuario as $row) : ?>
            <option value="<?php echo $row->idPerfilesUser; ?>"><?php echo $row->cPerfilUsuario; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="tblPersonal_id">Nombre del personal</label>
    <select name="tblPersonal_id" id="tblPersonal_id">
        <option value="">-- Seleccione --</option>
        <?php foreach($tblpersonal as $row) : ?>
            <option value="<?php echo $row->id; ?>"><?php echo $row->cNombre; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="catPuestos_id">Puesto del personal</label>
    <select name="catPuestos_id" id="catPuestos_id">
        <option value="">-- Seleccione --</option>
        <?php foreach($catpuestos as $row) : ?>
            <option value="<?php echo $row->id; ?>"><?php echo $row->cPuesto; ?></option>
        <?php endforeach; ?>
    </select>

</fieldset>

<input type="submit" value="Enviar" class="boton-verde-block">
</form>

</main>

<?
// Cerrar la conexion

incluirTemplate('footer');
?>