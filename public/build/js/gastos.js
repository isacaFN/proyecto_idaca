document.addEventListener("DOMContentLoaded",(function(){iniciarapp()}));let arrayGastos=[];function iniciarapp(){consultarAPI()}async function consultarAPI(){try{const e="http://localhost/proyecto_idaca/public/api/gastos",n=await fetch(e),t=await n.json();arrayGastos=t}catch(e){console.log(e)}}function agregarGasto(){let e=`\n    <div class="contendor-modal">\n        <div class="modal"> \n            <h3>Agregar un Gasto</h3>\n            <form class="formulario-inventario" action="gastos" method="post">\n            <div class="detalles_inventario">\n                    <label for="idnombre">Selecciona un gasto:</label>\n                    <select name="idnombre" id="idnombre">\n                        ${arrayGastos.map((e=>`<option value="${e.id}">${e.nombre}</option>`))}\n                    </select>\n                    <label for="fecha">Fecha:</label>\n                    <input type="date" name="fecha" id="fecha" required>\n                    <label for="monto">Monto:</label>\n                    <input type="text" name="monto" id="monto" required>\n                <div class="contenedor-boton">\n                    <input class="boton_verde" type="submit" value="Agregar">\n                </div>\n            </div>\n            </form>\n        </div>\n    </div>\n`;document.getElementById("modal-datos").innerHTML=e;const n=document.querySelector(".contendor-modal");n.addEventListener("click",(function(e){e.target===n&&n.remove()}));const t=document.getElementById("monto");t.addEventListener("input",(function(){let e=this.value.replace(/\./g,"");isNaN(e)||""===e?this.value="":this.value=parseInt(e,10).toLocaleString("es-ES").replace(/,/g,".")}));document.querySelector("form").addEventListener("submit",(function(e){const n=t.value.replace(/\./g,"");t.value=n}))}function formatNumber(e){let n=e.toString().replace(/\./g,"");return isNaN(n)||""===n?"":parseInt(n,10).toLocaleString("es-ES").replace(/,/g,".")}window.agregarGasto=agregarGasto;