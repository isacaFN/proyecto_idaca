<?php
namespace Model;

class Cliente extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'dni', 'nombre', 'telefono', 'correo', 'direccion'];

    public $id;
    public $dni;
    public $nombre;
    public $telefono;
    public $correo;
    public $direccion;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->dni = $args['dni'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
    
    }

    public function validarCliente(){
        if(!$this->nombre){
            self::$alertas['error'][] = "El nombre del usuario es obligatorio";
        }

        if(!$this->dni){
            self::$alertas['error'][] = "El rut o dni del usuario es obligatorio";
        }

        if(!$this->correo){
            self::$alertas['error'][] = "El correo electronico es obligatorio";
        }

        if(!$this->direccion){
            self::$alertas['error'][] = "La direccion es obligatoria";
        }

        return self::$alertas;
    }

    public function extisteCliente(){
        $query = "SELECT * FROM " .self::$tabla. " WHERE dni = '{$this->dni}' limit 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows > 0){
            self::$alertas['error'][] = "El cliente ya esta registrado";

        }

        return $resultado;
    }
}
?>