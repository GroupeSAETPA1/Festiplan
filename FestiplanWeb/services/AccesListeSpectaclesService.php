<?php

namespace services;

class AccesListeSpectaclesService
{

    private ?\PDO $pdoLectureSpectacle = null;

    public function __construct(\PDO $pdoLectureSpectacle)
    {
        $this->pdoLectureSpectacle = $pdoLectureSpectacle;
    }

    public function getSpectacles (int $id_festival) : array
    {
        $requete = "SELECT spectacle.id_spectacle, spectacle.nom, description, illustration, duree, c.nom as categorie 
                    FROM spectacle 
                    JOIN categorie c on c.id_categorie = spectacle.id_categorie
                    JOIN spectacle_festival_scene ls on spectacle.id_spectacle = ls.id_spectacle
                    WHERE ls.id_festival = :id_festival";

        $stmt = $this->pdoLectureSpectacle->prepare($requete);
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

        $stmt = $this->pdoLectureSpectacle->prepare($requete);
        $stmt->bindParam(":id_festival", $id_festival_actif);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Retire un spectacle de la liste des spectacles du festival
     * @param string $id_spectacle
     * @param string $id_festival_actif
     * @return void
     */
    public function retirerSpectacle(string $id_spectacle, string $id_festival_actif)
    {
        $requete = "DELETE FROM spectacle_festival_scene WHERE id_spectacle = :id_spectacle AND id_festival = :id_festival";

        $stmt = $this->pdoLectureSpectacle->prepare($requete);
        $stmt->bindParam(":id_spectacle", $id_spectacle);
        $stmt->bindParam(":id_festival", $id_festival_actif);
        $stmt->execute();
    }
}