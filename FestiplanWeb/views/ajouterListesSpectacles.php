<?php
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Festiplan - Ajouter des Spectacles</title>

        <link rel="stylesheet"
              href="/Festiplan/FestiplanWeb/static/style/css/ajoutListeSpectacles/ajoutListeSpectacles.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">

        <!-- Fontawesome --><!-- TODO Custom Kit -->
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/framework/fontawesome-free-6.2.1-web/css/all.css">
        <!-- Font Awesome -->
        <!--
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
              crossorigin="anonymous"
              referrerpolicy="no-referrer"/> -->

        <!-- Scripts -->
        <!-- GSAP -->  <!-- Jquery -->
        <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
        <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>

        <script src="/Festiplan/FestiplanWeb/static/scripts/redirection_logo.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/accesListeSpectacles.js" defer></script>

    </head>
    <body>
    <?php
    $nom_spectacle = "Spectacle 1";
    $categorie = "Categorie 1";
    $duree = "01:30";
    ?>
    <div class="app">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>

        <form action="/Festiplan/FestiplanWeb/index.php" method="post">
            <input type="hidden" name="controller" value="AccesListeSpectacles">
            <input type="hidden" name="id_festival" value="<?php echo $id_festival ?>">
            <div class="retour rounded">
                <button type="submit">
                    <i class="fas fa-arrow-left"></i> Retour
                </button>
            </div>
        </form>

        <div class="wrapper">
            <div class="titre">
                Ajouter des spectacles au festival <?php echo $nom_festival; ?>
            </div>

            <div class="section-spectacles-diposnible rounded">
                <div class="titre-section">
                    Spectacles disponibles
                </div>
            </div>

            <div class="container-card-spectacle rounded">
                <div class="card-spectacle-dispo rounded">
                    <div class="img-spectacle">
                        <img src="/Festiplan/FestiplanWeb/static/assets/img/deScenePalais.jpg"
                             alt="Image du spectacle <?php echo $nom_spectacle ?>"
                             class="rounded">
                    </div>
                    <div class="group-responsive">
                        <div class="nom-spectacle">
                            <?php echo $nom_spectacle ?>
                        </div>
                        <div class="group-categories">
                            <span class="label-categorie">Cat&eacute;gories :<br></span>
                            <span class="categorie rounded"><?php echo $categorie ?></span>
                        </div>
                    </div>
                    <div class="duree">
                        <span class="label-duree">Dur&eacute;e :</span>
                        <span class="duree"><?php echo $duree ?></span>
                    </div>
                    <div class="group-bouton-ajouter-spectacle rounded">
                        <form action="/Festiplan/FestiplanWeb/index.php" method="post">
                            <input type="hidden" name="controller" value="AjouterListesSpectacles">
                            <input type="hidden" name="action" value="ajouter" id="action">
                            <input type="hidden" name="id_festival" value="<?php echo $id_festival ?>">
                            <input type="hidden" name="nom_festival" value="<?php echo $nom_festival ?>">
                            <input type="hidden" name="id_spectacle" value="<?php echo $id_spectacle ?>">
                            <div class="bouton-ajouter-spectacle rounded">
                                <button type="submit" title="Ajouter un spectacle au festival" class="rounded">
                                    <i class="fa-solid fa-circle-plus"></i>
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
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
