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
    <title>Tarifas</title>
    <link rel="stylesheet" href="/simulador/public/css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
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

        .btn{
            color: #fff;
            background-color: #007bff;
            border: none;
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

            <h1>Tarifas da Categoria <?= htmlspecialchars($categoriaNome) ?></h1>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prêmio RC Legal</th>
                            <th>Prêmio Comercial RC</th>
                            <th>Índice de Desconto</th>
                            <th>Prêmio POC</th>
                            <th>Prêmio QIV</th>
                            <th>Taxa Danos Próprios</th>
                            <th>Taxa Comercial</th>
                            <th>Data de Vigência</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tarifas)): ?>
                            <?php foreach ($tarifas as $tarifa): ?>
                                <tr>
                                    <td><?= htmlspecialchars($tarifa["id"]) ?></td>
                                    <td><?= htmlspecialchars($tarifa["premio_rc_legal"]) ?></td>
                                    <td><?= htmlspecialchars($tarifa["premio_comercial_rc"]) ?></td>
                                    <td><?= htmlspecialchars($tarifa["indice_desconto"]) ?></td>
                                    <td><?= htmlspecialchars($tarifa["premio_poc"]) ?></td>
                                    <td><?= htmlspecialchars($tarifa["premio_qiv"]) ?></td>
                                    <td><?= htmlspecialchars($tarifa["taxa_danos_proprios"]) ?></td>
                                    <td><?= htmlspecialchars($tarifa["taxa_comercial"]) ?></td>
                                    <td><?= htmlspecialchars($tarifa["data_vigencia"]) ?></td>
                                    <td>
                                        <button class="btn-edit" 
                                            data-id="<?= $tarifa["id"] ?>" 
                                            data-premio-rc-legal="<?= htmlspecialchars($tarifa["premio_rc_legal"]) ?>" 
                                            data-premio-comercial-rc="<?= htmlspecialchars($tarifa["premio_comercial_rc"]) ?>" 
                                            data-indice-desconto="<?= htmlspecialchars($tarifa["indice_desconto"]) ?>" 
                                            data-premio-poc="<?= htmlspecialchars($tarifa["premio_poc"]) ?>" 
                                            data-premio-qiv="<?= htmlspecialchars($tarifa["premio_qiv"]) ?>" 
                                            data-taxa-danos-proprios="<?= htmlspecialchars($tarifa["taxa_danos_proprios"]) ?>" 
                                            data-taxa-comercial="<?= htmlspecialchars($tarifa["taxa_comercial"]) ?>" 
                                            data-data-vigencia="<?= htmlspecialchars($tarifa["data_vigencia"]) ?>">
                                            Editar
                                        </button>
                                        <button class="btn-delete" data-id="<?= $tarifa["id"] ?>">Excluir</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10">Nenhuma tarifa encontrada para esta categoria.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <a href="/simulador/category" class="btn">Voltar</a>
        </div>
    </div>

    <!-- Modal para editar tarifa -->
    <div id="editModal" class="modal" style="padding-top: 0;">
        <div class="modal-content" style="max-width: 600px;">
            <span class="close">&times;</span>
            <h2>Editar Tarifa</h2>
            <form id="editForm" action="http://localhost/simulador/tarifa/update" method="post">
                <input type="hidden" id="edit-id" name="id">
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-premio-rc-legal">Prêmio RC Legal:</label>
                        <input type="text" id="edit-premio-rc-legal" name="premio_rc_legal" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-premio-comercial-rc">Prêmio Comercial RC:</label>
                        <input type="text" id="edit-premio-comercial-rc" name="premio_comercial_rc" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-indice-desconto">Índice de Desconto:</label>
                        <input type="text" id="edit-indice-desconto" name="indice_desconto" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-premio-poc">Prêmio POC:</label>
                        <input type="text" id="edit-premio-poc" name="premio_poc" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-premio-qiv">Prêmio QIV:</label>
                        <input type="text" id="edit-premio-qiv" name="premio_qiv" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-taxa-danos-proprios">Taxa Danos Próprios:</label>
                        <input type="text" id="edit-taxa-danos-proprios" name="taxa_danos_proprios" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-taxa-comercial">Taxa Comercial:</label>
                        <input type="text" id="edit-taxa-comercial" name="taxa_comercial" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-data-vigencia">Data de Vigência:</label>
                        <input type="date" id="edit-data-vigencia" name="data_vigencia" required>
                    </div>
                </div>
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Evento para o botão "Editar"
            document.querySelectorAll(".btn-edit").forEach(function (button) {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const premioRcLegal = this.getAttribute("data-premio-rc-legal");
                    const premioComercialRc = this.getAttribute("data-premio-comercial-rc");
                    const indiceDesconto = this.getAttribute("data-indice-desconto");
                    const premioPoc = this.getAttribute("data-premio-poc");
                    const premioQiv = this.getAttribute("data-premio-qiv");
                    const taxaDanosProprios = this.getAttribute("data-taxa-danos-proprios");
                    const taxaComercial = this.getAttribute("data-taxa-comercial");
                    const dataVigencia = this.getAttribute("data-data-vigencia");

                    // Preenche os campos do modal com os dados da tarifa
                    document.getElementById("edit-id").value = id;
                    document.getElementById("edit-premio-rc-legal").value = premioRcLegal;
                    document.getElementById("edit-premio-comercial-rc").value = premioComercialRc;
                    document.getElementById("edit-indice-desconto").value = indiceDesconto;
                    document.getElementById("edit-premio-poc").value = premioPoc;
                    document.getElementById("edit-premio-qiv").value = premioQiv;
                    document.getElementById("edit-taxa-danos-proprios").value = taxaDanosProprios;
                    document.getElementById("edit-taxa-comercial").value = taxaComercial;
                    document.getElementById("edit-data-vigencia").value = dataVigencia;

                    // Exibe o modal de edição
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

            // Envio do formulário de edição via fetch
            document.querySelector("#editForm").addEventListener("submit", function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                const formData = new FormData(this);

                fetch("http://localhost/simulador/tarifa/update", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    console.log("Resposta do servidor:", response); // Log da resposta
                    if (!response.ok) {
                        throw new Error("Erro na requisição: " + response.status);
                    }
                    return response.json(); // Converte a resposta para JSON
                })
                .then(data => {
                    console.log("Dados recebidos do servidor:", data); // Log dos dados recebidos
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
                    console.error("Erro ao atualizar a tarifa:", error); // Log do erro
                    Swal.fire(
                        'Erro!',
                        'Erro inesperado. Verifique os logs.',
                        'error'
                    );
                });
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
                            fetch(`http://localhost/simulador/tarifa/delete/${id}`, {
                                method: "POST",
                            })
                            .then(response => {
                                if (response.redirected) {
                                    console.error("Redirecionado para:", response.url);
                                    Swal.fire(
                                        'Erro!',
                                        'Redirecionado para outra página. Verifique o backend.',
                                        'error'
                                    );
                                    throw new Error("Redirecionado para: " + response.url);
                                }
                                if (!response.ok) {
                                    throw new Error("Erro na requisição: " + response.status);
                                }
                                return response.json(); // Converte a resposta para JSON
                            })
                            .then(data => {
                                console.log("Dados recebidos do servidor:", data); // Log dos dados recebidos
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
                                console.error("Erro ao excluir a tarifa:", error); // Log do erro
                                Swal.fire(
                                    'Erro!',
                                    'Erro ao excluir a tarifa. Verifique os logs.',
                                    'error'
                                );
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>