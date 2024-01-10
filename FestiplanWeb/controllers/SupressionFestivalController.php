<?php

namespace controllers;

use yasmf\View;

class SupressionFestivalController
{

    public function __construct()
    {
    }

    public function index(): View
    {
        $view = new View("views/supression/supressionFestival");
        return $view;
    }
}