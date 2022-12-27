<?php
require '../../includes/app.php';

use App\TblPaciente;
use App\TblPersonal;

$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}

//Obtener mensaje de vuelta de base de datos
$id = $_GET['id'];

if (!$id) {
    header('Location : /Hist_Clinica/admin/pacientes/listarPacientes.php');
}
//debuguear($id);
// Arreglo con mensaje de errores
$errores = TblPaciente::getErrores();

$tblpaciente = new TblPaciente;

$tblPersonal = TblPersonal::all();
$tblpaciente = TblPaciente::findReg($id);
//debuguear($tblpaciente->tblPersonal_id);
$tblPersonal_id = $tblpaciente->tblPersonal_id;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $args = $_POST['tblpaciente'];

    //$tblpaciente = new TblPaciente($_POST);
    //debuguear($_POST);
    // Asignar los atributos
/* 
    $args = [];
    $args['cNumExpediente'] = $_POST['cNumExpediente'] ?? null;
    $args['cNombre'] = $_POST['cNombre'] ?? null;
    $args['cPaterno'] = $_POST['cPaterno'] ?? null;
    $args['cMaterno'] = $_POST['cMaterno'] ?? null;
    $args['cCURP'] = $_POST['cCURP'] ?? null;
 */
    $tblpaciente->sincronizar($args);
    
    //debuguear($tblpaciente);

    $tblPersonal_id = $tblpaciente->tblPersonal_id;

    $errores = $tblpaciente->validar();

    if (empty($errores)) {
        $tblpaciente->guardar();
        //$id = $tblpaciente->guardar();
        //header("Location: /Hist_Clinica/seguimiento_Consulta.php?idReg=" . $id);
    }
}

incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Información General</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" id="myform" enctype = "multipart/form-data">
        <?php
            //if (strval( $mensaje ) === '1') {
        ?>
            <!-- <span class="boton-verde">La informacion se guardo satisfactoriamente.</span> -->
        <?php
        //}
        ?>
            <?php include '../../includes/templates/infoGeneral.php'; ?>

            <input type="submit" value="Enviar" class="boton-verde-block">
    </form>
</main>
<?php
incluirTemplate('footer');
?>