<?php

namespace controllers;

use yasmf\View;

class ErrorController
{

    public function __construct()
    {
    }

    public function index(): View
    {
        $view = new View("views/Error504");
        return $view;
    }
}