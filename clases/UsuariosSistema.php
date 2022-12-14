<?php

namespace App;

class UsuariosSistema {

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
        $this->dFechaAlta = date('Y-m-d h:m:s');
        $this->nHabilitado = $args['$nHabilitado'] ?? '';        
    }

    public function guardar() {
        echo "Guardando informacion en la base de datos";

        // Insertar en la base de datos
        $sql="INSERT INTO tblPaciente (nNumExpediente,cUnidadMedica,cNombre,cPaterno,
        cMaterno,dFechaNac,cGenero,FechaRegistro,idMedico) VALUES (:n_Expediente,:unidadMedica,:nombre,
        :apaterno,:amaterno,:Fecha_Nacimiento,:genero,:Fecha,:idMedico)";
    }
}