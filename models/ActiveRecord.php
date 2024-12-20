<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        if ($resultado->field_count === 1) {
            $array = [];
            while ($registro = $resultado->fetch_assoc()) {
                $array[] = (object) $registro;
            }
            $resultado->free();
            return $array;
        }

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }

        return $this;
    }

    // CRUD
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;

    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function registrosTotales() {
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);


        // Verificar que el resultado sea un arreglo y que contiene la clave 'total'
        if ($resultado && isset($resultado[0]->total)) {
            return (int) $resultado[0]->total;  // Convertir a entero
        }
    
        // Si no hay resultados, retornar 0 como fallback
        return 0;
    }

    public static function suma($columna) {
        $query = "SELECT SUM({$columna}) FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Busca un registro por su columna y valor
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

    // public function actualizar($incrementarCantactual = false) {
    //     // Sanitizar los datos
    //     $atributos = $this->sanitizarAtributos();
    

    //     if (!$incrementarCantactual) {
    //         unset($atributos['cantactual']);
    //     }
    
    //     // Construir los valores para la consulta
    //     $valores = [];
    //     foreach ($atributos as $key => $value) {
    //         $valores[] = "{$key} = '{$value}'";
    //     }
    
    //     if ($incrementarCantactual && property_exists($this, 'cantactual') && !is_null($this->cantactual)) {
    //         $valores[] = "cantactual = cantactual + '" . self::$db->escape_string($this->cantactual) . "'";
    //     }
    
    //     // Construir la consulta SQL
    //     $query = "UPDATE " . static::$tabla . " SET ";
    //     $query .= join(', ', $valores);
    //     $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    //     $query .= " LIMIT 1";
    
    //     // Ejecutar la consulta
    //     $resultado = self::$db->query($query);
    //     return $resultado;
    // }


    public function actualizar($incrementarCantactual = false) {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
    
        if (!$incrementarCantactual) {
            unset($atributos['cantactual']);
        }
    
        // Construir los valores para la consulta
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key} = '" . self::$db->escape_string($value) . "'";
        }
    
        // Agregar suma de cantactual si aplica
        if (property_exists($this, 'cantactual') && !is_null($this->cantactual)) {
            $cantactual = self::$db->escape_string($this->cantactual);
            $valores[] = "cantactual = cantactual + {$cantactual}";
        }
    
        // Construir la consulta SQL
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";
    
        // Depurar la consulta SQL
        error_log("Consulta SQL: " . $query);
    
        // Ejecutar la consulta
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    

}