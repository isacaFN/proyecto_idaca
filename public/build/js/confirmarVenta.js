function mostrarPrevisualizacionPDF(){document.getElementById("modalPrevisualizacion").style.display="block";const e=new URLSearchParams(window.location.search).get("pdf");e?document.getElementById("iframePrevisualizacion").src=decodeURIComponent(e):console.error("No se encontró la URL del PDF")}function confirmarVenta(){JSON.parse(localStorage.getItem("productos")),JSON.parse(localStorage.getItem("cliente"))}document.addEventListener("DOMContentLoaded",(function(){mostrarPrevisualizacionPDF()})),window.confirmarVenta=confirmarVenta;