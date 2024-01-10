<?php

namespace controllers;

use services\AccesListeSceneService;
use services\CreateSpectacleService;
use yasmf\HttpHelper;
use yasmf\View;

class AccesListeSceneController
{

    private ?AccesListeSceneService $accesListeSceneService = null;
    private CreateSpectacleService $createSpectacleService;
    private array|false $tailleSceneBD;

    public function __construct(AccesListeSceneService $accesListeSceneService, CreateSpectacleService $createSpectacleService )
    {
        $this->accesListeSceneService = $accesListeSceneService;
        $this->createSpectacleService = $createSpectacleService;
        $this->tailleSceneBD = $this->createSpectacleService->recupererTailleScene();
    }

    function index(): View
    {
        $id_festival_actif = $this->verifierConnecte();
        return $this->construireVue($id_festival_actif);
    }

    public function retirerScene(): View
    {
        $id_festival_actif = $this->verifierConnecte();

        $id_scene = HttpHelper::getParam("id_scene") ?? null;

        $this->accesListeSceneService->retirerScene($id_festival_actif, $id_scene);

        return $this->construireVue($id_festival_actif);
    }

    /**
     * @param string|null $id_festival_actif
     * @return View
     */
    public function construireVue(?string $id_festival_actif): View
    {
        $scenes = $this->accesListeSceneService->getScene($id_festival_actif);
        $info_festival = $this->accesListeSceneService->getInfoFestival($id_festival_actif);

        $nom_festival = $info_festival['nom'];
        $categorie = $info_festival['categorie'];

        $view = new View("views/accesListeScene");
        // on change l'id_taille en taille
        foreach ($scenes as &$scene) {
            $scene['taille'] = $this->tailleSceneBD[$scene['id_taille'] - 1]['taille'];
        }

        $view->setVar("scenes", $scenes);
        $view->setVar("id_festival", $id_festival_actif);
        $view->setVar("nom_festival", $nom_festival);
        $view->setVar("categorie", $categorie);


        return $view;
    }

    /**
     * @return string|null
     */
    public function verifierConnecte(): ?string
    {
        $id_gestionnaire = $_SESSION['id_utilisateur'] ?? null;
        $id_festival_actif = HttpHelper::getParam("id_festival") ?? null;

        if ($id_gestionnaire == null || $id_festival_actif == null) {
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }
        return $id_festival_actif;
    }
}