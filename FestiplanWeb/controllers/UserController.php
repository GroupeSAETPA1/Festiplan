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
class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index($pdo): View
    {
        session_destroy();

        $nom = htmlspecialchars(HttpHelper::getParam('nom') ?: "");
        $prenom = htmlspecialchars(HttpHelper::getParam('prenom') ?: "");
        $email = htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $mdp = htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
        $login = htmlspecialchars(HttpHelper::getParam('login') ?: "");

        $view = new View("views/index");
        $this->buildView($view, $nom, $prenom, $email, $mdp, $login, false, false, false, "");
        return $view;
    }


    /**
     * @param View $view
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $mdp
     * @param string $login
     * @param bool $displayInscription
     * @param bool $displayLoginError
     * @param bool $displaySignInError
     * @param string $errorMessage
     * @return void
     */
    public function buildView(View $view, string $nom, string $prenom, string $email, string $mdp, string $login, bool $displayInscription, bool $displayLoginError, bool $displaySignInError, string $errorMessage): void
    {
        $view->setVar('nom', $nom ?: "");
        $view->setVar('prenom', $prenom ?: "");
        $view->setVar('email', $email ?: "");
        $view->setVar('mdp', $mdp ?: "");
        $view->setVar('login', $login ?: "");
        $view->setVar('displayInscription', $displayInscription ?: false);
        $view->setVar('displayLoginError', $displayLoginError ?: false);
        $view->setVar('displaySignInError', $displaySignInError ?: false);
        $view->setVar('errorMessage', $errorMessage ?: "");
    }

    /**
     * Inscrit un utilisateur dans la base de données
     * @param $pdo pdo le pdo de l'application
     * @return View la vue du dashboard si on a réussi a créer le compte, sinon la vue index
     */
    public function inscription(PDO $pdo): View
    {

        $nom = htmlspecialchars(HttpHelper::getParam('nom') ?: "");
        $prenom = htmlspecialchars(HttpHelper::getParam('prenom') ?: "");
        $email = htmlspecialchars(HttpHelper::getParam('email') ?: "");
        $mdp = htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
        $login = htmlspecialchars(HttpHelper::getParam('login') ?: "");

        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/";
        $mdpValide = preg_match($pattern,$mdp);

        $view = new View("/views/index");
        if ($mdpValide) {
            try {
                if ($nom != "" && $prenom != "" && $email != "" && $mdp != "" && $login != "") {
                    if (!$this->userService->utilisateurExiste($pdo, $login)) {
                        $this->userService->createUser($pdo, $nom, $prenom, $email, $mdp, $login);
                        $view = new View("/views/dashboard");
                        // Si l'utilisateur existe déja, on affiche un message d'erreur
                    } else {
                        $messageErreur = "Erreur d'inscription : Un utilisateur existe déja avec ce login";
                        $this->buildView($view, $nom, $prenom, $email, $mdp, $login, true, false, true, $messageErreur);
                    }
                } else {
                    $messageErreur = "Erreur d'inscription : Un des champs requis n'est pas rempli";
                    $this->buildView($view, $nom, $prenom, $email, $mdp, $login, true, false, true, $messageErreur);
                }
            } catch (PDOException|\TypeError $e) {
                $messageErreur = "Erreur d'inscription : " . $e->getMessage();
                $this->buildView($view, $nom, $prenom, $email, $mdp, $login, true, false, true, $messageErreur);
            }
        } else {
            $messageErreur = "Le mot de passe n'est pas valide !". PHP_EOL
                            ."Il faut qu'il contienne 8 characteres, au moins une minuscule,". PHP_EOL
                            ." une majuscule, un chiffre et un characteres spécial";
            $this->buildView($view, $nom, $prenom, $email, $mdp, $login, true, false, true, $messageErreur);
        }
        return $view;

    }

    /**
     * Tente de connecter l'utilisateur pour le renvoyer sur le dashboard de l'application
     * @param $pdo pdo le pdo de l'application
     * @return View la vue dashboard si on arrive a se connecter, la vue index avec une erreure sinon
     */
    public function connexion(PDO $pdo): View
    {
        // Connecte l'utilisateur

        $mdp = htmlspecialchars(HttpHelper::getParam('mdp') ?: "");
        $login = htmlspecialchars(HttpHelper::getParam('login') ?: "");

        $view = new View("/views/index");
        try {
            if ($login != "" || $mdp != "") {
                $resultatRequete = $this->userService->connexion($pdo, $mdp, $login);
                if ($resultatRequete->rowCount() > 0) {
                    $view = new View("/views/dashboard");
                    while ($ligne = $resultatRequete->fetch()) {
                        // Stockage dans les variables de session les attributs de l'utilisateur
                        $_SESSION['connecte'] = true;
                        $_SESSION['id_utilisateur'] = $ligne->id_utilisateur;
                        $_SESSION['nom'] = $ligne->nom;
                        $_SESSION['prenom'] = $ligne->prenom;
                        $_SESSION['email'] = $ligne->mail;
                        $_SESSION['login'] = $ligne->login;
                    }
                    $messageErreur = "";
                    $displayLoginError = false;
                    header("Location: index.php?controller=Dashboard");
                    exit();
                } else {
                    $displayLoginError = true;
                    $messageErreur = "Erreur de connexion : L'identifiant ou le mot de passe ne sont pas valides";
                }
            } else {
                $displayLoginError = true;
                $messageErreur = "Erreur de connexion : Le login et le mot de passe ne doivent pas etre vides";
            }
        } catch (PDOException|\TypeError $e) {
            $displayLoginError = true;
            $messageErreur = "Erreur de connexion : " . $e->getMessage();
        }
        $this->buildView($view, "", "", "", $mdp, $login, false, $displayLoginError, false, $messageErreur);
        return $view;
    }

    function PDONotFound()
    {
        return new View("/views/Error504");
    }
}
