<?php

namespace services;

class AccesListeSceneService
{

    private ?\PDO $pdoLectureScene = null;

    public function __construct(\PDO $pdoLectureScene)
    {
        $this->pdoLectureScene = $pdoLectureScene;
    }

    public function getScene (int $id_festival) : array
    {
        $requete = "SELECT scene.id_scene, nom AS nomScene, id_taille, nb_spectateurs, longitude, latitude FROM scene INNER JOIN liste_scene ON scene.id_scene = liste_scene.id_scene WHERE id_festival = :id_festival";

        $stmt = $this->pdoLectureScene->prepare($requete);
        $stmt->bindParam(":id_festival", $id_festival);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getInfoFestival(string $id_festival_actif)
    {
        $requete = "SELECT id_festival, festival.nom, c.nom as categorie
                    FROM festival
                    JOIN categorie c on c.id_categorie = festival.id_categorie
                    WHERE festival.id_festival = :id_festival";

        $stmt = $this->pdoLectureScene->prepare($requete);
        $stmt->bindParam(":id_festival", $id_festival_actif);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Retire une scene de la liste des scene du festival
     * @param string $id_festival
     * @param int $id_scene
     * @return void
     */
    public function retirerScene(string $id_festival, int $id_scene): void
    {
        $requete = "DELETE FROM liste_scene WHERE id_festival = :id_festival AND id_scene = :id_scene";

        $stmt = $this->pdoLectureScene->prepare($requete);

        $stmt->bindParam(":id_festival", $id_festival);
        $stmt->bindParam("id_scene", $id_scene);

        $stmt->execute();

        // on dé-associe la scene du festival
        $requete = "DELETE FROM spectacle_festival_scene WHERE id_festival = :id_festival AND id_scene = :id_scene";

        $stmt = $this->pdoLectureScene->prepare($requete);

        $stmt->bindParam(":id_festival", $id_festival);
        $stmt->bindParam("id_scene", $id_scene);

        $stmt->execute();
    }
}