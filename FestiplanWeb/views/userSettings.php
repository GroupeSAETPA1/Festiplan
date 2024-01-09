<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festiplan- creation spectacle 1</title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/creationSpectacle.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/userSettings/userSettings.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/userSettings/responsive.css">

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
<div class="app">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
    <div class="retour">
        <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">
            <button class="Retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
        </a>
    </div>
    <div class="wrapper">
        <div class="container">
            <div class="title">
                <h1>Mes informations</h1>
            </div>
            <div class="information-row">
                <!-- Premier paquet pour le premier cube d'information-->
                <div class="informations block">

                    <h2>Changer les informations personnelles:</h2>
                    <form method="post" action="index.php">
                        <div>
                            <h3>Nom :</h3>
                            <input type="text" name="nom" placeholder="Tapez votre nom" value="<?php echo $nom ?: "" ?>"/>
                        </div>
                        <div>
                            <h3>Prenom :</h3>
                            <input type="text" name="prenom" placeholder="Tapez votre prenom" value="<?php echo $prenom ?: "" ?>"/>
                        </div>

                        <div>
                            <h3>Email :</h3>
                            <input type="email" name="email" placeholder="Tapez votre email" value="<?php echo $email ?: "" ?>"/>
                        </div>
                        <div>
                            <h3>Identifiant :</h3>
                            <input type="text" name="login" placeholder="Tapez votre login" value="<?php echo $login ?: "" ?>"/>
                        </div>
                        <div class="buttons">
                            <input hidden name="action" value="chnagerInfo">
                            <input hidden name="controller" value="Home">
                            <a href="/Festiplan/FestiplanWeb/index.php?controller=Home&action=settings">
                                <button type="button" class="annuler">Annuler</button>
                            </a>
                            <button type="submit" name="action" class="valider">Valider modfifications</button>
                        </div>
                    </form>
                </div>
                <div class="block">
                    <div class="informations">
                        <h2>Changer le mot de passe :</h2>
                        <form method="post" action="index.php">
                            <div class="inputs">
                                <div>
                                    <h3>Ancien mot de passe :</h3>
                                    <input type="password" name="oldMdp"/>
                                </div>
                                <div>
                                    <h3>Nouveau mot de passe :</h3>
                                    <input type="password" name="newMdp"/>
                                </div>
                                <div>
                                    <h3>Confirmer mot de passe :</h3>
                                    <input type="password" name="confirmMdp""/>
                                </div>
                            </div>

                            <div class="buttons">
                                <input hidden name="action" value="changerMdp">
                                <input hidden name="controller" value="Home">
                                <a href="/Festiplan/FestiplanWeb/index.php?controller=Home&action=settings">
                                    <button type="button" class="annuler">Annuler</button>
                                </a>
                                <button type="submit" name="action" class="valider">Valider modfifications</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="title">
                <h1>Parametres</h1>
            </div>
            <div class="information-row deleteAccount">
                <!-- suppression du compte -->
                <div class="informations block">
                    <h2>Supprimer le compte :</h2>
                    <form method="post" action="index.php">
                        <div class="inputs">
                            <div>
                                <h3>Confirmer mot de passe :</h3>
                                <input type="password" name="confirmMdp"/>
                            </div>
                        </div>
                        <div class="buttons">
                            <input hidden name="action" value="supprimerCompte">
                            <input hidden name="controller" value="Home">
                            <a href="/Festiplan/FestiplanWeb/index.php?controller=Home&action=settings">
                                <button type="button" class="annuler">Annuler</button>
                            </a>
                            <button type="submit" name="action" class="valider">Supprimer le compte</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>