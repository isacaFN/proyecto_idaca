<?php
namespace Model;

class Stock extends ActiveRecord {
    protected static $tabla = 'stock';
    protected static $columnasDB = ['id', 'codproducto', 'cantactual'];

    public $id;
    public $codproducto;
    public $cantactual;
    public $nomprod;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null; 
        $this->codproducto = $args['codproducto'] ?? ''; 
        $this->cantactual = $args['cantactual'] ?? ''; 
        $this->nomprod = $args['nomprod'] ?? '';

    }

    public static function findByCodProducto($codproducto) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE codproducto = '" . self::$db->escape_string($codproducto) . "' LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); // Devuelve el primer elemento del array o null
    }

    public static function productoyCantidad(){
        $query = "SELECT p.codproducto, p.nomprod, s.cantactual 
          FROM producto p
          JOIN stock s ON p.codproducto = s.codproducto";

        $resultado = self::consultarSQL($query);
        return $resultado;

    }

}