<?php
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}

/**
 * Convertit un nombre de minutes en heures et minutes
 * @param int $minutes Le nombre de minutes
 * @return string L'heure au format HH:MM
 */
function minutesToHHMM(int $minutes): string
{
    return sprintf('%02d:%02d', $minutes / 60, $minutes % 60);
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
                <button class="btn-retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
            </a>
        </div>
        <div class="wrapper">

            <div class="container">
                <div class="title">
                    <h1>Souhaitez vous supprimer ce Spectacle ? </h1>
                </div>


                <div class="card-spectacle rounded">
                    <div class="img-spectacle">
                        <img src="<?php echo $spectacle[0]['illustration'] ?>"
                             alt="L'image du spectacle <?php echo $spectacle[0]['nom'] ?>">
                    </div>
                    <div class="description-spectacle">
                        <p class="nom-spectacle bold"><?php echo $spectacle[0]['nom'] ?></p>
                        <div class="group-categories">
                            <span class="label-categorie">Cat&eacute;gories :</span>
                            <span class="categorie"><?php echo $spectacle[0]['categorie'] ?></span>
                        </div>
                        <div class="duree">
                            <span class="label-duree">Dur&eacute;e :</span>
                            <span><?php echo minutesToHHMM($spectacle[0]['duree']) ?></span>
                        </div>
                        <div>
                            <span class="label-description">D&eacute;scription :</span>
                            <span class="description"><?php echo $spectacle[0]['description'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" action="index.php">
                <div class="valid-annul-placement flex-row">
                    <div class="annulChoix lastButton rounded">
                        <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">Garder</a>
                    </div>
                    <input hidden name="action" value="suprimmer">
                    <input hidden name="controller" value="SupressionSpectacle">
                    <button type="submit" class="supprimer rounded page-suivante lastButton">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>

