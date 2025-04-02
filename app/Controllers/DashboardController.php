<?php
require_once 'core/Controller.php';

class DashboardController extends Controller {
    public function index() {
        $data = ["title" => "Dashboard do Simulador"];
        $this->view('dashboard', $data);
    }
}
?>
