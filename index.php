<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festiplan - Page d'Acceuil</title>
    <link rel="stylesheet" href="src/style/css/index.css">
    <link rel="icon" href="src/assets/img/Favicon.png" /> <!--  A remplacer quand on aura la favicon  -->
</head>
<body>
    <div class="display">
        <div class="presentation">
            <img src="src/assets/img/Logo.png" alt="Logo de Festiplan">
                <div class="titre">Festiplan</div>
                <p>
                    Créer et gérer tous vos évenements,<br>
                    avec facilité et ergonomie.
                </p>
        </div>
            <form class="formulaire" hidden>
                Identifiant
                <br>
                <input type="text" placeholder="Veuillez renseigner votre identifiant :"><br>
                Mot de passe<br>
                <input type="password" placeholder="Veuillez renseigner votre mot de passe :"><br> <!-- TODO mettre des longeur max d'id et de mdp -->
                <a href="">Créer un compte (mettre fleche font awesome ici)</a><br>
                <input type="submit" class="connexion" value="Me Connecter">
            </form>
            <form class="creationCompte">
                <div>
                    <div class="colonneCreationCompte">
                        Nom :<br>
                        <input type="text" placeholder="Votre nom :">
                    </div>
                    <div class="colonneCreationCompte">
                        Prénom :<br>
                        <input type="text" placeholder="Votre prénom :">
                    </div>
                </div><br>
                Email :<br>
                <input type="email" placeholder="Votre email :"><br>
                <div>
                    <div class="colonneCreationCompte">
                        Identifiant :<br>
                        <input type="text" placeholder="Votre identifiant :">
                    </div>
                    <div class="colonneCreationCompte">
                        Mot de passe :<br>
                        <input type="text" placeholder="Votre mot de passe :">
                    </div>
                </div>
                <button class="retour">(fleche fa) Retour</button>
                <button type="submit" class="connexion">Créer le compte</button>
            </form>
        </div>
    <footer>
    </footer>
</body>
</html>