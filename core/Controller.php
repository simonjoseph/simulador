<?php
class Controller {
    public function __construct() {
        // Iniciar a sessão primeiro
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->checkAuthentication();
    }

    protected function view($viewName, $data = []) {
        extract($data);
        require "app/Views/$viewName.php";
    }

    private function checkAuthentication() {
        // Rotas permitidas sem autenticação
        $allowedRoutes = [
            '/login',
            '/login/authenticate',
            '/'
        ];
    
        // Obtém a rota atual e remove parâmetros de query
        $currentRoute = strtok($_SERVER['REQUEST_URI'], '?');
    
        // Verifica se a rota atual está na lista de rotas permitidas
        if (!in_array($currentRoute, $allowedRoutes)) {
            // Verifica se o usuário está autenticado
            if (empty($_SESSION['user'])) {
                // Redireciona para a página de login
                header('Location: /simulador/login');
                exit;
            }
        }
    }
}
?>