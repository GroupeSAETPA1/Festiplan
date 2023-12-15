<?php

namespace services;

use PDO ;

class createFestivalService
{
    private PDO $pdoCreationFestival;

    public function __construct(PDO $pdo) {
        echo "<br>Variable d'instance : ";
        $this->$pdoCreationFestival = null;
        var_dump($pdoCreationFestival);
        echo "<br>Parametre : ";
        var_dump($pdo);
        $this->$pdoCreationFestival = $pdo ; 
    }   

    public function recupererCategorie() {
        try {
            $sql = $pdoCreationFestival->prepare('SELECT nom FROM categorie');
            $sql->execute();
            return $sql->fetch_all();
        } catch (PDOException $e) {
            return false;
        }
    }
}