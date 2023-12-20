<?php

namespace services;

class AjouterLIstesSpectaclesServices
{
    private \PDO $pdoAjouterSpectacle;

    public function __construct(\PDO $pdoAjouterSpectacle)
    {
        $this->pdoAjouterSpectacle = $pdoAjouterSpectacle;
    }

    public function getSpectaclesDisponible (int $id_festival) : array
    {
        $requete = "SELECT spectacle.id_spectacle, spectacle.nom, description, illustration, duree, c.nom as categorie 
                    FROM spectacle 
                    JOIN festiplan.categorie c on c.id_categorie = spectacle.id_categorie
                    WHERE spectacle.id_spectacle NOT IN (SELECT id_spectacle FROM festiplan.liste_spectacle WHERE id_festival = :id_festival)";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ajouterSpectacle(int $id_festival, int $id_spectacle)
    {
        $requete = "INSERT INTO festiplan.liste_spectacle_temporaire (id_festival, id_spectacle) VALUES (:id_festival, :id_spectacle)";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();
    }

    public function retirerSpectacle(int $id_festival, int $id_spectacle)
    {
        $requete = "DELETE FROM festiplan.liste_spectacle_temporaire WHERE id_festival = :id_festival AND id_spectacle = :id_spectacle";

        $stmt = $this->pdoAjouterSpectacle->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();
    }

    

}