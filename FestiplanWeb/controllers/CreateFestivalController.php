<?php
namespace controllers;

use Couchbase\ViewException;
use PDO;
use services\CreateFestivalService;
use services\UserService;
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
        $this->createFestivalService = $createFestivalService;
        $this->categorieBD = $this -> createFestivalService->recupererCategorie();
        $this->spectacleBD = $this -> createFestivalService->recupererSpectacle();
        $this->sceneBD = $this -> createFestivalService->recupererTailleScene();
    }

    public function index(PDO $pdo): View{
        //$this -> connectionOk();
        $view = new View("views/creationFestival/createFestival");
        $view = new View("views/creationFestival/createFestival");
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
           $_SESSION['photoFestival'] = $this->photoOk(HttpHelper::getParam("nom"));
           $_SESSION['categorie'] = HttpHelper::getParam('categorie');
           $view = new View("views/creationFestival/createFestival3");
           $view -> setVar('tableauSpectacle' , $this->spectacleBD);
           $view -> setVar('tableauScene' , $this->sceneBD);
       } else {
           $view = new View("views/creationFestival/createFestival");
           $view -> setVar('tableauCategorie' , $this->categorieBD);
           $this -> reAfficherElementPage1($view);
       }
       return $view;
    }

    public  function validerPage2 () {
        $this->connectionOk();
        $tousOk =  $this->organisateurOk()  && $this->sceneOk()  && $this->spectacleOk() ;
        if ($tousOk) {
            $view = new View("/views/creationFestival/CreateFestival2");

        } else {
            $view = new View("/views/creationFestival/CreateFestival3");
            $view -> setVar('tableauSpectacle' , $this->spectacleBD);
            $view -> setVar('tableauScene' , $this->sceneBD);
        }
        return $view;
    }

    public function validerPage3 () {
        $this->connectionOk();
        $champOk = $this->champsValides(HttpHelper::getParam('HDS') , HttpHelper::getParam('HFS'), HttpHelper::getParam('TPS'));
        $tempOk = $this->verifierTempsSuffisant(HttpHelper::getParam('TPS') , HttpHelper::getParam('HDS') , HttpHelper::getParam('HFS'));
        if($champOk && $tempOk) {
            echo 'oui';
        } else {
            $view = new View("/views/creationFestival/CreateFestival2");
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

    public  function spectacleOk() {
        if (!isset($_GET['spectacle'])) {
            return false ;
        }
        $spectacle = array();
        foreach($_GET['spectacle'] as $ligne) {
            if($this->createFestivalService->spectacleExiste($ligne)) {
                $spectacle[] = $ligne;
            } else {
                return false ;
            }
        }
        $_SESSION['spectacle'] = $spectacle;
        return true;
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

    public function verifierTempsSuffisant($pause , $debut , $fin)
    {
        $duree_journee = (strtotime($fin) - strtotime($debut))/60;
        //echo 'duree jour'.$duree_journee;
        $debut_festival = strtotime($_SESSION['ddd']);
        $fin_festival = strtotime($_SESSION['ddf']);

        $dureeDisponible = ($fin_festival - $debut_festival)/60;
        $dureeDisponible == 0 ? $dureeDisponible = $duree_journee :$dureeDisponible = $dureeDisponible;
        //echo 'dureDispo'.$dureeDisponible;
        $duree_totale_spectacle  = $this->calculerDureeTotaleSpectacle($pause);

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

    public function calculerDureeTotaleSpectacle($pause)
    {
        $result = $this->createFestivalService -> dureeSpectacle($_SESSION['spectacle']);
        $result +=  (count($_SESSION['spectacle']) - 1) * strtotime($pause);
        echo 'duree total'.$result;
        return $result ;
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

}

