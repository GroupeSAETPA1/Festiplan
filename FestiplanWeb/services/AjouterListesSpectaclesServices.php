<?php

namespace services;

class AjouterListesSpectaclesServices
{
    private \PDO $pdoAjouterSpectacle;

    public function __construct(\PDO $pdoAjouterSpectacle)
    {
        $this->pdoAjouterSpectacle = $pdoAjouterSpectacle;
    }

    public function getSpectaclesDisponible (int $id_festival) : array
    {
        $requete = "SELECT spectacle.id_spectacle, spectacle.nom, description, illustration, duree, c.nom AS categorie, 'ajouterSpectacle' AS action
                    FROM spectacle
                    JOIN categorie c ON c.id_categorie = spectacle.id_categorie
                    WHERE spectacle.id_spectacle NOT IN (SELECT id_spectacle
                                                         FROM spectacle_festival_scene
                                                         WHERE id_festival = :id_festival)
                      AND taille_scene IN (SELECT ts.id_taille
                                           FROM scene
                                           JOIN festiplan.taille_scene ts ON ts.id_taille = scene.id_taille
                                           JOIN festiplan.liste_scene ls ON scene.id_scene = ls.id_scene
                                           WHERE id_festival = :id_festival1);";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_festival1", $id_festival);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ajouterSpectacle(int $id_festival, int $id_spectacle, int $id_scene): void
    {
        $requete = "INSERT INTO liste_spectacle_temporaire (id_festival, id_spectacle, id_scene) VALUES (:id_festival, :id_spectacle, :id_scene)";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);

        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->bindParam("id_scene", $id_scene);

        $stmt->execute();
    }

    public function retirerSpectacle(int $id_festival, int $id_spectacle, int $id_scene): void
    {
        $requete = "DELETE FROM liste_spectacle_temporaire WHERE id_festival = :id_festival AND id_spectacle = :id_spectacle AND id_scene = :id_scene";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);

        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->bindParam("id_scene", $id_scene);

        $stmt->execute();
    }

    public function getSpectaclesTemporaire () : array
    {
        $requete = "SELECT id_spectacle, s.id_scene, s.nom as nom_scene
                    FROM liste_spectacle_temporaire
                    JOIN scene s on liste_spectacle_temporaire.id_scene = s.id_scene";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function viderTableTemporaire(int $id_festival): void
    {
        $requete = "DELETE FROM liste_spectacle_temporaire WHERE id_festival = :id_festival;";
        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();
    }

    public function ajouterSpectacleAuFestival(int $id_festival, int $id_spectacle, int $id_scene): void
    {
        $requete = "INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES (:id_festival, :id_spectacle, :id_scene);";
        $stmt = $this->pdoAjouterSpectacle->prepare($requete);

        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->bindParam("id_scene", $id_scene);

        $stmt->execute();
    }

    function getScene(int $id_festival): array
    {
        $requete = "SELECT scene.id_scene, nom
                    FROM scene
                    JOIN liste_scene s on scene.id_scene = s.id_scene
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}