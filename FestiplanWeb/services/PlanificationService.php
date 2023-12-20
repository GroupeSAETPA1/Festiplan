<?php

namespace services;

use PDO;

class PlanificationService
{
    /**
     * @var PDO La connexion à la base de données avec
     * le droit de lecture sur les tables Festival, Spectacle et listeOrganisateur
     */
    private PDO $pdoLecture;

    public function __construct(PDO $pdo)
    {
        $this->pdoLecture = $pdo;
    }

    public function getFestival(int $id_festival, int $id_organisateur) {
        $requete = "SELECT * FROM festival
                    JOIN liste_organisateur
                    ON festival.id_festival = liste_organisateur.id_festival
                    WHERE liste_organisateur.id_organisateur = :id_organisateur
                    AND liste_organisateur.id_festival = :id_festival";

        $requete = $this->pdoLecture->prepare($requete);
        $requete->bindParam("id_organisateur", $id_organisateur);
        $requete->bindParam("id_festival", $id_festival);
        $requete->execute();

        return $requete->fetch();
    }

    public function getSpectaclesFestival(int $id_festival) {
        $requete = "SELECT *
                    FROM spectacle
                    JOIN liste_spectacle
                    ON spectacle.id_spectacle = liste_spectacle.id_spectacle
                    JOIN festival
                    ON liste_spectacle.id_festival = festival.id_festival
                    WHERE festival.id_festival = :id_festival";                    

        $requete = $this->pdoLecture->prepare($requete);
        $requete->bindParam("id_festival", $id_festival);
        $requete->execute();

        return $requete->fetchAll();
    }
}