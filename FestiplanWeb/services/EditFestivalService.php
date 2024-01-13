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

    public function editionFestival(
        $nom ,
        $description ,
        $illustration ,
        $ddd ,
        $ddf ,
        $categorie ,
        $heure_debut_spectacle  ,
        $heure_fin ,
        $duree ,
        $id_responsable ,
        $id)
    {
        $illustration == NULL ? $illustration = "null" : $illustration = $illustration;
        $requete = $this->editFestival->prepare("UPDATE festival SET nom = :nom , 
                    description = :description , 
                    illustration = :illustration , 
                    debut = :debut , 
                    fin = :fin , id_categorie = :categorie , 
                    heure_debut_spectacles = :heure_debut_spectacles , 
                    heure_fin_spectacles = :heure_fin_spectacles , 
                    duree_entre_spectacle = :duree_entre_spectacle , 
                    id_responsable = :id_responsable WHERE id_festival = :id");
        $this->editFestival->beginTransaction();
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':illustration', $illustration);
        $requete->bindParam(':debut', $ddd);
        $requete->bindParam(':fin', $ddf);
        $requete->bindParam(':categorie', $categorie);
        $requete->bindParam(':heure_debut_spectacles', $heure_debut_spectacle);
        $requete->bindParam(':heure_fin_spectacles', $heure_fin);
        $requete->bindParam(':duree_entre_spectacle', $duree);
        $requete->bindParam(':id_responsable', $id_responsable);
        $requete->bindParam(':id', $id);
        $requete->execute();
        $this->editFestival->commit();
    }
}