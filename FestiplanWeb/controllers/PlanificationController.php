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

    // GROS TODO changer la méthode pour utiliser que ce qu'on a besoin car on a pas besoin des specacles par exemple
    public function index(PDO $pdo): View {
        // On récupère l'id de l'utilisateur et le festival sélectionné
        $id_organisateur = 1; // $_SESSION['id_utilisateur'] ?? null;
        $id_festival = 1; // $_SESSION['id_festival'] ?? null;
        // Si on tente d'accéder a la page de planification sans être connecté ou sans avoir séléctionné un festival,
        // on renvoie sur la page de connexion
//        if ($id_organisateur == null || $id_festival == null) {
//            header("Location: /Festiplan/FestiplanWeb/");
//            exit();
//        }
//
        $festival = $this->planificationService->getFestival($id_festival, $id_organisateur);

//        if ($festival == null) {
//            header("Location: /Festiplan/FestiplanWeb/"); // TODO renvoyer sur la bonne page avec éventuellement un message d'erreur
//            exit();
//        } // else


        $spectaclesFestival = $this->planificationService->getSpectaclesFestival($id_festival);

        $view = new View("views/planification"); // TODO Si ya un pb de pdo s'arreter la et afficher un message d'erreur
        $view->setVar('festival', $festival);
        $view->setVar('spectaclesFestival', $spectaclesFestival);
        $view->setVar('nom', $_SESSION['nom'] ?? 'Nom Inconnu');
        $view->setVar('prenom', $_SESSION['prenom'] ?? 'Uknown User'); 
        return $view;
    }

    public function getDataFestival() { // TODO bloquer si ya erreur pdo, a moins que ca se fasse avant
        // On récupère l'id de l'utilisateur et le festival sélectionné
        $id_organisateur = 1; // $_SESSION['id_utilisateur'] ?? null;
        $id_festival = 1; // $_SESSION['id_festival'] ?? null;

        $dataFestival = $this->planificationService->getFestival($id_festival, $id_organisateur);

        $view = new View("views/planificationDataFestival");
        $view->setVar('dataFestival', $dataFestival);

        return $view;
    }

    public function getDataSpectacle() {
        // On récupère l'id du festival sélectionné
        $id_festival = 1; // $_SESSION['id_festival'] ?? null;
        $dataSpectacle = $this->planificationService->getSpectaclesFestival($id_festival);

        $view = new View("views/PlanificationDataSpectacles");
        $view->setVar('dataSpectacle', $dataSpectacle);

        return $view;
    }
}