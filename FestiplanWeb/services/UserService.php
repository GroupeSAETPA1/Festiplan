<?php

namespace services;

use PDO;
use PDOStatement;

class UserService
{

    public function createUser($pdo, $nom, $prenom, $email, $mdp, $login): bool
    {
        // Inscription d'un utilisateur
        // Renvoie vrai ou faux en fonction si l'utilisateur a été inscrit.

       $mdp = hash("sha256", $mdp);

        $requeteCreationClient = $pdo->prepare('INSERT INTO utilisateurs (nom, prenom, mail, mdp, login) VALUES (:nom, :prenom, :email, :mdp, :login)');
        $requeteCreationClient->bindParam(':nom', $nom);
        $requeteCreationClient->bindParam(':prenom', $prenom);
        $requeteCreationClient->bindParam(':email', $email);
        $requeteCreationClient->bindParam(':mdp', $mdp);
        $requeteCreationClient->bindParam(':login', $login);
        if ($requeteCreationClient->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Vérifie si un utilisateur existe avec les parametres envoyés
     * @param $pdo pdo le pdo de l'application
     * @param $login string le login de l'utillisateur a rechercher
     * @return bool true si l'utilisateur existe dans la base de donnée, false sinon
     */
    public function utilisateurExiste(pdo $pdo, string $login): bool
    {
        // Vérifie si l'utilisateur existe
        // Renvoie vrai ou faux en fonction si l'utilisateur a été trouvé.
        $utilisateurExiste = false;
        $requeteUtilisateurExiste = $pdo->prepare("SELECT DISTINCT nom, prenom FROM utilisateurs WHERE login = :login");
        $requeteUtilisateurExiste->bindParam(':login', $login);
        $requeteUtilisateurExiste->execute();

        return $requeteUtilisateurExiste->rowCount() > 0;
    }

    /**
     * Connecte un utilisateur en mettant ses attributs dans la connexion
     * @param $pdo pdo le pdo de l'application
     * @param $mdp string le mot de passe de l'utilisateur à connecter
     * @param $login string le login de l'utilisateur à connecter
     * @return PDOStatement
     */
    public function connexion($pdo, string $mdp, string $login):PDOStatement {

        $mdp = hash("sha256", $mdp);

        // Vérifie si l'utilisateur existe
        // Renvoie vrai ou faux en fonction si l'utilisateur a été trouvé.
        $requeteConnexionUtilisateur = $pdo->prepare("SELECT DISTINCT id_utilisateur, nom, prenom, login, mail FROM utilisateurs WHERE login = :login AND mdp = :mdp");
        $requeteConnexionUtilisateur->bindParam(':login', $login);
        $requeteConnexionUtilisateur->bindParam(':mdp', $mdp);

        $requeteConnexionUtilisateur->execute();
        $requeteConnexionUtilisateur->setFetchMode(PDO::FETCH_OBJ);
        return $requeteConnexionUtilisateur;
    }

    /**
     * verifie si un utilisateur existe avec l'email
     * @param $pdo pdo le pdo de l'application
     * @param $email string l'email de l'utilisateur a rechercher
     */
    public function emailExiste($pdo, $email): bool
    {
        $requeteEmailExiste = $pdo->prepare("SELECT DISTINCT nom, prenom FROM utilisateurs WHERE mail = :email");
        $requeteEmailExiste->bindParam(':email', $email);
        $requeteEmailExiste->execute();

        return $requeteEmailExiste->rowCount() > 0;
    }

    /**
     * retourne l'id de l'utilisateur en fonction de son mail
     * @param $pdo pdo le pdo de l'application
     * @param $email string l'email de l'utilisateur a rechercher
     */
    public function getIdUtilisateur($pdo, $email): int
    {
        $requeteIdUtilisateur = $pdo->prepare("SELECT DISTINCT id_utilisateur FROM utilisateurs WHERE mail = :email");
        $requeteIdUtilisateur->bindParam(':email', $email);
        $requeteIdUtilisateur->execute();
        $requeteIdUtilisateur->setFetchMode(PDO::FETCH_OBJ);
        $resultat = $requeteIdUtilisateur->fetch();
        // si l'utilisateur n'existe pas on renvoie -1
        if ($resultat == null) {
            return -1;
        }
        return $resultat->id_utilisateur;
    }

    /**
     * supprime un utilisateur de la base de donnée
     * renvoie vrai si l'utilisateur a été supprimé, faux sinon
     * @param PDO $pdo
     * @param mixed $login
     * @param string $mdp
     * @return void
     */
    public function supprimerCompte(PDO $pdo, string $mdp): bool
    {
        $mdpEncript = hash("sha256", $mdp);

        $requeteSupprimerCompte = $pdo->prepare("DELETE FROM utilisateurs WHERE login = :login AND mdp = :mdp");
        $requeteSupprimerCompte->bindParam(':login', $_SESSION['login']);
        $requeteSupprimerCompte->bindParam(':mdp', $mdpEncript);
        $requeteSupprimerCompte->execute();
        return $requeteSupprimerCompte->rowCount() > 0;
    }

    public function changerInfo(PDO $pdo, string $newNom, string $newPrenom, string $newEmail, string $newLogin): bool
    {
        $requeteChangerInfo = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, mail = :email, login = :login WHERE id_utilisateur = :id_utilisateur");
        $requeteChangerInfo->bindParam(':nom', $newNom);
        $requeteChangerInfo->bindParam(':prenom', $newPrenom);
        $requeteChangerInfo->bindParam(':email', $newEmail);
        $requeteChangerInfo->bindParam(':login', $newLogin);
        $requeteChangerInfo->bindParam(':id_utilisateur', $_SESSION['id_utilisateur']);
        $requeteChangerInfo->execute();
        return $requeteChangerInfo->rowCount() > 0;
    }

    public function changerMdp(PDO $pdo, string $oldMdp, string $newMdp): bool
    {
        $oldMdp = hash("sha256", $oldMdp);
        $newMdp = hash("sha256", $newMdp);

        $requeteChangerMdp = $pdo->prepare("UPDATE utilisateurs SET mdp = :mdp WHERE id_utilisateur = :id_utilisateur AND mdp = :oldMdp");
        $requeteChangerMdp->bindParam(':mdp', $newMdp);
        $requeteChangerMdp->bindParam(':id_utilisateur', $_SESSION['id_utilisateur']);
        $requeteChangerMdp->bindParam(':oldMdp', $oldMdp);
        $requeteChangerMdp->execute();
        return $requeteChangerMdp->rowCount() > 0;
    }
}