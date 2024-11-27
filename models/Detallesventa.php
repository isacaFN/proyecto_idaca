<?php
namespace Model;

class Detallesventa extends ActiveRecord {
    protected static $tabla = 'detallventa';
    protected static $columnasDB = ['idcliente', 'cantidad', 'codproducto', 'subtotal', 'numventa', 'nombre', 'fecha', 'nomprod', 'precio', 'montoNeto', 'totaliva', 'totalpagar', 'tipoventa', 'pdf'];

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
    public $tipoventa;
    public $pdf;
    public $cantidad_vendida;

    public function __construct($args = []) {
        $this->idcliente = $args['idcliente'] ?? ''; // v.idcliente,
        $this->cantidad = $args['cantidad'] ?? ''; // dv.cantidad,
        $this->codproducto = $args['codproducto'] ?? ''; // dv.codproducto,
        $this->subtotal = $args['subtotal'] ?? ''; // dv.subtotal,
        $this->numventa = $args['numventa'] ?? ''; // dv.numventa,
        $this->nombre = $args['nombre'] ?? ''; // c.nombre,
        $this->fecha = $args['fecha'] ?? ''; // v.fecha,
        $this->nomprod = $args['nomprod'] ?? ''; // p.nomprod, 
        $this->precio = $args['precio'] ?? ''; // p.precio,
        $this->montoNeto = $args['montoNeto'] ?? ''; // v.montoNeto,
        $this->totaliva = $args['totaliva'] ?? ''; // listo
        $this->totalpagar = $args['totalpagar'] ?? ''; // listo
        $this->tipoventa = $args['tipoventa'] ?? ''; // v.tipoventa, 
        $this->pdf = $args['pdf'] ?? ''; // v.tipoventa, 
        $this->cantidad_vendida = $args['cantidad_vendida'] ?? ''; // SUM(d.cantidad) AS cantidad_vendida


    
    }

    public static function ventaEspecifica($numventa) {
        $query = "SELECT 
        dv.numventa,
        dv.codproducto,
        dv.cantidad,
        dv.subtotal,
        p.nomprod, 
        p.precio,
        v.idcliente, 
        v.fecha,
        v.tipoventa, 
        v.montoNeto,
        v.totaliva,
        v.totalpagar,
        v.pdf,
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


        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function productoMasPedido(){
        $query = "SELECT 
            p.nomprod,
            SUM(d.cantidad) AS cantidad_vendida
        FROM 
            ". self::$tabla ." d
        INNER JOIN 
            producto p 
        ON 
            d.codproducto = p.codproducto
        GROUP BY 
            p.nomprod
        ORDER BY 
            cantidad_vendida DESC;";

        $resultado = self::consultarSQL($query);
        return $resultado;

    }

}