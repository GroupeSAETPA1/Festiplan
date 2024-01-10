<?php

namespace services;

use PDO;

class SupressionFestivalServices
{

    private PDO $pdoSupressionFestival;

    private UserService $userService;

    public function __construct(PDO $pdo, UserService $userService)
    {
        $this->pdoSupressionFestival = $pdo;
        $this->userService = $userService;
    }

    public function recupFestival(int $id_festival) : array
    {
        $requete = "SELECT *
                    FROM festival
                    WHERE id_festival = :id_festival;";
        $stmt = $this->pdoSupressionFestival->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function supression(int $id_festival) : array
    {
        $requete = "DELETE FROM festival 
                    WHERE id_festival = :id_festival;";
        $stmt = $this->pdoSupressionFestival->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
