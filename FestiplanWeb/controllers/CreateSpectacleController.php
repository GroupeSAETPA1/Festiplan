<?php

namespace controllers;

use PDO;
use services\createFestivalService;
use services\CreateSpectacleService;
use services\UserService;
use yasmf\HttpHelper;
use yasmf\View;

class CreateSpectacleController
{
    private $createSpectacleService;
    private $userService;
    private $pdo;

    public function __construct(CreateSpectacleService $createSpectacleService, UserService $userService, PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createSpectacleService = $createSpectacleService;
        $this->userService = $userService;
    }

    /**
     * verifie si l'utilisateur existe par son email
     * renvoie une vue qui echo true ou false
     */
    public function checkUserByEmail(): View
    {
        $email = htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $result = $this->userService->emailExiste($this->pdo, $email);
        $view = new View("views/creationSpectacle/checkUserByEmail");
        $view->setVar("result", $result);
        return $view;
    }

    public function index(PDO $pdo): View{
        $view = new View("views/creationSpectacle/createSpectacle2");
        return $view;
    }



}