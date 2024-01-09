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
        return new View("views/userSettings");
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

        if ($this->userService->supprimerCompte($pdo, $mdp)) {
            $this->userService->deconnexion();
            return new View("/views/index");
        } else {
            $view = new View("/views/userSettings");
            $view->setVar('displaySuppressionError', true);
            $view->setVar('errorMessage', "Erreur de suppression : Le mot de passe n'est pas valide");
            return $view;
        }
    }

    public function deconnexion(): View
    {
        session_destroy();
        return new View("/views/index");
    }

    public function changerInfo(Pdo $pdo)
    {
        $newNom = htmlspecialchars(HttpHelper::getParam('nom') ?: "");
        $newPrenom = htmlspecialchars(HttpHelper::getParam('prenom') ?: "");
        $newEmail = htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $newLogin = htmlspecialchars(HttpHelper::getParam('login') ?: "");

        if ($newNom == "" || $newPrenom == "" || $newEmail == "" || $newLogin == "") {
            $view = new View("/views/userSettings");
            $view->setVar('displayChangerInfoError', true);
            $view->setVar('errorMessage', "Erreur de modification : Un des champs est vide");
            return $view;
        }
        $this->userService->changerInfo($pdo, $newNom, $newPrenom, $newEmail, $newLogin);

        $_SESSION['nom'] = $newNom;
        $_SESSION['prenom'] = $newPrenom;
        $_SESSION['email'] = $newEmail;
        $_SESSION['login'] = $newLogin;

        $view = new View("/views/userSettings");
        $view->setVar('changerInfo', true);
        return $view;
    }
}
