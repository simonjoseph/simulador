<?php
session_start();

// Verifica se o usuário está autenticado
if (empty($_SESSION['user'])) {
    // Redireciona para a página de login
    header('Location: /simulador/login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campanhas de Marketing</title>
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
        input[type="text"],
        select {
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
        <!-- Sidebar menu -->

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
                            <th>Nome</th>
                            <th>Percentagem</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th>Tipo Seguro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($campanhas as $campanha): ?>
                            <tr>
                                <td><?= htmlspecialchars($campanha["id"]) ?></td>
                                <td><?= htmlspecialchars($campanha["nome"]) ?></td>
                                <td><?= htmlspecialchars($campanha["percentagem"]) ?></td>
                                <td><?= htmlspecialchars($campanha["data_inicio"]) ?></td>
                                <td><?= htmlspecialchars($campanha["data_fim"]) ?></td>
                                <td><?= htmlspecialchars($campanha["tipo_seguro"]) ?></td>
                                <td>
                                    <button class="btn-edit" 
                                        data-id="<?= $campanha["id"] ?>" 
                                        data-nome="<?= htmlspecialchars($campanha["nome"]) ?>" 
                                        data-percentagem="<?= htmlspecialchars($campanha["percentagem"]) ?>" 
                                        data-data-inicio="<?= htmlspecialchars($campanha["data_inicio"]) ?>" 
                                        data-data-fim="<?= htmlspecialchars($campanha["data_fim"]) ?>" 
                                        data-tipo-seguro="<?= htmlspecialchars($campanha["tipo_seguro"]) ?>">
                                        Editar
                                    </button>
                                    <button class="btn-delete" data-id="<?= $campanha["id"] ?>">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal para cadastrar campanha -->
            <div id="myModal" class="modal">
                <div class="modal-content" style="max-width: 600px;">
                    <span class="close">&times;</span>
                    <h2>Adicionar Campanha</h2>
                    <form action="CampanhaMarketing/create" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" id="nome" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="percentagem">Percentagem:</label>
                                <input type="text" id="percentagem" name="percentagem" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="data_inicio">Data Início:</label>
                                <input type="date" id="data_inicio" name="data_inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="data_fim">Data Fim:</label>
                                <input type="date" id="data_fim" name="data_fim" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="tipo_seguro">Tipo Seguro:</label>
                                <select id="tipo_seguro" name="tipo_seguro" required>
                                    <option value="auto">Auto</option>
                                    <option value="viagem">Viagem</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit">Cadastrar</button>
                    </form>
                </div>
            </div>
            <!-- Fim do modal -->

            <!-- Modal para editar campanha -->
            <div id="editModal" class="modal">
                <div class="modal-content" style="max-width: 600px;">
                    <span class="close">&times;</span>
                    <h2>Editar Campanha</h2>
                    <form id="editForm" action="CampanhaMarketing/update" method="post">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="edit-nome">Nome:</label>
                                <input type="text" id="edit-nome" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-percentagem">Percentagem:</label>
                                <input type="text" id="edit-percentagem" name="percentagem" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="edit-data_inicio">Data Início:</label>
                                <input type="date" id="edit-data_inicio" name="data_inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-data_fim">Data Fim:</label>
                                <input type="date" id="edit-data_fim" name="data_fim" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="edit-tipo_seguro">Tipo Seguro:</label>
                                <select id="edit-tipo_seguro" name="tipo_seguro" required>
                                    <option value="auto">Auto</option>
                                    <option value="viagem">Viagem</option>
                                </select>
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

            // Abre o modal de edição com os dados da campanha
            document.querySelectorAll(".btn-edit").forEach(function (button) {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const nome = this.getAttribute("data-nome");
                    const percentagem = this.getAttribute("data-percentagem");
                    const dataInicio = this.getAttribute("data-data-inicio");
                    const dataFim = this.getAttribute("data-data-fim");
                    const tipoSeguro = this.getAttribute("data-tipo-seguro");

                    // Preenche os campos do modal com os dados da campanha
                    document.getElementById("edit-id").value = id;
                    document.getElementById("edit-nome").value = nome;
                    document.getElementById("edit-percentagem").value = percentagem;
                    document.getElementById("edit-data_inicio").value = dataInicio;
                    document.getElementById("edit-data_fim").value = dataFim;
                    document.getElementById("edit-tipo_seguro").value = tipoSeguro;

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
                            fetch(`CampanhaMarketing/delete/${id}`, {
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
                                console.error("Erro ao excluir a campanha:", error);
                                Swal.fire(
                                    'Erro!',
                                    'Erro ao excluir a campanha. Verifique os logs.',
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

                fetch("CampanhaMarketing/create", {
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
                    console.error("Erro ao cadastrar a campanha:", error);
                    Swal.fire(
                        'Erro!',
                        'Erro ao cadastrar a campanha. Verifique os logs.',
                        'error'
                    );
                });
            });

            // Evento para o envio do formulário de edição
            document.querySelector("#editForm").addEventListener("submit", function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                const formData = new FormData(this);

                fetch("CampanhaMarketing/update", {
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
                    console.error("Erro ao atualizar a campanha:", error);
                    Swal.fire(
                        'Erro!',
                        'Erro ao atualizar a campanha. Verifique os logs.',
                        'error'
                    );
                });
            });
        });
    </script>
</body>

</html>