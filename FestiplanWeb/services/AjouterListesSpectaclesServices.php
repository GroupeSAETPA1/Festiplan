<?php

namespace services;

class AjouterListesSpectaclesServices
{
    private \PDO $pdoAjouterSpectacle;

    public function __construct(\PDO $pdoAjouterSpectacle)
    {
        $this->pdoAjouterSpectacle = $pdoAjouterSpectacle;
    }

    public function getSpectaclesDisponible(int $id_festival): array
    {
        $requete = "SELECT spectacle.id_spectacle, spectacle.nom, description, illustration, duree, c.nom AS categorie, 'ajouterSpectacle' AS action, taille_scene
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

    public function getSpectaclesTemporaire(): array
    {
        $requete = "SELECT id_spectacle, s.id_scene, s.nomScene as nom_scene
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

    /**
     * Retourne la liste des scenes du festival
     * @param int $id_festival L'id du festival
     * @return array La liste des scenes du festival
     */
    function getScene(int $id_festival): array
    {
        $requete = "SELECT scene.id_scene, nomScene as nom, ts.id_taille, taille
                    FROM scene
                    JOIN liste_scene s on scene.id_scene = s.id_scene
                    JOIN festiplan.taille_scene ts on ts.id_taille = scene.id_taille
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Retourne la durée totale des spectacles du festival
     * @param int $id_festival_actif L'id du festival actif
     * @return int La durée totale des spectacles
     */
    public function dureesSpectacles(int $id_festival_actif): int
    {
        $requete = "SELECT SUM(s.duree) AS duree_totale
                    FROM festival
                    JOIN (
                        SELECT lst.id_festival, lst.id_spectacle
                        FROM liste_spectacle_temporaire lst
                        UNION ALL
                        SELECT sfs.id_festival, sfs.id_spectacle
                        FROM spectacle_festival_scene sfs
                    ) AS combined ON festival.id_festival = combined.id_festival
                    JOIN festiplan.spectacle s ON s.id_spectacle = combined.id_spectacle
                    WHERE festival.id_festival = :id_festival;";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival_actif);
        $stmt->execute();
        return $stmt->fetch()['duree_totale'];
    }

    /**
     * Retourne la durée disponible du festival depuis la date de debut jusqu'à la date de fin
     * @param int $id_festival_actif L'id du festival actif
     * @return int La durée disponible du festival
     */
    public function getDureeDisponibleFestival(int $id_festival_actif) : int
    {
        $requete = "SELECT (fin - debut) / 60 AS duree_disponible
                    FROM festival
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival_actif);
        $stmt->execute();
        return $stmt->fetch()['duree_disponible'];
    }

    /**
     * Retourne la durée d'une journée au festival
     * @param int $id_festival_actif L'id du festival actif
     * @return int La durée totale des spectacles
     */
    public function getDureeJournee(int $id_festival_actif): int
    {
        $requete = "SELECT (heure_fin_spectacles - heure_debut_spectacles) / 60 AS duree_journee
                    FROM festival
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival_actif);
        $stmt->execute();
        return $stmt->fetch()['duree_journee'];
    }

    /**
     * Retourne la durée de la pause entre les spectacles
     * @param int $id_festival_actif
     * @return int
     */
    public function getPause(int $id_festival_actif): int
    {
        $requete = "SELECT duree_entre_spectacle
                    FROM festival
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival_actif);
        $stmt->execute();
        return $stmt->fetch()['duree_entre_spectacle'];
    }

}