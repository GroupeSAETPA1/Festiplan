<?php
include ('../model/User.php');
class UserController {
    private $userModel;
    private $pdo;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function inscription($email, $nom, $prenom, $pwd, $login): bool {
        if (!$this->userModel->utilisateurExiste($email, $pwd, $this->pdo)) {
            return $this->userModel->createUser($email, $nom, $prenom, $pwd, $login, $this->pdo);
        } else {
            echo "Il y a déja un utilisateur avec l'adresse mail " . $email
                . ".\n Veuillez réessayer avec une autre adresse.";
            return false;
        }
    }

   public function connexion($login,$pwd):bool {
      // connecte l'utilisateur
      try{
          if ($this->userModel->utilisateurExiste($login,$pwd, $this->pdo)) {
              $_SESSION['connecte']= true ; 			// Stockage dans les variables de session que l'on est connecté (sera utilisé sur les autres pages)
              $_SESSION['nomClient']= $ligne->nom ;   // Stockage dans les variables de session du nom du client
              $_SESSION['prenomClient']= $ligne->prenom ;// Stockage dans les variables de session du prénom du client
              return true;
          } else {
              return false;
          }
      }
      catch (Exception $e ) {
          echo "<h1>Erreur de connexion à la base de données ! </h1>";
          return false;
      }
   }

   function SetPDO($User, $Mdp): pdo {
       $this->pdo = createPdo($User,$Mdp);
   }
}
