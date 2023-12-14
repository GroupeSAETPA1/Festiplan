<?php
namespace controllers;

use PDO;
use services\UserService;
use yasmf\HttpHelper;
use yasmf\View;

/**
 * Controleur de la gestion utilisateur
 */
class UserController {
    private UserService $userService;

    public function __construct(UserService $userService) {
        session_start();
        $this->userService = $userService;
    }

    public function index($pdo): View {
        $this->userService->deconnexion();

        $mdp =  htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
        $login =  htmlspecialchars(HttpHelper::getParam('identifiant') ?: "");
        $view = new View("views/index");
        $view->setVar('nom', "");
        $view->setVar('prenom', "");
        $view->setVar('email', "");
        $view->setVar('mdp', $mdp);
        $view->setVar('login', $login);
        $view->setVar('displayInscription', false);
        $view->setVar('displayLoginError', false);
        return $view;
    }

    /**
     * Inscrit un utilisateur dans la base de données
     * @param $pdo pdo le pdo de l'application
     * @return View la vue du dashboard si on a réussi a créer le compte, sinon la vue index
     */
    public function inscription($pdo): View {

        $nom =  htmlspecialchars(HttpHelper::getParam('nom') ?: "");
        $prenom =  htmlspecialchars(HttpHelper::getParam('prenom') ?: "");
        $email =  htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $mdp =  htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
        $login =  htmlspecialchars(HttpHelper::getParam('login') ?: "");

        $view = null;
        try {
            // Si l'utilisateur n'existe pas, on le crée
            if (!$this->userService->utilisateurExiste($pdo, $email, $mdp)) {
                // TODO mettre les infos du dashboard de l'utilisateur
                $view = new View("/views/dashboard");
            // Si l'utilisateur existe déja, on affiche un message d'erreur
            } else {
                $view = new View("/views/index");
                $view->setVar('nom', $nom);
                $view->setVar('prenom', $prenom);
                $view->setVar('email', $email);
                $view->setVar('mdp', $mdp);
                $view->setVar('login', $login);
                $view->setVar('displayInscription', true);
                $view->setVar('displayLoginError', true);
            }
        } catch (\PDOException $e) {
            $view->setVar('error', "Erreur d'inscription : " . $e->getMessage());
        }
        return  $view;
    }

    /**
     * Tente de connecter l'utilisateur pour le renvoyer sur le dashboard de l'application
     * @param $pdo pdo le pdo de l'application
     * @return View la vue dashboard si on arrive a se connecter, la vue index avec une erreure sinon
     */
    public function connexion($pdo): View {
        // Connecte l'utilisateur

        $mdp =  htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
        $login =  htmlspecialchars(HttpHelper::getParam('login') ?: "");

      $view = null;
      try {
          $view = new View("/views/index");
          if ($login != "" || $mdp != "") {
              if ($this->userService->utilisateurExiste($pdo, $mdp, $login)) {
                  $view = new View("/views/dashboard");
                  $resultatRequete = $this->userService->connexion($pdo, $mdp, $login);
                  while ($ligne=$resultatRequete->fetch()) {
                    // Stockage dans les variables de session les attributs de l'utilisateur
                    $_SESSION['connecte']= true;
                    $_SESSION['id_utilisateur']= $ligne->id_utilisateur;
                    $_SESSION['nom']= $ligne->nom;
                    $_SESSION['prenom']= $ligne->prenom;
                    }
                  $displayLoginError = false;
              } else {
                  $displayLoginError = true;
                  $view->setVar('errorMessage', "Erreur de connexion : L'identifiant ou le mot de passe ne sont pas valides");
              }
          } else {
              $displayLoginError = true;
              $view->setVar('errorMessage', "Erreur de connexion : Le login et le mot de passe ne doivent pas etre vides");
          }
      } catch (\PDOException $e ) {
          $displayLoginError = true;
          $view->setVar('errorMessage', "Erreur de connexion : " . $e->getMessage());
      }
       $view->setVar('displayLoginError', $displayLoginError);
       $view->setVar('mdp', $mdp);
       $view->setVar('login', $login);
       return $view;
   }
}
