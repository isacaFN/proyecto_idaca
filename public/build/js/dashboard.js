function iniciarapp(){apiVentasTotales(),apiProductos()}async function apiVentasTotales(){fetch("http://localhost/proyecto_idaca/public/api/ventastotales").then((t=>t.json())).then((t=>{const o=document.getElementById("sales-expenses-chart").getContext("2d");new Chart(o,{type:"bar",data:{labels:["Ventas Totales","gastos totales"],datasets:[{label:"Monto en pesos chilenos",data:[t.ventas_totales,"50000"],backgroundColor:["rgba(75, 192, 192, 0.7)","rgba(255, 99, 132, 0.7)"],borderColor:["rgba(75, 192, 192, 1)","rgba(255, 99, 132, 1)"],borderWidth:1}]},options:{responsive:!0,plugins:{legend:{display:!0,position:"top"},tooltip:{enabled:!0}},scales:{y:{beginAtZero:!0,title:{display:!0,text:"Monto en Pesos chilenos"}}}}})})).catch((t=>console.error("Error:",t)))}async function apiProductos(){console.log("Cargando productos"),fetch("http://localhost/proyecto_idaca/public/api/productoMasVendido").then((t=>t.json())).then((t=>{const o=t.map((t=>t.nomprod)),a=t.map((t=>t.cantidad_vendida)),e=document.getElementById("productos_chart").getContext("2d");new Chart(e,{type:"bar",data:{labels:o,datasets:[{label:"Cantidad Vendida",data:a,backgroundColor:o.map((()=>"rgba(75, 192, 192, 0.7)")),borderColor:o.map((()=>"rgba(75, 192, 192, 1)")),borderWidth:1}]},options:{responsive:!0,plugins:{legend:{display:!1},tooltip:{enabled:!0}},scales:{y:{beginAtZero:!0,title:{display:!0,text:"Cantidad Vendida"}}}}})})).catch((t=>console.error("Error al cargar los datos:",t)))}document.addEventListener("DOMContentLoaded",(function(){iniciarapp()}));