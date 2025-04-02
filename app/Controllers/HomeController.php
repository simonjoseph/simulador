<?php
require_once 'core/Controller.php';
require_once __DIR__ . '/../Models/Imposto.php';
require_once __DIR__ . "/../Models/Tarifa.php";
require_once __DIR__ . "/../Models/CampanhaMarketing.php";
require_once __DIR__ . "/../Models/Category.php";

class HomeController extends Controller
{

    protected $modelo;
    protected $modeloTarifa;
    protected $modeloMarketing;
    protected $modeloCategorias;

    public function __construct()
    {
        $this->modelo = new Imposto();
        $this->modeloTarifa = new Tarifa();
        $this->modeloMarketing = new CampanhaMarketing();
        $this->modeloCategorias = new Category();
    }

    public function index()
    {
        $impostos = $this->modelo->listarImpostos();
        $tarifas = $this->modeloTarifa->listarTarifasPorCategoria();
        $modeloMarketing = $this->modeloMarketing->listar();
        $modeloCategorias = $this->modeloCategorias->listar();

        // print_r($modeloCategorias);
        // exit;
        $data = [
            "title" => "Bem-vindo ao Simulador", 
            "impostos" => $impostos, 
            "tarifas" => $tarifas, 
            "campanhas" => $modeloMarketing, 
            "modeloCategorias" => $modeloCategorias];
        $this->view('home', $data);
    }
}
