<?php

namespace controllers;

use PDO;
use PDOException;
use services\UserService;
use yasmf\HttpHelper;
use yasmf\View;

/**
 * Controleur de la gestion utilisateur
 */
class SettingsController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * genere la vue de la page de parametres utilisateur
     * @return View
     */
    public function index(): View
    {
        $view = new View("views/userSettings");
        $view->setVar('nom', $_SESSION['nom']);
        $view->setVar('prenom', $_SESSION['prenom']);
        $view->setVar('email', $_SESSION['email']);
        $view->setVar('login', $_SESSION['login']);

        return $view;
    }

    function PDONotFound()
    {
        return new View("/views/Error504");
    }


    /**
     * Supprime un compte utilisateur
     * @param PDO $pdo
     * @return View
     */
    public function supprimerCompte(PDO $pdo): View
    {
        $mdp = htmlspecialchars(HttpHelper::getParam('confirmMdp') ?: "");
        $login = $_SESSION['login'];
        if ($this->userService->supprimerCompte($pdo, $login, $mdp)) {
            $this->userService->deconnexion();
            return new View("/views/index");
        } else {
            $view = new View("/views/userSettings");
            $view->setVar('displaySuppressionError', true);
            $view->setVar('errorMessage', "Erreur de suppression : Le mot de passe n'est pas valide");
            return $view;
        }
    }
}
