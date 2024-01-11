<?php

namespace controllers;

use PDO;
use services\SupressionSpectacleService;
use yasmf\HttpHelper;
use yasmf\View;

class SupressionSpectacleController
{

    private SupressionSpectacleService $supressionSpectacleService;

    public function __construct(SupressionSpectacleService $supressionSpectacleService)
    {
        $this->SupressionSpectacleService = $supressionSpectacleService;
    }

    public function index(): View
    {
        $id_spectacle_actif = HttpHelper::getParam("id-spectacle") ?? null;
        if ($id_spectacle_actif == null) {
            echo "Erreur : id_specatcle_actif est null index()";
        }
        return $this->construireVue($id_spectacle_actif);
    }

    public function construireVue(int $id_spectacle_actif): View
    {

        $_SESSION["id_spectacle_a_supprimer"] = $id_spectacle_actif;
        $spectacle = $this->SupressionSpectacleService->recupSpectacle($id_spectacle_actif);

        $view = new View("views/supression/supressionSpectacle");
        $view->setVar("spectacle", $spectacle);


        return $view;
    }

    public function suprimmer(Pdo $pdo)
    {
        $this->SupressionSpectacleService->supression($_SESSION['id_spectacle_a_supprimer']);

        header('Location: /Festiplan/FestiplanWeb/?controller=Dashboard');
    }
}