<?php
namespace services;

use PDO;
use PDOException;

class UserService {

    public function createUser($pdo, $nom, $prenom, $email, $mdp, $login): void {
       // Inscription d'un utilisateur
       // Renvoie vrai ou faux en fonction si l'utilisateur a été inscrit.

        // TODO chiffrer le mot de passe

       $requeteCreationClient = $pdo->prepare('INSERT INTO utilisateurs (nom, prenom, email, mdp, login) VALUES (:nom, :prenom, :email, :mdp, :login)');
       $requeteCreationClient->bindParam(':nom', $nom);
       $requeteCreationClient->bindParam(':prenom', $prenom);
       $requeteCreationClient->bindParam(':email', $email);
       $requeteCreationClient->bindParam(':mdp', $mdp);
       $requeteCreationClient->bindParam(':login', $login);
       $requeteCreationClient->execute();
   }

    /**
     * Vérifie si un utilisateur existe avec les parametres envoyés
     * @param $pdo pdo le pdo de l'application
     * @param $mdp string le mot de passe de l'utillisateur a rechercher
     * @param $login string le login de l'utillisateur a rechercher
     * @return bool true si l'utilisateur existe dans la base de donnée, false sinon
     */
    public function utilisateurExiste($pdo, $mdp, $login): bool {
       // Vérifie si l'utilisateur existe
       // Renvoie vrai ou faux en fonction si l'utilisateur a été trouvé.
       $utilisateurExiste = false;
       $requeteUtilisateurExiste = $pdo->prepare("SELECT DISTINCT nom, prenom FROM utilisateurs WHERE login = :login AND mdp = :mdp");
       $requeteUtilisateurExiste->bindParam(':login', $login);
       $requeteUtilisateurExiste->bindParam(':mdp', $mdp);
       $requeteUtilisateurExiste->execute();

       return $requeteUtilisateurExiste->rowCount() > 0;
    }

    /**
     * Connecte un utilisateur en mettant ses attributs dans la connexion
     * @param $pdo pdo le pdo de l'application
     * @param $mdp string le mot de passe de l'utillisateur a connecter
     * @param $login string le login de l'utillisateur a connecter
     * @return void
     */
    public function connexion($pdo, $mdp, $login): void {
        // Vérifie si l'utilisateur existe
        // Renvoie vrai ou faux en fonction si l'utilisateur a été trouvé.
        $requeteUtilisateurExiste = $pdo->prepare("SELECT DISTINCT nom, prenom FROM utilisateurs WHERE login = :login AND mdp = :mdp");
        $requeteUtilisateurExiste->bindParam(':login', $login);
        $requeteUtilisateurExiste->bindParam(':mdp', $mdp);

        $requeteUtilisateurExiste->execute();
        $requeteUtilisateurExiste->setFetchMode(PDO::FETCH_OBJ);
        while ($ligne=$requeteUtilisateurExiste->fetch()) {
            // Stockage dans les variables de session les attributs de l'utilisateur
            $_SESSION['connecte']= true ;
            $_SESSION['nom']= $ligne->nom;
            $_SESSION['prenom']= $ligne->prenom;
        }
    }

    /**
     * Déconnecte l'utilisateur en réinitialisant les variables liées a l'utisateur
     * @return void
     */
    public function deconnexion(): void {
        $_SESSION['connecte']= false;
        $_SESSION['nom']= "User";
        $_SESSION['prenom']= "Unknown";
    }
}