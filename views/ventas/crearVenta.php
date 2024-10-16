<script type="module" src="../public/build/js/crearVenta.js"></script>

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
                <th>Limpiar</th>
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
                <td class="celda_limpiar">
                    <div class="icono_limpiar" title="Limpiar Fila">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clear-all" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 6h12" />
                        <path d="M6 12h12" />
                        <path d="M4 18h12" />
                        </svg>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="contenedor-boton">
        <button class="boton" type="button" onclick="agregarlinea()"> Agregar linea de detalle</button>
        <button class="boton" type="button" onclick="eliminarlinea()"> Eliminar linea de detalle</button>
    </div>

    <div class="contenedor_pago">
        <label for="pago" >Forma de pago:</label>
        <select class="tipoPago" name="pago" id="pago">
            <option value="1">Efectivo</option>
            <option value="2">Transferencia</option>
            <option value="3">Credito</option>
        </select>
    </div>

    <div class="contenedor_detallepago">
    <div class="detallePago">
        <div class="div_detallepago">
            <label>Subtotal:</label>
            <input type="number" name="subtotal" id="subtotal" readonly>
        </div>

        <div class="div_detallepago">
            <label>Descuento:</label>
            <input type="number" name="descuento" id="descuento">
            <label class="porcentaje">%</label>
        </div>

        <div class="div_detallepago">
            <label>Total Descuento:</label>
            <input type="number" name="totalDescuento" id="totalDescuento" readonly>
        </div>

        <div class="div_detallepago">
            <label>IVA:</label>
            <input type="number" name="iva" id="iva" readonly>
            <label class="porcentaje">%</label>
        </div>

        <div class="div_detallepago">
            <label>Total IVA:</label>
            <input type="number" name="totalIva" id="totalIva" readonly>
        </div>

        <div class="div_detallepago">
            <label>Total:</label>
            <input type="number" name="total" id="total" readonly>
        </div>
    </div>
</div>
</section>