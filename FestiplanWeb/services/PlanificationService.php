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

    public function getSpectacles(int $id_gestionnaire): array
    {
        $requete = "SELECT id_spectacle,spectacle.nom, spectacle.illustration, c.nom AS categorie, spectacle.duree, spectacle.description
                    FROM spectacle
                    JOIN festiplan.categorie c ON spectacle.id_categorie = c.id_categorie
                    WHERE responsable_spectacle = :id_gestionnaire";

        $requete = $this->pdoLecture->prepare($requete);
        $requete->bindParam("id_gestionnaire", $id_gestionnaire);
        $requete->execute();

        return $requete->fetchAll();
    }
}