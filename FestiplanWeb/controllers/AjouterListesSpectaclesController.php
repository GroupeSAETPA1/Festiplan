<?php

namespace controllers;

use services\AjouterLIstesSpectaclesServices;
use yasmf\HttpHelper;
use yasmf\View;

class AjouterListesSpectaclesController
{

    private AjouterLIstesSpectaclesServices $ajouterLIstesSpectaclesServices;

    public function __construct(AjouterLIstesSpectaclesServices $ajouterLIstesSpectaclesServices)
    {
        session_start();
        $this->ajouterLIstesSpectaclesServices = $ajouterLIstesSpectaclesServices;
    }

    function index(): View
    {
        $id_gestionnaire = $_SESSION['id_utilisateur'] ?? null;
        $id_festival_actif = HttpHelper::getParam("id_festival") ?? null;
        $nom_festival = HttpHelper::getParam("nom_festival") ?? null;

        $id_festival_actif = 1;
        if ($id_gestionnaire == null || $id_festival_actif == null) {
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }


        $view = new View("views/ajouterListesSpectacles");

        $view->setVar("id_festival", $id_festival_actif);
        $view->setVar("nom_festival", $nom_festival);

        return $view;
    }
}