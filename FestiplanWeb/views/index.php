<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festiplan - Page d'Acceuil</title>
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/index.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/forms.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/footer.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />

    <link rel="icon" href="../static/assets/img/Favicon.png" /> <!--  A remplacer quand on aura la favicon  -->

    <!-- Scripts -->
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>
    <!-- Jquery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JS -->
    <script src="../static/scripts/index.js" type="module" defer></script>

</head>
<body>
<div class="app">
    <div class="partiePrincipale">
        <div class="formulaire creationCompte">
            <form method="get" action="/Festiplan/FestiplanWeb">
                <div class="form-duo">
                    <div class="colonneCreationCompte">
                        <label for="nom" id="nom">
                            Nom :
                        </label>
                        <input type="text" id="nom" placeholder="Votre nom :" value="<?php echo $nom ?>"
                               required>
                    </div>
                    <div class="colonneCreationCompte">
                        <label for="prenom" id="prenom">
                            Prénom :
                        </label>
                        <input type="text" id="prenom" name="prenom" placeholder="Votre prénom :" value="<?php echo $prenom ?>"
                               required>
                    </div>
                </div>
                <div class="colonneCreationCompte">
                    <label for="mail" id="mail">
                        Email :
                    </label>
                    <input type="email" id="mail" name="email" placeholder="Votre email :" value="<?php echo $email ?>"
                           required>
                </div>
                <div class="form-duo">
                    <div class="colonneCreationCompte">
                        <label for="identifiantCrea" id="identifiantCrea">
                            Identifiant :
                        </label>
                        <input type="text" id="identifiantCrea" name="login" placeholder="Votre identifiant :" value="<?php echo $login ?>"
                               required>
                    </div>
                    <div class="colonneCreationCompte">
                        <label for="mdpCrea" id="mdpCrea">
                            Mot de passe :
                        </label>
                        <input type="password" id="mdpCrea" name="mdp" placeholder="Votre mot de passe :" value="<?php echo $mdp ?>"
                               required>
                    </div>
                </div>
                <div class="form-duo">
                    <button class="retour">
                        <i class="fa-solid fa-arrow-left"></i>
                        Retour
                    </button>
                    <input type="submit" class="boutonCreation" value="Créer le compte">
                    <input hidden name="action" value="inscription">
                </div>
            </form>
        </div>
        <div class="presentation">
            <i class="fa-solid fa-calendar-days"></i>
            <div class="titre">Festiplan</div>
            <p>
                Créer et gérer tous vos évenements,<br>
                avec facilité et ergonomie.
            </p>
        </div>
        <div class="formulaire connexion">
            <form method="get" action="/Festiplan/FestiplanWeb">
                <div class="colonneCreationCompte">
                    <label for="identifiant" id="identifiant">
                        Identifiant
                    </label>
                    <input type="text" id="identifiant" name="login"
                           placeholder="Entrez votre identifiant :"
                           value="<?php echo $login ?>"
                           required>
                </div>
                <div class="colonneCreationCompte">
                    <label for="mdp" id="mdp">
                        Mot de passe
                    </label>
                    <input type="password" id="mdp" name="mdp"
                           placeholder="Entrez votre mot de passe :"
                           value="<?php echo $mdp ?>"
                           required>
                </div>
                <button class="creerCompte">Créer un compte <i class="fa-solid fa-arrow-right"></i></button>
                <input type="submit" class="boutonConnexion" value="Me Connecter">
                <input hidden name="action" value="connexion">
            </form>
        </div>

    </div>
</div>
<!--<?php include_once "/Festiplan/FestiplanWeb/static/components/footer.php" ?>-->
</body>
</html>