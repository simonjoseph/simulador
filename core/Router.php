<?php
class Router {
    public function run() {
        $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : ['home'];
        $controllerName = ucfirst($url[0]) . 'Controller';
        $method = isset($url[1]) ? $url[1] : 'index';

        $controllerPath = "app/Controllers/$controllerName.php";

        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $controller = new $controllerName();
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], array_slice($url, 2));
            } else {
                echo "Método não encontrado.";
            }
        } else {
            echo "Página não encontrada.";
        }
    }
}
?>
