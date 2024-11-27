<?php

namespace controllers;

use Model\Usuario;
use MVC\router;
use Model\Cliente;
use Model\Producto;
use controllers\VentaController;
use Model\TipoVenta;
use Model\Venta;
use Model\Detallesventa;

class ApiController{
    public static function apiUsuarios(router $router){
        $usuarios = Usuario::all();

        echo json_encode($usuarios);

    }

    public static function apiClientes(router $router){
        $clientes = cliente::all();

        echo json_encode($clientes);
    }

    public static function apiProductos(router $router){
        $productos = Producto::all();

        echo json_encode($productos);
    }

    public static function apitipoventa(router $router){
        $productos = TipoVenta::all();

        echo json_encode($productos);
    }

    public static function apiventas(router $router){
        $ventas = Venta::all();

        echo json_encode($ventas);
    }

    public static function apiventastotales(router $router){
        $totalpagar = "totalpagar";
        $totalventa = Venta::suma($totalpagar);

        echo json_encode([
            'ventas_totales' => $totalventa->{"SUM(totalpagar)"},
        ]);
    }

    public static function apiproductosmaspedido(router $router){
        $productos = Detallesventa::productoMasPedido();

        // Crear un arreglo nuevo con los datos necesarios
        $arregloNuevo = array_map(function ($item) {
            return (object)[
                "nomprod" => $item->nomprod,
                "cantidad_vendida" => $item->cantidad_vendida
            ];
        }, $productos);

        
        echo json_encode($arregloNuevo);
    }
}