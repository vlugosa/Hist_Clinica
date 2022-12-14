<?php

namespace App;

class TblPaciente {
    // Base de Datos
    protected static $db;
    protected static $columnasDB = ['id','cNumExpediente','cUnidadMedica','cCURP','cNombre','cPaterno','cMaterno','dFechaNacimiento','cGenero','nHabilitado','tblPersonal_id','cNombreMed'];

    // Errores
    protected static $errores = [];

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

    // Definir la conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

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

    public function guardarPaciente() {
        
        // Sanitizar datos
        $atributos = $this->sanitizarAtributos();
        //debuguear($this->$atributos);
        $string = join(', ', array_keys($atributos));
        //debuguear($string);

         // Insertar en la base de datos
        $sql="INSERT INTO tblPaciente (";
        $sql .= join(', ', array_keys($atributos));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($atributos));
        $sql .= " ') ";

        $resultado = self::$db->query($sql);        
        //var_dump(self::$db->insert_id());
        //$id = self::$db->lastInsertId();
        //$lastInsertId = $conn->lastInsertId();
        //debuguear($resultado->insert_id);
        //$id = mysqli_insert_id();
        $id = self::$db->insert_id;
        return $id;
        //debuguear($id);
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            if($columna === 'nHabilitado') continue;
            if($columna === 'cNombreMed') continue;
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

    public function validar() {
        if (!$this->cCURP) {
            self::$errores[] = "Debes capturar el CURP del paciente";
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

        if (!$this->cGenero) {
            self::$errores[] = "Seleccione genero del paciente";
        }
        

        return self::$errores;
    }

    public static function all() {
        //$Query = "SELECT * FROM tblPaciente";

        $Query = "SELECT Pa.*,Pe.cNombre cNombreMed FROM tblPaciente Pa inner join tblPersonal Pe on Pa.tblPersonal_id = Pe.id 
        inner join tblUsuarios U on Pe.id = U.tblPersonal_id inner join catPuestos Pu on U.catPuestos_id = Pu.id;";

        $resultado = self::consultarSQL($Query);
        
        return $resultado;
    }

    public static function findReg($idReg) {
        //$Query = "SELECT * FROM tblPaciente WHERE id = ${idReg}";
        $Query = "SELECT Pa.*,Pe.cNombre cNombreMed FROM tblPaciente Pa inner join tblPersonal Pe on Pa.tblPersonal_id = Pe.id 
        inner join tblUsuarios U on Pe.id = U.tblPersonal_id inner join catPuestos Pu on U.catPuestos_id = Pu.id 
        where Pa.id = ${idReg};";

        //debuguear($Query);

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

    public function sincronizar( $args = [] ) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    } 

}