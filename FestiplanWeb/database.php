<?php
function createPdo($user, $mdp):bool {

    // Fonction permettant de créer un pdo avec les arguments de l'user et de son mdp
    $PARAM_hote='localhost'; // le chemin vers le serveur TODO a changer pour le vrai nom de l'hote
    $PARAM_port='3306';
    $PARAM_nom_bd='festiplan'; // le nom de la base de données
    $PARAM_utilisateur=$user; // nom d'utilisateur pour se connecter
    $PARAM_mot_passe=$mdp; // mot de passe de l'utilisateur pour se connecter

    // la variable de connexion globale pour acceder au pdo
    global $connexion;

    // connexion à la BD
    try{ // Bloc try bd injoignable
        $connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
        $connexion->exec('SET NAMES utf8'); // Réglage de la connexion en utf8
        return true ; // La connexion est établie.
    } catch ( Exception $e ) {
        $erreurRenvoyee=$e->getMessage();
        echo $erreurRenvoyee;
        return false ;// La connexion a échoué.
    }
}