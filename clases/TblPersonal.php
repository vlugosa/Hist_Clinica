<?php

namespace App;

class TblPersonal extends ActiveRecord {
    // Base de Datos
    protected static $columnasDB = ['id','cNombre','cTelefono','cMovil','cColonia','cDireccion'];
    protected static $tabla = 'tblPersonal';

    public $id;
    public $cNombre;
    public $cTelefono;
    public $cMovil;
    public $cColonia;
    public $cDireccion;
    public $dFechaAlta;
    public $nHabilitado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->cNombre = $args['cNombre'] ?? '';
        $this->cTelefono = $args['cTelefono'] ?? '';
        $this->cMovil = $args['cMovil'] ?? '';
        $this->cColonia = $args['cColonia'] ?? '';
        $this->cDireccion = $args['cDireccion'] ?? '';
        $this->dFechaAlta = $args['dFechaAlta'] ?? '';
        $this->nHabilitado = 1;
    }

    public function validar() {
        if (!$this->cNombre) {
            self::$errores[] = "Debes capturar el nombre del usuario";
        }
    
        if (!$this->cMovil) {
            self::$errores[] = "Debes capturar el teléfono movil del usuario";
        }
    
        if (!preg_match('/[0-9]{10}/', $this->cMovil)) {
            self::$errores[] = "Formato no válida";
        }
        
        if (!$this->cColonia) {
            self::$errores[] = "Debes capturar la colonia del usuario";
        }
    
        if (!$this->cDireccion) {
            self::$errores[] = "Debes capturar la dirección del usuario";
        }

        
        return self::$errores;
    }

/* 
    // Definir la conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->cNombre = $args['cNombre'] ?? '';
        $this->cTelefono = $args['cTelefono'] ?? '';
        $this->cMovil = $args['cMovil'] ?? '';
        $this->cColonia = $args['cColonia'] ?? '';
        $this->cDireccion = $args['cDireccion'] ?? '';
        $this->dFechaAlta = date('Y-m-d h:m:s');
        $this->nHabilitado = 1;        
    }

    public function guardar() {
        
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();
        //debuguear($atributos);
        $string = join(', ', array_keys($atributos));
        //debuguear($string);

        // Insertar en la base de datos
        $sql="INSERT INTO tblPersonal (";
        $sql .= join(', ', array_keys($atributos));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($atributos));
        $sql .= " ') ";

        $resultado = self::$db->query($sql);
        //debuguear($resultado);
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
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

    

    public static function all() {

        $Query = "SELECT * FROM tblPersonal where nHabilitado = 1;";

        $resultado = self::consultarSQL($Query);
        
        return $resultado;
    }

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
 */

}