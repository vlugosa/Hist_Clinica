<?php
require 'includes/app.php';

use App\TblPaciente;
use App\TblPersonal;

$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}

// Arreglo con mensaje de errores
$errores = TblPaciente::getErrores();

$tblpaciente = new TblPaciente();

$tblPersonal = TblPersonal::all();
$tblpaciente = TblPaciente::all();
//debuguear($tblpaciente);


$cCURP = '';
$cNumExpediente = '';
$cUnidadMedica = '';
$cNombre = '';
$cPaterno = '';
$cMaterno = '';
$dFechaNacimiento = '';
$cGenero = '';
$tblPersonal_id = 0;
$dFechaRegistro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tblpaciente = new TblPaciente($_POST);
    
    // Asignar atributos
    /* $args = [];
    $args['cCURP'] = $_POST['cCURP'] ?? null;
    $args['cNumExpediente'] = $_POST['cNumExpediente'] ?? null;
    $args['cUnidadMedica'] = $_POST['cUnidadMedica'] ?? null;
    $args['cNombre'] = $_POST['cNombre'] ?? null;
    $args['cPaterno'] = $_POST['cPaterno'] ?? null;
    $args['cMaterno'] = $_POST['cMaterno'] ?? null;
    $args['dFechaNacimiento'] = $_POST['dFechaNacimiento'] ?? null;
    $args['cGenero'] = $_POST['cGenero'] ?? null;
    $args['tblPersonal_id'] = $_POST['tblPersonal_id'] ?? null;
*/
    //$tblpaciente->sincronizar($args);

    //debuguear($tblpaciente);

    $cCURP = $tblpaciente->cCURP;
    $cNumExpediente = $tblpaciente->cNumExpediente;
    $cUnidadMedica = $tblpaciente->cUnidadMedica;
    $cNombre = $tblpaciente->cNombre;
    $cPaterno = $tblpaciente->cPaterno;
    $cMaterno = $tblpaciente->cMaterno;
    $dFechaNacimiento = $tblpaciente->dFechaNacimiento;
    $cGenero = $tblpaciente->cGenero;
    $tblPersonal_id = $tblpaciente->tblPersonal_id;
    $dFechaRegistro = '';

    //$primerApellido = urlencode($cPaterno);
    //debuguear($primerApellido);

    $errores = $tblpaciente->validar();

    if (empty($errores)) {
        $id = $tblpaciente->guardar();
        header("Location: /Hist_Clinica/seguimiento_Consulta.php?idReg=" . $id);
    }
}

incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Expediente Electronico</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" id="myform">

            <input type="hidden" name="idregistro" id="idregistro" value="<?php echo $id; ?>">
            
            <label for="Fecha">FECHA</label>
            <input type="text" name="Fecha" id="Fecha" readonly="readonly" value="<?php echo date('y-m-d h:i:s'); ?>">

            <label for="tblPersonal_id">Medico</label>
            <select name="tblPersonal_id" id="tblPersonal_id">
            <option value="">-- Seleccione --</option>

            <?php
            // Consultar para obtener los medicos
            //$consulta = "SELECT * FROM tblPersonal";
            //$stm = $conn->query($consulta);

            // fetch all rows into array, by default PDO::FETCH_BOTH is used
            //$rows = $stm->fetchAll();
            //debuguear($tblPersonal_id);

            // iterate over array by index and by name
            //debuguear($cNumExpediente);
        
            foreach($tblPersonal as $row) : ?>
                <option <?php echo $tblPersonal_id === strval($row->id) ? 'selected' : '' ?> value="<?php echo $row->id; ?>"><?php echo $row->cNombre; ?></option>
            <?php endforeach; ?>
            </select>

            <label for="cUnidadMedica">Unidad Medica</label>
            <input type="text" name="cUnidadMedica" id="cUnidadMedica" value="C. S. SAN JOSE BUENAVISTA" readonly="readonly">

            <label for="cNumExpediente">Numero Expediente</label>
            <input type="text" name="cNumExpediente" id="cNumExpediente" placeholder="Numero Expediente" value = "<?php echo $cNumExpediente; ?>">

            <label for="cNombre">Nombre</label>
            <input type="text" name="cNombre" id="cNombre" placeholder="Nombre" value = "<?php echo $cNombre; ?>">

            <label for="cPaterno">Apellido Paterno</label>
            <input type="text" name="cPaterno" id="cPaterno" placeholder="Apellido Paterno" value = "<?php echo $cPaterno; ?>">
            
            <label for="cMaterno">Apellido Materno</label>
            <input type="text" name="cMaterno" id="cMaterno" placeholder="Apellido Materno" value = "<?php echo $cMaterno; ?>">

            <label for="dFechaNacimiento">Fecha de Nacimiento</label>
            <input type="date" name="dFechaNacimiento" id="dFechaNacimiento" placeholder="dd-mm-yyyy" value="<?php echo $dFechaNacimiento; ?>">

            <label for="cCURP">CURP</label>
            <input type="text" name="cCURP" id="cCURP" placeholder="CURP" value = "<?php echo $cCURP; ?>">
            <!-- <input type="submit" value="Obtener CURP" class="boton-verde-block"> -->
            <select name="cGenero">
                <option value="">-- Seleccione --</option>
                <option <?php echo $cGenero === "H" ? 'selected' : '' ?> value="H">Hombre <?php echo $cGenero; ?></option>
                <option <?php echo $cGenero === "M" ? 'selected' : '' ?> value="M">Mujer</option>
            </select>

            <input type="submit" value="Enviar" class="boton-verde-block">
    </form>
</main>
<?php
incluirTemplate('footer');
?>