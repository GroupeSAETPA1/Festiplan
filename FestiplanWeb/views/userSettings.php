<?php

// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/Festiplan/FestiplanWeb/datas/img/logo.ico" />
    <title>Festiplan- creation spectacle 1</title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/creationSpectacle.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/userSettings/userSettings.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/userSettings/responsive.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d9b7264c5a.js" crossorigin="anonymous"></script>
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
            <button class="btn-retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
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
                    <?php if (isset($changerInfo) && $changerInfo) { ?>
                        <p class="successMessage">Vos informations ont bien été modifiées</p>
                    <?php } ?>
                    <?php if (isset($displayChangerInfoError) && $displayChangerInfoError) { ?>
                        <p class="errorMessage"><?php echo $errorMessage ?></p>
                    <?php } ?>
                    <form method="post" action="index.php">
                        <div>
                            <h3>Nom :</h3>
                            <input type="text" name="nom" placeholder="Tapez votre nom" value="<?= $_SESSION['nom'] ?>"/>
                        </div>
                        <div>
                            <h3>Prenom :</h3>
                            <input type="text" name="prenom" placeholder="Tapez votre prenom" value="<?= $_SESSION['prenom'] ?>"/>
                        </div>

                        <div>
                            <h3>Email :</h3>
                            <input type="email" name="email" placeholder="Tapez votre email" value="<?= $_SESSION['email'] ?>"/>
                        </div>
                        <div>
                            <h3>Identifiant :</h3>
                            <input type="text" name="login" placeholder="Tapez votre login" value="<?= $_SESSION['login'] ?>"/>
                        </div>
                        <div class="buttons">
                            <input hidden name="action" value="changerInfo">
                            <input hidden name="controller" value="Settings">
                            <a href="/Festiplan/FestiplanWeb/index.php?controller=Home&action=settings">
                                <button type="button" class="annuler"><i class="fa-solid fa-xmark"></i>Annuler</button>
                            </a>
                            <button type="submit" class="valider"><i class="fa-solid fa-check"></i> Valider modfications</button>
                        </div>
                    </form>
                </div>
                <div class="block">
                    <div class="informations">
                        <h2>Changer le mot de passe :</h2>
                        <?php if (isset($changerMdp) && $changerMdp) { ?>
                            <p class="successMessage">Votre mot de passe a bien été modifié</p>
                        <?php } ?>
                        <?php if (isset($displayChangerMdpError) && $displayChangerMdpError) { ?>
                            <p class="errorMessage"><?php echo $errorMessage ?></p>
                        <?php } ?>
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
                                <input hidden name="controller" value="Settings">
                                <a href="/Festiplan/FestiplanWeb/index.php?controller=Home&action=settings">
                                    <button type="button" class="annuler"><i class="fa-solid fa-xmark"></i> Annuler</button>
                                </a>
                                <button type="submit" class="valider"><i class="fa-solid fa-check"></i> Valider modfifications</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="title">
                <h1>Parametres</h1>
            </div>
            <div class="information-row">
                <!-- suppression du compte -->
                <div class="informations block">
                    <h2>Supprimer le compte :</h2>
                    <form method="post" action="index.php">
                        <div class="inputs">
                            <div>
                                <h3>Confirmer mot de passe :</h3>
                                <?php if (isset($displaySuppressionError) && $displaySuppressionError) { ?>
                                    <p class="errorMessage"><?php echo $errorMessage ?></p>
                                <?php } ?>
                                <input type="password" name="confirmMdp"/>
                            </div>
                        </div>
                        <div class="buttons">
                            <input hidden name="action" value="supprimerCompte">
                            <input hidden name="controller" value="Settings">
                            <button type="submit" class="supprimerCompte"><i class="fa-solid fa-trash"></i> Supprimer le compte</button>
                        </div>
                    </form>
                </div>
                <!-- se déconnecter -->
                <div class="block">
                    <div class="informations">
                        <h2>Se deconnecter :</h2>
                        <h3>En se déconnectant, vous serrez redirigé vers la page de connexion.</h3>
                        <form method="post" action="index.php">
                            <div class="buttons">
                                <input hidden name="action" value="deconnexion">
                                <input hidden name="controller" value="Settings">
                                <button type="submit" class="decconnecter"><i class="fa-solid fa-right-from-bracket"></i> Deconnexion</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>