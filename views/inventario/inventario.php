<script type="module" src="../public/build/js/inventario.js"></script>

<section>
    <h1>Inventario</h1>
    <table class="tabla">
        <thead>
            <tr>
                <th>Código producto</th>
                <th>Nombre producto</th>
                <th>Cantidad Actual</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ($stocks as $stock) { ?>
            <tr> 
                <td> <?php echo $stock->codproducto; ?> </td>
                <td> <?php echo $stock->nomprod; ?> </td>
                <td> <?php echo $stock->cantactual; ?> </td>
            </tr> 
                <?php } ?>
        </tbody>
    </table>

        <div class="botones">
            <a class="boton_verde" onclick="agregarInventario()">Agregar inventario</a>
            <div id="modal-datos"></div>
        </div>
</section>