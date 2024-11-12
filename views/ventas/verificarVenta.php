<script type="module" src="../public/build/js/confirmarVenta.js"></script>

<h1>Verificar venta</h1>

<div id="modalPrevisualizacion" style="display:none;">
    <iframe id="iframePrevisualizacion" width="100%" height="600px" src="<?php echo $pdf; ?>"></iframe>
    <button onclick="confirmarVenta()">Confirmar Venta</button>
    <button onclick="document.getElementById('modalPrevisualizacion').style.display='none'">Cerrar</button>
</div>
