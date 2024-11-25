document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

function iniciarapp(){
    consultarAPI();
}

async function consultarAPI(){
    fetch('http://localhost/proyecto_idaca/public/api/ventastotales')
    .then(response => response.json())
    .then(data => {
        // Crear el gráfico
        let gastos = "50000";
        const ctx = document.getElementById('sales-expenses-chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Gráfico de barras
            data: {
                labels: ['Ventas Totales', 'gastos totales'], // Etiquetas
                datasets: [{
                    label: 'Monto en pesos chilenos', 
                    data: [data.ventas_totales, gastos ], // Datos de ventas y gastos
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)', // Color para ventas
                        'rgba(255, 99, 132, 0.7)'  // Color para gastos
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