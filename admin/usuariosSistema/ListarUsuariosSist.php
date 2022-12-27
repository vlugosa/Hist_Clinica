<?php
require '../../includes/app.php';

use App\TblUsuarios;

$auth = estaAutenticado();
if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
}

// Arreglo con mensaje de errores
$errores = TblUsuarios::getErrores();

$tblpersonal = TblUsuarios::all();

incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Listar Usuarios de Sistema</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <table class="propiedades">
        <thead>
            <tr>
            <!-- public $idPerfilesUser;
            public $tblPersonal_id;
            public $catPuestos_id; -->
                <td>ID</td>
                <td>Usuario</td>
                <td>Puesto</td>
                <td>Nombre</td>
                <td>Perfil Usuario</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody> <!-- Mostrar Resultados -->
        <?php
            foreach($tblpersonal as $row) : ?>
            <tr>
                <td><?php echo $row->idusuario; ?></td>
                <td><?php echo $row->cUsuario; ?></td>
                <td><?php echo $row->catPuestos_id; ?></td>
                <td><?php echo $row->tblPersonal_id; ?></td>
                <td><?php echo $row->idPerfilesUser; ?></td>
                <td>
                    <a href="ActualizaPersonal.php?id=<?php echo $row->idusuario; ?>" class="boton boton-amarillo">Actualizar</a>
                    <a href="EliminarPersonal.php?id=<?php echo $row->idusuario; ?>" class="boton boton-rojo">Eliminar</a>
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