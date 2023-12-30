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

    public function emailExiste($email): bool
    {
        $requeteEmailExiste = $this -> pdoCreationFestival ->prepare("SELECT DISTINCT nom, prenom FROM utilisateurs WHERE mail = :email");
        $requeteEmailExiste->bindParam(':email', $email);
        $requeteEmailExiste->execute();
        return $requeteEmailExiste->rowCount() > 0;
    }

    public function sceneExiste($scene): bool
    {
        $requeteSceneExiste = $this -> pdoCreationFestival -> prepare( "SELECT * FROM SCENE WHERE nom = :nom");
        $requeteSceneExiste->bindParam(':nom' , $scene);
        $requeteSceneExiste->execute();
        return $requeteSceneExiste->rowCount() > 0 ;
    }

    public function spectacleExiste($spectacle) : bool
    {
        $requeteSpectacleExiste = $this -> pdoCreationFestival -> prepare( "SELECT * FROM SPECTACLE WHERE nom = :spectacle");
        $requeteSpectacleExiste->bindParam('spectacle' , $spectacle);
        $requeteSpectacleExiste -> execute();
        return $requeteSpectacleExiste->rowCount() > 0;
    }
    public  function insertionFestival() {

    }
}