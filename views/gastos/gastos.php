<script type="module" src="../public/build/js/gastos.js"></script>

<section>
    <h1>Gastos</h1>
    <table class="tabla">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo de gasto</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gastos as $gasto) { ?>
            <tr>
                <td><?php echo $gasto->fecha; ?></td>
                <td><?php echo $gasto->nombre; ?></td>
                <td><?php echo number_format($gasto->monto, 0, ',', '.'); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

        <div class="botones">
            <a class="boton" onclick="agregarGasto()">Agregar un Gasto</a>
            <div id="modal-datos"></div>
        </div>
</section>