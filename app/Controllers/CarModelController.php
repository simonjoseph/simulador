<?php
require_once 'core/Controller.php';

class CarModelController extends Controller {
    public function index() {
        $data = ["title" => "Modelo do automovel"];
        $this->view('carModel', $data);
    }
}
?>
