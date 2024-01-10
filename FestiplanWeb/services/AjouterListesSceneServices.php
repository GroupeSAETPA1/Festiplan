<?php

namespace services;

class AjouterListesSceneServices
{
    private \PDO $pdoAjouterScene;

    public function __construct(\PDO $pdoAjouterScene)
    {
        $this->pdoAjouterScene = $pdoAjouterScene;
    }

    public function getScenesDisponible (int $id_festival) : array
    {
        $requete = "SELECT id_scene, nomScene, id_taille, nb_spectateurs, 'ajouterScene' as action FROM festiplan.scene WHERE id_scene NOT IN (SELECT id_scene FROM festiplan.liste_scene WHERE id_festival = :id_festival)";

        $stmt = $this->pdoAjouterScene->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ajouterScene(int $id_festival, int $id_scene): void
    {
        $requete = "INSERT INTO liste_scene_temporaire (id_festival, id_scene) VALUES (:id_festival, :id_scene)";

        $stmt = $this->pdoAjouterScene->prepare($requete);

        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_scene", $id_scene);

        $stmt->execute();
    }

    public function retirerScene(int $id_festival, int $id_scene): void
    {
        $requete = "DELETE FROM liste_scene_temporaire WHERE id_festival = :id_festival AND id_scene = :id_scene";

        $stmt = $this->pdoAjouterScene->prepare($requete);

        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_scene", $id_scene);

        $stmt->execute();
    }

    public function getScenesTemporaire () : array
    {
        $requete = "SELECT liste_scene_temporaire.id_scene, s.nomScene as nom_scene
                    FROM liste_scene_temporaire
                    JOIN festiplan.scene s on liste_scene_temporaire.id_scene = s.id_scene";

        $stmt = $this->pdoAjouterScene->prepare($requete);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function viderTableTemporaire(): void
    {
        $requete = "DELETE FROM festiplan.liste_scene_temporaire";
        $this->pdoAjouterScene->exec($requete);
    }

    public function ajouterSceneAuFestival(int $id_festival, int $id_scene): void
    {
        $requete = "INSERT INTO liste_scene (id_festival, id_scene) VALUES (:id_festival, :id_scene)";
        $stmt = $this->pdoAjouterScene->prepare($requete);

        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_scene", $id_scene);

        $stmt->execute();
    }

    function getScene(int $id_festival): array
    {
        $requete = "SELECT scene.id_scene, nomScene
                    FROM festiplan.scene
                    JOIN festiplan.liste_scene s on scene.id_scene = s.id_scene
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoAjouterScene->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}