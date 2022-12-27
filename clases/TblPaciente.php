<?php

namespace App;

class TblPaciente extends ActiveRecord {
    protected static $columnasDB = ['id','cNumExpediente','cUnidadMedica','cCURP','cNombre','cPaterno','cMaterno','dFechaNacimiento','cGenero','nHabilitado','tblPersonal_id','cNombreMed'];
    protected static $tabla = 'tblPaciente';

    public $id;
    public $cNumExpediente;
    public $cUnidadMedica;
    public $cCURP;
    public $cNombre;
    public $cPaterno;
    public $cMaterno;
    public $dFechaNacimiento;
    public $cGenero;
    public $nHabilitado;
    public $tblPersonal_id;
    public $cNombreMed;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->cNumExpediente = $args['cNumExpediente'] ?? '';
        $this->cUnidadMedica = $args['cUnidadMedica'] ?? '';
        $this->cCURP = $args['cCURP'] ?? '';
        $this->cNombre = $args['cNombre'] ?? '';
        $this->cPaterno = $args['cPaterno'] ?? '';
        $this->cMaterno = $args['cMaterno'] ?? '';
        $this->dFechaNacimiento = $args['dFechaNacimiento'] ?? '';
        $this->cGenero = $args['cGenero'] ?? '';
        $this->nHabilitado = 1;
        $this->tblPersonal_id = $args['tblPersonal_id'] ?? '';
        $this->cNombreMed = $args['cNombreMed'] ?? '';
        //$this->dFechaAlta = date('Y-m-d h:m:s');
    }

        public function validar() {
        
            if (!$this->tblPersonal_id) {
                self::$errores[] = "Debes seleccionar el medico de consulta";
            }

            if (!$this->cNumExpediente) {
                self::$errores[] = "Debes capturar el numero de expediente del paciente";
            }
    
            if (!$this->cNombre) {
                self::$errores[] = "Debes capturar el nombre del paciente";
            }
        
            if (!$this->cPaterno) {
                self::$errores[] = "Debes capturar el apellido paterno del paciente";
            }
        
            if (!$this->cMaterno) {
                self::$errores[] = "Debes capturar apellido materno del paciente";
            }

            if (!$this->dFechaNacimiento) {
                self::$errores[] = "Seleccione la fecha de nacimiento del paciente";
            }

            if (!$this->cCURP) {
                self::$errores[] = "Debes capturar el CURP del paciente";
            }
            if (!$this->cGenero) {
                self::$errores[] = "Seleccione genero del paciente";
            }
        return self::$errores;
    }

}