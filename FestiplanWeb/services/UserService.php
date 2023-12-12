<?php

class UserService {

    public function __construct() {
    }

    public function createUser($email, $nom, $prenom, $pwd, $login, $pdo): bool {
       // Inscription d'un utilisateur
       // Renvoie vrai ou faux en fonction si l'utilisateur a été inscrit.

        // TODO chiffrer le mot de passe

       try {
           if (!$this->utilisateurExiste($email, $mdp, $pdo)) {
               $req = $pdo->prepare('INSERT INTO utilisateur (nom, prenom, email, mdp, login) VALUES (:nom, :prenom, :email, :mdp, :login)');
               $req->bindParam(':email', $email);
               $req->bindParam(':nom', $nom);
               $req->bindParam(':prenom', $prenom);
               $req->bindParam(':mdp', $mdp);
               $req->bindParam(':login', $login);
               $req->execute();
               return true;
           } else {
               return false;
           }
       } catch (PDOException $e) {
           echo 'Erreur : ' . $e->getMessage();
           return false;
       }
   }

    public function utilisateurExiste($login,$mdp, $pdo): bool {
       // Vérifie si l'utilisateur existe
       // Renvoie vrai ou faux en fonction si l'utilisateur a été trouvé.
        $utilisateurExiste = true;
       try {
           $maRequete = $pdo->prepare("SELECT nom, prenom from utilisateur where login = :login and mdp = :mdp");
           $maRequete->bindParam(':login', $login);
           $maRequete->bindParam(':mdp', $mdp);
           if ($maRequete->execute()) {
               $utilisateurExiste = $maRequete->rowCount() > 0;
           }
       } catch ( Exception $e ) {
           echo "<h1>Erreur de connexion à la base de données ! </h1>";
           $utilisateurExiste = false;
       } finally {
           return $utilisateurExiste;
       }
    }

    public function getUtilisateur($login, $pwd, $pdo): array {
        // Récupere l'id de l'utilisateur
        try {
            $maRequete = $pdo->prepare("SELECT nom, prenom from utilisateur where login = :login and mdp = :mdp");
            $maRequete->bindParam(':login', $login);
            $maRequete->bindParam(':mdp', $mdp);
            if ($maRequete->execute()) {
                $utilisateurExiste = $maRequete->rowCount() > 0;
            }
        } catch ( Exception $e ) {
            echo "<h1>Erreur de connexion à la base de données ! </h1>";
            $utilisateurExiste = false;
        } finally {
            return $utilisateurExiste;
        }
    }
}