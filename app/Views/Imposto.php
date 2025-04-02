<?php 
session_start();
if (isset($_SESSION["success"])) {
    echo "<div class='alert alert-success' style='text-align: center; background: green; color: #fff;'>" . $_SESSION["success"] . "</div>";
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
    <title>Imposto</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
        }
        button:hover {
            background-color: #0056b3;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input, select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        .form-group {
            flex: 1;
            min-width: 250px;
            margin-right: 20px;
        }
        .form-group:last-child {
            margin-right: 0;
        }
        input[type="number"],
        input[type="date"],
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            margin-top: 10px;
            padding: 10px 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar menu (ajuste conforme necessário) -->
        <div class="sidebar">
            <div class="logo">
                <h2>Logo</h2>
            </div>
            <div class="menu-item has-submenu" data-section="categorias">
                <i class="fas fa-car"></i> Simulador auto
                <i class="fas fa-chevron-right menu-arrow open"></i>
            </div>
            <div class="submenu">
                <div class="submenu-item" data-section="categoria-suv">
                    <a href="/simulador/carCategory">Categorias dos Carros</a>
                </div>
                <div class="submenu-item" data-section="categoria-sedan">
                    <a href="/simulador/carModel">Modelos dos Carros</a>
                </div>
                <div class="submenu-item" data-section="categoria-picape">
                    <a href="/simulador/imposto">Imposto</a>
                </div>
                <div class="submenu-item" data-section="categoria-picape">
                    <a href="/simulador/category">category</a>
                </div>
            </div>
            <div class="menu-item" data-section="modelos">
                <i class="fas fa-car"></i> Modelos dos Carros
            </div>
            <div class="menu-item" data-section="campanhas">
                <a class="menu-item-a" style="color: #fff; text-decoration: none;" href="/simulador/CampanhaMarketing"><i class="fas fa-bullhorn"></i> Campanhas de Marketing</a>
            </div>
            <div class="menu-item active" data-section="imposto">
                <a href="/simulador/imposto" style=" color: #fff; text-decoration: none; "><i class="fas fa-file-invoice-dollar"></i> Imposto</a>
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
                <h1 class="page-title">Impostos</h1>
                <div class="user-info">
                    <span>Bem-vindo, Admin</span>
                </div>
            </div>

            <button class="btn btn-primary" id="myBtn">Abrir Formulário</button>

            <div class="table-container" style="margin-top: 20px;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Câmbio</th>
                            <th>FGA</th>
                            <th>IVA</th>
                            <th>Desconto</th>
                            <th>Câmbio Geral</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($impostos as $imposto): ?>
                            <tr>
                                <td><?= htmlspecialchars($imposto["id"]) ?></td>
                                <td><?= htmlspecialchars($imposto["cambio"]) ?></td>
                                <td><?= htmlspecialchars($imposto["fga"]) ?></td>
                                <td><?= htmlspecialchars($imposto["iva"]) ?></td>
                                <td><?= htmlspecialchars($imposto["desconto"]) ?></td>
                                <td><?= htmlspecialchars($imposto["cambio_geral"]) ?></td>
                                <td>
                                    <button class="btn-edit" data-id="<?= $imposto["id"] ?>">Editar</button>
                                    <button class="btn-delete" data-id="<?= $imposto["id"] ?>">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal para cadastrar imposto -->
            <div id="myModal" class="modal">
                <div class="modal-content" style="max-width: 600px;">
                    <span class="close">&times;</span>
                    <h2>Adicionar Imposto</h2>
                    <form action="imposto/create" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="cambio">Câmbio:</label>
                                <input type="text" id="cambio" name="cambio" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                            <div class="form-group">
                                <label for="fga">FGA:</label>
                                <input type="text" id="fga" name="fga" pattern="^-?\d+([.,]\d+)?$"
                                title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="iva">IVA:</label>
                                <input type="text" id="iva" name="iva" pattern="^-?\d+([.,]\d+)?$"
                                title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                            <div class="form-group">
                                <label for="desconto">Desconto:</label>
                                <input type="text" id="desconto" name="desconto" pattern="^-?\d+([.,]\d+)?$"
                                title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="cambio_geral">Câmbio Geral:</label>
                                <input type="text" id="cambio_geral" name="cambio_geral" pattern="^-?\d+([.,]\d+)?$"
                                title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                        </div>
                        <button type="submit">Cadastrar</button>
                    </form>
                </div>
            </div>
            <!-- Fim do modal -->
        </div>
    </div>

    <script src="public/js/jquery.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Abre o modal quando o botão for clicado
            document.getElementById("myBtn").addEventListener("click", function() {
                document.getElementById("myModal").style.display = "block";
            });

            // Fecha o modal quando o botão de fechar for clicado
            document.querySelector(".close").addEventListener("click", function() {
                document.getElementById("myModal").style.display = "none";
            });

            // Fecha o modal se o usuário clicar fora dele
            window.addEventListener("click", function(event) {
                if (event.target === document.getElementById("myModal")) {
                    document.getElementById("myModal").style.display = "none";
                }
            });
        });
    </script>
</body>
</html>
