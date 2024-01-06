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
    private CreateFestivalService $createFestivalService;
    private $userService;
    private $pdo;
    private $categorieBD;

    public function __construct(CreateSpectacleService $createSpectacleService, UserService $userService, CreateFestivalService $createFestivalService, PDO $pdo)
    {
        session_start();
        $this->pdo = $pdo;
        $this->createFestivalService = $createFestivalService;
        $this->createSpectacleService = $createSpectacleService;
        $this->categorieBD = $this -> createFestivalService->recupererCategorie();
        $this->userService = $userService;
    }

    public function index(PDO $pdo): View{
        $view = new View("views/creationSpectacle.scss/createSpectacle1");
        $view -> setVar('tableauCategorie' , $this->categorieBD);
        $this->reAfficherElementsPage1($view);
        return $view;
    }

    /**
     * verifie si l'utilisateur existe par son email
     * renvoie une vue qui echo true ou false
     */
    public function checkUserByEmail(): View
    {
        $email = htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $result = $this->userService->emailExiste($this->pdo, $email);
        $view = new View("views/creationSpectacle.scss/checkUserByEmail");
        $view->setVar("result", $result);
        return $view;
    }

    private function reAfficherElementsPage1(View $view)
    {
        $view->setVar("nom", $_SESSION['nom'] ?? "");
        $view->setVar("duree", $_SESSION['duree'] ?? "");
        $view->setVar("description", $_SESSION['description'] ?? "");
        $view->setVar("categorie", $_SESSION['categorie'] ?? "");
        $view->setVar("image", $_SESSION['image'] ?? "");
        $view->setVar("categorie", $_SESSION['categorie'] ?? "");
    }
}