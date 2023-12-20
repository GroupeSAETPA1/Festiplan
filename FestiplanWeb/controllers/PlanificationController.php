<?php

namespace controllers;

use PDO;
use services\PlanificationService;
use yasmf\HttpHelper;
use yasmf\View;

class PlanificationController
{

    private PlanificationService $planificationService;

    public function __construct(PlanificationService $planificationService)
    {
        session_start();
        $this->planificationService = $planificationService;
    }

    public function index(PDO $pdo): View {
        // On récupère l'id de l'utilisateur
        $id_organisateur = $_SESSION['id_utilisateur'] ?? null;
        $id_festival = $_SESSION['id_festival'] ?? null;
        // Si on tente d'accéder a la page de planification sans être connecté ou sans avoir séléctionné un festival,
        // on renvoie sur la page de connexion
        if ($id_organisateur == null || $id_festival == null) {
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }
        
        $festival = $this->planificationService->getFestival($id_festival, $id_organisateur);

        if ($festival == null) {
            header("Location: /Festiplan/FestiplanWeb/"); // TODO renvoyer sur la bonne page avec éventuellement un message d'erreur
            exit();
        } // else


        $spectaclesFestival = $this->planificationService->getSpectaclesFestival($id_festival);

        $view = new View("views/planification");
        $view->setVar('festival', $festival);
        $view->setVar('spectaclesFestival', $spectaclesFestival);
        $view->setVar('nom', $_SESSION['nom'] ?? '');
        $view->setVar('prenom', $_SESSION['prenom'] ?? ''); 
        return $view;
    }
}