<?php

// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}

function afficher_spectacle(string $id_spectacle, string $nom_spectacle, string $illustration, string $duree, string $categorie, int $id_festival, int $id_scene): void
{
    echo '<div class="card-spectacles rounded">';
    echo '    <div class="img-spectacle rounded">';
    echo '        <img src="' . $illustration . '" alt="L\'image du spectacle ' . $nom_spectacle . '">';
    echo '    </div>';
    echo '    <div class="nom-spectacle">';
    echo '        <span>' . $nom_spectacle . '</span>';
    echo '    </div>';
    echo '    <div class="group-categories">';
    echo '        <span class="label-categorie">Cat&eacute;gories :</span>';
    echo '        <span class="categorie">' . $categorie . '</span>';
    echo '    </div>';
    echo '    <div class="duree">';
    echo '        <span class="label-duree">Dur&eacute;e :</span>';
    echo '        <span>' . minutesToHHMM($duree) . '</span>';
    echo '    </div>';
    echo '    <form method="post" action="/Festiplan/FestiplanWeb/">';
    echo '        <!-- TODO : mettre le lien pour retirer le spectacles du festival -->';
    echo '        <input hidden name="controller" value="AccesListeSpectacles">';
    echo '        <input hidden name="action" value="retirerSpectacle">';
    echo '        <input hidden name="id_festival" value="' . $id_festival . '">';
    echo '        <input hidden name="id_spectacle" value="' . $id_spectacle . '">';
    echo '        <input hidden name="id_scene" value="' . $id_scene . '">';
    echo '        <div class="btn-retirer-spectacle">';
    echo '            <button type="submit" title="Retirer le spectacle"><i class="fa-solid fa-times"></i></button>';
    echo '        </div>';
    echo '   </form>';
    echo '</div>';
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
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Festiplan - Liste Spectacles</title>

        <link rel="stylesheet"
              href="/Festiplan/FestiplanWeb/static/style/css/accesListeSpectacles/accesListeSpectacles.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">

        <!-- Fontawesome -->
        <script src="https://kit.fontawesome.com/d9b7264c5a.js" crossorigin="anonymous"></script>

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


            <div class="titre">Les spectacles du festival <?php echo $nom_festival; ?></div>

            <div class="card-festival-ligne rounded">
                <p class="nom-festival"><?php echo $nom_festival; ?></p>
                <div class="group-categories">
                    <span class="label-categorie">Cat&eacute;gories :</span>
                    <span class="categorie"><?php echo $categorie; ?></span>
                </div>
                <div class="date">
                    <p>Du 10/12/2023</p>
                    <p>Au 10/01/2023</p>
                </div>
            </div>

            <div class="entete-section rounded">
                <span class="titre-section titre">Les spectacles du festivals</span>
                <form action="/Festiplan/FestiplanWeb/index.php" method="post">
                    <input type="hidden" name="controller" value="AjouterListesSpectacles">
                    <input type="hidden" name="id_festival" value="<?php echo $id_festival; ?>">
                    <input type="hidden" name="nom_festival" value="<?php echo $nom_festival; ?>">
                    <div class="bouton-ajouter-spectacle rounded">
                        <button type="submit" title="Ajouter un spectacle au festival">
                            <i class="fa-solid fa-square-plus"></i>
                            <span>Ajouter un spectacle</span>
                        </button>
                    </div>
                </form>
            </div>


            <div class="container-card-spectacles rounded" id="container-card-spectacles">
                <?php
                if (sizeof($spectacles) == 0) {
                    echo '<div class="aucun-spectacle">';
                    echo '    <div>Aucun spectacle n\'est pr&eacute;sent dans ce festival</div>';
                    echo '</div>';
                } else {
                    foreach ($spectacles as $spectacle) {
                        $id_spectacle = $spectacle['id_spectacle'];
                        $nom_spectacle = $spectacle['nom_spectacle'];
                        $illustration = $spectacle['illustration'];
                        $duree = $spectacle['duree'];
                        $categorie = $spectacle['categorie'];
                        $id_scene = $spectacle['id_scene'];

                        afficher_spectacle($id_spectacle, $nom_spectacle, $illustration, $duree, $categorie, $id_festival, $id_scene);
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>

    </body>
</html>