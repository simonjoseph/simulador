<?php
require_once 'core/Controller.php';

class CarCategoryController extends Controller {
    public function index() {
        $data = ["title" => "Categoria do Simulador"];
        $this->view('carCategory', $data);
    }
}
?>
