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
            $view->setVar('errorMessage', "Erreur de modification : Un ou plusieurs des champs est vide");
            return $view;
        }
        if ($this->userService->changerInfo($pdo, $newNom, $newPrenom, $newEmail, $newLogin)) {
            $view = new View("/views/userSettings");
            $view->setVar('changerInfo', true);
            $_SESSION['nom'] = $newNom;
            $_SESSION['prenom'] = $newPrenom;
            $_SESSION['email'] = $newEmail;
            $_SESSION['login'] = $newLogin;
            return $view;
        } else {
            $view = new View("/views/userSettings");
            $view->setVar('displayChangerInfoError', true);
            $view->setVar('errorMessage', "Erreur de modification : veuillez réessayer");
            return $view;
        }
    }

    public function changerMdp(Pdo $pdo)
    {
        $oldMdp = htmlspecialchars(HttpHelper::getParam('oldMdp') ?: "");
        $newMdp = htmlspecialchars(HttpHelper::getParam('newMdp') ?: "");
        $confirmMdp = htmlspecialchars(HttpHelper::getParam('confirmMdp') ?: "");

        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/";
        $mdpValide = preg_match($pattern,$newMdp);

        if ($oldMdp == "" || $newMdp == "" || $confirmMdp == "") {
            $view = new View("/views/userSettings");
            $view->setVar('displayChangerMdpError', true);
            $view->setVar('errorMessage', "Erreur de modification : Un ou plusieurs des champs est vide");
            return $view;
        }

        if (!$mdpValide) {
            $view = new View("/views/userSettings");
            $view->setVar('displayChangerMdpError', true);
            $view->setVar('errorMessage', "Erreur de modification : Le nouveau mot de passe n'est pas valide, il doit contenir au moins 8 caractères dont une majuscule, une minuscule, un chiffre et un caractère spécial");
            return $view;
        }

        if ($newMdp != $confirmMdp) {
            $view = new View("/views/userSettings");
            $view->setVar('displayChangerMdpError', true);
            $view->setVar('errorMessage', "Erreur de modification : Les mots de passe ne correspondent pas");
            return $view;
        }

        if ($this->userService->changerMdp($pdo, $oldMdp, $newMdp)) {
            $view = new View("/views/userSettings");
            $view->setVar('changerMdp', true);
            return $view;
        } else {
            $view = new View("/views/userSettings");
            $view->setVar('displayChangerMdpError', true);
            $view->setVar('errorMessage', "Erreur de modification : veuillez réessayer");
            return $view;
        }
    }
}
