<?php

// ob_start(); // Inicia buffer de saída

require_once 'core/Controller.php';
require_once __DIR__ . '/../Models/Login.php'; // Inclui o modelo Login

class LoginController extends Controller {
    private $loginModel;

    public function __construct() {
        $this->loginModel = new Login(); // Instancia o modelo Login
    }

    public function index() {
        $data = ["title" => "Login ao Simulador"];
        $this->view('login', $data);
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Verifica as credenciais usando o modelo Login
            $user = $this->loginModel->verificarCredenciais($username, $password);

            // if ($user) {
            //     if (session_status() === PHP_SESSION_NONE) {
            //         session_start();
            //     }
            //     $_SESSION['user'] = $user; // Armazena os dados do usuário na sessão
            //     error_log("Usuário armazenado na sessão: " . print_r($_SESSION['user'], true));
            //     header('Location: /simulador/dashboard');
            //     exit;
            // } 
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                // die('Login OK'); // <- Teste se isso aparece
                header('Location: /simulador/dashboard');
                exit;
            }
            
            else {
                // Falha no login
                $data = [
                    "title" => "Login ao Simulador",
                    "error" => "Usuário ou senha inválidos." // Mensagem de erro
                ];
                $this->view('login', $data);
            }
        } else {
            header('Location: /simulador/login');
            exit;
        }
    }

    public function logout() {
        // Destroi a sessão do usuário
        session_start();
        session_unset();
        session_destroy();

        // Redireciona para a página de login
        header('Location: /simulador/login');
        exit;
    }
}
?>