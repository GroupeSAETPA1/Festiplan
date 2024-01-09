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
        $requete = "SELECT spectacle.nom, spectacle.description, spectacle.illustration, spectacle.duree, spectacle.id_categorie, spectacle.taille_scene, spectacle.responsable_spectacle, scene.id_scene, scene.nomScene
                    FROM spectacle
                    JOIN spectacle_festival_scene
                    ON spectacle.id_spectacle = spectacle_festival_scene.id_spectacle
                    JOIN festival
                    ON spectacle_festival_scene.id_festival = festival.id_festival
                    JOIN scene
                    ON spectacle_festival_scene.id_scene = scene.id_scene
                    WHERE festival.id_festival = :id_festival";

        $requete = $this->pdoLecture->prepare($requete);
        $requete->bindParam("id_festival", $id_festival);
        $requete->execute();

        return $requete->fetchAll();
    }
}