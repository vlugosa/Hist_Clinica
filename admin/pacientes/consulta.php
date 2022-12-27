<?php
require '../../includes/app.php';
use App\TblConsultaExterna;

$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}
//include 'includes/config/database.php';
//use App\TblPaciente;

// Arreglo con mensaje de errores
$errores = TblConsultaExterna::getErrores();

//debuguear($errores);
$tblConsultaExterna = new TblConsultaExterna();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $tblConsultaExterna = new TblConsultaExterna($_POST);

    //debuguear($tblConsultaExterna);
    $errores = $tblConsultaExterna->validar();
    
}
//require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Seguimiento Consulta Externa</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" >

    <input type="hidden" name="tblPaciente_id" id="tblPaciente_id" value="<?php //echo $tblPaciente_id ?>">
    
    <div class="contenedorFecha">
        <div class="fecha">
            <label for="Fecha">FECHA CONSULTA EXTERNA</label>
            <input type="text" name="Fecha" id="Fecha" readonly="readonly" value="<?php echo date('y-m-d h:i:s'); ?>">
        </div>
    </div>

    <div class="contenedorDatos">
    <!--<label for="nPeso">Peso (Kg)</label>-->
    <input type="text" name="nPeso_KG" id="nPeso_KG" placeholder="Peso en Kg." value="<?php //echo $nPeso_KG; ?>">

    <!--<label for="nTalla">Talla cm.</label>-->
    <input type="text" name="nTalla_CM" id="nTalla_CM" placeholder="Talla en Cm." value="<?php //echo $nTalla_CM ?>">

    <!--<label for="nIMC">IMC</label>-->
    <input type="text" name="nIMC" id="nIMC" placeholder="IMC" value="<?php //echo $nIMC ?>">

    </div>

    <div class="contenedorDatos2">
    
    <!--<label for="nCCintura">Circunferencia de cintura (cm)</label>-->
    <input type="text" name="nCirc_Cintura_cm" id="nCirc_Cintura_cm" placeholder="Circunferencia de cintura (cm)" value="<?php //echo $nCirc_Cintura_cm ?>">

    <!--<label for="nArterialSisto">Presión arterial sistólica</label>-->
    <input type="text" name="nP_A_Sistolica" id="nP_A_Sistolica" placeholder="Presión arterial sistólica" value="<?php //echo $nP_A_Sistolica ?>">

    <!--<label for="nArterialdiasto">Presión arterial diastólica</label>-->
    <input type="text" name="nP_A_Distolica" id="nP_A_Distolica" placeholder="Presión arterial diastólica" value="<?php //echo $nP_A_Distolica ?>">

    <!--<label for="nfcardiaca">Frecuencia cadiaca</label>-->
    <input type="text" name="nFCardiaca" id="nFCardiaca" placeholder="Frecuencia cadiaca" value="<?php //echo $nFCardiaca ?>">

    <input type="text" name="nFRespiratoria" id="nFRespiratoria" placeholder="Frecuencia respiratoria" value="<?php //echo $nFRespiratoria ?>">

    </div>

    <div class="contenedorDatos2">
    <input type="text" name="nTemp" id="nTemp" placeholder="Temperatura" value="<?php //echo $nTemp ?>">

    <input type="text" name="nSaturaOxigeno" id="nSaturaOxigeno" placeholder="Saturación de Oxigeno" value="<?php //echo $nSaturaOxigeno ?>">

    <input type="text" name="nGlucemia" id="nGlucemia" placeholder="Glucemia" value="<?php //echo $nGlucemia ?>">
    </div>

    <input type="submit" value="Enviar" class="boton-verde-block">

    </form>
</main>

<?
// Cerrar la conexion
incluirTemplate('footer');
?>