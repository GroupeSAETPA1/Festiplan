<?php

function utilisateurExiste($login,$pwd, $pdo) {
    // Vérifie si l'utilisateur existe
    // Renvoie vrai ou faux en fonction si l'utilisateur a été trouvé.
    try{ // Bloc try bd injoignable
        $connecte=false;
        $maRequete = $pdo->prepare("SELECT nom, prenom from clients where login = :login and pwd = :pwd");
        $maRequete->bindParam(':login', $login);
        $maRequete->bindParam(':pwd', $pwd);
        if ($maRequete->execute()) {
            $maRequete->setFetchMode(PDO::FETCH_OBJ);
            while ($ligne=$maRequete->fetch()) {
                $_SESSION['connecte']= true ; 			// Stockage dans les variables de session que l'on est connecté (sera utilisé sur les autres pages)
                $_SESSION['nomClient']= $ligne->nom ;   // Stockage dans les variables de session du nom du client
                $_SESSION['prenomClient']= $ligne->prenom ;// Stockage dans les variables de session du prénom du client
            }
        }
        return $connecte;
    }
    catch ( Exception $e ) {
        echo "<h1>Erreur de connexion à la base de données ! </h1><br/>";
        return false;
    }
}

