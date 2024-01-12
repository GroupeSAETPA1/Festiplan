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
        return new View("views/Error504");
    }
}