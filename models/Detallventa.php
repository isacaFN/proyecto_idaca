<?php
namespace Model;

class Detallventa extends ActiveRecord {
    protected static $tabla = 'detallventa';
    protected static $columnasDB = ['id', 'cantidad', 'codproducto', 'subtotal', 'numventa'];

    public $id;
    public $cantidad;
    public $codproducto;
    public $subtotal;
    public $numventa;

    public function __construct($args = []) {
        $this->numventa = $args['id'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->codproducto = $args['codproducto'] ?? '';
        $this->subtotal = $args['subtotal'] ?? '';
        $this->numventa = $args['numventa'] ?? '';
    
    }

    public static function ventaEspecifica($numventa) {
        $query = "SELECT 
        dv.numventa,
        dv.codproducto, 
        p.nomprod, 
        v.idcliente, 
        v.tipoventa, 
        c.nombre, 
        t.tipov as tipoventa 
    FROM 
        " . self::$tabla ." dv
    JOIN 
        venta v ON dv.numventa = v.numventa
    JOIN 
        producto p ON dv.codproducto = p.codproducto
    JOIN 
        clientes c ON v.idcliente = c.id
    JOIN 
        tipoven t ON v.tipoventa = t.id
    WHERE 
        dv.numventa = $numventa ";


        $resultado = self::$db->query($query);
        return $resultado;
    }

}