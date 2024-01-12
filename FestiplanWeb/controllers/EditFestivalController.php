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

const  longueur_nom_festival = 150 ;

const longueur_max_description = 1000 ;
class EditFestivalController
{
    private EditFestivalService $EditFestivalService;

    public function __construct(EditFestivalService $editFestivalService)
    {
        $this->editFestivalService = $editFestivalService;
        $this->categorieBD = $this->editFestivalService ->recupererCategorie();
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

    public function editerFestival() {
        var_dump($_POST);
        $nomOk = $this -> nomOk(HttpHelper::getParam('nom'));
        $decriptionOk = $this -> descriptionOk(HttpHelper::getParam('description'));
        $categorieOk = $this -> categorieOk(HttpHelper::getParam('categorie'));
        $dateOk = $this -> dateOK(HttpHelper::getParam('ddd') , HttpHelper::getParam('ddf'));
        $grijOk = $this -> grijOk(HttpHelper::getParam('heure_debut_spectacle') ,
            HttpHelper::getParam('heure_fin_spectacle') ,
            HttpHelper::getParam("duree_entre_spectacle"));
        $illustrationOk = $this -> photoOk(HttpHelper::getParam('illustration'));
        //echo 'grij : ';
        var_dump($illustrationOk);
        die();
    }

    public function nomOk($nom) {
        return $nom != "" and strlen($nom) <= longueur_nom_festival;
    }

    public function descriptionOk($description) {
        return $description != "" and strlen($description) <= longueur_max_description;
    }

    public function categorieOk($categorie) {
        foreach ($this -> categorieBD as $categorieValide) {
            if ($categorieValide['id_categorie'] == $categorie) {
                return true ;
            }
        }
        return false;
    }

    public function dateOk(mixed $ddd, mixed $ddf)
    {
        var_dump($ddd);
        $debut = DateTime::createFromFormat('Y-m-d' , $ddd);
        $fin = DateTime::createFromFormat('Y-m-d' , $ddf);
        return $debut <= $fin ;
    }

    public function grijOk($debut , $fin , $pause) {

        $heure_min = strtotime("00:00:00");
        $heure_max = strtotime("23:59:59");
        return preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/', $debut)
            && preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/', $fin)
            && strtotime($debut) >= $heure_min && strtotime($debut) <= $heure_max
            && strtotime($fin) >= $heure_min && strtotime($fin) <= $heure_max
            && strtotime($debut) < strtotime($fin) && $pause >= 0 ;

    }

    public function photoOk($nomFestival) {
        //photo ajoute
        if (isset($_FILES['imageFestival']) && $_FILES['imageFestival']['name'] != '') {
            $dossier = $_SERVER[ 'DOCUMENT_ROOT' ] . PREFIX_TO_RELATIVE_PATH . '/datas/img';
            try {
                $extension = $this->recupererExtension($_FILES['imageFestival']['name']);
            } catch (Exception) {
                return false ;
            }
            $nouveau_nom = $nomFestival."_image".time().$extension;
            if (move_uploaded_file($_FILES['imageFestival']['tmp_name'] , $dossier."/".$nouveau_nom)) {
                $_SESSION['photoFestival'] = $nouveau_nom;
                return true ;
            } else {
                return false;
            }
            // photo non ajouté
        } else {
            $_SESSION['photoFestival'] = 'null' ;
            return true ;
        }
    }

    public function recupererExtension($nomFichier) {
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

