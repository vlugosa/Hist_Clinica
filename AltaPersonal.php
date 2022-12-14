<?php
require 'includes/app.php';

use App\TblPersonal;
use Intervention\Image\ImageManagerStatic as Image;

$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
    //var_dump($_SESSION['login']);
}
// Arreglo con mensaje de errores
$errores = TblPersonal::getErrores();

$cNombre = "";
$cTelefono = "";
$cMovil = "";
$cColonia = "";
$cDireccion = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$usuariossistema = new UsuariosSistema($_POST);
    $tblpersonal = new TblPersonal($_POST);

/*     $cNombre = $_POST['cNombre'];
    $cTelefono = $_POST['cTelefono'];
    $cMovil = $_POST['cMovil'];
    $cColonia = $_POST['cColonia'];
    $cDireccion = $_POST['cDireccion']; */

    $errores = $tblpersonal->validar();

    if (empty($errores)) {
        $tblpersonal->guardar();
    }
    

    //debuguear($tblpersonal);    
}


incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Alta Personal del Sistema</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

<form class="formulario" method="POST">
<fieldset>
    <legend>Información del usuario</legend>

    <label for="cNombre">Nombre</label>
    <input type="text" name="cNombre" id="cNombre" placeholder="Nombre completo" value = "<?php echo $cNombre; ?>">

    <label for="cTelefono">Teléfono</label>
    <input type="number" name="cTelefono" id="cTelefono" max="9999999999" placeholder="Telefono" value = "<?php echo $cTelefono; ?>">

    <label for="cMovil">Teléfono Movil</label>
    <input type="number" name="cMovil" id="cMovil" max="9999999999" placeholder="Celular" value = "<?php echo $cMovil; ?>">

    <label for="cColonia">Colonia</label>
    <input type="text" name="cColonia" id="cColonia" placeholder="Colonia" value = "<?php echo $cColonia; ?>">

    <label for="cDireccion">Dirección</label>
    <input type="text" name="cDireccion" id="cDireccion" placeholder="Direccion" value = "<?php echo $cDireccion; ?>">


</fieldset>

<input type="submit" value="Enviar" class="boton-verde-block">
</form>

</main>

<?
// Cerrar la conexion

incluirTemplate('footer');
?>