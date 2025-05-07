<?php
session_start();

// Verifica se o usuário está autenticado
if (empty($_SESSION['user'])) {
    // Redireciona para a página de login
    header('Location: /simulador/login');
    exit;
}

// if (isset($_SESSION["success"])) {
//     echo "<div class='alert alert-success' style='
//     text-align: center;
//     background: green;
//     color: #fff;
// '>" . $_SESSION["success"] . "</div>";
//     unset($_SESSION["success"]);
// }
// if (isset($_SESSION["error"])) {
//     echo "<div class='alert alert-danger'>" . $_SESSION["error"] . "</div>";
//     unset($_SESSION["error"]);
// }
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
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main content -->
        <div class="main-content">
            
            <?php include 'includes/header.php'; ?>

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
                                    <button class="btn-edit" 
                                        data-id="<?= $imposto["id"] ?>" 
                                        data-cambio="<?= htmlspecialchars($imposto["cambio"]) ?>" 
                                        data-fga="<?= htmlspecialchars($imposto["fga"]) ?>" 
                                        data-iva="<?= htmlspecialchars($imposto["iva"]) ?>" 
                                        data-desconto="<?= htmlspecialchars($imposto["desconto"]) ?>" 
                                        data-cambio-geral="<?= htmlspecialchars($imposto["cambio_geral"]) ?>">
                                        Editar
                                    </button>
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

            <!-- Modal para editar imposto -->
            <div id="editModal" class="modal">
                <div class="modal-content" style="max-width: 600px;">
                    <span class="close">&times;</span>
                    <h2>Editar Imposto</h2>
                    <form id="editForm" action="imposto/update" method="post">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="edit-cambio">Câmbio:</label>
                                <input type="text" id="edit-cambio" name="cambio" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-fga">FGA:</label>
                                <input type="text" id="edit-fga" name="fga" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="edit-iva">IVA:</label>
                                <input type="text" id="edit-iva" name="iva" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-desconto">Desconto:</label>
                                <input type="text" id="edit-desconto" name="desconto" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="edit-cambio-geral">Câmbio Geral:</label>
                                <input type="text" id="edit-cambio-geral" name="cambio_geral" pattern="^-?\d+([.,]\d+)?$"
                                    title="Por favor, insira um número válido (ex: 25,50 ou 25.50)" required>
                            </div>
                        </div>
                        <button type="submit">Salvar Alterações</button>
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

            // Abre o modal de edição com os dados do imposto
            document.querySelectorAll(".btn-edit").forEach(function (button) {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const cambio = this.getAttribute("data-cambio");
                    const fga = this.getAttribute("data-fga");
                    const iva = this.getAttribute("data-iva");
                    const desconto = this.getAttribute("data-desconto");
                    const cambioGeral = this.getAttribute("data-cambio-geral");

                    // Preenche os campos do modal com os dados do imposto
                    document.getElementById("edit-id").value = id;
                    document.getElementById("edit-cambio").value = cambio;
                    document.getElementById("edit-fga").value = fga;
                    document.getElementById("edit-iva").value = iva;
                    document.getElementById("edit-desconto").value = desconto;
                    document.getElementById("edit-cambio-geral").value = cambioGeral;

                    // Exibe o modal
                    document.getElementById("editModal").style.display = "block";
                });
            });

            // Fecha o modal de edição
            document.querySelector("#editModal .close").addEventListener("click", function () {
                document.getElementById("editModal").style.display = "none";
            });

            // Fecha o modal se o usuário clicar fora dele
            window.addEventListener("click", function (event) {
                if (event.target === document.getElementById("editModal")) {
                    document.getElementById("editModal").style.display = "none";
                }
            });

            // Evento para o botão de exclusão
            document.querySelectorAll(".btn-delete").forEach(function (button) {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");

                    // Confirmação antes de excluir
                    Swal.fire({
                        title: 'Tem certeza?',
                        text: "Você não poderá reverter esta ação!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim, excluir!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enviar requisição para o backend
                            fetch(`imposto/delete/${id}`, {
                                method: "POST",
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error("Erro na requisição: " + response.status);
                                }
                                return response.json(); // Converte a resposta para JSON
                            })
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Excluído!',
                                        data.message,
                                        'success'
                                    ).then(() => location.reload()); // Recarrega a página após o alerta
                                } else {
                                    Swal.fire(
                                        'Erro!',
                                        data.message,
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error("Erro ao excluir o imposto:", error);
                                Swal.fire(
                                    'Erro!',
                                    'Erro ao excluir o imposto. Verifique os logs.',
                                    'error'
                                );
                            });
                        }
                    });
                });
            });

            // Evento para o envio do formulário de cadastro
            document.querySelector("#myModal form").addEventListener("submit", function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                const formData = new FormData(this);

                fetch("imposto/create", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro na requisição: " + response.status);
                    }
                    return response.json(); // Converte a resposta para JSON
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Sucesso!',
                            data.message,
                            'success'
                        ).then(() => location.reload()); // Recarrega a página após o alerta
                    } else {
                        Swal.fire(
                            'Erro!',
                            data.message,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error("Erro ao cadastrar o imposto:", error);
                    Swal.fire(
                        'Erro!',
                        'Erro ao cadastrar o imposto. Verifique os logs.',
                        'error'
                    );
                });
            });

            // Evento para o envio do formulário de edição
            document.querySelector("#editForm").addEventListener("submit", function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                const formData = new FormData(this);

                fetch("imposto/update", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro na requisição: " + response.status);
                    }
                    return response.json(); // Converte a resposta para JSON
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Sucesso!',
                            data.message,
                            'success'
                        ).then(() => location.reload()); // Recarrega a página após o alerta
                    } else {
                        Swal.fire(
                            'Erro!',
                            data.message,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error("Erro ao atualizar o imposto:", error);
                    Swal.fire(
                        'Erro!',
                        'Erro ao atualizar o imposto. Verifique os logs.',
                        'error'
                    );
                });
            });
        });
    </script>
</body>
</html>
