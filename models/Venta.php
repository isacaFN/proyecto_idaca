<?php
namespace Model;

class Venta extends ActiveRecord {
    protected static $tabla = 'venta';
    protected static $columnasDB = ['numventa', 'fecha', 'totalkg', 'totalpagar', 'idcliente', 'tipoventa', 'totaliva', 'pdf'];

    public $numventa;
    public $fecha;
    public $totalkg;
    public $totalpagar;
    public $idcliente;
    public $tipoventa;
    public $totaliva;
    public $pdf;

    public function __construct($args = []) {
        $this->numventa = $args['numventa'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->totalkg = $args['totalkg'] ?? '';
        $this->totalpagar = $args['totalpagar'] ?? '';
        $this->idcliente = $args['idcliente'] ?? '';
        $this->tipoventa = $args['tipoventa'] ?? '';
        $this->totaliva = $args['totaliva'] ?? '';
        $this->pdf = $args['pdf'] ?? '';
    
    }

}