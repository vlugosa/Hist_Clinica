<?php
require 'includes/app.php';
//$errores = [];
//$email = '';
use App\TblUsuarios;

// Arreglo con mensaje de errores
$errores = TblUsuarios::getErrores();

$cUsuario = '';
$cPassword = '';
$nHabilitado = '';
$dFechaRegistro = '';
$idPerfilesUser = '';
$tblPersonal_id = '';
$catPuestos_id = '';

// Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tblusuarios = new TblUsuarios($_POST);
    //debuguear($tblusuarios);
    $errores = $tblusuarios->validarAcceso();

    $cUsuario = $tblusuarios->cUsuario;

    $ConsultaUser = TblUsuarios::findReg($tblusuarios->cUsuario);

    //debuguear($ConsultaUser);

    if (empty($ConsultaUser)) {
        $errores []= "El usuario es incorrecto";
        //debuguear($errores);
    } else {
        //debuguear("entro if");
        foreach ($ConsultaUser as $row) {
            //debuguear($row->cUsuario);
            if ($row->cUsuario === $tblusuarios->cUsuario) {
                //debuguear($tblusuarios->cUsuario);
                // Revisa password de usuario
                $pass = $row->cPassword;
        
                $auth = password_verify($tblusuarios->cPassword , $pass);
    
                //debuguear($auth);
                if ($auth) {
                    // Usuario autenticado
                    session_start();

                    // Llenar el arreglo de la session
                    $_SESSION['usuario'] = $row->cUsuario;
                    $_SESSION['login'] = true;

                    header("Location: admin/index.php");
                } else {
                    $errores []= "El password es incorrecto";
                }
            }    
        }
    }
}

//}
//require 'includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>

        </div>
    <?php endforeach; ?>
    <form method="POST" action="" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="cUsuario">E-mail</label>
            <input type="email" name="cUsuario" id="cUsuario" placeholder="Tu Email" value="<?php echo $cUsuario; ?>" require>
            
            <label for="cPassword">Password</label>
            <input type="password" name="cPassword" id="cPassword" placeholder="Tu password" require>
            
        </fieldset>
        
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

    </form>
</main>
<?php
// Cerrar la conexion
incluirTemplate('footer');
?>