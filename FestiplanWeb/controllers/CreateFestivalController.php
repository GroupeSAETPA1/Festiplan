<?php
namespace controllers;

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
    public function __construct(CreateFestivalService $createFestivalService )
    {
        $this->createFestivalService = $createFestivalService;
    }

    public function index(PDO $pdo): View{
        $view = new View("views/creation/createFestival");
        return $view;
    }

    public function validerCreationFestival()
    {
        $this->photo();
        $tousOk = $this->nomOk(HttpHelper::getParam("nom"))
                  && $this-> descriptionOk(HttpHelper::getParam("description"));
                  && $this-> dateOk(HttpHelper::getParam("ddd"), HttpHelper::getParam("ddf"))
                  && $this-> photoOk(HttpHelper::getParam("nom"));
        //$this->photo();
       // return $tousOk;
       //if($tousOk) {
       //    $view = new View("views/creation/createFestival2");
       //} else {
           $view = new View("views/creation/createFestival");
       //}
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

    public function photoOk($nomFestival) {
        //photo ajoute
        if (isset($_FILES['imageFestival'])) {
            $dossier = $_SERVER[ 'DOCUMENT_ROOT' ] . PREFIX_TO_RELATIVE_PATH . '/datas/img';
            var_dump($fichier);
            $nouveau_nom = $nomFestival."_image".time().$extension;
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
}
