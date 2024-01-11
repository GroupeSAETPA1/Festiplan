<?php
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}
/**
 * @param int $id_spectacle L'identifiant du spectacle
 * @param string $nom_spectacle Le nom du spectacle
 * @param string $lien_image Le lien vers l'image du spectacle
 * @param string $categorie La catégorie du spectacle
 * @param int $duree La durée du spectacle en minutes
 */
function afficher_spectacle(int $id_spectacle, string $nom_spectacle, string $lien_image, string $categorie, int $duree, string $description): void
{
    echo '<div class="card-spectacles rounded">';
    echo '    <div class="img-spectacle">';
    echo '        <img src="' . $lien_image . '" alt="L\'image du spectacle ' . $nom_spectacle . '" >';
    echo '    </div>';
    echo '    <div class="description-spectacle">';
    echo '        <p class="nom-spectacle">' . $nom_spectacle . '</p>';
    echo '        <div class="group-categories">';
    echo '            <span class="label-categorie">Cat&eacute;gories :</span>';
    echo '            <span class="categorie">' . $categorie . '</span>';
    echo '        </div>';
    echo '        <div class="duree">';
    echo '            <span class="label-duree">Dur&eacute;e :</span>';
    echo '            <span>' . minutesToHHMM($duree) . '</span>';
    echo '        </div>';
    echo '        <div>';
    echo '            <span class="label-categorie">D&eacute;scription :</span>';
    echo '            <span class="categorie">' . $description . '</span>';
    echo '        </div>';
    echo '    </div>';
    echo'</div>';
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
                <form method="post" action="index.php">
                    <div class="container">
                        <div class="title">
                            <h1>Souhaitez vous supprimer ce Spectacle ? </h1>
                        </div>


                        <div class="container container-card-festivals">
                            <?php
                            $id_spectacle = $spectacle[0]['id_spectacle'];
                            afficher_spectacle($id_spectacle, $spectacle[0]['nom'], $spectacle[0]['duree'], $spectacle[0]['illustration'], $spectacle[0]['id_categorie'], $spectacle[0]['description']);
                            ?>
                        </div>
                    </div>

                    <div class="valid-annul-placement flex-row">
                        <div class="annulChoix lastButton">
                            <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">
                            Garder
                        </div>
                        <input hidden name="action" value="suprimmer">
                        <input hidden name="controller" value="SupressionSpectacle">
                        <button type="submit" class="valider page-suivante lastButton">
                            Supprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>

