<?php
namespace controllers;

use Couchbase\ViewException;
use PDO;
use services\CreateFestivalService;
use services\UserService;
use yasmf\HttpHelper;
use yasmf\View;
use DateTime;
use function PHPUnit\Framework\isEmpty;

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
        $this->createFestivalService = $createFestivalService;
        $this->categorieBD = $this -> createFestivalService->recupererCategorie();
        $this->spectacleBD = $this -> createFestivalService->recupererSpectacle();
        $this->sceneBD = $this -> createFestivalService->recupererTailleScene();
    }

    public function index(PDO $pdo): View{
        $this -> connectionOk();
        $view = new View("views/creationFestival/createFestival");
        $view -> setVar('nomOk' , false);
        $view -> setVar('dateOk' , false);
        $view -> setVar('descriptionOk' , false);
        $view ->setVar('categorieOk' , false);
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
        $photoOk =  $this-> photoOk(HttpHelper::getParam("nom"));
        $tousOk = $nomOk && $descriptionOk && $dateOk && $categorieOk && $photoOk ;

       if($tousOk) {
           $_SESSION['nomFestival'] = HttpHelper::getParam('nom');
           $_SESSION['descriptionFestival'] = HttpHelper::getParam('description');
           $_SESSION['ddd'] = HttpHelper::getParam('ddd');
           $_SESSION['ddf'] = HttpHelper::getParam('ddf');
           $_SESSION['categorie'] = HttpHelper::getParam('categorie');
           $view = new View("views/creationFestival/createFestival3");
           $view -> setVar('tableauSpectacle' , $this->spectacleBD);
           $view -> setVar('tableauScene' , $this->sceneBD);
       } else {
           $view = new View("views/creationFestival/createFestival");
           $view -> setVar('tableauCategorie' , $this->categorieBD);
           $view -> setVar('nomOk' , $nomOk);
           $view -> setVar('dateOk' , $dateOk);
           $view -> setVar('descriptionOk' , $descriptionOk);
           $view -> setVar('categorieOk' , $categorieOk);
           $this -> reAfficherElementPage1($view);
       }
       return $view;
    }

    public function page1() {
        $view = new View("views/creationFestival/createFestival");
        $view -> setVar('nomOk' , true);
        $view -> setVar('dateOk' , true);
        $view -> setVar('descriptionOk' , true);
        $view ->setVar('categorieOk' , true);
        $view -> setVar('tableauCategorie' , $this->categorieBD);
        $this -> reAfficherElementPage1($view);
        $view -> setVar('tableauCategorie' , $this->categorieBD);
        return $view;
    }


    public function page2() {
        $view = new View("views/creationFestival/createFestival3");
        $view -> setVar('tableauSpectacle' , $this->spectacleBD);
        $view -> setVar('tableauScene' , $this->sceneBD);
        return $view;
    }
    public  function validerPage2 () {
        $this->connectionOk();
        $tousOk =  $this->organisateurOk()  && $this->sceneOk() ; ;
        if ($tousOk) {
            $view = new View("/views/creationFestival/createFestival2");

        } else {
            $view = new View("/views/creationFestival/createFestival3");
            $view -> setVar('tableauScene' , $this->sceneBD);
        }
        return $view;
    }

    public function validerPage3 () {
        $this->connectionOk();
        $champOk = $this->champsValides(HttpHelper::getParam('HDS') , HttpHelper::getParam('HFS'), HttpHelper::getParam('TPS'));
        if($champOk) {
            $tableauIdScene = $this -> createFestivalService -> recupererIdScene($_SESSION['scene']);
            $tableauIdOrga = $this -> createFestivalService -> recupererIdOrga($_SESSION['organisateur']);
            $this -> createFestivalService -> insertionFestival(
                $_SESSION['nomFestival'] ,
                $_SESSION['descriptionFestival'] ,
                $_SESSION['photoFestival'] ,
                $_SESSION['ddd'] ,
                $_SESSION['ddf'] ,
                $_SESSION['categorie'] ,
                $_SESSION['id_utilisateur'] ,
                htmlspecialchars(HttpHelper::getParam('TPS') ),
                htmlspecialchars(HttpHelper::getParam('HDS')) ,
                htmlspecialchars(HttpHelper::getParam('HFS')),
                $tableauIdOrga ,
                $tableauIdScene);
            header("Location: index.php?controller=Dashboard");
            $_SESSION['nomFestival'] = '' ;
                $_SESSION['descriptionFestival'] = '' ;
                $_SESSION['photoFestival'] = '' ;
                $_SESSION['ddd']  = '' ;
                $_SESSION['ddf'] = '' ;
                $_SESSION['categorie'] = '' ;
            exit();

        } else {
            $view = new View("/views/creationFestival/CreateFestival2");
        }
        return $view ;
    }
    public function nomOk($aVerifier)
    {
        $_SESSION['nomFestival'] = htmlspecialchars($aVerifier);
        return !ctype_space($aVerifier) and strlen($aVerifier) <= longueur_nom_festival && $aVerifier != "";
    }

    public function descriptionOk($description)
    {
        $_SESSION['descriptionFestival'] = $description;
        return !ctype_space($description) and strlen($description) <= longueur_max_description && $description != "" ;
    }

    public function dateOk(mixed $ddd, mixed $ddf)
    {

        if (!empty($ddd) && !empty($ddf)) {
            $debut = DateTime::createFromFormat('Y-m-d', $ddd);
            $fin = DateTime::createFromFormat('Y-m-d', $ddf);
            $_SESSION['ddd'] = htmlspecialchars($ddd);
            $_SESSION['ddf'] = htmlspecialchars($ddf);
            return $debut <= $fin;
        } else {
            return false;
        }
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
            list($width, $height) = getimagesize($_FILES['imageFestival']['tmp_name']);

            // Check if the image dimensions are 800x600
            if ($width > 800 || $height > 600) {
                return false;
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

    function assoc_to_table(array $tab, string $cle) : array
    {
        $reponse = array();
        foreach ($tab as $ligne) {
            $reponse[] = $ligne[$cle];
        }
        return $reponse;
    }

    function sceneOk() {
        if (!isset($_GET['scene'])) {
            return false ;
        }
        $scene = array();
        foreach($_GET['scene'] as $ligne) {
            if($this->createFestivalService->sceneExiste($ligne)) {
                $scene[] = $ligne;
            } else {
                return false ;
            }
        }
        $_SESSION['scene'] = $scene;
        return true;
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
        //ar_dump($_SESSION['nomFestival'] ?? "");
        $view->setVar('nomFestival', $_SESSION['nomFestival'] ?? "");
        $view->setVar('descriptionFestival', $_SESSION['descriptionFestival'] ?? "");
        $view->setVar('ddd', $_SESSION['ddd'] ?? "");
        $view->setVar('ddf', $_SESSION['ddf'] ?? "");
        $view->setVar('photo', $_SESSION['photoFestival'] ?? "");
        $view->setVar('categorie', $_SESSION['categorie'] ?? "");
    }

    public function checkUserByEmail() {
        $email = htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $result = $this->createFestivalService->emailExiste($email);
        $view = new View("views/creationFestival/checkUserByEmail");
        $view->setVar("result", $result);
        return $view;
    }

    public function verifierScene() {
        $scene = htmlspecialchars(HttpHelper::getParam('scene') ?: "");
        $result = $this->createFestivalService-> sceneExiste($scene);
        $view = new View("/views/creationFestival/sceneExistante");
        $view->setVar("result" , $result);
        return $view;
    }

    public function verifierSpectacle() {
        $spectacle = htmlspecialchars(HttpHelper::getParam('spectacle') ?: "");
        $result = $this->createFestivalService -> spectacleExiste($spectacle);
        $view = new View("/views/creationFestival/spectacleExiste");
        $view-> setVar("result" , $result);
        return $view;
    }

    public function champsValides($debut , $fin , $pause) {

        $heure_min = strtotime("00:00");
        $heure_max = strtotime("23:59");
        return preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $debut) 
        && preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $fin)
        && strtotime($debut) >= $heure_min && strtotime($debut) <= $heure_max
        && strtotime($fin) >= $heure_min && strtotime($fin) <= $heure_max
        && strtotime($debut) < strtotime($fin) && $pause >= 0 ;

    }


    public function organisateurOk()
    {
        if (!isset($_GET['organisateur'])) {
            return false ;
        }
        $organisateur = array();
        foreach($_GET['organisateur'] as $ligne) {
            if($this->createFestivalService->emailExiste($ligne)) {
                $organisateur[] = $ligne;
            } else {
                return false ;
            }
        }
        $_SESSION['organisateur'] = $organisateur;
        return true;
    }

    public function viderChampPage1()
    {

        $view = new View("views/creationFestival/createFestival");
        $view -> setVar('tableauCategorie' , $this->categorieBD);
        $view ->setVar('nomFestival' , '');
        $view ->setVar('descriptionFestival' , '');
        $view ->setVar('ddd' , '');
        $view ->setVar('ddf' , '');
        $view -> setVar('nomOk' , false);
        $view -> setVar('dateOk' , false);
        $view -> setVar('descriptionOk' , false);
        $view ->setVar('categorieOk' , false);
        $_SESSION['categorie'] = '';
        return $view;
    }


}

