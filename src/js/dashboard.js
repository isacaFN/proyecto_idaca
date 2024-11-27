document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

function iniciarapp(){
    apiVentasTotales();
    apiProductos();
}

async function apiVentasTotales(){
    fetch('http://localhost/proyecto_idaca/public/api/ventastotales')
    .then(response => response.json())
    .then(data => {  
        let gastos = "50000";
        const ctx = document.getElementById('sales-expenses-chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: ['Ventas Totales', 'gastos totales'], 
                datasets: [{
                    label: 'Monto en pesos chilenos', 
                    data: [data.ventas_totales, gastos ], 
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)', 
                        'rgba(255, 99, 132, 0.7)'  
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Monto en Pesos chilenos'
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error:', error));
}

async function apiProductos(){
    console.log('Cargando productos');
    fetch('http://localhost/proyecto_idaca/public/api/productoMasVendido')
    .then(response => response.json())
    .then(data => {
        // Procesar los datos
        const nombres = data.map(item => item.nomprod);
        const cantidades = data.map(item => item.cantidad_vendida);

        const ctx = document.getElementById('productos_chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombres, 
                datasets: [{
                    label: 'Cantidad Vendida',
                    data: cantidades, // Cantidad vendida
                    backgroundColor: nombres.map(() => 'rgba(75, 192, 192, 0.7)'), 
                    borderColor: nombres.map(() => 'rgba(75, 192, 192, 1)'), 
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Cantidad Vendida' }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error al cargar los datos:', error));
}