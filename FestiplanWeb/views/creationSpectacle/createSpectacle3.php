<?php

// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}
?>
<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/Festiplan/FestiplanWeb/datas/img/logo.ico" />
    <title>Festiplan- creation spectacle 2</title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svgInFolder.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/customInput.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/creationSpectacle.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/createSpectaclePage2.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/intervenantInputs.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/index.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/responsivePage2.css">

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
    <script src="/Festiplan/FestiplanWeb/static/scripts/creationSpectacle/inputIntervenantsScene.js" defer></script>
    <script src="/Festiplan/FestiplanWeb/static/scripts/creationSpectacle/creerCompte.js" defer></script>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
<div class="retour">
    <a href="/Festiplan/FestiplanWeb/?controller=CreateSpectacle">
        <button class="btn-retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
    </a>
</div>
<div class="app">
    <div class="wrapper">
        <form method="post" action="index.php">
            <!-- formulaire de confirmation -->
            <div class="container">
                <div class="titre">
                    <h1>Etes vous sur de vouloir créer ce spectacle ?</h1></br>
                </div>
                <!-- recap des infos -->
                <div class="recapInfo">
                    <div class="info">
                        <h2>Nom du spectacle</h2>
                        <p><?php echo $_SESSION['nomSpectacle'] ?></p>
                    </div>
                    <div class="info">
                        <h2>Description</h2>
                        <p><?php echo $_SESSION['descriptionSpectacle'] ?></p>
                    </div>
                    <div class="info">
                        <h2>Durée</h2>
                        <p><?php echo $_SESSION['dureeSpectacle'] ?> minutes</p>
                    </div>
                    <div class="info">
                        <h2>Taille de la scène</h2>
                        <p><?php echo $taille;?> </p>
                    </div>
                    <div class="info">
                        <h2>Catégorie</h2>
                        <p><?php echo $categorie;?></p>
                    </div>
                    <div class="info">
                        <h2>Photo</h2>
                        <p><?php echo $_SESSION['photoSpectacle'] ?></p>
                    </div>
                    <div class="info">
                        <h2>Intervenants</h2>
                        <div class="intervenants">
                            <?php
                            foreach ($_SESSION['inter'] as $inter) {
                                ?>
                                <p><?php echo $inter ?></p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="info">
                        <h2>Intervenants hors scène</h2>
                        <div class="intervenants">
                            <?php
                            foreach ($_SESSION['interHorsScene'] as $interHorsScene) {
                                ?>
                                <p><?php echo $interHorsScene ?></p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- boutons de confirmation -->
                <input hidden name="action" value="validerCreation">
                <input hidden name="controller" value="CreateSpectacle">
                <div class="valid-annul-placement flex-row">
                    <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">
                        <div class="annulChoix lastButton">
                            <i class="fa-regular fa-circle-xmark"></i> Abandonner la création
                        </div>
                    </a>
                    <button type="submit" class="valider page-suivante lastButton">
                        Valider<i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>