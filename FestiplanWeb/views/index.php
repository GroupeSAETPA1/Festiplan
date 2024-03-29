<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="/Festiplan/FestiplanWeb/datas/img/logo.ico" />
        <title>Festiplan - Page d'Accueil</title>
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/index.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/forms.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components\footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/responsive.css">

        <!-- Font Awesome -->
<!--        <link rel="stylesheet"-->
<!--              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"-->
<!--              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="-->
<!--              crossorigin="anonymous"-->
<!--              referrerpolicy="no-referrer"/>-->
        <script src="https://kit.fontawesome.com/d9b7264c5a.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <!-- GSAP -->  <!-- Jquery -->
        <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
        <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>
        <!-- custom JS -->
        <!-- custom JS -->
        <script src="/Festiplan/FestiplanWeb/static/scripts/index.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/indexResponsive.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
    </head>
    <body>
    <input hidden id="displayInscription" value="<?php echo $displayInscription ?? "" ?>">
    <div class="app">
        <div class="partiePrincipale">
            <div class="formulaire creationCompte">
                <form method="get" action="/Festiplan/FestiplanWeb">
                    <div class="form-duo">
                        <div class="colonneCreationCompte">
                            <label for="nom">
                                Nom :
                            </label>
                            <input type="text" id="nom" name="nom" placeholder="Votre nom :" value="<?php echo $nom ?? "" ?>"
                                   required>
                        </div>
                        <div class="colonneCreationCompte">
                            <label for="prenom">
                                Prénom :
                            </label>
                            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom :"
                                   value="<?php echo $prenom ?? "" ?>"
                                   required>
                        </div>
                    </div>
                    <div class="colonneCreationCompte mail">
                        <label for="mail" id="mail">
                            Email :
                        </label>
                        <input type="email" id="mail" name="email" placeholder="Votre email :"
                               value="<?php echo $email ?? "" ?>"
                               required>
                    </div>
                    <div class="form-duo">
                        <div class="colonneCreationCompte">
                            <label for="identifiantCrea">
                                Identifiant :
                            </label>
                            <input type="text" id="identifiantCrea" name="login" placeholder="Votre identifiant :"
                                   value="<?php echo $login ?? "" ?>"
                                   required>
                        </div>
                        <div class="colonneCreationCompte">
                            <label for="mdpCrea">
                                Mot de passe :
                            </label>
                            <input type="password" id="mdpCrea" name="mdp" placeholder="Votre mot de passe :"
                                   value="<?php echo $mdp ?? "" ?>" minlength="8"
                                   required>
                        </div>
                    </div>
                    <div>
                        <?php if (isset($displaySignInError) && $displaySignInError) {
                            echo $errorMessage;
                        } else {
                            echo "";
                        } ?>
                    </div>
                    <div class="lastSection">
                        <div id="switchToSLogin" class="switchForm"><i class="fa-solid fa-arrow-left"></i> Se connecter
                        </div>
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
                        <label for="identifiant">
                            Identifiant
                        </label>
                        <input type="text" id="identifiant" name="login"
                               placeholder="Entrez votre identifiant :"
                               value="<?php echo $login ?? "" ?>"
                               required>
                    </div>
                    <div class="colonneCreationCompte">
                        <label for="mdp">
                            Mot de passe
                        </label>
                        <input type="password" id="mdp" name="mdp" minlength="8"
                               placeholder="Entrez votre mot de passe :"
                               value="<?php echo $mdp ?? "" ?>"
                               required>
                    </div>
                    <div>
                        <?php if (isset($displayLoginError) && $displayLoginError) {
                            echo $errorMessage;
                        } else {
                            echo "";
                        } ?>
                    </div>
                    <div id="switchToSignup" class="switchForm">Créer un compte <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <input type="submit" class="boutonConnexion" value="Me Connecter">
                    <input hidden name="action" value="connexion">
                </form>
            </div>

        </div>

    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>