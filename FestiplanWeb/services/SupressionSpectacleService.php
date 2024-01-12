<?php

namespace services;

use PDO;

class SupressionSpectacleService
{

    private PDO $pdoSupressionSpectacle;

    public function __construct(PDO $pdo)
    {
        $this->pdoSupressionSpectacle = $pdo;
    }

    public function recupSpectacle(int $id_spectacle) : array
    {
        $requete = "SELECT illustration, spectacle.nom, c.nom AS categorie, duree, description
                    FROM spectacle
                    JOIN festiplan.categorie c on c.id_categorie = spectacle.id_categorie
                    WHERE id_spectacle = :id_spectacle;";

        $stmt = $this->pdoSupressionSpectacle->prepare($requete);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function supression(int $id_spectacle) : void
    {
        $requete = "DELETE 
                    FROM spectacle
                    WHERE id_spectacle = :id_spectacle;";

        $stmt = $this->pdoSupressionSpectacle->prepare($requete);
        $stmt->bindParam("id_spectacle", $id_spectacle);
        $stmt->execute();
    }


}