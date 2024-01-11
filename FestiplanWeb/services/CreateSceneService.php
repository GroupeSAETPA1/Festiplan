<?php

namespace services;

class CreateSceneService
{
    private \PDO $pdoAjouterScene;

    public function __construct(\PDO $pdoAjouterScene)
    {
        $this->pdoAjouterScene = $pdoAjouterScene;
    }

    public function creerScene(string $nom, string $taille, int $nombre_spectateur, float $longitude, float $latitude)
    {
        $sql = "INSERT INTO scene (nomScene, id_taille, nb_spectateurs, longitude, latitude) VALUES (:nom, :taille, :nombre_spectateur, :longitude, :latitude)";
        $stmt = $this->pdoAjouterScene->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':taille', $taille);
        $stmt->bindParam(':nombre_spectateur', $nombre_spectateur, \PDO::PARAM_INT);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':latitude', $latitude);
        $stmt->execute();
    }

}