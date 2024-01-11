<?php
namespace controllers;

use Couchbase\ViewException;
use PDO;
use services\CreateFestivalService;
use services\EditFestivalService;
use services\UserService;
use yasmf\HttpHelper;
use yasmf\View;
use DateTime;
class EditFestivalController
{
    private EditFestivalService $EditFestivalService;

    public function __construct(EditFestivalService $editFestivalService)
    {
        $this->editFestivalService = $editFestivalService;
    }

    public function index(PDO $pdo) {
        //var_dump($_POST);
        //die();
        $festival = $this -> editFestivalService -> recupererInfoFestival(HttpHelper::getParam('id_festival'));
        $view = new View("views/editionFestival/editionFestival");
        $this->preparerVue($view, $festival);
        $tableauCategorie = $this->editFestivalService->recupererCategorie();
        $view -> setVar('tableauCategorie' , $tableauCategorie);
        return $view;
    }

    public function preparerVue(View $view , $festival)
    {
        $festival = $festival[0];
        var_dump($festival['nom']);
        $view -> setVar('nomActuel' , $festival['nom']);
        $view -> setVar('descriptionFestival' , $festival['description']);
        $view -> setVar("debut" , $festival['debut']);
        $view -> setVar("fin" , $festival['fin']);
        $view -> setVar("image" , $_SESSION['illustration']);
        $view -> setVar("heure_debut_spectacle" , $festival['heure_debut_spectacles']);
        $view -> setVar("heure_fin_spectacle" , $festival['heure_fin_spectacles']);
        $view -> setVar("duree_entre_spectacle" , $festival['duree_entre_spectacle']);
        var_dump($view);
        $_SESSION['id_a_editer'] = $festival['id_festival'];
        $_SESSION['nom_editer'] = $festival['nom'];
        $_SESSION['description_editer'] = $festival['description'];
        $_SESSION['date_debut_editer'] = $festival['debut'];
        $_SESSION['date_fin_editer'] = $festival['fin'];
        $_SESSION['illustration_editer'] = $festival['illustration'];
        var_dump($_SESSION['illustration_editer']);
        $_SESSION['categorie_editer'] = $festival['id_categorie'];
        $_SESSION['heure_debut_spectacle_editer'] = $festival['heure_debut_spectacles'];
        $_SESSION['heure_fin_spectacle_editer'] = $festival['heure_fin_spectacles'];
        $_SESSION['duree_entre_spectacle'] = $festival['duree_entre_spectacle'];
    }
}