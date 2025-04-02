<?php
session_start();
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
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
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

        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /*  */
        /*  */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            /* Permite que os itens se movam para a linha seguinte se não houver espaço */
            margin-bottom: 15px;
            /* Espaçamento entre as linhas */
        }

        .form-group {
            flex: 1;
            /* Cada grupo ocupa o mesmo espaço */
            min-width: 250px;
            /* Largura mínima para cada grupo */
            margin-right: 20px;
            /* Espaçamento à direita */
        }

        .form-group:last-child {
            margin-right: 0;
            /* Remove o espaçamento do último grupo na linha */
        }

        label {
            display: block;
            /* Faz o label ocupar toda a largura */
            margin-bottom: 5px;
            /* Espaçamento abaixo do label */
        }

        input[type="number"],
        input[type="date"],
        input[type="text"] {
            width: 100%;
            /* Ocupar toda a largura do grupo */
            padding: 8px;
            /* Espaçamento interno */
            box-sizing: border-box;
            /* Inclui padding e border no cálculo da largura */
        }

        button {
            margin-top: 10px;
            /* Espaçamento acima do botão */
            padding: 10px 15px;
            /* Espaçamento interno do botão */
        }
    </style>
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
                <div class="submenu-item" data-section="categoria-sedan">
                    <a href="/simulador/carModel">Modelos dos Carros</a>
                </div>
                <div class="submenu-item" data-section="categoria-picape">
                    <a href="/simulador/imposto">Imposto</a>
                </div>
                <div class="submenu-item active" data-section="categoria-picape">
                    <a href="/simulador/category">category</a>
                </div>
            </div>
            <div class="menu-item" data-section="modelos">
                <i class="fas fa-car"></i> Modelos dos Carros
            </div>
            <div class="menu-item" data-section="campanhas">
                <a classe="menu-item-a" style=" color: #fff; text-decoration: none; "
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

            <!--  -->


            <!--  -->


            <button class="btn btn-primary" id="myBtn">Abrir Formulário</button>

            <div class="table-container" style="margin-top: 20px;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?= htmlspecialchars($categoria["id"]) ?></td>
                                <td><?= htmlspecialchars($categoria["nome"]) ?></td>
                                <td>
                                    <button class="btn btn-tarifa" data-id="<?= htmlspecialchars($categoria["id"]) ?>" data-nome="<?= htmlspecialchars($categoria["nome"]) ?>">Adicionar Tarifas</button>
                                    <button class="btn btn-edit">Editar</button>
                                    <button class="btn btn-delete">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form class="frm_create_category" action="category/create" method="post">
                        <label for="nome">Nome da Categoria:</label>
                        <input type="text" id="nome" name="nome">
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>

            <!--  -->
            <!-- Modal -->
            <div id="myModal1" class="modal" style="padding-top: 0;">
                <div class="modal-content" style="max-width: 600px;">
                    <span class="close">&times;</span>
                    <h2>Adicionar Tarifas</h2>
                    <form id="tarifaForm" action="tarifa/create" method="post">
                        <input type="hidden" name="categoria_id" id="categoria_id">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome_categoria">Nome da Categoria:</label>
                                <input type="text" id="nome_categoria" name="nome_categoria" readonly>
                            </div>
                            <div class="form-group">
                                <label for="premio_rc_legal">Prêmio RC Legal:</label>
                                <input type="text" id="premio_rc_legal" name="premio_rc_legal" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="premio_comercial_rc">Prêmio Comercial RC:</label>
                                <input type="text" id="premio_comercial_rc" name="premio_comercial_rc" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)">
                            </div>
                            <div class="form-group">
                                <label for="indice_desconto">Índice de Desconto:</label>
                                <input type="text" id="indice_desconto" name="indice_desconto" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="premio_poc">Prêmio POC:</label>
                                <input type="text" id="premio_poc" name="premio_poc" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)">
                            </div>
                            <div class="form-group">
                                <label for="premio_qiv">Prêmio QIV:</label>
                                <input type="text" id="premio_qiv" name="premio_qiv" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="taxa_danos_proprios">Taxa Danos Próprios:</label>
                                <input type="text" id="taxa_danos_proprios" name="taxa_danos_proprios" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)">
                            </div>
                            <div class="form-group">
                                <label for="taxa_comercial">Taxa Comercial:</label>
                                <input type="text" id="taxa_comercial" name="taxa_comercial" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="data_vigencia">Data de Vigência:</label>
                                <input type="date" id="data_vigencia" name="data_vigencia">
                            </div>
                        </div>
                        <button type="submit">Cadastrar</button>
                    </form>
                </div>
            </div>
            <!--  -->
        </div>
    </div>


    <script src="public/js/main.js"></script>
    <script src="public/js/jquery.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Modal para criar categoria
            const modal = document.getElementById("myModal");
            const btn = document.getElementById("myBtn");
            const closeBtn = modal.querySelector(".close");

            btn.onclick = function() {
                modal.style.display = "block";
            };

            closeBtn.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };

            // Modal para adicionar tarifas
            const modalTarifa = document.getElementById("myModal1");
            const btnsTarifa = document.querySelectorAll(".btn-tarifa");
            const closeBtnTarifa = modalTarifa.querySelector(".close");

            btnsTarifa.forEach((btn) => {
                btn.addEventListener("click", function() {
                    const categoriaId = this.getAttribute("data-id");
                    const nomeCategoria = this.getAttribute("data-nome");

                    document.getElementById("categoria_id").value = categoriaId;
                    document.getElementById("nome_categoria").value = nomeCategoria;

                    console.log(btnsTarifa)
                    modalTarifa.style.display = "block";
                });
            });

            closeBtnTarifa.onclick = function() {
                modalTarifa.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target === modalTarifa) {
                    modalTarifa.style.display = "none";
                }
            };
        });
    </script>
</body>

</html>