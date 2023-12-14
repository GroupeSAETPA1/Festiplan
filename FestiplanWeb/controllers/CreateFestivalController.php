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
        //$this->photo();
        //var_dump($_POST);
        $tousOk = //$this->nomOk(HttpHelper::getParam("nom"))
                  //&& $this->descriptionOk(HttpHelper::getParam("description"));
                  //&& 
                  $this->dateOk(HttpHelper::getParam("ddd"), HttpHelper::getParam("ddf"));
        //$this->photo();
       // return $tousOk;
       if($tousOk) {
           $view = new View("views/creation/createFestival2");
       } else {
           $view = new View("views/creation/createFestival");
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
        $debut = DateTime::createFromFormat('d/m/Y' , $ddd);
        $fin = DateTime::createFromFormat('/d/m/Y' , $ddf);
        var_dump($debut);
        var_dump($fin);
        return $debut < $fin ;
    }

    public function photo() {
        //var_dump($_FILES);
        $file = $_FILES['fileInput'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        var_dump($fileName);
        var_dump($fileTmpName);
        //var_dump(file_get_contents($fileTmpName));
    }
}
