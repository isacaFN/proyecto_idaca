<script type="module" src="../public/build/js/ventas.js"></script>

<section>
    <h1>Crear Venta</h1>
    <div class="contenedor-buscar-cliente">
        <div>
            <label for="rut">Rut cliente:</label>
            <input type="number" name="rut" id="rut" required>
        </div>

        <div>
            <button class="buscar" type="button" onclick="buscar()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="32" height="32" viewBox="0 0 24 24" stroke-width="3" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M21 21l-6 -6" />
                    </svg>
            Buscar</button>
        </div>
    </div>

    <div id="nombreCliente">
    </div>

</section>

<section>
    <table class="tabla">
        <thead>
            <tr>
                <th>Cod producto</th>
                <th>Nombre producto</th>
                <th>Cantidad(KG)</th>
                <th>Precio unitario</th>
                <th>Sub Total</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody id="producto" >
            <tr>
                <td>
                    <input>
                </td>

                <td>
                    <input>
                </td>

                <td>
                    <input type="number">
                </td>
                <td>
                    <input type="number">
                </td>
                <td>
                    <input readonly>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="contenedor-boton">
        <button class="boton" type="button" onclick="agregarlinea()"> Agregar linea de detalle</button>
        <button class="boton" type="button" onclick="eliminarlinea()"> Eliminar linea de detalle</button>
    </div>
</section>