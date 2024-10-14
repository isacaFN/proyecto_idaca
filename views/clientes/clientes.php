<script type="module" src="../public/build/js/clientes.js"></script>
<section class="contenedor-lista-usuarios">
        <h1>Clientes</h1>
        <table class="tabla">
            <?php 
            if(isset($_GET['alert']) && $_GET['alert'] == 'success'){
                    echo '<div class="alerta exito">Cliente creado con exito</div>';
            }?>
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>nombre</th>
                    <th>telefono</th>
                    <th>correo electronico</th>
                    <th>direccion</th>
                </tr>
            </thead>
            <tbody id="clientes" >
            </tbody>
        </table>
        
        <div class="link-nuevo-usuario">
            <a href="crearCliente" >Crear nuevo cliente</button>
        </div>

</section>