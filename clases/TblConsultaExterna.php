<?php

namespace App;

class TblConsultaExterna extends ActiveRecord {
// Base de Datos
protected static $columnasDB = ['id','nPeso_KG','nTalla_CM','nIMC','nCirc_Cintura_cm','nP_A_Sistolica','nP_A_Distolica','nFCardiaca','nFRespiratoria','nTemp','nSaturaOxigeno','nGlucemia','dFechaRegistro','tblPaciente_id'];
protected static $tabla = 'tblConsultaExterna';

public $id;
public $nPeso_KG;
public $nTalla_CM;
public $nIMC;
public $nCirc_Cintura_cm;
public $nP_A_Sistolica;
public $nP_A_Distolica;
public $nFCardiaca;
public $nFRespiratoria;
public $nTemp;
public $nSaturaOxigeno;
public $nGlucemia;
public $dFechaRegistro;
public $tblPaciente_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nPeso_KG = $args['nPeso_KG'] ?? '';
        $this->nTalla_CM = $args['nTalla_CM'] ?? '';
        $this->nIMC = $args['nIMC'] ?? '';
        $this->nCirc_Cintura_cm = $args['nCirc_Cintura_cm'] ?? '';
        $this->nP_A_Sistolica = $args['nP_A_Sistolica'] ?? '';        
        $this->nP_A_Distolica = $args['nP_A_Distolica'] ?? '';
        $this->nFCardiaca = $args['nFCardiaca'] ?? '';
        $this->nFRespiratoria = $args['nFRespiratoria'] ?? '';
        $this->nTemp = $args['nTemp'] ?? '';
        $this->nSaturaOxigeno = $args['nSaturaOxigeno'] ?? '';
        $this->nGlucemia = $args['nGlucemia'] ?? '';
        $this->dFechaRegistro = date('Y-m-d h:m:s');
        $this->tblPaciente_id = $args['tblPaciente_id'] ?? '';  
    }

    public function validar() {
        
        if (!$this->nPeso_KG) {
            self::$errores[] = "Debes capturar el peso en kg. del paciente";
        }

        if (!$this->nTalla_CM) {
            self::$errores[] = "Debes capturar talla en cm del paciente";
        }

        if (!$this->nIMC) {
            self::$errores[] = "Debes capturar el indice de masa corporal";
        }
    
        if (!$this->nCirc_Cintura_cm) {
            self::$errores[] = "Debes capturar la medida de circunferencia en cm";
        }
    
        if (!$this->nP_A_Sistolica) {
            self::$errores[] = "Debes capturar la presión arterial sistolica";
        }

        if (!$this->nP_A_Distolica) {
            self::$errores[] = "Debes capturar la presión arterial diastolica";
        }

        if (!$this->nFCardiaca) {
            self::$errores[] = "Debes capturar la frecuencia cardiaca";
        }

        if (!$this->nFRespiratoria) {
            self::$errores[] = "Debes capturar la frecuencia respiratoria";
        }

        if (!$this->nTemp) {
            self::$errores[] = "Debes capturar la temperatura";
        }

        if (!$this->nSaturaOxigeno) {
            self::$errores[] = "Debes capturar la saturacion de Oxigeno";
        }

        if (!$this->nGlucemia) {
            self::$errores[] = "Debes capturar la glucemia";
        }

    return self::$errores;
}


}
