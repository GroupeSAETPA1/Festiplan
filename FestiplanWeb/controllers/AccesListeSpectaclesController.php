<?php

namespace controllers;

use yasmf\View;

class AccesListeSpectaclesController
{

    function index()
    {
        $view = new View("views/accesListeSpectacles");
        return $view;
    }
}