<?php

namespace controllers;

use yasmf\View;

class AccesListeSpectaclesController
{

    function index()
    {
        return new View("views/accesListeSpectacles");
    }
}