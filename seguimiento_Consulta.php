<?php
require 'includes/app.php';

$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}

use App\TblPaciente;

$id = $_GET['idReg'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /Hist_Clinica/');
}
// Importar la conexion
//include 'includes/config/database.php';
$tblpacientes = TblPaciente::findReg($id);

//require 'includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Seguimiento Expediente Electronico</h1>
    <table class="propiedades">
        <thead>
            <tr>
                <td>ID</td>
                <td>Num Expediente</td>
                <td>Unidad Medica</td>
                <td>Nombre Paciente</td>
                <td>CURP</td>
                <td>Medico</td>
            </tr>
        </thead>
        <tbody> <!-- Mostrar Resultados -->
        <?php
            foreach($tblpacientes as $row) : ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->cNumExpediente; ?></td>
                <td><?php echo $row->cUnidadMedica; ?></td>
                <td><?php echo $row->cNombre . " " . $row->cPaterno . " " . $row->cMaterno; ?></td>
                <td><?php echo $row->cCURP; ?></td>
                <td><?php echo $row->cNombreMed; ?></td>
            </tr>

        <?php
            endforeach; 
        ?>

        </tbody>
    </table>

    <form class="formulario" method="POST" >

    <div class="contenedorFecha">
        <div class="fecha">
            <label for="Fecha">FECHA CONSULTA EXTERNA</label>
            <input type="text" name="Fecha" id="Fecha" readonly="readonly" value="<?php echo date('y-m-d h:i:s'); ?>">
        </div>
    </div>

    <div class="contenedorDatos">
    <!--<label for="nPeso">Peso (Kg)</label>-->
    <input type="text" name="nPeso" id="nPeso" placeholder="Peso en Kg." value="<?php echo "" ?>">

    <!--<label for="nTalla">Talla cm.</label>-->
    <input type="text" name="nTalla" id="nTalla" placeholder="Talla en Cm." value="<?php echo "" ?>">

    <!--<label for="nIMC">IMC</label>-->
    <input type="text" name="nIMC" id="nIMC" placeholder="IMC" value="<?php echo "" ?>">

    </div>

    <div class="contenedorDatos2">
    
    <!--<label for="nCCintura">Circunferencia de cintura (cm)</label>-->
    <input type="text" name="nCCintura" id="nCCintura" placeholder="Circunferencia de cintura (cm)" value="<?php echo "" ?>">

    <!--<label for="nArterialSisto">Presión arterial sistólica</label>-->
    <input type="text" name="nArterialSisto" id="nArterialSisto" placeholder="Presión arterial sistólica" value="<?php echo "" ?>">

    <!--<label for="nArterialdiasto">Presión arterial diastólica</label>-->
    <input type="text" name="nArterialdiasto" id="nArterialdiasto" placeholder="Presión arterial diastólica" value="<?php echo "" ?>">

    <!--<label for="nfcardiaca">Frecuencia cadiaca</label>-->
    <input type="text" name="nfcardiaca" id="nfcardiaca" placeholder="Frecuencia cadiaca" value="<?php echo "" ?>">

    <input type="text" name="nfRespiratoria" id="nfRespiratoria" placeholder="Frecuencia respiratoria" value="<?php echo "" ?>">

    </div>

    <div class="contenedorDatos2">
    <input type="text" name="nTemperatura" id="nTemperatura" placeholder="Temperatura" value="<?php echo "" ?>">

    <input type="text" name="nSaturacionOxigeno" id="nSaturacionOxigeno" placeholder="Saturación de Oxigeno" value="<?php echo "" ?>">

    <input type="text" name="nGlucemia" id="nGlucemia" placeholder="Glucemia" value="<?php echo "" ?>">
    </div>

    <input type="submit" value="Enviar" class="boton-verde-block">

    </form>
</main>

<?
// Cerrar la conexion

incluirTemplate('footer');
?>