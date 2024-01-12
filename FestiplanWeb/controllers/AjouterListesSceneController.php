<?php

namespace controllers;

use services\AjouterListesSceneServices;
use services\CreateSpectacleService;
use yasmf\HttpHelper;
use yasmf\View;

class AjouterListesSceneController
{

    private AjouterListesSceneServices $ajouterListesSceneServices;
    private CreateSpectacleService $createSpectacleService;
    private array|false $tailleSceneBD;

    public function __construct(AjouterListesSceneServices $ajouterListesSceneServices, CreateSpectacleService $createSpectacleService)
    {
        $this->ajouterListesSceneServices = $ajouterListesSceneServices;
        $this->createSpectacleService = $createSpectacleService;
        $this->tailleSceneBD = $this->createSpectacleService->recupererTailleScene();
    }

    public function index(): View
    {
        $id_gestionnaire = $_SESSION['id_utilisateur'] ?? null;
        $id_festival_actif = HttpHelper::getParam("id_festival") ?? null;
        $nom_festival = HttpHelper::getParam("nom_festival") ?? null;
        $_SESSION['ajouterListesScenes'] = [
            "id_festival" => $id_festival_actif,
            "nom_festival" => $nom_festival
        ];

        if ($id_gestionnaire == null || $id_festival_actif == null) {
            if ($id_gestionnaire == null) echo "Erreur : id_gestionnaire est null index()";
            if ($id_festival_actif == null) echo "Erreur : id_festival_actif est null index()";
        }

        return $this->construireVue($id_festival_actif, $nom_festival);
    }

    public function construireVue(int $id_festival_actif, string $nom_festival): View
    {
        $lesScenesDisponible = $this->ajouterListesSceneServices->getScenesDisponible($id_festival_actif);
        $lesScenesSelectionne = $this->ajouterListesSceneServices->getScenesTemporaire();
        $sceneFestival = $this->ajouterListesSceneServices->getScene($id_festival_actif);

        foreach ($lesScenesDisponible as &$sceneDispo) {
            $sceneDispo['taille'] = $this->tailleSceneBD[$sceneDispo['id_taille'] - 1]['taille'];
            foreach ($lesScenesSelectionne as $sceneSelection) {
                if ($sceneDispo['id_scene'] == $sceneSelection['id_scene']) {
                    $sceneDispo['action'] = "retirer";
                }
            }
        }
        unset($sceneDispo);

        $view = new View("views/ajouterListesScene");

        $view->setVar("id_festival", $id_festival_actif);
        $view->setVar("nom_festival", $nom_festival);
        $view->setVar("scenesDisponible", $lesScenesDisponible);
        $view->setVar("sceneFestival", $sceneFestival);

        return $view;
    }

    public function ajouterScene(): View
    {
        $id_festival = $_SESSION['ajouterListesScenes']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesScenes']['nom_festival'] ?? null;
        $id_scene = HttpHelper::getParam("id_scene") ?? null;
        if ($id_festival == null || $id_scene == null) {
            echo "Erreur : id_festival ou id_scene est null ajouterScene()";
        }
        try {
            $this->ajouterListesSceneServices->ajouterScene($id_festival, $id_scene);
        } catch (\PDOException $e) {
        }

        return $this->construireVue($id_festival, $nom_festival);
    }

    public function retirer(): View
    {
        $id_festival = $_SESSION['ajouterListesScenes']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesScenes']['nom_festival'] ?? null;
        $id_scene = HttpHelper::getParam("id_scene") ?? null;

        if ($id_festival == null || $id_scene == null) {
            echo "Erreur : id_festival ou id_scene est null retirerScene()";
        }
        $this->ajouterListesSceneServices->retirerScene($id_festival, $id_scene);

        return $this->construireVue($id_festival, $nom_festival);
    }

    public function validerScenesSelectionne(): View
    {
        $id_festival = $_SESSION['ajouterListesScenes']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesScenes']['nom_festival'] ?? null;
        var_dump($id_festival);
        $tab_scene_valider = $this->ajouterListesSceneServices->getScenesTemporaire();
        $this->ajouterListesSceneServices->viderTableTemporaire($id_festival);
        foreach ($tab_scene_valider as $scene) {
            try {
                $this->ajouterListesSceneServices->ajouterSceneAuFestival($id_festival, $scene['id_scene']);
            } catch (\PDOException $e) {
            }
        }
        // on redirige vers la page d'accès à la liste des scenes
        header("Location: /Festiplan/FestiplanWeb/?controller=AccesListeScene&id_festival=" . $id_festival . "&nom_festival=" . $nom_festival);
    }
}