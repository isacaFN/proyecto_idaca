let rutCliente,url,filas=0;function iniciarapp(){productos()}function productos(){url="http://localhost/proyecto_idaca/public/api/productos",consultarAPI(url)}function buscar(){rutCliente=document.getElementById("rut").value.trim(),/^[0-9]+$/.test(rutCliente)?(url="http://localhost/proyecto_idaca/public/api/clientes",consultarAPI(url)):alert("El RUT solo debe contener números.")}async function consultarAPI(e){try{const t=await fetch(e),n=await t.json();e.includes("clientes")&&buscarCliente(n),e.includes("productos")&&autocompletar(n)}catch(e){console.log(e)}}function autocompletar(e){document.getElementById("producto").addEventListener("click",(function(e){if("INPUT"===e.target.tagName){const t=e.target,n=t.classList;console.log("Clases del input:",n);const o=t.parentElement.parentElement;o?console.log("Clase del primer contenedor (abuelo):",o.id):console.log("No se encontró el abuelo.")}}));const t=document.getElementById("nombreProducto0"),n=document.getElementById("sugerencias");t.addEventListener("input",(function(){const o=t.value.toLowerCase();n.innerHTML="";const l=e.filter((e=>"string"==typeof e.nomprod&&e.nomprod.toLowerCase().includes(o)));l.length>0?(n.style.display="block",l.forEach((e=>{const o=document.createElement("div");o.classList.add("sugerencia"),o.textContent=e.nomprod,o.addEventListener("click",(function(){t.value=e.nomprod,n.innerHTML="",n.style.display="none"})),n.appendChild(o)}))):n.style.display="none"})),document.addEventListener("click",(function(e){t.contains(e.target)||n.contains(e.target)||(n.innerHTML="",n.style.display="none")}))}function buscarCliente(e){e.forEach((e=>{const{dni:t,nombre:n}=e;t===rutCliente&&mostrar(t,n)}))}function mostrar(e,t){for(;nombreCliente.firstChild;)nombreCliente.removeChild(nombreCliente.firstChild);const n=document.createElement("LABEL");n.textContent="Nombre cliente:";const o=document.createElement("INPUT");o.type="text",o.classList.add("cliente"),o.value=t,nombreCliente.appendChild(n),nombreCliente.appendChild(o),document.getElementById("rut").value=e}function agregarlinea(){filas++;const e=document.createElement("input"),t=document.createElement("TD");t.appendChild(e);const n=document.createElement("TD"),o=document.createElement("input");n.appendChild(o);const l=document.createElement("TD"),c=document.createElement("input");c.type="number",l.appendChild(c);const i=document.createElement("TD"),r=document.createElement("input");r.setAttribute("readonly","true"),i.appendChild(r);const a=document.createElement("TD"),d=document.createElement("input");d.setAttribute("readonly","true"),a.appendChild(d);const u=document.createElement("TR");if(u.id="trVenta"+filas,u.appendChild(t),u.appendChild(n),u.appendChild(l),u.appendChild(i),u.appendChild(a),document.getElementById("producto").appendChild(u),document.querySelectorAll(".limpiar").forEach((function(e){e.innerHTML=iconoLimpiar})),2==producto.children.length){document.querySelector(".ocultar").style.display="block"}if(1==producto.children.length){document.querySelector(".ocultar").style.display="none"}}function eliminarlinea(){if(filas--,producto.children.length>1){document.getElementById("producto").lastChild.remove()}if(1==producto.children.length){document.querySelector(".ocultar").style.display="none"}}document.addEventListener("DOMContentLoaded",(function(){iniciarapp()})),window.buscar=buscar,window.agregarlinea=agregarlinea,window.eliminarlinea=eliminarlinea;