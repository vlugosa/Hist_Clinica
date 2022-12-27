<?php
require '../../includes/app.php';
$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}
//include 'includes/config/database.php';
use App\TblPaciente;

// Implementar metodo para obtener todos las consultas de pacientes
$tblpacientes = TblPaciente::all();

//require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Consulta Historico</h1>

    <table class="propiedades">
        <thead>
            <tr>
                <td>Num Expediente</td>
                <td>Nombre Paciente</td>
                <td>Medico</td>
                <td>Buscar</td>
            </tr>
        </thead>
        <tbody> <!-- Mostrar Resultados -->
        <?php
            foreach($tblpacientes as $row) : ?>
            <tr>
                <td><?php echo $row->cNumExpediente; ?></td>
                <td><?php echo $row->cNombre . " " . $row->cPaterno . " " . $row->cMaterno; ?></td>
                <td><?php echo $row->cNombreMed; ?></td>
                <td><a href="/Hist_Clinica/admin/pacientes/seguimiento_Consulta.php?idReg=<?php echo $row->id; ?>" class="boton-amarillo-block">Buscar</a></td>
                
            </tr>

        <?php
            endforeach; 
        ?>

        </tbody>
    </table>
</main>

<?
// Cerrar la conexion

incluirTemplate('footer');
?>