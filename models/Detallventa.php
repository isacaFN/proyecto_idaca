<?php
namespace Model;

class Venta extends ActiveRecord {
    protected static $tabla = 'detallventa';
    protected static $columnasDB = ['id', 'cantidad', 'codproducto', 'subtotal', 'numventa'];

    public $id;
    public $cantidad;
    public $codproducto;
    public $subtotal;
    public $numventa;

    public function __construct($args = []) {
        $this->numventa = $args['id'] ?? null;
        $this->fecha = $args['cantidad'] ?? '';
        $this->totalkg = $args['codproducto'] ?? '';
        $this->totalpagar = $args['subtotal'] ?? '';
        $this->idcliente = $args['numventa'] ?? '';
    
    }

}