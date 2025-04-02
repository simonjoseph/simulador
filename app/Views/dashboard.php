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
                <div class="submenu-item active" data-section="categoria-suv">
                    <a href="/simulador/carCategory">Categorias dos Carros</a>
                </div>
                <div class="submenu-item" data-section="categoria-sedan">
                    <a href="/simulador/carModel">Modelos dos Carros</a>
                </div>
                <div class="submenu-item" data-section="categoria-picape">
                    <a href="/simulador/imposto">Imposto</a>
                </div>
                <div class="submenu-item" data-section="categoria-picape">
                    <a href="/simulador/category">categoria</a>
                </div>
            </div>
            <div class="menu-item" data-section="modelos">
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
                <h1 class="page-title">SUV</h1>
                <div class="user-info">
                    <span>Bem-vindo, Admin</span>
                </div>
            </div>

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

            <!-- Modelos Section -->
            <div class="content-section" id="modelos">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Ano</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Modelo X</td>
                                <td>SUV</td>
                                <td>2024</td>
                                <td>R$ 180.000</td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Modelo Y</td>
                                <td>Sedan</td>
                                <td>2023</td>
                                <td>R$ 120.000</td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Modelo Z</td>
                                <td>Hatchback</td>
                                <td>2024</td>
                                <td>R$ 85.000</td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Modelo W</td>
                                <td>Picape</td>
                                <td>2023</td>
                                <td>R$ 210.000</td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary add-button">Adicionar Modelo</button>
            </div>

            <!-- Campanhas Section -->
            <div class="content-section" id="campanhas">
                <div class="card-container">
                    <div class="card">
                        <h3 class="card-title">Promoção de Verão</h3>
                        <p class="card-content">Descontos especiais em SUVs para a temporada de verão.</p>
                        <p><strong>Período:</strong> 01/12/2024 - 31/01/2025</p>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Lançamento Modelo Z</h3>
                        <p class="card-content">Condições especiais para o novo Modelo Z com taxa zero.</p>
                        <p><strong>Período:</strong> 15/02/2025 - 15/03/2025</p>
                    </div>
                </div>
                <button class="btn btn-primary add-button">Adicionar Campanha</button>
            </div>

            <!-- Imposto Section -->
            <div class="content-section" id="imposto">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Percentual</th>
                                <th>Aplicação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>IPVA</td>
                                <td>4%</td>
                                <td>Anual</td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                            <tr>
                                <td>IPI</td>
                                <td>7-25%</td>
                                <td>Na compra</td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary add-button">Adicionar Imposto</button>
            </div>

            <!-- Subscritor Section -->
            <div class="content-section" id="subscritor">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Plano</th>
                                <th>Data de Início</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>João Silva</td>
                                <td>Premium</td>
                                <td>10/01/2025</td>
                                <td><span class="status status-active">Ativo</span></td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Maria Oliveira</td>
                                <td>Básico</td>
                                <td>05/02/2025</td>
                                <td><span class="status status-active">Ativo</span></td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary add-button">Adicionar Subscritor</button>
            </div>

            <!-- Usuario Section -->
            <div class="content-section" id="usuario">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Perfil</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Admin</td>
                                <td>admin@sistema.com</td>
                                <td>Administrador</td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Vendedor</td>
                                <td>vendas@sistema.com</td>
                                <td>Vendedor</td>
                                <td>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary add-button">Adicionar Usuário</button>
            </div>
        </div>
    </div>

    <script src="public/js/main.js"></script>
</body>

</html>