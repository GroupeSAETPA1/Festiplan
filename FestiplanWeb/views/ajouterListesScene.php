<?php


// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}

function afficherScene($nom_scene, $id_scene, $id_festival, $taille, $nb_spectateurs, $action): void
{
    echo '<div class="card-spectacle-dispo rounded">';
    echo '    <div class="nom-spectacle">';
    echo $nom_scene;
    echo '    </div>';
    echo '    <div class="nom-spectacle">';
    echo $taille;
    echo '    </div>';
    echo '    <div class="nom-spectacle">';
    echo $nb_spectateurs .'places';
    echo '    </div>';
    echo '    <div class="group-bouton-ajouter-spectacle rounded">';
    echo '        <form action="/Festiplan/FestiplanWeb/index.php" method="post">';
    echo '            <input type="hidden" name="controller" value="AjouterListesScene">';
    echo '            <input type="hidden" name="action" value="' . $action . '">';
    echo '            <input type="hidden" name="id_spectacle" value="' . $id_festival . '">';
    echo '            <input type="hidden" name="id_scene" value="' . $id_scene . '">';
    echo '            <div class="bouton-ajouter-spectacle rounded" >';
    $titreBouton = $action == "ajouterScene" ? "Ajouter une scene au spectacle" : "Retirer la scene";
    echo '                <button type="submit" title="' . $titreBouton . '" class="rounded">';
    if ($action == "ajouterScene") {
        echo '                <i class="fa-solid fa-circle-plus"></i>';
    } else {
        echo '                <i class="fa-regular fa-square-check"></i>';
    }
    echo '                </button>';
    echo '            </div>';
    echo '        </form>';
    echo '    </div>';
    echo '</div>';
}
/**
 * Affiche la liste des scenes du festival
 * Sous la forme d'un select
 * @return void
 */
function afficher_liste_scene(array $liste_scene, int $id_spectacle): void
{
    if (empty($liste_scene)) {
        error_log("No scenes available for spectacle with ID: " . $id_spectacle);
        return;
    }

    echo '<select name="id_scene" id="'.$id_spectacle.'" class="selection_scene">';
    echo '    <option value="none" disabled selected>S&eacute;lectionner une sc&egrave;ne</option>';
    foreach ($liste_scene as $scene) {
        $nom_scene = $scene['nom'];
        $id_scene = $scene['id_scene'];
        echo '<option value="' . $id_scene . '">' . $nom_scene . '</option>';
    }
    echo '</select>';
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
    <title>Festiplan - Ajouter des Spectacles</title>

    <link rel="stylesheet"
          href="/Festiplan/FestiplanWeb/static/style/css/ajoutListeSpectacles/ajoutListeSpectacles.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">

    <!-- Fontawesome --><!-- TODO Custom Kit -->
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/framework/fontawesome-free-6.2.1-web/css/all.css">
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

</head>
<body>
    <div class="app">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>

        <!-- Bouton retour -->
        <form action="/Festiplan/FestiplanWeb/index.php" method="post">
            <input type="hidden" name="controller" value="AccesListeScene">
            <input type="hidden" name="id_festival" value="<?php echo $id_festival ?>">
            <div class="retour rounded">
                <button type="submit">
                    <i class="fas fa-arrow-left"></i> Retour
                </button>
            </div>
        </form>

        <div class="wrapper">
            <div class="titre">
                Ajouter des scenes au festival &af; <span class="bold"> <?php echo $nom_festival; ?></span>
            </div>

            <div class="section-spectacles-diposnible rounded">
                <div class="titre-section">
                    Scenes disponibles
                </div>
                <div class="btn-valider-spectacles-selectionne rounded">
                    <form action="/Festiplan/FestiplanWeb/index.php" method="post">
                        <input type="hidden" name="controller" value="AjouterListesScene">
                        <input type="hidden" name="action" value="validerScenesSelectionne">
                        <button type="submit" class="rounded">
                            <i class="fa-solid fa-circle-check"></i>Valider les scenes s&eacute;lectionn&eacute;s
                        </button>
                    </form>
                </div>
            </div>

            <div class="container-card-spectacle rounded">
                <?php
                if (sizeof($scenesDisponible) == 0) {
                    ?>
                    <div class="aucune-scene">
                        <h1 class="bold">Aucune scene disponible</h1>
                        <h2>Toutes les scenes sont ajout&eacute;es &agrave; votre festival.</h2>
                    </div>
                    <!-- Bouton retour -->
                    <form action="/Festiplan/FestiplanWeb/index.php" method="post">
                        <input type="hidden" name="controller" value="AccesListeScene">
                        <input type="hidden" name="id_festival" value="<?php echo $id_festival ?>">
                        <div class="retour rounded">
                            <button type="submit">
                                <i class="fas fa-arrow-left"></i> Retour
                            </button>
                        </div>
                    </form>
                    <?php
                }
                foreach ($scenesDisponible as $scene) {

                    $nom_scene = $scene['nomScene'];
                    $id_scene = $scene['id_scene'];
                    $taille = $scene['taille'];
                    $nb_spectateurs = $scene['nb_spectateurs'];
                    $action = $scene['action'];

                    afficherScene($nom_scene, $id_scene, $id_festival, $taille, $nb_spectateurs, $action);
                }
                ?>
            </div>
        </div>

    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>
