<?php

// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}

function afficher_scene(string $id_scene, string $nom_scene, string $taille, int $nombre_spectateur, float $longitude, float $latitude, int $id_festival): void
{
    echo '<div class="card-spectacles rounded">';
    echo '    <div class="nom-spectacle">';
    echo '        <span>' . $nom_scene . '</span>';
    echo '    </div>';
    echo '    <div class="group-categories">';
    echo '        <span class="label-categorie">Taille :</span>';
    echo '        <span class="categorie">' . $taille . '</span>';
    echo '    </div>';
    echo '    <div class="duree">';
    echo '        <span class="label-duree">Nombre de spectateurs :</span>';
    echo '        <span>' . $nombre_spectateur . '</span>';
    echo '    </div>';
    echo '    <div class="duree">';
    echo '        <span class="label-duree">Longitude :</span>';
    echo '        <span>' . $longitude . '</span>';
    echo '    </div>';
    echo '    <div class="duree">';
    echo '        <span class="label-duree">Latitude :</span>';
    echo '        <span>' . $latitude . '</span>';
    echo '    </div>';
    echo '    <form method="post" action="">';
    echo '        <!-- TODO : mettre le lien pour retirer la scene du festival -->';
    echo '        <input hidden name="controller" value="AccesListeScene">';
    echo '        <input hidden name="action" value="retirerScene">';
    echo '        <input hidden name="id_festival" value="' . $id_festival . '">';
    echo '        <input hidden name="id_scene" value="' . $id_scene . '">';
    echo '        <div class="btn-retirer-spectacle">';
    echo '            <button type="submit" title="Retirer la scene"><i class="fa-solid fa-times"></i></button>';
    echo '        </div>';
    echo '   </form>';
    echo '</div>';
}

?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="/Festiplan/FestiplanWeb/datas/img/logo.ico" />

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
        <script src="/Festiplan/FestiplanWeb/static/scripts/accesListeScene.js" defer></script>
    </head>
    <body>
    <div class="app">

        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>

        <div class="retour rounded">
            <a href="/Festiplan/FestiplanWeb/?controller=Dashboard"><i class="fas fa-arrow-left"></i> Retour</a>
        </div>

        <div class="wrapper">

            <div class="titre">Les scènes du festival <?php echo $nom_festival; ?></div>

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
                <span class="titre-section titre">Les scènes du festival</span>
                <form action="index.php" method="post">
                    <input type="hidden" name="controller" value="AjouterListesScene">
                    <input type="hidden" name="id_festival" value="<?php echo $id_festival; ?>">
                    <input type="hidden" name="nom_festival" value="<?php echo $nom_festival; ?>">
                    <div class="bouton-ajouter-spectacle rounded">
                        <button type="submit" title="Ajouter une scène au festival">
                            <i class="fa-solid fa-square-plus"></i>
                            <span>Ajouter une scène</span>
                        </button>
                    </div>
                </form>
            </div>


            <div class="container-card-spectacles rounded" id="container-card-spectacles">
                <?php
                foreach ($scenes as $scene) {
                    $nom_scene = $scene['nomScene'];
                    $id_scene = $scene['id_scene'];
                    $taille = $scene['taille'];
                    $nb_spectateurs = $scene['nb_spectateurs'];
                    $longitude = $scene['longitude'];
                    $latitude = $scene['latitude'];

                    afficher_scene($id_scene, $nom_scene, $taille, $nb_spectateurs, $longitude, $latitude, $id_festival);
                }
                ?>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>

    </body>
</html>