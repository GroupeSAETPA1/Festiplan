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
            $sql = $this -> pdoCreationFestival->prepare('SELECT id_categorie , nom FROM categorie');
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    public  function recupererSpectacle() {
        try {
            $sql = $this -> pdoCreationFestival->prepare('SELECT id_spectacle , nom FROM spectacle');
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }

    public function recupererTailleScene() {
        try {
            $sql = $this -> pdoCreationFestival->prepare('SELECT nom  , nb_spectateurs FROM scene');
            $sql->execute();
            return $sql -> fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }

    public  function insertionFestival() {

    }
}