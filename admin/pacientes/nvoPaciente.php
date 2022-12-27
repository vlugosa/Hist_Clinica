<?php
require '../../includes/app.php';

use App\TblPaciente;
use App\TblPersonal;

$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}

$resultado = $_GET['resultado'] ?? null;

//$mensaje = $_GET['mensaje'];

// Arreglo con mensaje de errores
$errores = TblPaciente::getErrores();

$tblpaciente = new TblPaciente;

$tblPersonal = TblPersonal::all();
//$tblpaciente = TblPaciente::all();
//debuguear($tblPersonal);
$tblPersonal_id = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //$tblpaciente = new TblPaciente($_POST);
    //$tblpaciente = $_POST;

    //debuguear($tblpaciente);
    $args = $_POST['tblpaciente'];
    //debuguear($args);
    // Asignar los atributos
/*     $args = [];
    $args['cNumExpediente'] = $_POST['cNumExpediente'] ?? null;
    $args['cNombre'] = $_POST['cNombre'] ?? null;
    $args['cPaterno'] = $_POST['cPaterno'] ?? null;
    $args['cMaterno'] = $_POST['cMaterno'] ?? null;
    $args['cCURP'] = $_POST['cCURP'] ?? null; */
 
    $tblpaciente->sincronizar($args);
    
    //debuguear($tblpaciente);

    //$tblPersonal_id = $tblpaciente->tblPersonal_id;

    //debuguear($tblPersonal_id);

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

    <?php if ( intval( $resultado ) === 1): ?>
            <p class="boton-verde">La información se guardo satisfactoriamente.</p>
    <?php endif; ?>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" id="myform" enctype = "multipart/form-data">
        
            <?php include '../../includes/templates/infoGeneral.php'; ?>

            <input type="submit" value="Enviar" class="boton-verde-block">
    </form>
</main>
<?php
incluirTemplate('footer');
?>