<?php

namespace controllers;

use PDO;
use services\CreateSceneService;
use services\CreateSpectacleService;
use services\UserService;
use yasmf\HttpHelper;
use yasmf\View;

/**
 * Controleur de la gestion utilisateur
 */
class CreateSceneController
{

    private CreateSceneService $sceneService;
    private $tailleSceneBD;
    private CreateSpectacleService $createSpectacleService;

    public function __construct(CreateSceneService $sceneService, CreateSpectacleService $createSpectacleService)
    {
        $this->sceneService = $sceneService;
        $this->createSpectacleService = $createSpectacleService;
        $this->tailleSceneBD = $this->createSpectacleService->recupererTailleScene();
    }

    /**
     * genere la vue de la page de parametres utilisateur
     * @return View
     */
    public function index(): View
    {
        $view = new View("views/createScene");
        $view->setVar('tableauTailleScene', $this->tailleSceneBD);
        $id_festival = HttpHelper::getParam("id_festival") ?? null;
        $nom_festival = HttpHelper::getParam("nom_festival") ?? null;
        $view->setVar('id_festival', $id_festival);
        $view->setVar('nom_festival', $nom_festival);
        $this->reAfficherElementsPage1($view);
        return $view;
    }

    function PDONotFound()
    {
        return new View("/views/Error504");
    }

    private function reAfficherElementsPage1(View $view)
    {
        $view->setVar('nomScene', HttpHelper::getParam("nomScene") ?: "");
        $view->setVar('tailleScene', HttpHelper::getParam("tailleScene") ?: "");
        $view->setVar('nombreSpectateur', HttpHelper::getParam("nombreSpectateur") ?: "");
        $view->setVar('longitude', HttpHelper::getParam("longitude") ?: 0);
        $view->setVar('latitude', HttpHelper::getParam("latitude") ?: 0);
    }

    public function valider() {
        $nomScene = htmlspecialchars(HttpHelper::getParam("nomScene") ?: "");
        $tailleScene = htmlspecialchars(HttpHelper::getParam("tailleScene") ?: "");
        $nombreSpectateur = htmlspecialchars(HttpHelper::getParam("nombreSpectateur") ?: "");
        $longitude = htmlspecialchars(HttpHelper::getParam("longitude") ?: "");
        $latitude = htmlspecialchars(HttpHelper::getParam("latitude") ?: "");

        $ok = $nomScene != "" && $tailleScene != "" && $nombreSpectateur > 0 && $longitude > -180  && $longitude < 180 && $latitude > -180 && $latitude < 180;
        if (!$ok) {
            $view = new View("views/createScene");
            $view->setVar('tableauTailleScene', $this->tailleSceneBD);
            $this->reAfficherElementsPage1($view);
            $view->setVar('id_festival', HttpHelper::getParam("id_festival") ?: "");
            $view->setVar('nom_festival', HttpHelper::getParam("nom_festival") ?: "");
            $view->setVar('erreur', "Veuillez remplir tous les champs");
            return $view;
        } else {
            $this->sceneService->creerScene($nomScene, $tailleScene, $nombreSpectateur, $longitude, $latitude);
            header("Location: /Festiplan/FestiplanWeb/index.php?controller=AjouterListesScene&action=index&id_festival=" . HttpHelper::getParam("id_festival") . "&nom_festival=" . HttpHelper::getParam("nom_festival"));
        }
        return null;
    }
}
