<?php

namespace services;

use PDO;

class CreateGrij
{

    private PDO $pdoCreationGrij;

    private UserService $userService;

    public function __construct(PDO $pdo, UserService $userService)
    {
        $this->pdoCreationGrij = $pdo;
        $this->userService = $userService;
    }

    public function ajoutGrij(PDO $pdo, int $tempPause, int $debutSpectacle, int $finSpectacle ){
        try {
            $sql = $pdo->prepare('INSERT INTO festival (duree_entre_spectacle, heure_debut_spectacle, heure_fin_spectacle) VALUES (:duree_entre_spectacle, :heure_debut_spectacle, :heure_fin_spectacle)');
            $sql->bindParam(':duree_entre_spectacle', $tempPause );
            $sql->bindParam(':heure_debut_spectacle', $debutSpectacle);
            $sql->bindParam(':heure_fin_spectacle', $finSpectacle);
            $sql->execute();
            return true;

        }catch (PDOException $e) {
            return false;
        }
    }

    public function recupGrij(){
        try {
            $sql = $this -> pdoCreationGrij->prepare('SELECT duree_entre_spectacle, heure_debut_spectacle, heure_fin_spectacle FROM festival');
            $sql->execute();
            return $sql -> fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }


}