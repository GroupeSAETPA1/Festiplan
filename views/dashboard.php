<?php
include('../backend/functions/connexion.php');
include('../backend/functions/database.php');
include('../backend/functions/function_dashboard.php');

function afficher_festival(int $id_festival, string $nom_festival, string $date_debut, string $date_fin, string $lien_image, array $categories)
{
    echo'<div class="card-festival">';
    echo'    <div class="haut-card">';
    echo'        <div class="img-festival">';
    echo'           <img src="'.$lien_image.'" alt="Image du festival '.$nom_festival.'">';
    echo'        </div>';
    echo'        <div class="description-festival">';
    echo'            <p class="nom-festival">'.$nom_festival.'</p>';
    echo'            <p>Du '.$date_debut.'</p>';
    echo'            <p>AU '.$date_fin.'</p>';
    echo'        </div>';
    echo'    </div>';
    echo'    <div class="bas-card">';
    echo'        <div class="group-categories">';
    echo'            <span>Cat&eacute;gories :</span>';
    echo'            <div class="categories">';
                        foreach ($categories as $categorie) {
                            echo'<span>'.$categorie.'</span>';
                        }
    echo'            </div>';
    echo'        </div>';
    echo'        <div class="group-boutons">';
    echo'            <form method="post" action=""> <!-- TODO : mettre le lien pour éditer le festival -->';
    echo'                <input hidden name="id-festival" value="'.$id_festival.'">';
    echo'                <div><button type="submit"><i class="fa-solid fa-pen-to-square"></i></button></div>';
    echo'            </form>';
    echo'            <form method="post" action=""> <!-- TODO : mettre le lien pour supprimer le festival -->';
    echo'                <input hidden name="id-festival" value="'.$id_festival.'">';
    echo'                <div><button type="submit"><i class="fa-solid fa-trash-can"></i></button></div>';
    echo'            </form>';
    echo'        </div>';
    echo'   </div>';
    echo'</div>';
}

/**
 * @param int $id_spectacle L'identifiant du spectacle
 * @param string $nom_spectacle Le nom du spectacle
 * @param string $lien_image Le lien vers l'image du spectacle
 * @param array $categories Les catégories du spectacle
 * @param int $duree La durée du spectacle en minutes
 */
function afficher_spectacle(int $id_spectacle, string $nom_spectacle, string $lien_image, array $categories, int $duree)
{
    echo'<div class="card-spectacles">';
    echo'    <div class="img-spectacle">';
    echo'        <img src="'.$lien_image.'" alt="L\'image du spectacle '.$nom_spectacle.'">';
    echo'    </div>';
    echo'    <div class="description-spectacle">';
    echo'        <p class="nom-spectacle">'.$nom_spectacle.'</p>';
    echo'        <div class="group-categories">';
    echo'            <span>Cat&eacute;gories :</span>';
    echo'            <div class="categories">';
                        foreach ($categories as $categorie) {
                            echo'<span>'.$categorie.'</span>';
                        }
    echo'            </div>';
    echo'        </div>';
    echo'        <div class="duree">';
    echo'            <span class="label-duree">Dur&eacute;e :</span>';
    echo'            <span>'.minutesToHHMM($duree).'</span>';
    echo'        </div>';
    echo'        <div class="group-boutons">';
    echo'            <form method="post" action=""> <!-- TODO : mettre le lien pour supprimer le spectacle -->';
    echo'                <input hidden name="id-spectacle" value="'.$id_spectacle.'">';
    echo'                <div>';
    echo'                    <button type="submit">';
    echo'                        <i class="fa-solid fa-trash-can"></i>';
    echo'                    </button>';
    echo'                </div>';
    echo'            </form>';
    echo'            <form method="post" action=""> <!-- TODO : mettre le lien pour éditer le spectacle -->';
    echo'                <input hidden name="id-spectacle" value="'.$id_spectacle.'">';
    echo'                <div>';
    echo'                    <button type="submit">';
    echo'                        <i class="fa-solid fa-pen-to-square"></i>';
    echo'                    </button>';
    echo'                </div>';
    echo'            </form>';
    echo'        </div>';
    echo'    </div>';
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

//TODO : Récupérer l'id du gestionnaire de festival
$id_gestionnaire_festival = 1;

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport">
        <title>Festiplan - Dashboard</title>

        <link rel="stylesheet" href="../src/style/css/dashboard.css">

        <!-- Fontawesome -->
        <!-- TODO CDN -->
        <link rel="stylesheet" href="../framework/fontawesome-free-6.2.1-web/css/all.css">

        <script src="../src/scripts/index.js" defer></script>
    </head>

    <body>
    <header>
        <a href="../index.php">
            <div class="logo">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Festiplan</span>
            </div>
        </a>
        <div class="mon-compte">
            <div>
                <i class="fa-solid fa-user"></i>
                <span>Mon Compte</span>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <div class="container entete-section">
            <h1>Mes festivals</h1>
            <a href=""> <!-- TODO : Lien vers la page de création de festival -->
                <div>
                    <i class="fa-regular fa-calendar-plus"></i>
                    <p>Cr&eacute;er un festival</p>
                </div>
            </a>
        </div>

        <!-- Liste des festivals -->
        <div class="container container-card-festivals">
            <?php

            $festivals = get_festivals($id_gestionnaire_festival);

            foreach ($festivals as $festival) {
                $id_festival = $festival['id_festival'];
                $nom_festival = $festival['nom_festival'];
                $date_debut = $festival['date_debut'];
                $date_fin = $festival['date_fin'];
                $lien_image = $festival['lien_image'];
                $categories = $festival['categories'];
                afficher_festival($id_festival, $nom_festival, $date_debut, $date_fin, $lien_image, $categories);
            }
            ?>

        </div>

        <div class="container entete-section">
            <h1>Mes Spectacles</h1>
            <a href=""> <!-- TODO : Lien vers la page de création de spectacle -->
                <div>
                    <i class="fa-regular fa-calendar-plus"></i>
                    <p>Cr&eacute;er un spectacle</p>
                </div>
            </a>
        </div>

        <!-- Liste des spectacles -->
        <div class="container container-card-spectacles">
            <?php
            $spectacles = get_spectacles($id_gestionnaire_festival);

            foreach ($spectacles as $spectacle) {
                $id_spectacle = $spectacle['id_spectacle'];
                $nom_spectacle = $spectacle['nom_spectacle'];
                $lien_image = $spectacle['lien_image'];
                $categories = $spectacle['categories'];
                $duree = $spectacle['duree'];
                afficher_spectacle($id_spectacle, $nom_spectacle, $lien_image, $categories, $duree);
            }
            ?>
        </div>
    </div>


    <footer>
        <!-- TODO : Vague -->
    </footer>
    </body>
</html>
