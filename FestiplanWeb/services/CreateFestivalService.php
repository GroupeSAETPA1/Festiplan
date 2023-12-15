<?php

namespace services;

use PDO ;

class createFestivalService
{
    private PDO $pdoCreationFestival;

    public function __construct(PDO $pdo) 
    {    
        $this->pdoCreationFestival = $pdo;
    }   

    public function recupererCategorie() {
        try {
            $sql = $this -> pdoCreationFestival->prepare('SELECT nom FROM categorie');
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }
}