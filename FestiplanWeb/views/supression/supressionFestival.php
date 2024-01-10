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
        <meta name="viewport">
        <title>Festiplan - Supression d'un Festival</title>

        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/supression/supression.css">

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
                        <h1>Souhaitez vous supprimer ce festival ? </h1>
                    </div>
                    <div class="recap entete-section">
                        <div>
                            photo, nom, date debut, date fin, catégorie
                        </div>
                        <div>
                            description
                        </div>
                    </div>
                </div>
                <div class="valid-annul-placement flex-row">
                    <div class="annulChoix lastButton">
                         Garder
                    </div>
                    <button type="submit" class="valider page-suivante lastButton">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>
