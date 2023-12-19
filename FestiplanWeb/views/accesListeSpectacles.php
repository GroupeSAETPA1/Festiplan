<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Festiplan - Liste Spectacles</title>

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
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/accesListeSpectacles.js" defer></script>
    </head>
    <body>
    <div class="app">

        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>

        <div class="retour rounded">
            <a href="/Festiplan/FestiplanWeb/?controller=Dashboard"><i class="fas fa-arrow-left"></i> Retour</a>
        </div>

        <div class="wrapper">

            <div class="titre">Les spectacles du festival NOM</div>

            <div class="card-festival-ligne rounded">
                <div class="img-festival rounded">
                    <img src="/estiplan/FestiplanWeb/static/assets/img/deScenePalais.jpg"
                         alt="Image du festival ' . $nom_festival . '">
                </div>
                <p class="nom-festival">$nom_festival</p>
                <div class="group-categories">
                    <span class="label-categorie">Cat&eacute;gories :</span>
                    <span class="categorie">$categorie</span>
                </div>
                <div class="date">
                    <p>Du 10/12/2023</p>
                    <p>Au 10/01/2023</p>
                </div>
            </div>

            <div class="entete-section rounded">
                <span class="titre-section titre">Les spectacles du festivals</span>
                <a href=""><!-- TODO : Lien vers la page d'ajout d'un spectacle -->
                    <div class="bouton-ajouter-spectacle rounded">
                        <i class="fa-solid fa-square-plus"></i>
                        <span>Ajouter un spectacle</span>
                    </div>
                </a>
            </div>

            <div class="accordeon">
                <div class="bouton-drop-down rounded" id="bouton-drop-down">
                    <i class="fa-solid fa-chevron-down"></i>
                </div>

                <div class="container-card-spectacles rounded" id="container-card-spectacles">
                    <div class="card-spectacles rounded">
                        <div class="img-spectacle rounded">
                            <img src="" alt="L'image du spectacle Festiplan">
                        </div>
                        <div class="nom-spectacle">
                            <span>Le spectacle de Festiplan</span>
                        </div>
                        <div class="group-categories">
                            <span class="label-categorie">Cat&eacute;gories :</span>
                            <span class="categorie">Projection de film</span>
                        </div>
                        <div class="duree">
                            <span class="label-duree">Dur&eacute;e :</span>
                            <span>00:50</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>

    </body>
</html>