<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festiplan- creation spectacle 2</title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/customInput.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/responsivePage2.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/creationSpectacle.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/createSpectaclePage2.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/intervenantInputs.css">

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/index.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- Scripts -->
    <!-- GSAP -->  <!-- Jquery -->
    <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
    <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>
    <!-- custom js -->
    <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
    <script src="/Festiplan/FestiplanWeb/static/scripts/customInput.js" defer></script>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
<div class="retour">
    <button class="Retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
</div>
<div class="app">
    <div class="wrapper">
        <div class="container flex">
            <div class="title">
                <h1>Création d'un spectacle</h1>
            </div>
            <section>
                <div class="custom-select">
                    <label for="inter">Intervenants sur scene:</label>
                    <div class="text">Veuillez rentrer l'email du compte, </br>le compte n'existe pas, vous pouvez le crer avec le + </div>
                    <div class="row">
                        <input id="inter" type="text" placeholder="exemple@mail.fr">
                        <div class="button-add-inter">
                            <i class="fa-solid fa-plus"></i>
                            Ajouter l'intervenant
                        </div>
                    </div>
                    <div class="selections">
                        <!-- rempli avec le js -->
                    </div>
                </div>
            </section>
            <hr>
            <section class="interHorsScene">
                <div class="custom-select">
                    <label for="inter">Intervenants hors scene:</label>
                    <div class="text">Veuillez rentrer l'email du compte, </br>le compte n'existe pas, vous pouvez le crer avec le + </div>
                    <div class="row">
                        <input id="interHorsScene" type="text" placeholder="exemple@mail.fr">
                        <div class="button-add-inter">
                            <i class="fa-solid fa-plus"></i>
                            Ajouter l'intervenant
                        </div>
                    </div>
                    <div class="selections">
                        <!-- rempli avec le js -->
                    </div>
                </div>
            </section>
            <div class="formulaire creationCompte">
                <form method="get" action="/Festiplan/FestiplanWeb">
                    <div class="form-duo">
                        <div class="colonneCreationCompte">
                            <label for="nom">
                                Nom :
                            </label>
                            <input type="text" id="nom" name="nom" placeholder="Votre nom :" required>
                        </div>
                        <div class="colonneCreationCompte">
                            <label for="prenom">
                                Prénom :
                            </label>
                            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom :" required>
                        </div>
                    </div>
                    <div class="colonneCreationCompte mail">
                        <label for="mail" id="mail">
                            Email :
                        </label>
                        <input type="email" id="mail" name="email" placeholder="Votre email :" required>
                    </div>
                    <div class="form-duo">
                        <div class="colonneCreationCompte">
                            <label for="identifiantCrea">
                                Identifiant :
                            </label>
                            <input type="text" id="identifiantCrea" name="login" placeholder="Votre identifiant :" required>
                        </div>
                        <div class="colonneCreationCompte">
                            <label for="mdpCrea">
                                Mot de passe :
                            </label>
                            <input type="password" id="mdpCrea" name="mdp" placeholder="Votre mot de passe :" minlength="8" required>
                        </div>
                    </div>
                    <div class="lastSection">
                        <input type="submit" class="boutonCreation" value="Créer le compte">
                        <input hidden name="action" value="inscription">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>