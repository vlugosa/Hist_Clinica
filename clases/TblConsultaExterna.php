<?php

namespace App;

class TblConsultaExterna {
// Base de Datos
protected static $db;
protected static $columnasDB = ['id','cNumExpediente','cUnidadMedica','cCURP','cNombre','cPaterno','cMaterno','dFechaNacimiento','cGenero','nHabilitado','tblPersonal_id','cNombreMed'];

// Errores
protected static $errores = [];

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

    // Definir la conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

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
        $this->dFechaAlta = date('Y-m-d h:m:s');
        $this->tblPaciente_id = $args['tblPaciente_id'] ?? '';  
    }

    public function guardar() {
        
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();
        //debuguear($atributos);
        $string = join(', ', array_keys($atributos));
        //debuguear($string);

        // Insertar en la base de datos
        $sql="INSERT INTO tblConsultaExterna (";
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

}
