<?php
namespace services;

use PDOException;

class UserService {

    public function createUser($pdo, $nom, $prenom, $email, $mdp, $login): void {
       // Inscription d'un utilisateur
       // Renvoie vrai ou faux en fonction si l'utilisateur a été inscrit.

        // TODO chiffrer le mot de passe

       $requeteCreationClient = $pdo->prepare('INSERT INTO utilisateur (nom, prenom, email, mdp, login) VALUES (:nom, :prenom, :email, :mdp, :login)');
       $requeteCreationClient->bindParam(':nom', $nom);
       $requeteCreationClient->bindParam(':prenom', $prenom);
       $requeteCreationClient->bindParam(':email', $email);
       $requeteCreationClient->bindParam(':mdp', $mdp);
       $requeteCreationClient->bindParam(':login', $login);
       $requeteCreationClient->execute();
   }

    public function utilisateurExiste($pdo, $mdp, $login): bool {
       // Vérifie si l'utilisateur existe
       // Renvoie vrai ou faux en fonction si l'utilisateur a été trouvé.
       $utilisateurExiste = true;
       $requeteUtilisateurExiste = $pdo->prepare("SELECT nom, prenom FROM utilisateur WHERE login = :login AND mdp = :mdp");
       $requeteUtilisateurExiste->bindParam(':login', $login);
       $requeteUtilisateurExiste->bindParam(':mdp', $mdp);
       $requeteUtilisateurExiste->execute();

       return $requeteUtilisateurExiste->rowCount() > 0;
    }

    public function getUtilisateur($pdo, $nom, $prenom) {
        $requeteGetUtilisateur = $pdo->prepare("SELECT nom, prenom FROM utilisateur WHERE nom = :nom AND mdp = :prenom");
        $requeteGetUtilisateur->bindParam(':nom', $nom);
        $requeteGetUtilisateur->bindParam(':prenom', $prenom);
        $requeteGetUtilisateur->execute();
        return $requeteGetUtilisateur;
    }
}