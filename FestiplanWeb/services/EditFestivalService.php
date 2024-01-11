<?php

namespace services;

use PDO;

class EditFestivalService
{
    private PDO $editFestival;

    public function __construct(PDO $pdo)
    {
        $this->editFestival = $pdo;
    }

    public function recupererInfoFestival($idFestival)
    {
        $requete = $this->editFestival->prepare("SELECT * FROM festival WHERE id_festival = :id");
        $requete->bindParam(':id', $idFestival);
        $requete->execute();
        return $requete->fetchAll();
    }

    public function recupererCategorie() {
        $requete = $this->editFestival->prepare("SELECT id_categorie , nom FROM categorie");
        $requete ->execute();
        return $requete->fetchAll();
    }
}