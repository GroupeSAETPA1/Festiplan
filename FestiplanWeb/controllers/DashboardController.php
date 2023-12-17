<?php

namespace controllers;

use PDO;
use services\DashboardService;
use yasmf\HttpHelper;
use yasmf\View;

class DashboardController
{

    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        session_start();
        $this->dashboardService = $dashboardService;
    }

    public function index(PDO $pdo): View
    {
        //On récupère l'id de l'utilisateur
        $id_gestionnaire = $_SESSION['id_utilisateur'] ?? null;
        //Si on a tenté d'accéder au dashboard sans être connecté, on renvoie sue la page de connexion
        if ($id_gestionnaire == null) {
            $view = new View("views/index");
            $view->setVar("login", "");
            $view->setVar("mdp", "");
            return $view;
        }
        $festivals = $this->dashboardService->getFestivals($id_gestionnaire) ;
        $spectacles = $this->dashboardService->getSpectacles($id_gestionnaire) ;

        $view = new View("views/dashboard");
        $view->setVar('festivals',$festivals);
        $view->setVar('spectacles',$spectacles);
        return $view;
    }
}