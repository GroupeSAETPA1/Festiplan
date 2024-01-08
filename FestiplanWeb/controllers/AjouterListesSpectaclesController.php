<?php

namespace controllers;

use services\AjouterListesSpectaclesServices;
use yasmf\HttpHelper;
use yasmf\View;

class AjouterListesSpectaclesController
{

    private AjouterListesSpectaclesServices $ajouterListesSpectaclesServices;

    public function __construct(AjouterListesSpectaclesServices $ajouterLIstesSpectaclesServices)
    {
        session_start();
        $this->ajouterListesSpectaclesServices = $ajouterLIstesSpectaclesServices;
    }

    public function index(): View
    {
//        var_dump($_SESSION);
        $id_gestionnaire = $_SESSION['id_utilisateur'] ?? null;
        $id_festival_actif = HttpHelper::getParam("id_festival") ?? null;
        $nom_festival = HttpHelper::getParam("nom_festival") ?? null;
        $_SESSION['ajouterListesSpectacles'] = [
            "id_festival" => $id_festival_actif,
            "nom_festival" => $nom_festival
        ];

        if ($id_gestionnaire == null || $id_festival_actif == null) {
            //header("Location: /Festiplan/FestiplanWeb/");
            //exit();
            if ($id_gestionnaire == null) echo "Erreur : id_gestionnaire est null index()";
            if ($id_festival_actif == null) echo "Erreur : id_festival_actif est null index()";
        }

        return $this->construireVue($id_festival_actif, $nom_festival);
    }

    /**
     * @param $id_festival_actif
     * @param $nom_festival
     * @return View
     */
    public function construireVue($id_festival_actif, $nom_festival): View
    {
        $spectacleDisponible = $this->ajouterListesSpectaclesServices->getSpectaclesDisponible($id_festival_actif);
        $spectacleSelectionne = $this->ajouterListesSpectaclesServices->getSpectaclesTemporaire();
        $sceneFestival = $this->ajouterListesSpectaclesServices->getScene($id_festival_actif);

        foreach ($spectacleDisponible as &$spectacle) {
            foreach ($spectacleSelectionne as $id) {
                if ($spectacle['id_spectacle'] == $id) {
                    $spectacle["action"] = "retirerSpectacle";
                }
            }
        }
        unset($spectacle);


        $view = new View("views/ajouterListesSpectacles");

        $view->setVar("id_festival", $id_festival_actif);
        $view->setVar("nom_festival", $nom_festival);
        $view->setVar("spectaclesDisponible", $spectacleDisponible);

        return $view;
    }

    public function ajouterSpectacle(): View
    {
        $id_festival = $_SESSION['ajouterListesSpectacles']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesSpectacles']['nom_festival'] ?? null;
        $id_spectacle = HttpHelper::getParam("id_spectacle") ?? null;

        if ($id_festival == null || $id_spectacle == null) {
            //header("Location: /Festiplan/FestiplanWeb/");
            //exit();
            echo "Erreur : id_festival ou id_spectacle est null ajouterSpectacle()";
        }
        try {
            $this->ajouterListesSpectaclesServices->ajouterSpectacle($id_festival, $id_spectacle);
        } catch (\PDOException $e) {
        }

        return $this->construireVue($id_festival, $nom_festival);
    }

    public function retirerSpectacle(): View
    {
        $id_festival = $_SESSION['ajouterListesSpectacles']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesSpectacles']['nom_festival'] ?? null;
        $id_spectacle = HttpHelper::getParam("id_spectacle") ?? null;

        if ($id_festival == null || $id_spectacle == null) {
            //header("Location: /Festiplan/FestiplanWeb/");
            //exit();
            echo "Erreur : id_festival ou id_spectacle est null retirerSpectacle()";
        }
        $this->ajouterListesSpectaclesServices->retirerSpectacle($id_festival, $id_spectacle);


        return $this->construireVue($id_festival, $nom_festival);
    }

    public function validerSpectaclesSelectionne() : View
    {
        $id_festival = $_SESSION['ajouterListesSpectacles']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesSpectacles']['nom_festival'] ?? null;
        //TODO enregistrer les spectacle ajouté dans `liste_spectacle`
        //TODO Rediriger vers la page AccesListeSpectacle
        $tab_spectacle_valider = $this->ajouterListesSpectaclesServices->getSpectaclesTemporaire();
        var_dump($tab_spectacle_valider);
        $this->ajouterListesSpectaclesServices->viderTableTemporaire();

        foreach ($tab_spectacle_valider as $item) {
            try {
                $this->ajouterListesSpectaclesServices->ajouterSpectacleAuFestival($id_festival, $item);
            } catch (\PDOException $e) {}
        }

        return $this->construireVue($id_festival, $nom_festival);
    }
}