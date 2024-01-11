<?php

namespace services;

use PDO;

class SupressionSpectacleService
{

    private PDO $pdoSupressionSpectacle;

    private UserService $userService;

    public function __construct(PDO $pdo, UserService $userService)
    {
        $this->pdoSupressionSpectacle = $pdo;
        $this->userService = $userService;
    }

    public function recupSpectacle(int $id_spectacle) : array
    {
        $requete = "SELECT *
                    FROM spectacle
                    WHERE id_spectacle = :id_spectacle;";

        $stmt = $this->pdoSupressionSpectacle->prepare($requete);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();


        return $stmt->fetchAll();
    }

    public function supression(int $id_spectacle) : array
    {
        $requete = "DELETE 
                    FROM spectacle
                    WHERE id_spectacle = :id_spectacle;";

        $stmt = $this->pdoSupressionSpectacle->prepare($requete);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();


        return $stmt->fetchAll();
    }
}