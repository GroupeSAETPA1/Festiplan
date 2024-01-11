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
        $requete = "SELECT id_festival, festival.nom, illustration, debut, fin, description, c.nom as categorie
                    FROM festival
                    JOIN festiplan.categorie c on c.id_categorie = festival.id_categorie
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoSupressionFestival->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function supression(int $id_festival) : array
    {
        //TODO Supprimer les donnee ou le festival apparait. Les tables à chercher sont spectacle-festival-scene, liste-scene et liste-organisateur
        $requete = "DELETE 
                    FROM festival 
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoSupressionFestival->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}
