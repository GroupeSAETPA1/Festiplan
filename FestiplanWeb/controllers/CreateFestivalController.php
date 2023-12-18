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

    public function __construct(CreateFestivalService $createFestivalService )
    {
        $this->createFestivalService = $createFestivalService;
        $this->categorieBD = $this -> createFestivalService->recupererCategorie();
        $this->spectacleBD = $this -> createFestivalService->recupererSpectacle();
        $this->sceneBD = $this -> createFestivalService->recupererTailleScene();
    }

    public function index(PDO $pdo): View{
        $view = new View("views/creation/createFestival");
        $view -> setVar('tableauCategorie' , $this->categorieBD);
        return $view;
    }

    public function validerPage1()
    {   
        $tousOk = $this->nomOk(HttpHelper::getParam("nom"))
                  && $this-> descriptionOk(HttpHelper::getParam("description"))
                  && $this-> categorieOk(HttpHelper::getParam("categorie"))
                  && $this-> dateOk(HttpHelper::getParam("ddd"), HttpHelper::getParam("ddf"))
                  && $this-> photoOk(HttpHelper::getParam("nom"));
       //var_dump($tousOk);
       $tousOk = true;
       if($tousOk) {
           $view = new View("views/creation/createFestival2");
       } else {
           $view = new View("views/creation/createFestival");
           $view -> setVar('tableauCategorie' , $this->categorieBD);
       }
       return $view;
    }

    public  function validerPage2 () {
        //echo "valider page 2" ;
        //$view = new View("views/creation/createFestival2");
        $tousOk = true ;
        if ($tousOk) {
            $view = new View("/views/creation/CreateFestival3");
            $view -> setVar('tableauSpectacle' , $this->spectacleBD);
            $view -> setVar('tableauScene' , $this->sceneBD);
        } else {
            $view = new View("/views/creation/CreateFestival2");
        }
        return $view;
    }

    public function nomOk($aVerifier)
    {
        return $aVerifier != '' and strlen($aVerifier) <= longueur_nom_festival;
    }

    public function descriptionOk($description)
    {
        return $description  != '' and strlen($description) <= longueur_max_description ;
    }

    public function dateOk(mixed $ddd, mixed $ddf)
    {
        $debut = DateTime::createFromFormat('Y-m-d' , $ddd);
        $fin = DateTime::createFromFormat('Y-m-d' , $ddf);
        return $debut <= $fin ;
    }

    public function categorieOk($categorie) {
        foreach ($this -> categorieBD as $categorieValide) {
            if ($categorieValide['nom'] == $categorie) {
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
            var_dump($nouveau_nom);
            if (move_uploaded_file($_FILES['imageFestival']['tmp_name'] , $dossier."/".$nouveau_nom)) { 
                return true ; 
            } else { 
                return false; 
            }
        // photo non ajouté
        } else {
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
