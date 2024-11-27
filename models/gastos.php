<?php
namespace Model;

class Gastos extends ActiveRecord {
    protected static $tabla = 'gasto';
    protected static $columnasDB = ['id', 'fecha', 'monto', 'idnombre'];

    public $id;
    public $fecha;
    public $monto;
    public $idnombre;
    public $nombre;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->monto = $args['monto'] ?? '';
        $this->idnombre = $args['idnombre'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
    
    }

    public static function nombreGasto(){
        $query = "SELECT gasto.fecha,
                        g.nombre,
                        gasto.monto 
                FROM nombregasto AS g
                INNER JOIN gasto ON gasto.idnombre = g.id";

        $resultado = self::consultarSQL($query);
        return $resultado;

    }

}