<!-- <?php
$current_uri = $_SERVER['REQUEST_URI'];

if (strpos($current_uri, 'carModel') !== false) {
    $current_section = 'categoria-sedan';
} elseif (strpos($current_uri, 'carCategory') !== false) {
    $current_section = 'categoria-suv';
} elseif (strpos($current_uri, 'imposto') !== false) {
    $current_section = 'imposto';
} elseif (strpos($current_uri, 'simulacoes') !== false) {
    $current_section = 'simulacoes';
} elseif (strpos($current_uri, 'CampanhaMarketing') !== false) {
    $current_section = 'campanhas';
} elseif (strpos($current_uri, 'subscritor') !== false) {
    $current_section = 'subscritor';
} elseif (strpos($current_uri, 'usuario') !== false) {
    $current_section = 'usuario';
} else {
    $current_section = 'categorias';
}

?>
<div class="sidebar">
    <div class="logo">
        <img src="public/images/logo-tcas.png" width="200px" alt="Tranquilidade Seguro" />
    </div>
    <div class="menu-item has-submenu <?php echo $current_section === 'categorias' ? 'active' : ''; ?>" data-section="categorias">
        <i class="fas fa-car"></i> Simulador auto
        <i class="fas fa-chevron-right menu-arrow <?php echo $current_section === 'categorias' ? 'open' : ''; ?>"></i>
    </div>
    <div class="submenu <?php echo $current_section === 'categorias' ? 'open' : ''; ?>">
        <div class="submenu-item <?php echo $current_section === 'categoria-suv' ? 'active' : ''; ?>" data-section="categoria-suv">
            <a href="/simulador/carCategory">Categorias dos Carros</a>
        </div>
        <div class="submenu-item <?php echo $current_section === 'categoria-sedan' ? 'active' : ''; ?>" data-section="categoria-sedan">
            <a href="/simulador/carModel">Modelos dos Carros</a>
        </div>
        <div class="submenu-item <?php echo $current_section === 'imposto' ? 'active' : ''; ?>" data-section="categoria-picape">
            <a href="/simulador/imposto">Imposto</a>
        </div>
        <div class="submenu-item <?php echo $current_section === 'categoria' ? 'active' : ''; ?>" data-section="categoria-picape">
            <a href="/simulador/category">Categoria</a>
        </div>
        <div class="submenu-item <?php echo $current_section === 'simulacoes' ? 'active' : ''; ?>" data-section="categoria-picape">
            <a href="/simulador/simulacoes">Simulações auto</a>
        </div>
    </div>
    <div class="menu-item <?php echo $current_section === 'modelos' ? 'active' : ''; ?>" data-section="modelos">
        <i class="fas fa-car"></i> Modelos dos Carros
    </div>
    <div class="menu-item <?php echo $current_section === 'campanhas' ? 'active' : ''; ?>" data-section="campanhas">
        <a class="menu-item-a" style="color: #fff; text-decoration: none;" href="/simulador/CampanhaMarketing">
            <i class="fas fa-bullhorn"></i> Campanhas de Marketing
        </a>
    </div>
    <div class="menu-item <?php echo $current_section === 'imposto' ? 'active' : ''; ?>" data-section="imposto">
        <i class="fas fa-file-invoice-dollar"></i> Imposto
    </div>
    <div class="menu-item <?php echo $current_section === 'subscritor' ? 'active' : ''; ?>" data-section="subscritor">
        <i class="fas fa-users"></i> Subscritor
    </div>
    <div class="menu-item <?php echo $current_section === 'usuario' ? 'active' : ''; ?>" data-section="usuario">
        <i class="fas fa-user-shield"></i> Usuário
    </div>
</div> -->