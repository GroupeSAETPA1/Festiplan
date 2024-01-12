<?php

namespace controllers;

use services\AccesListeSpectaclesService;
use yasmf\HttpHelper;
use yasmf\View;

class AccesListeSpectaclesController
{

    private ?AccesListeSpectaclesService $accesListeSpectaclesService = null;

    public function __construct(AccesListeSpectaclesService $accesListeSpectaclesService)
    {
        $this->accesListeSpectaclesService = $accesListeSpectaclesService;
    }

    function index(): View
    {
        $id_festival_actif = $this->verifierConnecte();
        return $this->construireVue($id_festival_actif);
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

    /**
     * @param string|null $id_festival_actif
     * @return View
     */
    public function construireVue(?string $id_festival_actif): View
    {
        $spectacles = $this->accesListeSpectaclesService->getSpectacles($id_festival_actif);
        $info_festival = $this->accesListeSpectaclesService->getInfoFestival($id_festival_actif);

        $nom_festival = $info_festival['nom'];
        $categorie = $info_festival['categorie'];

        $view = new View("views/accesListeSpectacles");

        $view->setVar("spectacles", $spectacles);
        $view->setVar("id_festival", $id_festival_actif);
        $view->setVar("nom_festival", $nom_festival);
        $view->setVar("categorie", $categorie);


        return $view;
    }

    public function retirerSpectacle(): View
    {
        echo "retirerSpectacle";
        $id_festival_actif = $this->verifierConnecte();

        $id_spectacle = HttpHelper::getParam("id_spectacle") ?? null;
        $id_scene = HttpHelper::getParam("id_scene") ?? null;

        $this->accesListeSpectaclesService->retirerSpectacle($id_spectacle, $id_festival_actif, $id_scene);

        return $this->construireVue($id_festival_actif);
    }
}