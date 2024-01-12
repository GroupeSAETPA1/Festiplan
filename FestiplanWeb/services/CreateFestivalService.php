<?php

namespace services;

use PDO ;

class createFestivalService
{
    private PDO $pdoCreationFestival;

    public function __construct(PDO $pdo) 
    {    
        $this->pdoCreationFestival = $pdo;
    }   

    public function recupererCategorie() {
        try {
            $sql = $this -> pdoCreationFestival->prepare('SELECT id_categorie , nom FROM categorie');
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    public  function recupererSpectacle() {
        try {
            $sql = $this -> pdoCreationFestival->prepare('SELECT id_spectacle , nom FROM spectacle');
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }

    public function recupererTailleScene() {
        try {
            $sql = $this -> pdoCreationFestival->prepare('SELECT nom AS nomScene , nb_spectateurs FROM scene');
            $sql->execute();
            return $sql -> fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }

    public function emailExiste($email): bool
    {
        $requeteEmailExiste = $this -> pdoCreationFestival ->prepare("SELECT id_utilisateur FROM utilisateurs WHERE mail = :email");
        $requeteEmailExiste->bindParam(':email', $email);
        $requeteEmailExiste->execute();
        return $requeteEmailExiste->rowCount() > 0;
    }

    public function sceneExiste($scene): bool
    {
        $requeteSceneExiste = $this -> pdoCreationFestival -> prepare( "SELECT * FROM SCENE WHERE nom = :nom");
        $requeteSceneExiste->bindParam(':nom' , $scene);
        $requeteSceneExiste->execute();
        return $requeteSceneExiste->rowCount() > 0 ;
    }

    public function spectacleExiste($spectacle) : bool
    {
        $requeteSpectacleExiste = $this -> pdoCreationFestival -> prepare( "SELECT * FROM SPECTACLE WHERE nom = :spectacle");
        $requeteSpectacleExiste->bindParam('spectacle' , $spectacle);
        $requeteSpectacleExiste -> execute();
        return $requeteSpectacleExiste->rowCount() > 0;
    }
    public  function insertionFestival($nom , $description , $image , $debut , $fin , $categorie , $responsable , $dureeEntreSpectacle , $heure_debut , $heure_fin , $liste_organisateur , $liste_scene) {

        $this->pdoCreationFestival->beginTransaction();
        $insertionFestival = $this -> pdoCreationFestival -> prepare("INSERT INTO festival (nom , description , illustration , debut , fin , id_categorie , id_responsable , duree_entre_spectacle , heure_debut_spectacles , heure_fin_spectacles) VALUES (:nom , :description , :image , :debut , :fin , :categorie , :responsable , :dureeEntreSpectacle , :heure_debut , :heure_fin);");
        $insertionListeScene = $this -> pdoCreationFestival -> prepare("INSERT INTO liste_scene (id_festival , id_scene) VALUES (:id_festival , :id_scene)");
        $insertionListeOrga = $this -> pdoCreationFestival -> prepare("INSERT INTO liste_organisateur (id_festival , id_organisateur) VALUES (:id_festival , :id_organisateur)");
        $insertionFestival->bindParam(':nom' , $nom);
        $insertionFestival->bindParam(':description' , $description);
        $insertionFestival->bindParam(':categorie' , $categorie);
        $insertionFestival->bindParam(':image' , $image);
        $insertionFestival->bindParam(':debut' , $debut);
        $insertionFestival->bindParam(':fin' , $fin);
        $insertionFestival->bindParam(':responsable' , $responsable);
        $insertionFestival->bindParam(':dureeEntreSpectacle' , $dureeEntreSpectacle);
        $insertionFestival->bindParam(':heure_debut' , $heure_debut);
        $insertionFestival->bindParam(':heure_fin' , $heure_fin);
        $insertionFestival->execute();
        $lastInsertedId = $this->pdoCreationFestival->lastInsertId();

        foreach ($liste_scene as $scene) {
            $insertionListeScene->bindParam(':id_festival' , $lastInsertedId);
            htmlspecialchars($insertionListeScene->bindParam(':id_scene' , $scene));
            $insertionListeScene->execute();
        }
        foreach ($liste_organisateur as $orga) {
            $insertionListeOrga->bindParam(':id_festival' , $lastInsertedId);
            htmlspecialchars($insertionListeOrga->bindParam(':id_organisateur' , $orga));
            $insertionListeOrga->execute();
        }
        $this->pdoCreationFestival->commit();
    }

    public  function insertionOrganisateur($id_festival , $listeOrganisateur) {

    }

    public function dureeSpectacle($spectacle)
    {
        $total = 0;
        $requeteDureeSpectacle = $this -> pdoCreationFestival -> prepare("SELECT duree FROM spectacle WHERE nom = :spectacle");
        foreach ($spectacle as $ligne) {
           $requeteDureeSpectacle->bindParam(':spectacle' , $ligne);
              $requeteDureeSpectacle->execute();
              $total += $requeteDureeSpectacle->fetch()['duree'];
        }
        return $total;
    }

    public function  recupererIdCategorie($nom) {
        $requeteIdCategorie = $this -> pdoCreationFestival -> prepare("SELECT id_categorie FROM categorie WHERE nom = :nom");
        $requeteIdCategorie->bindParam(':nom' , $nom);
        $requeteIdCategorie->execute();
        return $requeteIdCategorie->fetch()['id_categorie'];
    }

    public function recupererIdScene($tableauScene) {
        $requete = $this -> pdoCreationFestival -> prepare("SELECT id_scene FROM scene WHERE nom = :nom");
        $resultat = array();
        foreach ($tableauScene as $ligne) {
            $requete->bindParam(':nom' , $ligne);
            $requete->execute();
            $resultat[] = $requete->fetch()['id_scene'];
        }
        return $resultat ;
    }

    public function recupererIdOrga($tableauOrga) {
        $requete = $this -> pdoCreationFestival -> prepare("SELECT id_utilisateur FROM utilisateurs WHERE mail = :mail");
        $resultat = array();
        foreach ($tableauOrga as $ligne) {
            $requete->bindParam(':mail' , $ligne);
            $requete->execute();
            $resultat[] = $requete->fetch()['id_utilisateur'];
        }
        return $resultat ;
    }
}