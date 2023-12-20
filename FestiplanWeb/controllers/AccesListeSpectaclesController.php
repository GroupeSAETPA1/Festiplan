<?php

namespace controllers;

use services\AccesListeSpectaclesService;
use yasmf\HttpHelper;
use yasmf\View;

class AccesListeSpectaclesController
{

    private ?AccesListeSpectaclesService $accesListeSpectaclesService = null;

    public function __construct(AccesListeSpectaclesService $accesListeSpectaclesService )
    {
        session_start();
        $this->accesListeSpectaclesService = $accesListeSpectaclesService;
    }

    function index(): View
    {
        $id_gestionnaire = $_SESSION['id_utilisateur'] ?? null;
        $id_festival_actif = HttpHelper::getParam("id_festival") ?? null;


        //if ($id_gestionnaire == null || $id_festival_actif == null) {
        //    header("Location: /Festiplan/FestiplanWeb/");
        //    exit();
        //}

        $spctacles = $this->accesListeSpectaclesService->getSpectacles($id_festival_actif);
        $info_festival = $this->accesListeSpectaclesService->getInfoFestival($id_festival_actif);

        $nom_festival = $info_festival['nom'];
        $categorie = $info_festival['categorie'];

        $view = new View("views/accesListeSpectacles");

        $view->setVar("spectacles", $spctacles);
        $view->setVar("id_festival", $id_festival_actif);
        $view->setVar("nom_festival", $nom_festival);
        $view->setVar("categorie", $categorie);


        return $view;
    }
}