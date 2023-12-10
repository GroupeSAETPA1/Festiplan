class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createUser($email, $nom, $prenom, $pwd, $login, $pdo) {
       // inscription d'un utilisateur
       // Renvoie vrai ou faux en fonction si l'utilisateur a été inscrit.

       try {
           if (!utilisateurExiste($email, $pdo)) {
               $req = $pdo->prepare('INSERT INTO utilisateur (email, nom, prenom, pwd, login) VALUES (:email, :nom, :prenom, :pwd, :login)');
               $req->bindParam(':email', $email);
               $req->bindParam(':nom', $nom);
               $req->bindParam(':prenom', $prenom);
               $req->bindParam(':pwd', $pwd);
               $req->bindParam(':login', $login);
               $req->execute();
               ));
               return true;
           } else {
               return false;
           }
       } catch (PDOException $e) {
           echo 'Erreur : ' . $e->getMessage();
           return false;
       }
   }

    public function utilisateurExiste($login,$pwd) {
       // Vérifie si l'utilisateur existe
       // Renvoie vrai ou faux en fonction si l'utilisateur a été trouvé.
       try{
           $maRequete = $pdo->prepare("SELECT nom, prenom from clients where login = :login and pwd = :pwd");
           $maRequete->bindParam(':login', $login);
           $maRequete->bindParam(':pwd', $pwd);
           if ($maRequete->execute()) {
               return $maRequete->rowCount() > 0;
           }
       }
       catch ( Exception $e ) {
           echo "<h1>Erreur de connexion à la base de données ! </h1>";
           return false;
       }
    }


}