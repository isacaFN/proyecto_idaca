<?php
namespace Model;

class TipoVenta extends ActiveRecord {
    protected static $tabla = 'tipoven';
    protected static $columnasDB = ['id', 'tipov'];

    public $id;
    public $tipov;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->tipov = $args['tipov'] ?? '';
    }
}