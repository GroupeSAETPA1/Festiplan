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
        $view = new View("views/createFestival.php");
        return $view;
    }

    public function tousChampsOK()
    {
        $tousOk = $this->nomOk($_POST['nom'])
                  && $this->descriptionOk($_POST['description'])
                  && $this->dateOk($_POST['ddd'], $_POST['ddf']);
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
        return $debut < $fin ;
    }
}
