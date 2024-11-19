let rutCliente,url,filas=0,arrayproductos=[],arrayProductosCopia=[];function iniciarapp(){productos(),tipoventa()}function productos(){url="http://localhost/proyecto_idaca/public/api/productos",consultarAPI(url)}function tipoventa(){url="http://localhost/proyecto_idaca/public/api/tipoventa",consultarAPI(url)}function buscar(){rutCliente=document.getElementById("rut").value.trim(),/^[0-9]+$/.test(rutCliente)?(url="http://localhost/proyecto_idaca/public/api/clientes",consultarAPI(url)):alert("El RUT solo debe contener números.")}async function consultarAPI(e){try{const t=await fetch(e),o=await t.json();e.includes("clientes")&&buscarCliente(o),e.includes("tipoventa")&&agregartipoventa(o),e.includes("productos")&&(arrayproductos=o,autocompletar(arrayproductos),arrayProductosCopia=arrayproductos.map((e=>({...e}))))}catch(e){console.log(e)}}function autocompletar(e){document.addEventListener("focusin",(function(t){if(t.target.classList.contains("nombreProducto")){const o=t.target;let n=o.nextElementSibling;n&&n.classList.contains("sugerencias")||(n=document.createElement("div"),n.classList.add("sugerencias"),o.parentElement.appendChild(n)),o.addEventListener("input",(function(){const t=o.value.toLowerCase();n.innerHTML="";const a=e.filter((e=>e.nomprod.toLowerCase().includes(t)));a.length>0?(n.style.display="block",a.forEach((t=>{const a=document.createElement("div");a.classList.add("sugerencia"),a.textContent=t.nomprod,a.addEventListener("click",(function(){o.value=t.nomprod,n.innerHTML="",n.style.display="none";const a=o.closest("tr"),r=e.find((e=>e.nomprod===t.nomprod));if(a&&r){a.dataset.idproducto=r.codproducto;const e=a.querySelector(".codProducto"),t=a.querySelector(".precioProducto"),o=a.querySelector(".cantidadProducto"),n=a.querySelector(".subtotalProducto");e&&t&&o&&n&&(e.value=r.codproducto,t.value=r.precio,o.addEventListener("input",(function(){const e=parseFloat(o.value)||0;n.value=new Intl.NumberFormat("es-ES").format(r.precio*e),calcularSubtotalTotal()})))}})),n.appendChild(a)}))):n.style.display="none"})),document.addEventListener("click",(function(e){o.contains(e.target)||n.contains(e.target)||(n.innerHTML="",n.style.display="none")}))}}))}function calcularSubtotalTotal(){const e=document.querySelectorAll(".subtotalProducto");let t=0;e.forEach((e=>{let o=Number(e.value.replace(/\./g,"").replace(",","."))||0;t+=o}));const o=document.getElementById("subtotal");o.value=new Intl.NumberFormat("es-ES").format(t),calcularMontoNeto(o.value)}function agregartipoventa(e){const t=document.getElementById("tipoventa"),o=document.createElement("select");o.classList.add("tipoPago"),o.name="pago",o.id="pago",t.appendChild(o),e.forEach((e=>{const t=document.createElement("option");t.value=e.id,t.textContent=e.tipov,o.appendChild(t)}))}function calcularMontoNeto(e){let t=Number(e.replace(/\./g,"").replace(",","."))||0;const o=document.getElementById("descuento");o.addEventListener("input",(function(){if(Number(o.value)>100)alert("El descuento no puede ser mayor que 100%."),o.value=100;else{const n=document.getElementById("totalDescuento");n.value=new Intl.NumberFormat("es-ES").format((Number(e.replace(/\./g,"").replace(",","."))||0)*Number(o.value)/100);const a=document.getElementById("montoNeto");a.value=new Intl.NumberFormat("es-ES").format(t-Number(n.value.replace(/\./g,"").replace(",","."))),calcularTotal(a.value)}})),calcularTotal(e)}function calcularTotal(e){document.getElementById("iva").value=19;let t=Number(e.replace(/\./g,"").replace(",","."))||0;const o=document.getElementById("totalIva");let n=19*t/100;o.value=new Intl.NumberFormat("es-ES").format(n),t=Number(o.value.replace(/\./g,"").replace(",","."))||0;let a=t+Number(e.replace(/\./g,"").replace(",","."));document.getElementById("total").value=new Intl.NumberFormat("es-ES").format(a)}function agregarlinea(){filas++;const e=document.createElement("tr");e.classList.add("tr");const t=document.createElement("input"),o=document.createElement("td");t.classList.add("codProducto"),t.name="codproducto",t.setAttribute("required","true"),o.appendChild(t);const n=document.createElement("td"),a=document.createElement("input");a.classList.add("nombreProducto"),a.setAttribute("required","true"),a.name=`NombreProducto${filas}`,a.type="text",n.appendChild(a);const r=document.createElement("td"),c=document.createElement("input");c.classList.add("cantidadProducto"),c.type="Number",c.name="cantidad",c.setAttribute("required","true"),r.appendChild(c);const l=document.createElement("td"),d=document.createElement("input");d.classList.add("precioProducto"),d.setAttribute("readonly","true"),d.name="precio",l.appendChild(d);const i=document.createElement("td"),u=document.createElement("input");u.classList.add("subtotalProducto"),u.setAttribute("readonly","true"),u.name="subtotal",i.appendChild(u),e.appendChild(o),e.appendChild(n),e.appendChild(r),e.appendChild(l),e.appendChild(i),document.getElementById("producto").appendChild(e);document.querySelector(".ocultar").style.display=producto.children.length>1?"block":"none"}function buscarCliente(e){const t=e.find((e=>e.dni===rutCliente));t?mostrar(t.dni,t.nombre):clienteNoExiste()}function clienteNoExiste(){document.getElementById("modal-datos").innerHTML='<div class="contendor-modal">\n    <div class="modal"> \n\n    <h2>Cliente no existe</h2>\n    <a class="boton_verde" href="crearCliente">\n        Crear cliente \n        <svg\n            xmlns="http://www.w3.org/2000/svg"\n            width="32"\n            height="32"\n            viewBox="0 0 24 24"\n            fill="none"\n            stroke="currentColor"\n            stroke-width="1.75"\n            stroke-linecap="round"\n            stroke-linejoin="round"\n            >\n            <path d="M12.5 8l4 4l-4 4h4.5l4 -4l-4 -4z" />\n            <path d="M3.5 8l4 4l-4 4h4.5l4 -4l-4 -4z" />\n        </svg>\n    </a>\n</div>';const e=document.querySelector(".contendor-modal");e.addEventListener("click",(function(t){t.target===e&&e.remove()}))}function mostrar(e,t){for(;nombreCliente.firstChild;)nombreCliente.removeChild(nombreCliente.firstChild);const o=document.createElement("LABEL");o.textContent="Nombre cliente:";const n=document.createElement("INPUT");n.type="text",n.classList.add("cliente"),n.id="inputNombreCliente",n.value=t,nombreCliente.appendChild(o),nombreCliente.appendChild(n),document.getElementById("rut").value=e}function eliminarlinea(){filas--;const e=document.getElementById("producto");if(e.children.length>1){const e=document.getElementById("producto").lastChild;e.dataset.idproducto,Number(e.querySelector(".cantidadProducto").value);arrayProductosCopia=arrayproductos.map((e=>({...e}))),e.remove()}for(let t=0;t<e.children.length;t++)e.children[t].dataset.processed="false";if(1==e.children.length){document.querySelector(".ocultar").style.display="none"}autocompletar(arrayproductos,filas),calcularSubtotalTotal()}function verificarVenta(){if(!document.getElementById("inputNombreCliente"))return void alert("Debes ingresar un cliente para poder verificar la venta");const e=document.querySelectorAll(".tr"),t={};arrayproductos.forEach((e=>{t[e.codproducto]=e}));for(let o=0;o<e.length;o++){const n=e[o];if("true"===n.dataset.processed)continue;const a=n.dataset.idproducto;if(t[a]){let e=Number(n.querySelector(".cantidadProducto").value);isNaN(e)||insertarProducto(a,e)}n.dataset.processed="true"}enviarProductosVerificados()}function insertarProducto(e,t){let o=arrayProductosCopia.find((t=>t.codproducto===e));o&&(o.cantidad=(o.cantidad||0)+Number(t))}async function enviarProductosVerificados(){const e=document.getElementById("inputNombreCliente").value,t=document.getElementById("pago").value,o=Number(document.getElementById("montoNeto").value)?Number(document.getElementById("montoNeto").value.replace(/\./g,"").replace(",",".")):Number(document.getElementById("subtotal").value.replace(/\./g,"").replace(",",".")),n=Number(document.getElementById("totalIva").value.replace(/\./g,"").replace(",",".")),a=Number(document.getElementById("total").value.replace(/\./g,"").replace(",","."));let r=arrayProductosCopia.filter((e=>"cantidad"in e));r.push({dni:rutCliente,nombre:e,montoNeto:o,totalIva:n,totalApagar:a,tipoPago:t});const c=JSON.stringify(r);try{const e=await fetch("http://localhost/proyecto_idaca/public/verificarVenta",{method:"POST",headers:{"Content-Type":"application/json"},body:c}),t=await e.text();try{const e=JSON.parse(t);"success"===e.status?(console.log("Respuesta del servidor:",e.data),window.location.href="verificarVenta?pdf="+e.pdfurl):console.log("Hubo un error en la solicitud:",e.message)}catch(e){console.error("Error al analizar el JSON:",e)}}catch(e){console.error("Error en la solicitud:",e)}}async function confirmarVenta(){try{const e=await fetch("http://localhost/proyecto_idaca/public/confirmarVenta",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({confirmar:!0})}),t=await e.json();"success"===t.status?(alert("Venta confirmada y PDF guardado correctamente"),window.location.href="/ventas"):console.error("Error al confirmar la venta:",t.message)}catch(e){console.error("Error en la solicitud de confirmación:",e)}}document.addEventListener("DOMContentLoaded",(function(){iniciarapp()})),window.buscar=buscar,window.agregarlinea=agregarlinea,window.eliminarlinea=eliminarlinea,window.verificarVenta=verificarVenta,window.enviarProductosVerificados=enviarProductosVerificados;