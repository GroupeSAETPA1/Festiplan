<?php

namespace services;

use PDO;

class CreateSpectacleService
{

    private PDO $pdoCreationSpectacle;

    public function __construct(PDO $pdo)
    {
        $this->pdoCreationSpectacle = $pdo;
    }

    public function recupererTailleScene() {
        try {
            $sql = $this -> pdoCreationSpectacle->prepare('SELECT * FROM taille_scene');
            $sql->execute();
            return $sql -> fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }

    public function recupererCategorie() {
        try {
            $sql = $this -> pdoCreationSpectacle->prepare('SELECT * FROM categorie');
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }

}