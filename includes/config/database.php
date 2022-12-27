<?php

function ConectarDB() : mysqli {
    $db = new mysqli('localhost','root','V3ct4r_l5g4','bdExpClinico');

    if (!$db) {
        echo 'No se pudo conectar a la base de datos';
        exit;
    }
return $db; 
}

/*     
    class database {

        public function DBConnection(){

            $host = 'localhost';
            $dbname = 'bdExpClinico';
            $user = 'root';
            $pass = 'V3ct4r_l5g4';

            try {
                $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $DBH;
            }
            catch(PDOException $e) {

                echo 'ERROR: ' . $e->getMessage();
            }

        } // function ends

    } // class ends */

    $servername = "localhost";
    $username = "root";
    $password = "V3ct4r_l5g4";
    $database = "bdExpClinico";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexion Satisfactoria";

    } catch (PDOExeption $e) {
        echo "Conexion fallo" . $e->getMessage();
    }

?>
