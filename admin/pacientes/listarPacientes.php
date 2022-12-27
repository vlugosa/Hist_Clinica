<?php
require '../../includes/app.php';

use App\TblPaciente;

$auth = estaAutenticado();
if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}

$resultado = $_GET['resultado'] ?? null;

//$tblpersonal = new TblPersonal();
// Arreglo con mensaje de errores
$errores = TblPaciente::getErrores();
//$tblpersonal = new TblPersonal();

$tblpaciente = TblPaciente::all();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //
    //debuguear($_POST);
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    //debuguear($id);

    if ($id) {
        //$tblpaciente = new TblPaciente;
        $tblpaciente = TblPaciente::findReg($id);
        //debuguear($tblpaciente);
        $tblpaciente->eliminar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Listar Pacientes</h1>

    <?php
    $mensaje = mostrarNotificacion( intval( $resultado ) );

    if ($mensaje) { ?>
        <p class="alerta exito"><?php echo s($mensaje) ?></p>
    <?php }

    ?>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <table class="propiedades">
        <thead>
            <tr>
                <td>ID</td>
                <td>Numero de Expediente</td>
                <td>Nombre</td>
                <!-- <td>Medico Atiende</td> -->
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody> <!-- Mostrar Resultados -->
        <?php
            foreach($tblpaciente as $row) : ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->cNumExpediente; ?></td>
                <td><?php echo $row->cNombre . " " . $row->cPaterno . " " . $row->cMaterno; ?></td>
                
                <td>
                <a href="actualizarPaciente.php?id=<?php echo $row->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $row->id ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    
                    <!-- <a href="EliminarPersonal.php?id=<?php //echo $row->id; ?>" class="boton boton-rojo">Eliminar</a> -->
                </td>
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