<?php
// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}

/**
 * Affiche un festival
 * @param int $id_festival L'identifiant du festival
 * @param string $nom_festival Le nom du festival
 * @param string $date_debut La date de début du festival
 * @param string $date_fin La date de fin du festival
 * @param string $lien_image Le lien vers l'image du festival
 * @param string $categorie La catégorie du festival
 * @return void
 */
function afficher_festival(int $id_festival, string $nom_festival, string $date_debut, string $date_fin, string $lien_image, string $categorie, string $description): void
{
    echo '<div class="container container-card-festivals">';
    echo '    <div class="haut-card">';
    echo '        <div class="img-festival">';
    echo '           <img src="' . $lien_image . '" alt="Image du festival ' . $nom_festival . '">';
    echo '        </div>';
    echo '        <div class="description-festival">';
    echo '            <p class="nom-festival">' . $nom_festival . '</p>';
    echo '            <p>Du ' . $date_debut . '</p>';
    echo '            <p>Au ' . $date_fin . '</p>';
    echo '        </div>';
    echo '    </div>';
    echo '    <div class="bas-card">';
    echo '        <div class="group-categories">';
    echo '            <span class="label-categorie">Cat&eacute;gories :</span>';
    echo '            <span class="categorie">' . $categorie . '</span>';
    echo '        </div>';
    echo '   </div>';
    echo '</div>';
    echo '<div>';
    echo '    <span class="label-categorie">D&eacute;scription :</span>';
    echo '    <span class="categorie">' . $description . '</span>';
}

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
                    <button class="Retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
                </a>
            </div>
            <div class="wrapper">
                <form method="post" action="index.php">
                    <div class="container">
                        <div class="title">
                            <h1>Souhaitez vous supprimer ce festival ? </h1>
                        </div>


                            <div class="container container-card-festivals">
                                <?php
                                $id_festival = $festival[0]['id_festival'];
                                    afficher_festival($id_festival, $festival[0]['nom'], $festival[0]['debut'], $festival[0]['fin'], $festival[0]['illustration'], $festival[0]['id_categorie'], $festival[0]['description']);

                                ?>
                            </div>
                    </div>

                    <div class="valid-annul-placement flex-row">
                        <div class="annulChoix lastButton">
                            <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">
                             Garder
                        </div>
                        <input hidden name="action" value="suprimmer">
                        <input hidden name="controller" value="SupressionFestival">
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
