<script type="module" src="../public/build/js/detalleVenta.js"></script>
<?php $encomun = $venta[0]; 

$arrayFiltrado = [];

foreach ($venta as $detalles) {
    $arrayFiltrado[] = [
        'cantidad' => $detalles->cantidad,
        'codproducto' => $detalles->codproducto,
        'subtotal' => $detalles->subtotal,
        'nomprod' => $detalles->nomprod,
        'precio' => $detalles->precio
    ];
}


?>
<section class="contenedor-lista-usuarios">
        <h1>Detalle de Venta</h1>
        <div class="contenedor_detalleventa">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Numero de venta</th>
                        <th>Nombre Cliente</th>
                        <th>Fecha de venta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $encomun->numventa; ?></td>
                        <td><?php echo $encomun->nombre; ?></td>
                        <td><?php echo $encomun->fecha; ?></td>
                    </tr>
                </tbody>
            </table>
        <p>Detalles de productos</p>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Código producto</th>
                        <th>Nombre producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arrayFiltrado as $producto) {?><tr>
                        <td><?php echo $producto['codproducto']; ?></td>
                        <td><?php echo $producto['nomprod']; ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td><?php echo number_format($producto['precio'], 0, ',', '.'); ?></td>
                        <td><?php echo number_format($producto['subtotal'], 0, ',', '.'); ?></td>
                        </tr><?php }; ?>
                </tbody>
            </table>
    
            <p>Detalles de pago</p>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Monto neto</th>
                        <th>Total Iva</th>
                        <th>Total pagado</th>
                        <th>Condicion de pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo number_format($encomun->montoNeto, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($encomun->totaliva, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($encomun->totalpagar, 0, ',', '.'); ?></td>
                        <td><?php echo $encomun->tipoventa; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="botones">
            <a class="boton_verde" data-pdf="<?php echo $encomun->pdf; ?>">Descargar PDF</a>
            <a href="ventas" class="boton">Volver</a>
        </div>

</section>
