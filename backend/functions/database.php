<?php

// fonction de création de PDO

function getPDO($db_name, $db_user, $db_pass, $db_host = 'localhost')
{
    try {
        $pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);
        // pour afficher les erreurs SQL
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
        return false;
    }
}

