<?php
namespace Model;

class Cliente extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombre', 'telefono', 'correo', 'direccion'];

    public $id;
    public $nombre;
    public $telefono;
    public $correo;
    public $direccion;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
    
    }
}
?>