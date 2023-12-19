<?php
namespace controllers;

use Couchbase\ViewException;
use PDO;
use services\CreateFestivalService;
use yasmf\HttpHelper;
use yasmf\View;
use DateTime;

/**
 * Default controller
 */
const  longueur_nom_festival = 150 ;

const longueur_max_description = 1000 ;
class CreateFestivalController {

    private CreateFestivalService $createFestivalService;
    private array $categorieBD ;
    private array $spectacleBD;

    private array $sceneBD;

    public function __construct(CreateFestivalService $createFestivalService )
    {
        session_start();
        $this->createFestivalService = $createFestivalService;
        $this->categorieBD = $this -> createFestivalService->recupererCategorie();
        $this->spectacleBD = $this -> createFestivalService->recupererSpectacle();
        $this->sceneBD = $this -> createFestivalService->recupererTailleScene();
    }

    public function index(PDO $pdo): View{
        //$this -> connectionOk();
        $view = new View("views/creation/createFestival");
        $view -> setVar('tableauCategorie' , $this->categorieBD);
        $this->reAfficherElementPage1($view);
        return $view;
    }

    public function validerPage1()
    {
        $this->connectionOk();
        $nomOk = $this->nomOk(HttpHelper::getParam("nom"));
        $descriptionOk = $this-> descriptionOk(HttpHelper::getParam("description"));
        $dateOk =  $this-> dateOk(HttpHelper::getParam("ddd"), HttpHelper::getParam("ddf"));
        $categorieOk =  $this-> categorieOk(HttpHelper::getParam("categorie"));
        $photoOk =  !$this-> photoOk(HttpHelper::getParam("nom"));
        $tousOk = $nomOk && $descriptionOk && $dateOk && $categorieOk && !$photoOk ;

       if($tousOk) {
           $_SESSION['nomFestival'] = HttpHelper::getParam('nom');
           $_SESSION['descriptionFestival'] = HttpHelper::getParam('description');
           $_SESSION['ddd'] = HttpHelper::getParam('ddd');
           $_SESSION['ddf'] = HttpHelper::getParam('ddf');
           $_SESSION['photoFestival'] = $this->photoOk(HttpHelper::getParam("nom"));
           $_SESSION['categorie'] = HttpHelper::getParam('categorie');
           $view = new View("views/creation/createFestival2");
       } else {
           $view = new View("views/creation/createFestival");
           $view -> setVar('tableauCategorie' , $this->categorieBD);
           $this -> reAfficherElementPage1($view);
       }
       return $view;
    }

    public  function validerPage2 () {
        $this->connectionOk();
        //echo "valider page 2" ;
        //$view = new View("views/creation/createFestival2");
        $tousOk = false ; // STUB
        if ($tousOk) {
            $view = new View("/views/creation/CreateFestival3");
            $view -> setVar('tableauSpectacle' , $this->spectacleBD);
            $view -> setVar('tableauScene' , $this->sceneBD);
        } else {
            $view = new View("/views/creation/CreateFestival2");
        }
        return $view;
    }

    public function validerPage3 () {
        //$this->connectionOk();
        //$tousOk = false ; //STUB
        $tousOk =  $this->spectacleOk(HttpHelper::getParam("spectacle"))
                   && $this->sceneOK(HttpHelper::getParam("scene"));


        if ($tousOk) {

            header("Location: /Festiplan/FestiplanWeb/?controller=Dashboard");
            exit();
        } else {
            $view = new View("/views/creation/CreateFestival3");
            $view -> setVar('tableauSpectacle' , $this->spectacleBD);
            $view -> setVar('tableauScene' , $this->sceneBD);
        }
        return $view ;
    }
    public function nomOk($aVerifier)
    {
        $_SESSION['nomFestival'] = htmlspecialchars($aVerifier);
        return $aVerifier != '' and strlen($aVerifier) <= longueur_nom_festival;
    }

    public function descriptionOk($description)
    {
        $_SESSION['descriptionFestival'] = $description;
        return $description  != '' and strlen($description) <= longueur_max_description ;
    }

    public function dateOk(mixed $ddd, mixed $ddf)
    {
        $debut = DateTime::createFromFormat('Y-m-d' , $ddd);
        $fin = DateTime::createFromFormat('Y-m-d' , $ddf);
        $_SESSION['ddd'] = htmlspecialchars($ddd);
        $_SESSION['ddf'] = htmlspecialchars($ddf);
        return $debut <= $fin ;
    }

    public function categorieOk($categorie) {
        $_SESSION['categorie'] = $categorie;
        foreach ($this -> categorieBD as $categorieValide) {
            if ($categorieValide['id_categorie'] == $categorie) {
                return true ; 
            }
        }         
        return false;
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

    public  function spectacleOk($tableauSpectacle) {
        $tableauSpectacle = array($tableauSpectacle);
        $tab = $this->assoc_to_table($this -> spectacleBD , 'id_spectacle');
        foreach ($tableauSpectacle as $spectacle) {
            if (! in_array($spectacle , $tab)) {
                return false ;
            }
        }
        return true ;
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

    function assoc_to_table(array $tab, string $cle) : array
    {
        $reponse = array();
        foreach ($tab as $ligne) {
            $reponse[] = $ligne[$cle];
        }
        return $reponse;
    }

    function sceneOk($scene) {
        $tab_scene = array($scene);
        $tab_scene_bd = $this->assoc_to_table($this->sceneBD , 'id_taille');
        foreach ($tab_scene as $ligne) {
            if (! in_array($ligne , $tab_scene_bd)) {
                return false ;
            }
        }
        return true ;
    }

    /**
     * @return array
     */
    public function connectionOk(): void
    {
        if ($_SESSION['id_utilisateur'] == null) {
            header('Location: /Festiplan/FestiplanWeb/');
            exit();
        }
    }

    public function reAfficherElementPage1($view) : void
    {
        $view->setVar('nomFestival', $_SESSION['nomFestival'] ?: "");
        $view->setVar('descriptionFestival', $_SESSION['descriptionFestival'] ?: "");
        $view->setVar('ddd', $_SESSION['ddd'] ?: "");
        $view->setVar('ddf', $_SESSION['ddf'] ?: "");
        $view->setVar('photo', $_SESSION['photoFestival'] ?: "");
        $view->setVar('categorie', $_SESSION['categorie'] ?: "");
    }
}

