<?php


//TODO Déplacer dans le contrôleur
// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}

function afficherSpectacle($spectacle, $liste_scene, int $id_festival): void
{
    $nom_spectacle = $spectacle['nom'];
    $categorie = $spectacle['categorie'];
    $duree = $spectacle['duree'];
    $illustration = $spectacle['illustration'];
    $id_spectacle = $spectacle['id_spectacle'];
    $action = $spectacle['action'];
    $nom_scene = $spectacle['nom_scene'] ?? "";
    $id_scene = $spectacle['id_scene'] ?? "";

    echo '<div class="card-spectacle-dispo rounded">';
    echo '    <div class="img-spectacle">';
    echo '        <img src="' . $illustration . '"';
    echo '             alt="Image du spectacle ' . $nom_spectacle . '"';
    echo '             class="rounded">';
    echo '    </div>';
    echo '        <div class="nom-spectacle hors-group-responsive">';
    echo $nom_spectacle;
    echo '       </div>';
    echo '       <div class="group-categories hors-group-responsive">';
    echo '           <span class="label-categorie">Cat&eacute;gories :<br></span>';
    echo '           <span class="categorie rounded">' . $categorie . '</span>';
    echo '       </div>';
    echo '    <div class="group-responsive">';
    echo '        <div class="nom-spectacle">';
    echo              $nom_spectacle;
    echo '        </div>';
    echo '       <div class="group-categories">';
    echo '           <span class="label-categorie">Cat&eacute;gories :</span><br>';
    echo '           <span class="categorie rounded">' . $categorie . '</span>';
    echo '       </div>';
    echo '       <div class="duree">';
    echo '           <span class="label-duree">Dur&eacute;e :</span>';
    echo '           <span class="duree">' . minutesToHHMM($duree) . '</span>';
    echo '       </div>';
    echo '   </div>';
    echo '    <div class="group-bouton-ajouter-spectacle rounded">';
    echo '        <form action="/Festiplan/FestiplanWeb/index.php" method="post">';
    echo '            <input type="hidden" name="controller" value="AjouterListesSpectacles">';
    echo '            <input type="hidden" name="action" value="' . $action . '">';
    echo '            <input type="hidden" name="id_festival" value="' . $id_festival . '">';
    echo '            <input type="hidden" name="id_scene" value="' . $id_scene . '">';
    echo '            <input type="hidden" name="id_spectacle" value="' . $id_spectacle . '">';
    echo '            <div class="scene">';
    if ($action == "ajouterSpectacle") {
        afficher_liste_scene($liste_scene, $id_spectacle, $spectacle['taille_scene']);
    } else {
        echo $nom_scene;
    }
    echo '            </div>';
    echo '            <div class="bouton-ajouter-spectacle rounded" >';
    $titreBouton = $action == "ajouterSpectacle" ? "Ajouter un spectacle au festival" : "Retirer le spectacle";
    echo '                <button type="submit" title="' . $titreBouton . '" class="rounded">';
    if ($action == "ajouterSpectacle") {
        echo '                   <i class="fa-solid fa-circle-plus" id="bouton' . $id_spectacle . '"></i>';
    } else {
        echo '                   <i class="fa-regular fa-square-check"></i>';
    }
    echo '               </button>';
    echo '           </div>';
    echo '       </form>';
    echo '   </div>';
    echo '</div>';
}

/**
 * Affiche la liste des scenes du festival
 * Sous la forme d'un select
 * @return void
 */
function afficher_liste_scene(array $liste_scene, int $id_spectacle, int $id_taille_scene_necessaire): void
{
    echo '<select name="id_scene" id="' . $id_spectacle . '" class="selection_scene">';
    echo '    <option value="none" disabled selected>S&eacute;lectionner une sc&egrave;ne</option>';
    foreach ($liste_scene as $scene) {
        if ($scene['id_taille'] == $id_taille_scene_necessaire) {
            $nom_scene = $scene['nom'];
            $id_scene = $scene['id_scene'];
            echo '<option value="' . $id_scene . '">' . $nom_scene .'</span></option>';
        }
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
        <script src="/Festiplan/FestiplanWeb/static/scripts/ajouterListeSpectacles.js" defer></script>

    </head>
    <body>
    <?php
    //TODO remove STUB
    //$nom_festival = "";
    //$spectaclesDisponible =
    //    [
    //        [
    //            "nom" => "Nom",
    //            "categorie" => "Categorie",
    //            "duree"=>"123",
    //            "illustration" => "",
    //            "action"=>"",
    //            "id_spectacle" => 1
    //        ]
    //    ];
    //$id_festival = 1;
    ?>
    <div class="app">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>

        <!-- Bouton retour -->
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
                Ajouter des spectacles au festival &af; <span class="bold"> <?php echo $nom_festival; ?></span>
            </div>

            <div class="section-spectacles-diposnible rounded">
                <div class="titre-section">
                    Spectacles disponibles
                </div>
                <div class="btn-valider-spectacles-selectionne rounded">
                    <form action="/Festiplan/FestiplanWeb/index.php" method="post">
                        <input type="hidden" name="controller" value="AjouterListesSpectacles">
                        <input type="hidden" name="action" value="validerSpectaclesSelectionne">
                        <!--                        <input type="hidden" name="id_festival" value="<?php //echo $id_festival ?>">
                        <input type="hidden" name="nom_festival" value="<?php //echo $nom_festival ?>">-->
                        <button type="submit" class="rounded">
                            <i class="fa-solid fa-circle-check"></i>Valider les spectacles s&eacute;lectionn&eacute;s
                        </button>
                    </form>
                </div>
            </div>

            <div class="container-card-spectacle rounded">
                <?php
                if (sizeof($spectaclesDisponible) == 0) {
                    ?>
                    <div class="aucun-spectacle">
                        <h1 class="bold">Aucun spectacle disponible</h1>
                        <h2>Tous les spectacles sont ajout&eacute;s &agrave; votre festival.</h2>
                    </div>
                    <!-- Bouton retour -->
                    <form action="/Festiplan/FestiplanWeb/index.php" method="post">
                        <input type="hidden" name="controller" value="AccesListeSpectacles">
                        <input type="hidden" name="id_festival" value="<?php echo $id_festival ?>">
                        <div class="retour rounded">
                            <button type="submit">
                                <i class="fas fa-arrow-left"></i> Retour
                            </button>
                        </div>
                    </form>
                    <?php
                }

                foreach ($spectaclesDisponible as $spectacle) {
                    afficherSpectacle($spectacle, $sceneFestival, $id_festival);
                }
                ?>
            </div>
        </div>

    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>
