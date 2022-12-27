<?php

namespace App;

class TblUsuarios extends ActiveRecord {
    // Base de Datos
    protected static $columnasDB = ['idusuario','cUsuario','cPassword','nHabilitado','dFechaRegistro','idPerfilesUser','tblPersonal_id','catPuestos_id'];
    protected static $tabla = 'tblUsuarios';

    public $idusuario;
    public $cUsuario;
    public $cPassword;
    public $nHabilitado;
    public $dFechaRegistro;
    public $idPerfilesUser;
    public $tblPersonal_id;
    public $catPuestos_id;

    public function __construct($args = [])
    {
        $this->idusuario = $args['idusuario'] ?? '';
        $this->cUsuario = $args['cUsuario'] ?? '';
        $this->cPassword = $args['cPassword'] ?? '';
        $this->nHabilitado = $args['nHabilitado'] ?? '';
        //$this->dFechaRegistro = $args['dFechaRegistro'] ?? '';
        $this->dFechaRegistro = date('Y-m-d h:m:s');
        $this->idPerfilesUser = $args['idPerfilesUser'] ?? '';
        $this->tblPersonal_id = $args['tblPersonal_id'] ?? '';
        $this->catPuestos_id = $args['catPuestos_id'] ?? '';
    }

    public function validar() {
        if (!$this->cUsuario) {
            self::$errores[] = "Debes capturar el usuario";
        }

        if (!$this->cPassword) {
            self::$errores[] = "Debes capturar el password del usuario";
        }

        if (!$this->idPerfilesUser) {
            self::$errores[] = "Debes seleccionar el perfil del usuario";
        }

        if (!$this->tblPersonal_id) {
            self::$errores[] = "Debes seleccionar el usuario";
        }

        if (!$this->catPuestos_id) {
            self::$errores[] = "Debes seleccionar el puesto del usuario";
        }
        return self::$errores;
    }

    public function validarAcceso() {
        if (!$this->cUsuario) {
            self::$errores[] = "Debes capturar el usuario";
        }

        if (!$this->cPassword) {
            self::$errores[] = "Debes capturar el password del usuario";
        }
        return self::$errores;
    }

    /*
    public static function findReg($cUsuario) {
        $Query = "SELECT * FROM tblUsuarios WHERE cUsuario = '${cUsuario}'";

        //debuguear($Query);
        $resultado = self::consultarSQL($Query);
        
        return $resultado;
    }
*/
/*     public static function findRegPerfil() {
        $Query = "SELECT * FROM catPerfilUsuarios WHERE nHabilitado = 1;";

        //debuguear($Query);
        $resultado = self::consultarSQL($Query);
        
        return $resultado;
    } */
/*
    public static function consultarSQL($Query) {
        // Consultar la base de datos
        $resultado = self::$db->query($Query);

        // Iterar los resultados
        //debuguear($resultado->fetch_assoc());
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // retomar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if (property_exists( $objeto , $key )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }


    public function guardarUsuario() {
        
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();
        //debuguear($this->$atributos);
        $string = join(', ', array_keys($atributos));
        //debuguear($string);

         // Insertar en la base de datos
        $sql="INSERT INTO tblUsuarios (";
        $sql .= join(', ', array_keys($atributos));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($atributos));
        $sql .= " ') ";

        //debuguear($sql);

        $resultado = self::$db->query($sql);        
        //var_dump(self::$db->insert_id());
        //$id = self::$db->lastInsertId();
        //$lastInsertId = $conn->lastInsertId();
        //debuguear($resultado->insert_id);
        //$id = mysqli_insert_id();
        //$id = self::$db->insert_id;
        //return $id;
        //debuguear($id);
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'idusuario') continue;
            if($columna === 'nHabilitado') continue;
            if($columna === 'dFechaRegistro') continue;
            if($columna === 'cPassword') {
                $atributos[$columna] = password_hash($this->$columna, PASSWORD_DEFAULT);
                //debuguear($atributos[$columna]);
            } else {
                $atributos[$columna] = $this->$columna;
            }
            //$passHash = password_hash($pass, PASSWORD_DEFAULT);            
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
    */

}