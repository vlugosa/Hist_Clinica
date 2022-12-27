<?php

namespace App;

class CatPuestos extends ActiveRecord {
    // Base de Datos
    protected static $columnasDB = ['id','cPuesto','nHabilitado','dFecha'];
    protected static $tabla = 'catPuestos';

    public $id;
    public $cPuesto;
    public $nHabilitado;
    public $dFecha;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->cPuesto = $args['cPuesto'] ?? '';
        $this->nHabilitado = $args['nHabilitado'] ?? '';
        $this->dFecha = $args['dFecha'] ?? '';
    }

    public function validar() {
        if (!$this->cPerfilUsuario) {
            self::$errores[] = "Debes capturar el perfil del usuario";
        }

        return self::$errores;
    }

}