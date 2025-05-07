<?php
// session_start();

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
    <title>Categoria</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar menu -->
        
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main content -->
        <div class="main-content">
            
            <?php include 'includes/header.php'; ?>

            <!-- SUV Section -->
            <div class="content-section active" id="categoria-suv">
                <div class="card-container">
                    <div class="card">
                        <h3 class="card-title">SUV</h3>
                        <p class="card-content">Veículos utilitários esportivos com maior espaço e capacidade off-road.</p>
                        <p><strong>Modelos Populares:</strong> Modelo X, RAV4, CR-V</p>
                    </div>
                </div>
                <button class="btn btn-primary add-button">Adicionar SUV</button>
            </div>

            <!-- Sedan Section -->
            <div class="content-section" id="categoria-sedan">
                <div class="card-container">
                    <div class="card">
                        <h3 class="card-title">Sedan</h3>
                        <p class="card-content">Veículos de passeio com porta-malas separado do compartimento de passageiros.</p>
                        <p><strong>Modelos Populares:</strong> Modelo Y, Corolla, Civic</p>
                    </div>
                </div>
                <button class="btn btn-primary add-button">Adicionar Sedan</button>
            </div>

            <!-- Hatchback Section -->
            <div class="content-section" id="categoria-hatchback">
                <div class="card-container">
                    <div class="card">
                        <h3 class="card-title">Hatchback</h3>
                        <p class="card-content">Veículos compactos com porta-malas integrado ao compartimento de passageiros.</p>
                        <p><strong>Modelos Populares:</strong> Modelo Z, HB20, Polo</p>
                    </div>
                </div>
                <button class="btn btn-primary add-button">Adicionar Hatchback</button>
            </div>

            <!-- Picape Section -->
            <div class="content-section" id="categoria-picape">
                <div class="card-container">
                    <div class="card">
                        <h3 class="card-title">Picape</h3>
                        <p class="card-content">Veículos com caçamba para transporte de carga, ideais para trabalho.</p>
                        <p><strong>Modelos Populares:</strong> Modelo W, Hilux, Ranger</p>
                    </div>
                </div>
                <button class="btn btn-primary add-button">Adicionar Picape</button>
            </div>

            <!-- Categorias Section (Original) -->
            <div class="content-section" id="categorias">
                <div class="card-container">
                    <div class="card">
                        <h3 class="card-title">SUV</h3>
                        <p class="card-content">Veículos utilitários esportivos com maior espaço e capacidade off-road.</p>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Sedan</h3>
                        <p class="card-content">Veículos de passeio com porta-malas separado do compartimento de passageiros.</p>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Hatchback</h3>
                        <p class="card-content">Veículos compactos com porta-malas integrado ao compartimento de passageiros.</p>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Picape</h3>
                        <p class="card-content">Veículos com caçamba para transporte de carga, ideais para trabalho.</p>
                    </div>
                </div>
                <button class="btn btn-primary add-button">Adicionar Categoria</button>
            </div>

        </div>
    </div>

    <script src="public/js/main.js"></script>
</body>

</html>