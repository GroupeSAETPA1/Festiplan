<?php

namespace services;

use PDO;

class CreateSpectacleService
{

    private PDO $pdoCreationSpectacle;

    public function __construct(PDO $pdo)
    {
        $this->pdoCreationSpectacle = $pdo;
    }

    public function recupererTailleScene() {
        try {
            $sql = $this -> pdoCreationSpectacle->prepare('SELECT * FROM taille_scene');
            $sql->execute();
            return $sql -> fetchAll();
        } catch (PDOException $e) {
            return false ;
        }
    }

    public function recupererCategorie() {
        try {
            $sql = $this -> pdoCreationSpectacle->prepare('SELECT * FROM categorie');
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function ajouterSpectacle(PDO $pdo,string $nomSpectacle, string $descriptionSpectacle, int $dureeSpectacle, int $tailleSceneSpectacle, int $categorieSpectacle, string $photoSpectacle, array $listeInter, array $listInterHorsScene)
    {
        try {
            $sql = $pdo->prepare('INSERT INTO spectacle (nom, description, duree, taille_scene, id_categorie, illustration, responsable_spectacle) VALUES (:nom, :description, :duree, :taille_scene, :categorie, :photo, :responsable_spectacle)');
            $sql->bindParam(':nom', $nomSpectacle);
            $sql->bindParam(':description', $descriptionSpectacle);
            $sql->bindParam(':duree', $dureeSpectacle);
            $sql->bindParam(':taille_scene', $tailleSceneSpectacle);
            $sql->bindParam(':categorie', $categorieSpectacle);
            $sql->bindParam(':photo', $photoSpectacle);
            var_dump($_SESSION);
            $sql->bindParam(':responsable_spectacle', $_SESSION['id_utilisateur']);
            $sql->execute();
            $idSpectacle = $pdo->lastInsertId();
            $this->ajouterInterVenantSurScene($pdo, $idSpectacle, $listeInter);
            $this->ajouterInterHorsScene($pdo, $idSpectacle, $listInterHorsScene);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    private function ajouterInterVenantSurScene(PDO $pdo, string $idSpectacle, array $listeInter): bool
    {
        try {
            foreach ($listeInter as $inter) {
                $sql = $pdo->prepare('INSERT INTO liste_inter_scene (id_spectacle, id_inter) VALUES (:id_spectacle, :id_inter)');
                $sql->bindParam(':id_spectacle', $idSpectacle);
                $sql->bindParam(':id_inter', $inter);
                $sql->execute();
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    private function ajouterInterHorsScene(PDO $pdo, string $idSpectacle, array $listInterHorsScene): bool
    {
        try {
            foreach ($listInterHorsScene as $inter) {
                $sql = $pdo->prepare('INSERT INTO liste_inter_hors_scene (id_spectacle, id_inter) VALUES (:id_spectacle, :id_inter)');
                $sql->bindParam(':id_spectacle', $idSpectacle);
                $sql->bindParam(':id_inter', $inter);
                $sql->execute();
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}