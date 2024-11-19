<script type="module" src="../public/build/js/confirmarVenta.js"></script>

<h1>Verificar venta</h1>
<section class="contenedorIframePDF">
    <div id="modalPrevisualizacion">
        <iframe id="iframePrevisualizacion"><?echo $pdf ?></iframe>
    </div>
    <div class="contenedor-boton">
        <button class="boton_verde" onclick="confirmarVenta()">Confirmar Venta</button>
        <button class="boton">Cerrar</button>
    </div>
</section>