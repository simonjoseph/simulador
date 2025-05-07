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
    <title><?php echo $title ?></title>
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

        input,
        select {
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
        input[type="text"],
        select {
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

        /*  */
        .pagination {
    margin-top: 20px;
}

.pagination a {
    padding: 8px 12px;
    margin: 0 5px;
    text-decoration: none;
    border: 1px solid #ddd;
    color: #00be86;
}

.pagination a.active {
    background-color: #00be86;
    color: white;
    border: 1px solid #00be86;
}

.pagination a:hover {
    background-color:#43b029;
    color: white
}

        /*  */
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar menu -->
        
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main content -->
        <div class="main-content">
            
            <?php include 'includes/header.php'; ?>

            <!-- <button class="btn btn-primary btn btn-tarifa" id="myBtn">Abrir Formulário</button> -->

            <div class="table-container" style="margin-top: 20px;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Contacto</th>
                            <th>Categoria</th>
                            <th>Opção ESSENCIAL (RC)</th>
                            <th>Opção ESSENCIAL PLUS (RC+POC)</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($simulacoes as $simulacao): ?>
                            <tr>
                                <td><?= htmlspecialchars($simulacao["id"]) ?></td>
                                <td><?= htmlspecialchars($simulacao["nome"]) ?></td>
                                <td><?= htmlspecialchars($simulacao["email"]) ?></td>
                                <td><?= htmlspecialchars($simulacao["contato"]) ?></td>
                                <td><?= htmlspecialchars($simulacao["nome_categoria"]) ?></td>
                                <td><?= htmlspecialchars($simulacao["premio_rc_legal"]) ?></td>
                                <td><?= htmlspecialchars($simulacao["premio_comercial_rc"]) ?></td>
                                <td>
                                    <a class="btn-edit" href="/simulador/home/baixarPdf?cotacao=<?= $simulacao["cotacao"] ?>" target="_blank">Imprimir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Navegação de Páginas -->
                <div class="pagination">
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <a href="?pagina=<?= $i ?>" <?= $i == $paginaAtual ? 'class="active"' : '' ?>><?= $i ?></a>
                    <?php endfor; ?>
                </div>

            </div>

            <div id="myModal1" class="modal" style="padding-top: 0;">
                <div class="modal-content" style="max-width: 600px;">
                    <span class="close">&times;</span>
                    <h2>Adicionar Campanha de Marketing</h2>
                    <form id="tarifaForm" action="CampanhaMarketing/create" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome">Nome da Campanha:</label>
                                <input type="text" id="nome" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="percentagem">percentagem de desconto:</label>
                                <input type="text" id="percentagem" name="percentagem" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="data_inicio">Data de Incio:</label>
                                <input type="date" id="data_inicio" name="data_inicio">
                            </div>
                            <div class="form-group">
                                <label for="data_fim">Data de Fim:</label>
                                <input type="date" id="data_fim" name="data_fim">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="tipo_seguro">Tipo de seguro:</label>
                                <select name="tipo_seguro" id="tipo_seguro">
                                    <option value="auto">auto</option>
                                    <option value="viagem">viagem</option>
                                </select>
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
            // const modal = document.getElementById("myModal");
            // const btn = document.getElementById("myBtn");
            // const closeBtn = modal.querySelector(".close");

            // btn.onclick = function() {
            //     modal.style.display = "block";
            // };

            // closeBtn.onclick = function() {
            //     modal.style.display = "none";
            // };

            // window.onclick = function(event) {
            //     if (event.target === modal) {
            //         modal.style.display = "none";
            //     }
            // };

            // Modal para adicionar tarifas
            const modalTarifa = document.getElementById("myModal1");
            const btnsTarifa = document.querySelector(".btn-tarifa");
            const closeBtnTarifa = modalTarifa.querySelector(".close");

            // btnsTarifa.forEach((btn) => {
            btnsTarifa.addEventListener("click", function() {
                // const categoriaId = this.getAttribute("data-id");
                // const nomeCategoria = this.getAttribute("data-nome");

                // document.getElementById("categoria_id").value = categoriaId;
                // document.getElementById("nome_categoria").value = nomeCategoria;

                console.log(btnsTarifa)
                modalTarifa.style.display = "block";
            });
            // });

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