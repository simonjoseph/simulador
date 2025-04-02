<?php
require_once 'core/Controller.php';

class LoginController extends Controller {
    public function index() {
        $data = ["title" => "Login ao Simulador"];
        $this->view('login', $data);
    }
}
?>
