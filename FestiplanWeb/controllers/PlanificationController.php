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
        $this->planificationService = $planificationService;
    }

    public function index(PDO $pdo): View {
        // On récupère l'id de l'utilisateur et le festival sélectionné
        $id_organisateur = $_SESSION['id_utilisateur'] ?? null;
        $id_festival =  HttpHelper::getParam("id_festival") ?? null;

        // Si on tente d'accéder a la page de planification sans être connecté ou sans avoir séléctionné un festival,
        // on renvoie sur la page de connexion
        if ($id_organisateur == null || $id_festival == null) {
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }

        $festival = $this->planificationService->getFestival($id_festival);

        if ($festival == null) {
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }

        $view = new View("views/planification");
        $view->setVar('festival', $festival);
        $view->setVar('nom', $_SESSION['nom'] ?? 'Nom Inconnu');
        $view->setVar('prenom', $_SESSION['prenom'] ?? 'Uknown User'); 
        return $view;
    }

    public function getDataFestival() { // TODO bloquer si ya erreur pdo, a moins que ca se fasse avant
        // On récupère l'id du festival sélectionné
        $id_festival =  HttpHelper::getParam("idFes") ?? null;

        $dataFestival = $this->planificationService->getFestival($id_festival);

        $view = new View("views/planificationDataFestival");
        $view->setVar('dataFestival', $dataFestival);

        return $view;
    }

    public function getDataSpectacle() {
        // On récupère l'id du festival sélectionné
        $id_festival =  HttpHelper::getParam("idFes") ?? null;

        $dataSpectacle = $this->planificationService->getSpectaclesFestival($id_festival);

        $view = new View("views/PlanificationDataSpectacles");
        $view->setVar('dataSpectacle', $dataSpectacle);

        return $view;
    }
}