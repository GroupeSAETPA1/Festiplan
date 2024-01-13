<?php

namespace services;

use PDO;

class DashboardService
{
    /**
     * @var PDO La connexion à la base de données avec
     * le droit de lecture sur les tables Festival et Spectacle
     */
    private PDO $pdoLectureFestivalSpectacle;

    public function __construct(PDO $pdo)
    {
        $this->pdoLectureFestivalSpectacle = $pdo;
    }

    public function getFestivals(int $id_gestionnaire): array
    {
        $requete = "SELECT festival.id_festival,
                           festival.nom AS nom,
                           festival.description,
                           festival.illustration,
                           festival.debut,
                           festival.fin,
                           c.nom AS categorie,
                           COUNT(DISTINCT spectacle.id_spectacle) AS nombre_spectacles
                    FROM festival
                    JOIN categorie c 
                    ON c.id_categorie = festival.id_categorie
                    LEFT JOIN spectacle_festival_scene sfs ON sfs.id_festival = festival.id_festival
                    LEFT JOIN spectacle ON spectacle.id_spectacle = sfs.id_spectacle
                    WHERE festival.id_responsable = :id_gestionnaire
                    GROUP BY festival.id_festival;";

        $requete = $this->pdoLectureFestivalSpectacle->prepare($requete);
        $requete->bindParam("id_gestionnaire", $id_gestionnaire);
        $requete->execute();

        return $requete->fetchAll();
    }

    public function getSpectacles(int $id_gestionnaire): array
    {
        $requete = "SELECT id_spectacle,spectacle.nom, spectacle.illustration, c.nom AS categorie, spectacle.duree, spectacle.description
                    FROM spectacle
                    JOIN categorie c ON spectacle.id_categorie = c.id_categorie
                    WHERE responsable_spectacle = :id_gestionnaire";

        $requete = $this->pdoLectureFestivalSpectacle->prepare($requete);
        $requete->bindParam("id_gestionnaire", $id_gestionnaire);
        $requete->execute();

        return $requete->fetchAll();
    }
}