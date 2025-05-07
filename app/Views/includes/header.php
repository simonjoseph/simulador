<?php
$current_uri = $_SERVER['REQUEST_URI'];

if (strpos($current_uri, 'carModel') !== false) {
    $current_section = 'Modelos de Carros';
} elseif (strpos($current_uri, 'carCategory') !== false) {
    $current_section = 'Categorias de Carros';
} elseif (strpos($current_uri, 'imposto') !== false) {
    $current_section = 'Imposto';
} elseif (strpos($current_uri, 'simulacoes') !== false) {
    $current_section = 'Simulacoes';
} elseif (strpos($current_uri, 'CampanhaMarketing') !== false) {
    $current_section = 'Campanhas de Marketing';
} elseif (strpos($current_uri, 'subscritor') !== false) {
    $current_section = 'Subscritor';
} elseif (strpos($current_uri, 'usuario') !== false) {
    $current_section = 'Usuario';
} else {
    $current_section = 'Categorias';
}
?>

<div class="header">
    <h1 class="page-title" style="color: #fff;"><?php echo $current_section ?></h1>

    <!-- Navbar -->
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="/simulador/dashboard">Dashboard</a></li>
            <li><a href="/simulador/subscritor">Subscritor</a></li>
            <li><a href="/simulador/usuario">Usuário</a></li>
            <li class="dropdown">
                <a href="#">Auto <i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="/simulador/carCategory">Categorias dos Carros</a></li>
                    <li><a href="/simulador/carModel">Modelos dos Carros</a></li>
                    <li><a href="/simulador/imposto">Imposto</a></li>
                    <li><a href="/simulador/category">Categoria</a></li>
                    <li><a href="/simulador/simulacoes">Simulações Auto</a></li>
                    <li><a href="/simulador/CampanhaMarketing">Campanhas de Marketing</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="user-info">
        <span>Bem-vindo, Admin</span>
        <a href="#" id="logout-btn" style="color: white;text-decoration: none;background: #2c3e50;padding: 5px 16px;border-radius: 8px;">Sair</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const logoutBtn = document.getElementById("logout-btn");

    logoutBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Impede o redirecionamento padrão

        Swal.fire({
            title: 'Tem certeza?',
            text: "Você deseja sair do sistema?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, sair!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireciona para o logout
                window.location.href = "/simulador/login/logout";
            }
        });
    });
});
</script>