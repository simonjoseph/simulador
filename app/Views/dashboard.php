<?php
session_start();

// Verifica se o usuário está autenticado
if (empty($_SESSION['user'])) {
    // Redireciona para a página de login
    header('Location: /simulador/login');
    exit;
}

if (isset($_SESSION["success"])) {
    echo "<div class='alert alert-success' style='
    text-align: center;
    background: green;
    color: #fff;
'>" . $_SESSION["success"] . "</div>";
    unset($_SESSION["success"]);
}
if (isset($_SESSION["error"])) {
    echo "<div class='alert alert-danger'>" . $_SESSION["error"] . "</div>";
    unset($_SESSION["error"]);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Ajuste do tamanho do gráfico de categorias */
        #categoriasChart {
            max-width: 800px;
            max-height: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar menu -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main content -->
        <div class="main-content">
            
            <?php include 'includes/header.php'; ?>

            <!-- Gráficos -->
            <div class="charts-container">
                <!-- Gráfico de Simulações Auto -->
                <div class="chart-card">
                    <h3>Simulações Auto Feitas</h3>
                    <canvas id="simulacoesChart"></canvas>
                </div>

                <!-- Gráfico de Campanhas de Marketing -->
                <div class="chart-card">
                    <h3>Campanhas de Marketing Realizadas</h3>
                    <canvas id="campanhasChart"></canvas>
                </div>

                <!-- Gráfico de Categorias -->
                <div class="chart-card">
                    <h3>Simulações por Categoria</h3>
                    <canvas id="categoriasChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dados para o gráfico de Simulações Auto
        const simulacoesData = {
            labels: <?= json_encode(array_column($simulacoesPorMes, 'mes')) ?>,
            datasets: [{
                label: 'Simulações',
                data: <?= json_encode(array_column($simulacoesPorMes, 'total_simulacoes')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Configuração do gráfico de Simulações Auto
        const simulacoesConfig = {
            type: 'bar',
            data: simulacoesData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Simulações Auto Feitas'
                    }
                }
            },
        };

        // Renderizar o gráfico de Simulações Auto
        const simulacoesChart = new Chart(
            document.getElementById('simulacoesChart'),
            simulacoesConfig
        );

        // Dados para o gráfico de Campanhas de Marketing
        const campanhasData = {
            labels: <?= json_encode(array_column($simulacoesPorCampanha, 'campanha')) ?>,
            datasets: [{
                label: 'Campanhas',
                data: <?= json_encode(array_column($simulacoesPorCampanha, 'total_simulacoes')) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Configuração do gráfico de Campanhas de Marketing
        const campanhasConfig = {
            type: 'line',
            data: campanhasData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Campanhas de Marketing Realizadas'
                    }
                }
            },
        };

        // Renderizar o gráfico de Campanhas de Marketing
        const campanhasChart = new Chart(
            document.getElementById('campanhasChart'),
            campanhasConfig
        );

        // Dados para o gráfico de Categorias
        const categoriasData = {
            labels: <?= json_encode(array_column($simulacoesPorCategoria, 'categoria')) ?>,
            datasets: [{
                label: 'Simulações por Categoria',
                data: <?= json_encode(array_column($simulacoesPorCategoria, 'total_simulacoes')) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Configuração do gráfico de Categorias
        const categoriasConfig = {
            type: 'pie',
            data: categoriasData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Simulações por Categoria'
                    }
                }
            },
        };

        // Renderizar o gráfico de Categorias
        const categoriasChart = new Chart(
            document.getElementById('categoriasChart'),
            categoriasConfig
        );
    </script>
</body>

</html>