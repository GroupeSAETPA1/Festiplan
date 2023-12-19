<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Liste Spectacles</title>

        <link rel="stylesheet"
              href="/Festiplan/FestiplanWeb/static/style/css/accesListeSpectacles/accesListeSpectacles.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">

        <!-- Fontawesome --><!-- TODO Custom Kit -->
        <!--        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/framework/fontawesome-free-6.2.1-web/css/all.css">-->
        <!-- Font Awesome -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
              crossorigin="anonymous"
              referrerpolicy="no-referrer"/>

        <!-- Scripts -->
        <!-- GSAP -->  <!-- Jquery -->
        <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
        <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>

        <script src="/Festiplan/FestiplanWeb/static/scripts/redirection_logo.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/dashboard.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
    </head>
    <body>
    <div class="app">

        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>

        <div class="retour rounded">
            <a href="/Festiplan/FestiplanWeb/dashboard"><i class="fas fa-arrow-left"></i> Retour</a>
        </div>

        <div class="wrapper">

            <div class="titre"><h1>Les spectacles du festival NOM</h1></div>

            <div class="card-spectacles rounded">
                <div class="img-spectacle">
                    <img src=" $lien_image" alt="L'image du spectacle NOM">
                </div>
                <div class="description-spectacle">
                    <p class="nom-spectacle">Nom</p>
                    <div class="group-categories">
                        <span class="label-categorie">Cat&eacute;gories :</span>
                        <span class="categorie">Categorie</span>
                    </div>
                    <div class="duree">
                        <span class="label-duree">Dur&eacute;e :</span>
                        <span>90</span>
                    </div>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>

    </body>
</html>