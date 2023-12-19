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

    public  function recupererSpectacle() {
        try {
            $sql = $this -> pdoCreationFestival->prepare('SELECT nom FROM spectacle');
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }

    public function recupererTailleScene() {
        try {
            $sql = $this -> pdoCreationFestival->prepare('SELECT taille FROM taille_scene');
            $sql->execute();
            return $sql -> fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }
}