<?php

namespace App;

class CatPerfilUsuarios extends ActiveRecord {
    // Base de Datos
    protected static $columnasDB = ['idPerfilesUser','cPerfilUsuario','nHabilitado','dFechaRegistro'];
    protected static $tabla = 'catPerfilUsuarios';
    
    public $idPerfilesUser;
    public $cPerfilUsuario;
    public $nHabilitado;
    public $dFechaRegistro;

    public function __construct($args = [])
    {
        $this->idPerfilesUser = $args['idPerfilesUser'] ?? '';
        $this->cPerfilUsuario = $args['cPerfilUsuario'] ?? '';
        $this->nHabilitado = $args['nHabilitado'] ?? '';
        $this->dFechaRegistro = $args['dFechaRegistro'] ?? '';
    }

}