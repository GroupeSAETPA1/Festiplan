class UserController {
    private $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function register($email, $nom, $prenom, $pwd, $login) {
        if (!$this->userModel->userExists($email)) {
            $this->userModel->createUser($email, $nom, $prenom, $pwd, $login);
            // Mettre à jour la vue pour indiquer que l'inscription a réussi
        } else {
            // Mettre à jour la vue pour indiquer que l'email est déjà utilisé
        }
    }

   public function connexion($login,$pwd, $pdo) {
      // connecte l'utilisateur
      try{
          if (utilisateurExiste($login,$pwd, $pdo)) {
              $_SESSION['connecte']= true ; 			// Stockage dans les variables de session que l'on est connecté (sera utilisé sur les autres pages)
              $_SESSION['nomClient']= $ligne->nom ;   // Stockage dans les variables de session du nom du client
              $_SESSION['prenomClient']= $ligne->prenom ;// Stockage dans les variables de session du prénom du client
              return true;
          } else {
              return false;
          }
      }
      catch ( Exception $e ) {
          echo "<h1>Erreur de connexion à la base de données ! </h1>";
          return false;
      }
    }
}