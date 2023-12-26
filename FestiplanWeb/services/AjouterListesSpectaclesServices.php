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
        $requete = "SELECT spectacle.id_spectacle, spectacle.nom, description, illustration, duree, c.nom as categorie, 'ajouterSpectacle' as action
                    FROM spectacle 
                    JOIN categorie c on c.id_categorie = spectacle.id_categorie
                    WHERE spectacle.id_spectacle NOT IN (SELECT id_spectacle FROM liste_spectacle WHERE id_festival = :id_festival)";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ajouterSpectacle(int $id_festival, int $id_spectacle)
    {
        $requete = "INSERT INTO liste_spectacle_temporaire (id_festival, id_spectacle) VALUES (:id_festival, :id_spectacle)";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();
    }

    public function retirerSpectacle(int $id_festival, int $id_spectacle)
    {
        $requete = "DELETE FROM liste_spectacle_temporaire WHERE id_festival = :id_festival AND id_spectacle = :id_spectacle";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();
    }

    public function getSpectaclesTemporaire () : array
    {
        $requete = "SELECT id_spectacle
                    FROM liste_spectacle_temporaire";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->execute();

        $tab = $stmt->fetchAll();
        $result = array();

        foreach ($tab as $item) {
            $result[] = $item['id_spectacle'];
        }

        return $result;
    }

    public function viderTableTemporaire(): void
    {
        $requete = "DELETE FROM festiplan.liste_spectacle_temporaire";
        $this->pdoAjouterSpectacle->exec($requete);
    }

    public function ajouterSpectacleAuFestival(int $id_festival, int $id_spectacle)
    {
        $requete = "INSERT INTO liste_spectacle (id_festival, id_spectacle) VALUES (:id_festival, :id_spectacle);";
        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();
    }

}