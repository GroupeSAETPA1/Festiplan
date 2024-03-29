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

    public function getFestival(int $id_festival) {
        $requete = "SELECT * FROM festival WHERE id_festival = :id_festival;";

        $requete = $this->pdoLecture->prepare($requete);
        $requete->bindParam("id_festival", $id_festival);
        $requete->execute();

        return $requete->fetch();
    }

    public function getSpectaclesFestival(int $id_festival) {
        $requete = "SELECT spectacle.nom, spectacle.description, spectacle.illustration, spectacle.duree, spectacle.id_categorie, spectacle.taille_scene, spectacle.responsable_spectacle, scene.id_scene, scene.nom as nomScene
                    FROM spectacle
                    JOIN spectacle_festival_scene
                    ON spectacle.id_spectacle = spectacle_festival_scene.id_spectacle
                    JOIN festival
                    ON spectacle_festival_scene.id_festival = festival.id_festival
                    JOIN scene
                    ON spectacle_festival_scene.id_scene = scene.id_scene
                    WHERE festival.id_festival = :id_festival
                    ORDER BY scene.id_scene ASC, spectacle.duree ASC;";
        
        $requete = $this->pdoLecture->prepare($requete);
        $requete->bindParam("id_festival", $id_festival);
        $requete->execute();
        return $requete->fetchAll();
    }
}