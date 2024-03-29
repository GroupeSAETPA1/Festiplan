<?php

namespace controllers;

use services\AjouterListesSpectaclesServices;
use services\createFestivalService;
use services\CreateSpectacleService;
use services\UserService;
use yasmf\HttpHelper;
use yasmf\View;

class AjouterListesSpectaclesController
{

    private AjouterListesSpectaclesServices $ajouterListesSpectaclesServices;


    public function __construct(AjouterListesSpectaclesServices $ajouterLIstesSpectaclesServices,CreateSpectacleService $createSpectacleService)
    {
        $this->ajouterListesSpectaclesServices = $ajouterLIstesSpectaclesServices;
    }

    public function index(): View
    {
        $id_gestionnaire = $_SESSION['id_utilisateur'] ?? null;
        $id_festival_actif = HttpHelper::getParam("id_festival") ?? null;
        $nom_festival = HttpHelper::getParam("nom_festival") ?? null;
        $_SESSION['ajouterListesSpectacles'] = [
            "id_festival" => $id_festival_actif,
            "nom_festival" => $nom_festival
        ];

        if ($id_gestionnaire == null || $id_festival_actif == null) {
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }

        return $this->construireVue($id_festival_actif, $nom_festival);
    }

    /**
     * Cette fonction construit une vue pour la page d'ajout de spectacle du festival.
     *
     * @param int $id_festival_actif L'id du festival actif.
     * @param string $nom_festival Le nom du festival.
     * @return View La vue construite avec les variables définies.
     */
    public function construireVue(int $id_festival_actif, string $nom_festival): View
    {
        //Tous les spectacles qui ne sont pas déjà dans le festival
        $lesSpectaclesDisponible = $this->ajouterListesSpectaclesServices->getSpectaclesDisponible($id_festival_actif);
        //Tous les spectacles qui sont sélectionnés pour un futur ajout
        $lesSpectaclesSelectionne = $this->ajouterListesSpectaclesServices->getSpectaclesTemporaire();
        //Toutes les scenes du festival
        $sceneFestival = $this->ajouterListesSpectaclesServices->getScene($id_festival_actif);

        foreach ($lesSpectaclesDisponible as &$spectacleDispo) {
            foreach ($lesSpectaclesSelectionne as $spectacleSelection) {
                // on remplace l'id de la taille par le nom de la taille
                if ($spectacleDispo['id_spectacle'] == $spectacleSelection['id_spectacle']) {
                    //Si le spectacle est sélectionné, l'action sera de le retirer (l'action par défaut est d'ajouter)
                    $spectacleDispo["action"] = "retirerSpectacle";
                    $spectacleDispo['nom_scene'] = $spectacleSelection['nom_scene'];
                    $spectacleDispo['id_scene'] = $spectacleSelection['id_scene'];
                }
            }
        }
        unset($spectacleDispo); //On retire le pointeur créé avec `&$spectacleDispo`.

        $view = new View("views/ajouterListesSpectacles");

        $view->setVar("id_festival", $id_festival_actif);
        $view->setVar("nom_festival", $nom_festival);
        $view->setVar("spectaclesDisponible", $lesSpectaclesDisponible);
        $view->setVar("sceneFestival", $sceneFestival);

        return $view;
    }

    public function ajouterSpectacle(): View
    {
        $id_festival = $_SESSION['ajouterListesSpectacles']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesSpectacles']['nom_festival'] ?? null;
        $scene = HttpHelper::getParam("id_scene") ?? null;
        $id_spectacle = HttpHelper::getParam("id_spectacle") ?? null;

        if ($id_festival == null || $id_spectacle == null || $scene == null) {
            echo "Erreur : id_festival ou id_spectacle ou scene est null ajouterSpectacle()";
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }
        try {
            $this->ajouterListesSpectaclesServices->ajouterSpectacle($id_festival, $id_spectacle, $scene);
        } catch (\PDOException $e) {
            /** L'erreur peut apparaitre si on a déjà ajouté ce spectacle,
             * mais s'il existe déjà, il n'y a rien de plus à faire *
             */
        }

        return $this->construireVue($id_festival, $nom_festival);
    }

    public function retirerSpectacle(): View
    {
        $id_festival = $_SESSION['ajouterListesSpectacles']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesSpectacles']['nom_festival'] ?? null;
        $scene = HttpHelper::getParam("id_scene") ?? null;
        $id_spectacle = HttpHelper::getParam("id_spectacle") ?? null;

        if ($id_festival == null || $id_spectacle == null || $scene == null) {
            echo "Erreur : id_festival ou id_spectacle est null retirerSpectacle()";
            header("Location: /Festiplan/FestiplanWeb/");
            exit();
        }
        $this->ajouterListesSpectaclesServices->retirerSpectacle($id_festival, $id_spectacle, $scene);


        return $this->construireVue($id_festival, $nom_festival);
    }

    public function validerSpectaclesSelectionne(): void
    {
        $id_festival = $_SESSION['ajouterListesSpectacles']['id_festival'] ?? null;
        $nom_festival = $_SESSION['ajouterListesSpectacles']['nom_festival'] ?? null;
        //TODO enregistrer les spectacle ajouté dans `liste_spectacle`
        //TODO Rediriger vers la page AccesListeSpectacle
        $tab_spectacle_valider = $this->ajouterListesSpectaclesServices->getSpectaclesTemporaire();
        $this->ajouterListesSpectaclesServices->viderTableTemporaire($id_festival);

        foreach ($tab_spectacle_valider as $spectacle) {
            try {
                $this->ajouterListesSpectaclesServices->ajouterSpectacleAuFestival($id_festival, $spectacle['id_spectacle'], $spectacle['id_scene']);
            } catch (\PDOException $e) {
            }
        }

        header("Location: /Festiplan/FestiplanWeb/?controller=AccesListeSpectacles&action=index&id_festival=$id_festival");
        exit();
    }

    /**
     * Cette fonction permet de vérifier si le temps disponible est suffisant pour accueillir les spectacles
     * @param $id_festival_actif int L'id du festival actif
     * @return bool true si le temps est suffisant, false sinon
     */
    public function verifierTempsSuffisant(int $id_festival_actif): bool
    {
        $pause = $this->ajouterListesSpectaclesServices->getPause($id_festival_actif);
        //$duree_journee = (strtotime($fin) - strtotime($debut))/60;
        $duree_journee = $this->ajouterListesSpectaclesServices->getDureeJournee($id_festival_actif);

        $dureeDisponible = $this->ajouterListesSpectaclesServices->getDureeDisponibleFestival($id_festival_actif);
        //echo 'duree jour'.$duree_journee;
        //$debut_festival = strtotime($_SESSION['ddd']);
        //$fin_festival = strtotime($_SESSION['ddf']);

        //$dureeDisponible = ($fin_festival - $debut_festival)/60;
        if ($dureeDisponible == 0) $dureeDisponible = $duree_journee;

        //echo 'dureDispo'.$dureeDisponible;
        $duree_totale_spectacle  = $this->calculerDureeTotaleSpectacle($pause, $id_festival_actif);

        $nombre_jours_necessaires = ceil($duree_totale_spectacle /($duree_journee));
        //echo '<br>jour necessaire'.$nombre_jours_necessaires;
        if ($nombre_jours_necessaires > (($dureeDisponible) / $duree_journee)) {
            //echo 'non';
            return false; // Nombre de jours insuffisants pour accueillir les spectacles
        } else {
            //echo 'oui';
            return true; // Assez de jours pour les spectacles
        }
    }

    public function calculerDureeTotaleSpectacle($pause, int $id_festival_actif): int
    {
        $result = $this->ajouterListesSpectaclesServices->dureesSpectacles($id_festival_actif);
        $result +=  (count($_SESSION['spectacle']) - 1) * strtotime($pause);
        //echo 'durée totale'.$result ;
        return $result ;
    }
}