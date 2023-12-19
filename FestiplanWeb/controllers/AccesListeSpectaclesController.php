<?php

namespace controllers;

use services\AccesListeSpectaclesService;
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
        $id_festival_actif = $_SESSION['id_festival_actif'] ?? null;

        $id_festival_actif = 1; // TODO : A supprimer STUB

        if ($id_gestionnaire == null || $id_festival_actif == null) {
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }

        $spctacles = $this->accesListeSpectaclesService->getSpectacles($id_festival_actif);

        $view = new View("views/accesListeSpectacles");




        return $view;
    }
}