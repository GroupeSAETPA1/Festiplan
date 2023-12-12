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
        $login =  htmlspecialchars(HttpHelper::getParam('identifiant') ?: "");
        $mdp =  htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
        $view = new View("views/.."); // TODO mettre la bonne view
        $view->setVar('mdp', $mdp);
        $view->setVar('login', $login);
        $view->setVar('displayInscription', false);
        return $view;
    }

    public function inscription($pdo): View {

        $nom =  htmlspecialchars(HttpHelper::getParam('nom') ?: "");
        $prenom =  htmlspecialchars(HttpHelper::getParam('prenom') ?: "");
        $email =  htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $mdp =  htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
        $login =  htmlspecialchars(HttpHelper::getParam('login') ?: "");

        // Si l'utilisateur n'existe pas, on le crée
        if (!$this->userService->utilisateurExiste($pdo, $email, $mdp)) {
            $this->userService->createUser($pdo, $email, $nom, $prenom, $mdp, $login);
            // TODO mettre les infos du dashboard de l'utilisateur
            return new View("/views/dashboard");
        // Si l'utilisateur existe déja, on affiche un message d'erreur
        } else {
            $view = new View("/views/..."); // TODO mettre la bonne view
            $view->setVar('nom', $nom);
            $view->setVar('prenom', $prenom);
            $view->setVar('email', $email);
            $view->setVar('mdp', $mdp);
            $view->setVar('login', $login);
            $view->setVar('displayInscription', true);
            return  $view;
        }
    }

   public function connexion($pdo): View {
      // Connecte l'utilisateur

      $mdp =  htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
      $login =  htmlspecialchars(HttpHelper::getParam('login') ?: "");

      try {
          if ($this->userService->utilisateurExiste($pdo, $login, $mdp)) {
              $_SESSION['connecte']= true ; 			// Stockage dans les variables de session que l'on est connecté (sera utilisé sur les autres pages)
              $_SESSION['nomClient']= $ligne->nom ;   // Stockage dans les variables de session du nom du client
              $_SESSION['prenomClient']= $ligne->prenom ;// Stockage dans les variables de session du prénom du client
              return true;
          } else {
              return false;
          }
      } catch (\PDOException $e ) {
          $view->setVar('error', "Il y a une erreure :" . $e->getMessage());
      }
       return $view;
   }
}
