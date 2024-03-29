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
function afficher_festival(int $id_festival, string $nom_festival, string $date_debut, string $date_fin, string $lien_image, string $categorie, int $nbFestival): void
{
    echo '<div class="card-festival rounded">';
    echo '    <div class="haut-card">';
    echo '        <div class="img-festival">';
    echo '           <img src="' . $lien_image . '" alt="Image du festival ' . $nom_festival . '">';
    echo '        </div>';
    echo '        <div class="description-festival">';
    echo '            <p class="nom-festival">' . $nom_festival . '</p>';
    echo '            <p>Du ' . $date_debut . '</p>';
    echo '            <p>Au ' . $date_fin . '</p>';
    echo '            <p>Nombre de spectacles : ' . $nbFestival . '</p>';
    echo '        </div>';
    echo '    </div>';
    echo '    <div class="bas-card">';
    echo '        <div class="group-categories">';
    echo '            <span class="label-categorie">Cat&eacute;gories :</span>';
    echo '            <span class="categorie">' . $categorie . '</span>';
    echo '        </div>';
    echo '        <div class="group-boutons">';
    echo '            <form method="post" action="/Festiplan/FestiplanWeb/index.php">';
    echo '                <input hidden name="controller" value="AccesListeSpectacles">';
    echo '                <input hidden name="id_festival" value="' . $id_festival . '">';
    echo '                <input hidden name="nom_festival" value="' . $nom_festival . '">';
    echo '                <input hidden name="categorie" value="' . $categorie . '">';
    echo '                <div class="btn-acces-spectacles rounded"><button type="submit">Spectacles <i class="fa-solid fa-pen-to-square"></i></button></div>';
    echo '            </form>';
    echo '            <form method="post" action="/Festiplan/FestiplanWeb/index.php">';
    echo '                <input hidden name="controller" value="AccesListeScene">';
    echo '                <input hidden name="id_festival" value="' . $id_festival . '">';
    echo '                <input hidden name="nom_festival" value="' . $nom_festival . '">';
    echo '                <div class="btn-acces-spectacles rounded"><button type="submit">Scenes <i class="fa-solid fa-pen-to-square"></i></button></div>';
    echo '            </form>';
    echo '            <form method="post" action="/Festiplan/FestiplanWeb/index.php">';
    echo '                <input hidden name="controller" value="Planification">';
    echo '                <input hidden name="id_festival" value="' . $id_festival . '">';
    echo '                <input hidden name="nom_festival" value="' . $nom_festival . '">';
    echo '                <div class="btn-acces-spectacles rounded"><button type="submit">Voir la planification <i class="fa-solid fa-eye"></i></button></div>';
    echo '            </form>';
    echo '            <form method="post" action="/Festiplan/FestiplanWeb/index.php"> <!-- TODO : mettre le lien pour éditer le festival -->';
    echo '                <input hidden name="id_festival" value="' . $id_festival . '">';
    echo'                 <input hidden name="controller" value="EditFestival">';
    echo '                <div><button type="submit"><i class="fa-solid fa-pen-to-square"></i></button></div>';
    echo '            </form>';
    echo '            <form method="post" action="/Festiplan/FestiplanWeb/index.php">';
    echo '                <input hidden name="id_festival" value="' . $id_festival . '">';
    echo '                <input hidden name="controller" value="SupressionFestival">';
    echo '                <div><button type="submit"><i class="fa-solid fa-trash-can"></i></button></div>';
    echo '            </form>';
    echo '        </div>';
    echo '   </div>';
    echo '</div>';
}

/**
 * @param int $id_spectacle L'identifiant du spectacle
 * @param string $nom_spectacle Le nom du spectacle
 * @param string $lien_image Le lien vers l'image du spectacle
 * @param string $categorie La catégorie du spectacle
 * @param int $duree La durée du spectacle en minutes
 */
function afficher_spectacle(int $id_spectacle, string $nom_spectacle, string $lien_image, string $categorie, int $duree): void
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
    echo '        <div class="group-boutons">';
    echo '            <div>';
    echo '                <form method="post" action="/Festiplan/FestiplanWeb/index.php"> <!-- TODO : mettre le lien pour supprimer le spectacle -->';
    echo '                    <input hidden name="id-spectacle" value="' . $id_spectacle . '">';
    echo '                    <input hidden name="controller" value="SupressionSpectacle">';
    echo '                    <button type="submit">';
    echo '                        <i class="fa-solid fa-trash-can"></i>';
    echo '                    </button>';
    echo '                </form>';
    echo '            </div>';
    echo '            <div>';
    echo '                <form method="post" action=""> <!-- TODO : mettre le lien pour éditer le spectacle -->';
    echo '                    <input hidden name="id-spectacle" value="' . $id_spectacle . '">';
    echo '                    <button type="submit">';
    echo '                        <i class="fa-solid fa-pen-to-square"></i>';
    echo '                    </button>';
    echo '                </form>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
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
        <meta name="viewport">
        <link rel="icon" href="/Festiplan/FestiplanWeb/datas/img/logo.ico" />
        <title>Festiplan - Dashboard</title>

        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/dashboard/dashboard.css">
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
        <script src="/Festiplan/FestiplanWeb/static/scripts/dashboard.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
    </head>

    <body>
    <div class="app">

        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
        <div class="wrapper">
            <!-- Liste des festivals -->
            <div class="container entete-section">
                <h1>Mes festivals</h1>
                <a href="/Festiplan/FestiplanWeb/?controller=CreateFestival">
                    <div class="rounded">
                        <i class="fa-regular fa-calendar-plus"></i>
                        <p>Cr&eacute;er un festival</p>
                    </div>
                </a>
            </div>

            <?php
            if (!empty($festivals)) {
                ?>

                <div class="container container-card-festivals">
                    <?php
                    foreach ($festivals as $festival) {
                        $id_festival = $festival['id_festival'];
                        $nom_festival = $festival['nom'];
                        $date_debut = $festival['debut'];
                        $date_fin = $festival['fin'];
                        $image = $festival['illustration'];
                        $categorie = $festival['categorie'];
                        $nbFestival = $festival['nombre_spectacles'];
                        // cosntruction du lien de l'image
                        $lien_image = "/Festiplan/FestiplanWeb/datas/img/" . $image;
                        afficher_festival($id_festival, $nom_festival, $date_debut, $date_fin, $lien_image, $categorie, $nbFestival);
                    }
                    ?>
                </div>
                <?php
            }
            ?>

            <!-- Liste des spectacles -->

            <div class="container entete-section">
                <h1>Mes Spectacles</h1>
                <a href="/Festiplan/FestiplanWeb/?controller=CreateSpectacle">
                    <div class="rounded">
                        <i class="fa-regular fa-calendar-plus"></i>
                        <p>Cr&eacute;er un spectacle</p>
                    </div>
                </a>
            </div>
            <?php
            if (!empty($spectacles)) {
            ?>
            <div class="container container-card-spectacles">
                <?php
                foreach ($spectacles as $spectacle) {
                    $id_spectacle = $spectacle['id_spectacle'];
                    $nom_spectacle = $spectacle['nom'];
                    $image = $spectacle['illustration'];
                    $categorie = $spectacle['categorie'];
                    $duree = $spectacle['duree'];
                    // cosntruction du lien de l'image
                    $lien_image = "/Festiplan/FestiplanWeb/datas/img/" . $image;
                    afficher_spectacle($id_spectacle, $nom_spectacle, $lien_image, $categorie, $duree);
                }
                }
                ?>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>
