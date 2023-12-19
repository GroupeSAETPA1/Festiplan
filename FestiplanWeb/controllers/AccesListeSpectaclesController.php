<?php

namespace controllers;

use services\AccesListeSpectaclesService;
use yasmf\View;

class AccesListeSpectaclesController
{

    private ?AccesListeSpectaclesService $accesListeSpectaclesService = null;

    public function __construct(AccesListeSpectaclesService $accesListeSpectaclesService )
    {
        $this->accesListeSpectaclesService = $accesListeSpectaclesService;
    }

    function index(): View
    {
        $spctacles = $this->accesListeSpectaclesService->getSpectacles();

        $view = new View("views/accesListeSpectacles");




        return $view;
    }
}