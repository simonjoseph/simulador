<?php

require_once 'core/Controller.php';
require_once __DIR__ . '/../Models/Dashboard.php';

class DashboardController extends Controller
{
    protected $dashboardModel;

    public function __construct()
    {
        $this->dashboardModel = new Dashboard();
    }

    public function index()
    {
        // Obter dados para os gráficos
        $simulacoesPorMes = $this->dashboardModel->getSimulacoesPorMes();
        $simulacoesPorCategoria = $this->dashboardModel->getSimulacoesPorCategoria();
        $simulacoesPorCampanha = $this->dashboardModel->getSimulacoesPorCampanha();

        // Preparar os dados para a view
        $data = [
            "title" => "Dashboard",
            "simulacoesPorMes" => $simulacoesPorMes,
            "simulacoesPorCategoria" => $simulacoesPorCategoria,
            "simulacoesPorCampanha" => $simulacoesPorCampanha
        ];

        // Renderizar a view do dashboard
        $this->view('dashboard', $data);
    }
}
?>
