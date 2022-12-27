<?php
require '../../includes/app.php';

use App\TblPersonal;

$auth = estaAutenticado();
if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}

//$tblpersonal = new TblPersonal();
// Arreglo con mensaje de errores
$errores = TblPersonal::getErrores();
//$tblpersonal = new TblPersonal();

$tblpersonal = TblPersonal::all();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //
    //debuguear($_POST);
    $id = $_POST['id'];
    
    $id = filter_var($id, FILTER_VALIDATE_INT);
    //debuguear($id);
    $tblpersonal = TblPersonal::findReg($id);

    if ($id) {
        $tblpersonal = new TblPersonal();
        $tblpersonal->Actualizar();
    }

}

incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Listar Personal</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <table class="propiedades">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Telefono</td>
                <td>Movil</td>
                <td>Colonia</td>
                <td>Direccion</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody> <!-- Mostrar Resultados -->
        <?php
            foreach($tblpersonal as $row) : ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->cNombre; ?></td>
                <td><?php echo $row->cTelefono; ?></td>
                <td><?php echo $row->cMovil; ?></td>
                <td><?php echo $row->cColonia; ?></td>
                <td><?php echo $row->cDireccion; ?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row->id ?>">
                        <input type="submit" class="boton boton-rojo" value="Eliminar">
                    </form> 
                    <!-- <a href="ActualizaPersonal.php?id=<?php echo $row->id; ?>" class="boton boton-amarillo">Actualizar</a>
                    <a href="EliminarPersonal.php?id=<?php echo $row->id; ?>" class="boton boton-rojo">Eliminar</a>
 -->                </td>
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