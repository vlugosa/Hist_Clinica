<?php
include 'includes/config/database.php';

//include 'build/utilidades/header.php';

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

                //var_dump($query_execute);
                if ($query_execute) {
                    header("Location: /Hist_Clinica/");
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
?>