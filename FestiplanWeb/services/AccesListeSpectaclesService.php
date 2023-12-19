<?php

namespace services;

class AccesListeSpectaclesService
{
    public function __construct()
    {
    }

    public function getSpectacles (\PDO $pdo) : array
    {
        $requete = "SELECT id_spectacle, spectacle.nom, description, illustration, duree, c.nom as categorie 
                    FROM spectacle 
                    JOIN festiplan.categorie c on c.id_categorie = spectacle.id_categorie";

        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}