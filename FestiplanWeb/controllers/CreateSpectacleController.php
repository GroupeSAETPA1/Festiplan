<?php

namespace controllers;

use Exception;
use PDO;
use services\createFestivalService;
use services\CreateSpectacleService;
use services\UserService;
use yasmf\HttpHelper;
use yasmf\View;

const  longueur_nom_spectacle = 150 ;

const longueur_max_description = 1000 ;

class CreateSpectacleController
{
    private CreateSpectacleService $createSpectacleService;
    private CreateFestivalService $createFestivalService;
    private UserService $userService;
    private PDO $pdo;
    private array $categorieBD;
    private array $tailleSceneBD;

    public function __construct(CreateSpectacleService $createSpectacleService, UserService $userService, CreateFestivalService $createFestivalService, PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createFestivalService = $createFestivalService;
        $this->createSpectacleService = $createSpectacleService;
        $this->categorieBD = $this -> createSpectacleService->recupererCategorie();
        $this->tailleSceneBD = $this -> createSpectacleService->recupererTailleScene();
        $this->userService = $userService;
    }

    public function index(PDO $pdo): View{
        $view = new View("views/creationSpectacle/createSpectacle1");
        $view -> setVar('tableauCategorie' , $this->categorieBD);
        $view -> setVar('tableauTailleScene' , $this->tailleSceneBD);
        $this->reAfficherElementsPage1($view);
        return $view;
    }

    /**
     * verifie si l'utilisateur existe par son email
     * renvoie une vue qui echo true ou false
     */
    public function checkUserByEmail(): View
    {
        $email = htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $result = $this->userService->emailExiste($this->pdo, $email);
        $view = new View("views/creationSpectacle/checkUserByEmail");
        $view->setVar("result", $result);
        return $view;
    }

    private function reAfficherElementsPage1(View $view): void
    {
        $view->setVar('nomSpectacle', HttpHelper::getParam("nom") ?: "");
        $view->setVar('descriptionSpectacle', HttpHelper::getParam("description") ?: "");
        $view->setVar('dureeSpectacle', HttpHelper::getParam("duree") ?: "");
        $view->setVar('tailleSceneSpectacle', HttpHelper::getParam("taille") ?: "");
        $view->setVar('categorieSpectacle', HttpHelper::getParam("categorie") ?: "");
    }

    public function validerPage1(): View
    {
        $tousOk = $this->nomOk(HttpHelper::getParam("nom"))
            && $this-> descriptionOk(HttpHelper::getParam("description"))
            && $this-> dureeOk(HttpHelper::getParam("duree"))
            && $this-> tailleOk(HttpHelper::getParam("taille"))
            && $this-> categorieOk(HttpHelper::getParam("categorie"))
            && $this-> photoOk(HttpHelper::getParam("fileInput"));
        if($tousOk) {
            // on écrit les données dans la variable de session
            $_SESSION['nomSpectacle'] = HttpHelper::getParam("nom");
            $_SESSION['descriptionSpectacle'] = HttpHelper::getParam("description");
            $_SESSION['dureeSpectacle'] = HttpHelper::getParam("duree");
            $_SESSION['tailleSceneSpectacle'] = HttpHelper::getParam("taille");
            $_SESSION['categorieSpectacle'] = HttpHelper::getParam("categorie");
            $_SESSION['photoSpectacle'] = HttpHelper::getParam("fileInput");
            $view = new View("views/creationSpectacle/createSpectacle2");
        } else {
            $view = new View("views/creationSpectacle/createSpectacle1");
            $view -> setVar('tableauCategorie' , $this->categorieBD);
            $view -> setVar('tableauTailleScene' , $this->tailleSceneBD);
            $this->reAfficherElementsPage1($view);
        }
        return $view;
    }

    public function validerPage2(): View
    {
        if (isset($_POST['inter'])) {
            $inter = $_POST['inter'];
        } else {
            $inter = array();
        }
        if (isset($_POST['interHorsScene'])) {
            $interHorsScene = $_POST['interHorsScene'];
        } else {
            $interHorsScene = array();
        }

        $tousOk = true; // STUB
        if ($tousOk) {
            // on ajoute dans la bd le spectacle
            $this->createSpectacleService->ajouterSpectacle($this->pdo, $_SESSION['nomSpectacle'], $_SESSION['descriptionSpectacle'],
                                                                                       $_SESSION['dureeSpectacle'], $_SESSION['tailleSceneSpectacle'],
                                                                                       $_SESSION['categorieSpectacle'], $_SESSION['photoSpectacle'],
                                                                                       $inter, $interHorsScene);
            $view = new View("views/dashboard");
        } else {
            $view = new View("views/creationSpectacle/createSpectacle2");
        }
        return $view;
    }


    private function nomOk($nom): bool
    {
        return $nom != "" && strlen($nom) <= longueur_nom_spectacle;
    }

    private function descriptionOk($description): bool
    {
        return $description != "" && strlen($description) <= longueur_max_description;
    }

    private function dureeOk($duree): bool
    {
        return $duree != "" && is_numeric($duree) && $duree >= 1 && $duree <= 1440;
    }

    private function tailleOk($taille): bool
    {
        return $taille != "" && is_numeric($taille) && $taille >= 1 && $taille <= 3;
    }

    private function categorieOk($categorie): bool
    {
        return $categorie != "vide";
    }

    private function photoOk($photo): bool
    {
        // TODO
        return true;
    }

    /**
     * @throws Exception
     */
    public function recupererExtension($nomFichier): string
    {
        $extensionsPossibles = array(
            strtoupper('.jpg') ,
            strtoupper('.jpeg') ,
            strtoupper('.gif') ,
            strtoupper('.png'));
        $extensionFichier = strtoupper(strrchr($nomFichier , '.'));
        if (in_array($extensionFichier , $extensionsPossibles)) {
            return $extensionFichier;
        } else {
            throw new Exception("Extension de fichier non valide");
        }
    }


}