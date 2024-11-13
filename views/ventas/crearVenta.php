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
            </tr>
        </thead>
<form id="formularioVenta" action="verificarVenta" method="post">
        <tbody id="producto" >
            <tr id="trVenta0" class="tr">
                <td>
                    <input id="codproducto" class="codProducto" name="codproducto" type="text" readonly>
                </td>

                <td>
                    <input id="nombreProducto" class="nombreProducto" name="nombreProducto" type="text" required>
                    <div id="sugerencias" class="sugerencias"></div>
                </td>

                <td>
                    <input id="cantidadProducto" class="cantidadProducto" name="cantidad" type="number" required>
                </td>
                <td>
                    <input id="precioProducto" class="precioProducto" name="precio" type="number" readonly>
                </td>
                <td>
                    <input id="subtotalProducto" class="subtotalProducto" name="subtotal" type="number" readonly>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="contenedor-boton">
        <button class="boton" type="button" onclick="agregarlinea()"> Agregar linea de detalle</button>
        <button class="boton ocultar" type="button" onclick="eliminarlinea()"> Eliminar linea de detalle</button>

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
            <input type="number" name="descuento" id="descuento" max="100"> 
            <label class="porcentaje">%</label>
        </div>

        <div class="div_detallepago">
            <label>Total Descuento:</label>
            <input type="number" name="totalDescuento" id="totalDescuento" readonly>
        </div>

        <div class="div_detallepago">
            <label>Monto neto: </label>
            <input type="number" name="montoNeto" id="montoNeto" readonly>
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
            <label class="pago_total">Total:</label>
            <input type="number" name="total" id="total" readonly>
        </div>
    </div>
</div>

    <div class="contenedor-boton">
            <button class="boton" type="button" onclick="verificarVenta()"> Verificar</button>
            <!-- <button class="boton" type="submit" ">Generar Venta</button> -->

    </div>

</form>

<section class="contendor" id="modal-datos">
</section>
</section>