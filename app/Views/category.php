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
    <title>Categorias</title>
    <link rel="stylesheet" href="/simulador/public/css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
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
    </style>
    
</head>

<body>
    <div class="container">
        <!-- Sidebar menu -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main content -->
        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <h1>Lista de Categorias</h1>

            <!-- Botão para adicionar categoria -->
            <button class="btn btn-primary" id="btnAddCategory">Adicionar Categoria</button>

            <!-- Tabela de categorias -->
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
                        <?php if (!empty($categorias)): ?>
                            <?php foreach ($categorias as $categoria): ?>
                                <tr>
                                    <td><?= htmlspecialchars($categoria["id"]) ?></td>
                                    <td><?= htmlspecialchars($categoria["nome"]) ?></td>
                                    <td>
                                        <button class="btn btn-edit" 
                                            data-id="<?= htmlspecialchars($categoria["id"]) ?>" 
                                            data-nome="<?= htmlspecialchars($categoria["nome"]) ?>">Editar</button>
                                        <button class="btn btn-delete" data-id="<?= htmlspecialchars($categoria["id"]) ?>">Excluir</button>
                                        <button class="btn btn-ver" data-id="<?= htmlspecialchars($categoria["id"]) ?>">Ver</button>
                                        <button class="btn btn-tarifa" 
                                            data-id="<?= htmlspecialchars($categoria["id"]) ?>" 
                                            data-nome="<?= htmlspecialchars($categoria["nome"]) ?>">Adicionar Tarifas</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Nenhuma categoria encontrada.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para adicionar categoria -->
    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Adicionar Categoria</h2>
            <form id="addCategoryForm" action="/simulador/category/create" method="post">
                <label for="nome">Nome da Categoria:</label>
                <input type="text" id="nome" name="nome" required>
                <button type="submit">Salvar</button>
            </form>
        </div>
    </div>

    <!-- Modal para editar categoria -->
    <div id="editCategoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Editar Categoria</h2>
            <form id="editCategoryForm" action="/simulador/category/update" method="post">
                <input type="hidden" id="edit-id" name="id">
                <label for="edit-nome">Nome da Categoria:</label>
                <input type="text" id="edit-nome" name="nome" required>
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <!-- Modal para adicionar tarifas -->
    <div id="myModal1" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <span class="close">&times;</span>
            <h2>Adicionar Tarifas</h2>
            <form id="tarifaForm" action="/simulador/tarifa/create" method="post">
                <input type="hidden" name="categoria_id" id="categoria_id">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome_categoria">Nome da Categoria:</label>
                        <input type="text" id="nome_categoria" name="nome_categoria" readonly>
                    </div>
                    <div class="form-group">
                        <label for="premio_rc_legal">Prêmio RC Legal:</label>
                        <input type="text" id="premio_rc_legal" name="premio_rc_legal" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="premio_comercial_rc">Prêmio Comercial RC:</label>
                        <input type="text" id="premio_comercial_rc" name="premio_comercial_rc" required>
                    </div>
                    <div class="form-group">
                        <label for="indice_desconto">Índice de Desconto:</label>
                        <input type="text" id="indice_desconto" name="indice_desconto" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="premio_poc">Prêmio POC:</label>
                        <input type="text" id="premio_poc" name="premio_poc" required>
                    </div>
                    <div class="form-group">
                        <label for="premio_qiv">Prêmio QIV:</label>
                        <input type="text" id="premio_qiv" name="premio_qiv" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="taxa_danos_proprios">Taxa Danos Próprios:</label>
                        <input type="text" id="taxa_danos_proprios" name="taxa_danos_proprios" required>
                    </div>
                    <div class="form-group">
                        <label for="taxa_comercial">Taxa Comercial:</label>
                        <input type="text" id="taxa_comercial" name="taxa_comercial" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data_vigencia">Data de Vigência:</label>
                        <input type="date" id="data_vigencia" name="data_vigencia" required>
                    </div>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Modal para adicionar categoria
            const addCategoryModal = document.getElementById("addCategoryModal");
            const btnAddCategory = document.getElementById("btnAddCategory");
            const closeAddCategory = addCategoryModal.querySelector(".close");

            btnAddCategory.onclick = function () {
                addCategoryModal.style.display = "block";
            };

            closeAddCategory.onclick = function () {
                addCategoryModal.style.display = "none";
            };

            window.onclick = function (event) {
                if (event.target === addCategoryModal) {
                    addCategoryModal.style.display = "none";
                }
            };

            // Modal para editar categoria
            const editCategoryModal = document.getElementById("editCategoryModal");
            const closeEditCategory = editCategoryModal.querySelector(".close");

            document.querySelectorAll(".btn-edit").forEach(function (button) {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const nome = this.getAttribute("data-nome");

                    document.getElementById("edit-id").value = id;
                    document.getElementById("edit-nome").value = nome;

                    editCategoryModal.style.display = "block";
                });
            });

            closeEditCategory.onclick = function () {
                editCategoryModal.style.display = "none";
            };

            window.onclick = function (event) {
                if (event.target === editCategoryModal) {
                    editCategoryModal.style.display = "none";
                }
            };

            // Evento para criar categoria
            document.getElementById("addCategoryForm").addEventListener("submit", function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                const formData = new FormData(this);

                fetch("/simulador/category/create", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro na requisição: " + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Sucesso!',
                            data.message,
                            'success'
                        ).then(() => location.reload());
                    } else {
                        Swal.fire(
                            'Erro!',
                            data.message,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error("Erro ao criar a categoria:", error);
                    Swal.fire(
                        'Erro!',
                        'Erro ao criar a categoria. Verifique os logs.',
                        'error'
                    );
                });
            });

            // Evento para editar categoria
            document.getElementById("editCategoryForm").addEventListener("submit", function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                const formData = new FormData(this);

                fetch("/simulador/category/update", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro na requisição: " + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Sucesso!',
                            data.message,
                            'success'
                        ).then(() => location.reload());
                    } else {
                        Swal.fire(
                            'Erro!',
                            data.message,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error("Erro ao editar a categoria:", error);
                    Swal.fire(
                        'Erro!',
                        'Erro ao editar a categoria. Verifique os logs.',
                        'error'
                    );
                });
            });

            // Evento para o botão "Excluir"
            document.querySelectorAll(".btn-delete").forEach(function (button) {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");

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
                            fetch(`/simulador/category/delete/${id}`, {
                                method: "POST",
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error("Erro na requisição: " + response.status);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Excluído!',
                                        data.message,
                                        'success'
                                    ).then(() => location.reload());
                                } else {
                                    Swal.fire(
                                        'Erro!',
                                        data.message,
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error("Erro ao excluir a categoria:", error);
                                Swal.fire(
                                    'Erro!',
                                    'Erro ao excluir a categoria. Verifique os logs.',
                                    'error'
                                );
                            });
                        }
                    });
                });
            });

            // Evento para o botão "Ver"
            document.querySelectorAll(".btn-ver").forEach(function (button) {
                button.addEventListener("click", function () {
                    const categoriaId = this.getAttribute("data-id");
                    window.location.href = `/simulador/category/ver/${categoriaId}`;
                });
            });

            // Modal para adicionar tarifas
            const modalTarifa = document.getElementById("myModal1");
            const btnsTarifa = document.querySelectorAll(".btn-tarifa");
            const closeBtnTarifa = modalTarifa.querySelector(".close");

            btnsTarifa.forEach((btn) => {
                btn.addEventListener("click", function () {
                    const categoriaId = this.getAttribute("data-id");
                    const nomeCategoria = this.getAttribute("data-nome");

                    document.getElementById("categoria_id").value = categoriaId;
                    document.getElementById("nome_categoria").value = nomeCategoria;

                    modalTarifa.style.display = "block";
                });
            });

            closeBtnTarifa.onclick = function () {
                modalTarifa.style.display = "none";
            };

            window.onclick = function (event) {
                if (event.target === modalTarifa) {
                    modalTarifa.style.display = "none";
                }
            };

            // Evento para o formulário de adicionar tarifas
            document.getElementById("tarifaForm").addEventListener("submit", function (event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                const formData = new FormData(this);

                fetch("/simulador/tarifa/create", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro na requisição: " + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Sucesso!',
                            data.message,
                            'success'
                        ).then(() => {
                            modalTarifa.style.display = "none";
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Erro!',
                            data.message,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error("Erro ao adicionar a tarifa:", error);
                    Swal.fire(
                        'Erro!',
                        'Erro ao adicionar a tarifa. Verifique os logs.',
                        'error'
                    );
                });
            });

            // Evento para o botão "Ver"
            document.querySelectorAll(".btn-ver").forEach(function (button) {
                button.addEventListener("click", function () {
                    const categoriaId = this.getAttribute("data-id");
                    // Redireciona para a página de visualização, passando o ID da categoria na URL
                    window.location.href = `/simulador/category/ver/${categoriaId}`;
                });
            });
        });
    </script>
</body>

</html>