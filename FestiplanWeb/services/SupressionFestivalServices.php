<?php

namespace services;

use PDO;
use PDOException;

class SupressionFestivalServices
{

    private PDO $pdoSupressionFestival;


    public function __construct(PDO $pdo)
    {
        $this->pdoSupressionFestival = $pdo;
    }

    public function recupFestival(int $id_festival): array
    {
        $requete = "SELECT id_festival, festival.nom, illustration, debut, fin, description, c.nom as categorie
                    FROM festival
                    JOIN categorie c on c.id_categorie = festival.id_categorie
                    WHERE id_festival = :id_festival;";

        $stmt = $this->pdoSupressionFestival->prepare($requete);
        $stmt->bindParam("id_festival", $id_festival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function supprimer(int $id_festival): void
    {
    
    echo 'fonction';
        try {
            $requete1 = $this ->pdoSupressionFestival->prepare("DELETE FROM spectacle_festival_scene WHERE id_festival = :id;");

            $requete2 = $this ->pdoSupressionFestival->prepare("DELETE FROM liste_scene WHERE id_festival = :id;");
            $requete3 = $this ->pdoSupressionFestival->prepare("DELETE FROM liste_organisateur WHERE id_festival = :id;");
            $requete4 = $this ->pdoSupressionFestival->prepare("DELETE FROM festival WHERE id_festival = :id;");
            $requete1->bindParam("id", $id_festival);
            $requete2->bindParam("id", $id_festival);
            $requete3->bindParam("id", $id_festival);
            $requete4->bindParam("id", $id_festival);
            $this->pdoSupressionFestival->beginTransaction();
            $requete1 -> execute();
            $requete2 -> execute();
            $requete3 -> execute();
            $requete4 -> execute();
            $this->pdoSupressionFestival->commit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

}
