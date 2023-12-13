<?php
namespace services;

use services\UserService;
    class SessionService {
        public function connexion($pdo, $nom, $prenom) {
            $valeursUtilisateurs = getUtilisateur($pdo, $nom, $prenom);
            $_SESSION['connecte']= true ; 			// Stockage dans les variables de session que l'on est connecté (sera utilisé sur les autres pages)
            $_SESSION['nomClient']= $valeursUtilisateurs[0];   // Stockage dans les variables de session du nom du client
            $_SESSION['prenomClient']= $valeursUtilisateurs[1];// Stockage dans les variables de session du prénom du client
        }
    }