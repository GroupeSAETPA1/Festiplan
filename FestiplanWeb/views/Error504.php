<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Festiplan - Erreur 504</title>
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/index.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/forms.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components\footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/responsive.css">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/d9b7264c5a.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <!-- GSAP -->  <!-- Jquery -->
        <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
        <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>
        <!-- custom JS -->
        <!-- custom JS -->
        <script src="/Festiplan/FestiplanWeb/static/scripts/index.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/indexResponsive.js" defer></script>
    </head>
    <body>
    <div class="app">
        <div class="partiePrincipale">
            <div class="presentation">
                <i class="fa-regular fa-face-frown"></i>
                <div class="titre">Error 504 : La base de donnée à eu un problème, veuillez réessayer plus tard</div>
                <h2><a href="../index.php">Recharger la page</a></h2>
            </div>
        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>