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
        $this->dashboardService = $dashboardService;
    }

    public function index(PDO $pdo): View
    {
        $id_gestionnaire = (int)HttpHelper::getParam('id_gestionnaire');

        $festivals = $this->dashboardService->getFestivals($id_gestionnaire) ;
        $spectacles = $this->dashboardService->getSpectacles($id_gestionnaire) ;

        $view = new View("views/dashboard");
        $view->setVar('festivals',$festivals);
        $view->setVar('spectacles',$spectacles);
        return $view;
    }
}