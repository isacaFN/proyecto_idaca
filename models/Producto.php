<?php
namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'producto';
    protected static $columnasDB = ['codproducto', 'nomprod', 'precio'];

    public $codproducto;
    public $nomprod;
    public $precio;

    public function __construct($args = []) {
        $this->codproducto = $args['codproducto'] ?? null;
        $this->nomprod = $args['nomprod'] ?? '';
        $this->precio = $args['precio'] ?? '';
    
    }
}