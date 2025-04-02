<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Gerenciamento de Veículos</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar menu -->
        <div class="sidebar">
            <div class="logo">
                <h2>Logo</h2>
            </div>
            <div class="menu-item has-submenu active" data-section="categorias">
                <i class="fas fa-car"></i> Simulador auto
                <i class="fas fa-chevron-right menu-arrow open"></i>
            </div>
            <!-- Submenu for Categorias -->
            <div class="submenu open">
                <div class="submenu-item" data-section="categoria-suv">
                    <a href="/simulador/carCategory">Categorias dos Carros</a>
                </div>
                <div class="submenu-item active" data-section="modelos">
                    <a href="/simulador/carModel">Modelos dos Carros</a>
                </div>
                <div class="submenu-item" data-section="categoria-picape">
                    <a href="/simulador/imposto">Imposto</a>
                </div>
                <div class="submenu-item" data-section="categoria-picape">
                    <a href="/simulador/category">category</a>
                </div>
            </div>
            <div class="menu-item">
                <i class="fas fa-car"></i> Modelos dos Carros
            </div>
            <div class="menu-item" data-section="campanhas">
                 <a classe="menu-item-a"  style=" color: #fff; text-decoration: none; " 
 href="/simulador/CampanhaMarketing"><i class="fas fa-bullhorn"></i> Campanhas de Marketing</a>
            </div>
            <div class="menu-item" data-section="imposto">
                <i class="fas fa-file-invoice-dollar"></i> Imposto
            </div>
            <div class="menu-item" data-section="subscritor">
                <i class="fas fa-users"></i> Subscritor
            </div>
            <div class="menu-item" data-section="usuario">
                <i class="fas fa-user-shield"></i> Usuário
            </div>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <div class="header">
                <h1 class="page-title">SUVJ</h1>
                <div class="user-info">
                    <span>Bem-vindo, AdminJU</span>
                </div>
            </div>

            <!-- Modelos Section -->
            <h2>modelos</h1>

        </div>
    </div>
    <script src="public/js/main.js"></script>
</body>

</html>