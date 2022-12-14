<?php

namespace App;

class CatPerfilUsuarios {
    // Base de Datos
    protected static $db;
    protected static $columnasDB = ['idPerfilesUser','cPerfilUsuario','nHabilitado','dFechaRegistro'];

    // Errores
    protected static $errores = [];

    public $idPerfilesUser;
    public $cPerfilUsuario;
    public $nHabilitado;
    public $dFechaRegistro;

    // Definir la conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->idPerfilesUser = $args['idPerfilesUser'] ?? '';
        $this->cPerfilUsuario = $args['cPerfilUsuario'] ?? '';
        $this->nHabilitado = $args['nHabilitado'] ?? '';
        $this->dFechaRegistro = $args['dFechaRegistro'] ?? '';
    }

    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
        if (!$this->cPerfilUsuario) {
            self::$errores[] = "Debes capturar el perfil del usuario";
        }

        return self::$errores;
    }

    public static function all() {

        $Query = "SELECT * FROM catPerfilUsuarios where nHabilitado = 1;";

        $resultado = self::consultarSQL($Query);
        
        return $resultado;
    }

    public static function findRegPerfil() {
        $Query = "SELECT * FROM catPerfilUsuarios WHERE nHabilitado = 1;";

        $resultado = self::consultarSQL($Query);

        //debuguear($resultado);
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



}