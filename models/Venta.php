<?php
namespace Model;

class Venta extends ActiveRecord {
    protected static $tabla = 'venta';
    protected static $columnasDB = ['numventa', 'fecha', 'totalkg', 'totalpagar', 'idcliente', 'codproducto', 'tipoventa'];

    public $numventa;
    public $fecha;
    public $totalkg;
    public $totalpagar;
    public $idcliente;
    public $codproducto;
    public $tipoventa;

    public function __construct($args = []) {
        $this->numventa = $args['numventa'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->totalkg = $args['totalkg'] ?? '';
        $this->totalpagar = $args['totalpagar'] ?? '';
        $this->idcliente = $args['idcliente'] ?? '';
        $this->codproducto = $args['codproducto'] ?? '';
        $this->tipoventa = $args['tipoventa'] ?? '';
    
    }

}