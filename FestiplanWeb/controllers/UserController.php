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
            $view->setVar('error', "Il y a une erreure :" . $e->getMessage());
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
                  $this->userService->connexion($pdo, $mdp, $login);
                  $displayLoginError = false;
              } else {
                  $displayLoginError = true;
              }
          } else {
              $displayLoginError = true;
          }
      } catch (\PDOException $e ) {
          $displayLoginError = true;
          $view->setVar('error', "Il y a une erreure :" . $e->getMessage());
      }
       $view->setVar('displayLoginError', $displayLoginError);
       $view->setVar('mdp', $mdp);
       $view->setVar('login', $login);
       return $view;
   }
}
