<?php
require 'includes/app.php';

//var_dump(estaAutenticado());
//exit;
$auth = estaAutenticado();

if (!$auth) {
    header("Location: /Hist_Clinica/login.php");
    //var_dump($_SESSION['login']);
}
//include 'includes/config/database.php';
        // Arreglo con mensaje de errores
        $errores = [];

        $Fecha = '';
        $unidadMedica = '';
        $n_Expediente = '';
        $medico = '';
        $nombre = '';
        $apaterno = '';
        $amaterno = '';
        $Fecha_Nacimiento = '';
        $genero = '';
        $idMedico = 0;

        //var_dump($_POST['medico']);
        //exit;
        // Ejecutar codigo despues de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //$numero = "1numero";
            //$numero2 = 1;

            // Sanitizar
            //$resultado = filter_var($numero, FILTER_SANITIZE_NUMBER_INT);

            //var_dump($resultado);

            //exit;

            $Fecha = $_POST['Fecha'];
            $unidadMedica = $_POST['unidadMedica'];
            $n_Expediente = $_POST['n_Expediente'];
            $medico = $_POST['medico'];
            $nombre = $_POST['nombre'];
            $apaterno = $_POST['apaterno'];
            $amaterno = $_POST['amaterno'];            
            $Fecha_Nacimiento = $_POST['Fecha_Nacimiento'];
            $genero = $_POST['genero'];
            //$idMedico = 1;

            if (!$medico) {
                $errores[] = "Debes seleccionar al medico";
            }            

            if (!$n_Expediente) {
                $errores[] = "Debes agregar el numero de expediente";
            }

            if (!$nombre) {
                $errores[] = "Debes agregar el nombre de paciente";
            }

            if (!$apaterno) {
                $errores[] = "Debes agregar el apellido paterno del paciente";
            }

            if (!$amaterno) {
                $errores[] = "Debes agregar el apellido materno del paciente";
            }

            if (!$Fecha_Nacimiento) {
                $errores[] = "Debes seleccionar la fecha de nacimiento";
            }

            if (!$genero) {
                $errores[] = "Debes elegir genero del paciente";
            }

            if (empty($errores)) {

                // Insertar en la base de datos
                $sql="INSERT INTO tblPaciente (nNumExpediente,cUnidadMedica,cNombre,cPaterno,
                cMaterno,dFechaNac,cGenero,FechaRegistro,idMedico) VALUES (:n_Expediente,:unidadMedica,:nombre,
                :apaterno,:amaterno,:Fecha_Nacimiento,:genero,:Fecha,:idMedico)";

                $query_run = $conn->prepare($sql);
        
                $data = [
                    ':n_Expediente' => $n_Expediente,
                    ':unidadMedica' => $unidadMedica,
                    ':nombre' => $nombre,
                    ':apaterno' => $apaterno,
                    ':amaterno' => $amaterno,
                    ':Fecha_Nacimiento' => $Fecha_Nacimiento,
                    ':genero' => $genero,
                    ':Fecha' => $Fecha,
                    ':idMedico' => $medico 
                ];
                
                $query_execute = $query_run->execute($data);

                $lastInsertId = $conn->lastInsertId();
                //var_dump($query_execute);
                if ($query_execute) {
                    header ("Location: /Hist_Clinica/seguimiento_Consulta.php?idReg=".$lastInsertId);
                }
                //endif;
            }           


/*             $sql->bindParam(':n_Expediente',$n_Expediente,PDO::PARAM_STR, 25);
            $sql->bindParam(':unidadMedica',$unidadMedica,PDO::PARAM_STR, 25);
            $sql->bindParam(':nombre',$nombre,PDO::PARAM_STR,25);
            $sql->bindParam(':apaterno',$apaterno,PDO::PARAM_STR);
            $sql->bindParam(':amaterno',$amaterno,PDO::PARAM_STR);
            //$sql->bindParam(':Fecha_Nacimiento',$Fecha_Nacimiento,PDO::PARAM_STR);
            $sql->bindParam(':idMedico',$idMedico,PDO::PARAM_STR); */
    
            //$STH->execute();

            //$lastInsertId = $connect->lastInsertId();
            //if($lastInsertId>0){
            //    echo "<div class='content alert alert-primary' > Gracias .. Tu Nombre es : $lastInsertId  </div>";
            //}            
        }
incluirTemplate('header');
//include 'includes/templates/header.php';

?>
<main class="contenedor">
    <h1>Expediente Electronico</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" id="myform">

            <input type="hidden" name="idregistro" id="idregistro" value="<?php echo $lastInsertId; ?>">
            
            <label for="Fecha">FECHA</label>
            <input type="text" name="Fecha" id="Fecha" readonly="readonly" value="<?php echo date('y-m-d   h:i:s'); ?>">

            <label for="medico">Medico</label>
            

            <select name="medico">
            <option value="">-- Seleccione --</option>

            <?php
            // Consultar para obtener los medicos
            $consulta = "SELECT * FROM tblMedico";
            $stm = $conn->query($consulta);

            // fetch all rows into array, by default PDO::FETCH_BOTH is used
            $rows = $stm->fetchAll();
            //printf("$row[0] $row[1] $row[2]\n");
            //printf("$row['id'] $row['name'] $row['population']\n");

            // iterate over array by index and by name
            foreach($rows as $row) : ?>
                <option <?php echo $medico === strval($row[0]) ? 'selected' : '' ?> value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
            <?php endforeach; ?>
            </select>

            <label for="unidadMedica">Unidad Medica</label>
            <input type="text" name="unidadMedica" id="unidadMedica" value="C. S. SAN JOSE BUENAVISTA" readonly="readonly">

            <label for="n_Expediente">Numero Expediente</label>
            <input type="text" name="n_Expediente" id="n_Expediente" placeholder="Numero Expediente" value = "<?php echo $n_Expediente; ?>">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" value = "<?php echo $nombre; ?>">

            <label for="apaterno">Apellido Paterno</label>
            <input type="text" name="apaterno" id="apaterno" placeholder="Apellido Paterno" value = "<?php echo $apaterno; ?>">
            
            <label for="amaterno">Apellido Materno</label>
            <input type="text" name="amaterno" id="amaterno" placeholder="Apellido Materno" value = "<?php echo $amaterno; ?>">

            <label for="Fecha_Nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" placeholder="dd-mm-yyyy" value="<?php echo $Fecha_Nacimiento; ?>">

            <select name="genero">
                <option value="">-- Seleccione --</option>
                <option <?php echo $genero === "H" ? 'selected' : '' ?> value="H">Hombre</option>
                <option <?php echo $genero === "M" ? 'selected' : '' ?> value="M">Mujer</option>
            </select>

            <input type="submit" value="Enviar" class="boton-verde-block">
    </form>
</main>
<?php
incluirTemplate('footer');
//include 'includes/templates/footer.php';
?>

