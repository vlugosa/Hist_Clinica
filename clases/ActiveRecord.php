<?php

namespace App;

class ActiveRecord {
        // Base de Datos
        protected static $db;
        protected static $columnasDB = [];
        protected static $tabla = '';
        
        // Errores
        protected static $errores = [];
    
        // Definir la conexion a la base de datos
        public static function setDB($database) {
            self::$db = $database;
        }
    
        public function guardar() {
            //debuguear(isset($this->id));
            
            //debuguear($this->id);

            if (isset($this->id) && !empty($this->id)) {
                // Actualizar
                $this->Actualizar();                
            } else {  
                // Crear un nuevo registro
                $this->crear();
            }
        }

        public function crear() {            
            // Sanitizar datos
            $atributos = $this->sanitizarAtributos();
            //debuguear($this->$atributos);
            $string = join(', ', array_keys($atributos));
            //debuguear($string);
    
             // Insertar en la base de datos
            $sql="INSERT INTO " . static::$tabla ." (";
            $sql .= join(', ', array_keys($atributos));
            $sql .= ") VALUES ('";
            $sql .= join("', '", array_values($atributos));
            $sql .= " ') ";
    
            //debuguear($sql);
            $resultado = self::$db->query($sql);
            //$id = self::$db->insert_id;
            //debuguear($id);
            //return $id;
            header("Location: /Hist_Clinica/admin/pacientes/nvoPaciente.php?resultado=1");
        }

        public function Actualizar() {
            //debuguear('Actualizando...');
            // Sanitizar datos
            $atributos = $this->sanitizarAtributos();

            $valores = [];
            foreach ($atributos as $key => $value) {
                $valores[] = "{$key}='{$value}'";
            }

            $query = "UPDATE " . static::$tabla ." SET ";
            $query .= join (', ', $valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1";
            
            //debuguear($query);
            $resultado = self::$db->query($query);
            //$id = self::$db->insert_id;
            //debuguear($id);
            //return $id;
            header("Location: /Hist_Clinica/admin/pacientes/listarPacientes.php?resultado=2");
        }
    
        public function eliminar() {
            // Eliminar registro

            $query = "UPDATE " . static::$tabla ." SET ";
            $query .= "nHabilitado = 0 where id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";

            //debuguear($query);
            $resultado = self::$db->query($query);
            header("Location: /Hist_Clinica/admin/pacientes/listarPacientes.php?resultado=3");
        }

        // Identificar y unir los atributos de la BD
        public function atributos() {
            $atributos = [];
            foreach (static::$columnasDB as $columna) {
                if($columna === 'id') continue;
                if($columna === 'nHabilitado') continue;
                if($columna === 'idusuario') continue;
                if($columna === 'cNombreMed') continue;
                if($columna === 'cPassword') {
                    $atributos[$columna] = password_hash($this->$columna, PASSWORD_DEFAULT);
                } else {
                    $atributos[$columna] = $this->$columna;
                }
                //$atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }
    
        public function sanitizarAtributos() {
            //
            $atributos = $this->atributos();
            $sanitizado = [];
            //debuguear($atributos);
            foreach ($atributos as $key => $value) {
                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }
    
        public static function getErrores() {
            return self::$errores;
        }
    
        public function validar() {
            static::$errores = [];
            return static::$errores;
        }
    
        public static function all() {

            if (static::$tabla === "tblPaciente") {
                $Query = "SELECT Pa.*,Pe.cNombre cNombreMed FROM " . static::$tabla ." Pa inner join tblPersonal Pe on Pa.tblPersonal_id = Pe.id 
                inner join tblUsuarios U on Pe.id = U.tblPersonal_id inner join catPuestos Pu on U.catPuestos_id = Pu.id
                 where Pa.nHabilitado = 1";
            }
            elseif (static::$tabla === "tblUsuarios") {
                $Query = "SELECT A.idusuario,A.cUsuario,'' cPassword,A.nHabilitado,A.dFechaRegistro,B.cPerfilUsuario idPerfilesUser,
                C.cNombre tblPersonal_id,D.cPuesto catPuestos_id FROM " . static::$tabla . " A inner join catPerfilUsuarios B 
                on A.idPerfilesUser = B.idPerfilesUser inner join tblPersonal C
                on A.tblPersonal_id = C.id inner join catPuestos D
                on A.catPuestos_id = D.id 
                where A.nHabilitado = 1 and B.nHabilitado = 1 and C.nHabilitado = 1 and D.nHabilitado = 1;";
            } else {
                $Query = "SELECT * FROM " . static::$tabla . " where nHabilitado = 1";
            }

            //debuguear($Query);
            $resultado = self::consultarSQL($Query);
            
            return $resultado;
        }
    
        public static function findReg($idReg) {
            //$Query = "SELECT * FROM tblPaciente WHERE id = ${idReg}";
            //debuguear(static::$tabla);

            if (static::$tabla === "tblPaciente") {
                $Query = "SELECT Pa.*,Pe.cNombre cNombreMed FROM " . static::$tabla ." Pa inner join tblPersonal Pe on Pa.tblPersonal_id = Pe.id 
                inner join tblUsuarios U on Pe.id = U.tblPersonal_id inner join catPuestos Pu on U.catPuestos_id = Pu.id 
                where Pa.id = ${idReg};";
            } elseif (static::$tabla === "tblUsuarios") {
                $Query = "SELECT * FROM " . static::$tabla . " where cUsuario = '" . $idReg . "'";
            } else {
                $Query = "SELECT * FROM " . static::$tabla . " where id = " . $idReg;
            }
            //debuguear($Query);
    
            $resultado = self::consultarSQL($Query);
            
            //debuguear( array_shift($resultado) );
            if (static::$tabla === "tblUsuarios") {
                return $resultado;
            } else {
                return array_shift($resultado);
            }
            //return $resultado;
        }
    
        public static function consultarSQL($Query) {
            //debuguear($Query);
            // Consultar la base de datos
            $resultado = self::$db->query($Query);
    
            // Iterar los resultados
            //debuguear($resultado->fetch_assoc());
            $array = [];
            while ($registro = $resultado->fetch_assoc()) {
                $array[] = static::crearObjeto($registro);
            }
    
            // Liberar la memoria
            $resultado->free();
    
            // retomar los resultados
            return $array;
        }
    
        protected static function crearObjeto($registro) {
            $objeto = new static;
    
            foreach ($registro as $key => $value) {
                if (property_exists( $objeto , $key )) {
                    $objeto->$key = $value;
                }
            }
            return $objeto;
        }
    // Sincronixar el objeto en memoria con los cambios realizados por el usuario
        public function sincronizar( $args = [] ) {
            //debuguear($args);
            foreach ($args as $key => $value) {
                if (property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                }
            }
        }    
}