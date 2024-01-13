<?php

namespace services;

use PDO;
use PDOException;

class SupressionFestivalServices
{

    private PDO $pdoSupressionFestival;


    public function __construct(PDO $pdo)
    {
        $this->pdoSupressionFestival = $pdo;
    }

    public function recupFestival(int $id_festival): array
    {
        $requete = "SELECT id_festival, festival.nom, illustration, debut, fin, description, c.nom as categorie
                    FROM festival
                    JOIN categorie c on c.id_categorie = festival.id_categorie
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoSupressionFestival->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function supression(int $id_festival): void
    {
        try {
            $stmt = $this->pdoSupressionFestival->prepare("CALL supprimer_festival(:id_festival)");
            $stmt->bindParam("id_festival", $id_festival);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

}
