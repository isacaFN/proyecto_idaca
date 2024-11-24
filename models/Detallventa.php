<?php
namespace Model;

class Detallventa extends ActiveRecord {
    protected static $tabla = 'detallventa';
    protected static $columnasDB = ['id', 'cantidad', 'codproducto', 'subtotal', 'numventa'];

    public $idcliente;
    public $cantidad;
    public $codproducto;
    public $subtotal;
    public $numventa;
    public $nombre;
    public $fecha;
    public $nomprod;
    public $precio;
    public $montoNeto;
    public $totaliva;
    public $totalpagar;
    public $tipov;

    public function __construct($args = []) {
        $this->idcliente = $args['id'] ?? ''; 
        $this->cantidad = $args['cantidad'] ?? ''; 
        $this->codproducto = $args['codproducto'] ?? ''; 
        $this->subtotal = $args['subtotal'] ?? ''; 
        $this->numventa = $args['numventa'] ?? ''; 

    
    }

}