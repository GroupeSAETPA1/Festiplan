<?php
namespace controllers;

use PDO;
use services\UserService;
use services\SessionService;
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

   public function connexion($pdo): View {
      // Connecte l'utilisateur

      $mdp =  htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
      $login =  htmlspecialchars(HttpHelper::getParam('login') ?: "");

      $view = null;
      try {
          if ($this->userService->utilisateurExiste($pdo, $mdp, $login)) {
              // TODO mettre les infos du dashboard de l'utilisateur
              $view = new View("/views/dashboard");
          } else {
              $view = new View("/views/index");
              $view->setVar('mdp', $mdp);
              $view->setVar('login', $login);
              $view->setVar('displayInscription', false);
              $view->setVar('displayLoginError', true);
          }
      } catch (\PDOException $e ) {
          $view->setVar('error', "Il y a une erreure :" . $e->getMessage());
      }
       return $view;
   }
}
