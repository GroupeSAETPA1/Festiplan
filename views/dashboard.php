<?php
include('../backend/functions/connexion.php');
include('../backend/functions/database.php');

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
    echo'                <div>';
    echo'                    <button type="submit">';
    echo'                        <input hidden name="action" value="editer">';
    echo'                        <i class="fa-solid fa-pen-to-square"></i>';
    echo'                    </button>';
    echo'                </div>';
    echo'            </form>';
    echo'            <form method="post" action=""> <!-- TODO : mettre le lien pour supprimer le festival -->';
    echo'                <input hidden name="id-festival" value="'.$id_festival.'">';
    echo'                <div>';
    echo'                    <button type="submit">';
    echo'                        <i class="fa-solid fa-trash-can"></i>';
    echo'                    </button>';
    echo'                </div>';
    echo'            </form>';
    echo'        </div>';
    echo'   </div>';
    echo'</div>';
}



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
        <div class="logo">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Festiplan</span>
        </div>
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
            $id_festival = 1;
            $nom_festival = 'De Scene Palais';
            $date_debut = '16/12/2023';
            $date_fin = '24/15/2023';
            $lien_image = '../src/assets/img/deScenePalais.jpg';
            $categories = ['Musique', 'Divertissement', 'Divertissement', 'Divertissement', 'Divertissement', 'ABCDEF'];
            afficher_festival($id_festival, $nom_festival, $date_debut, $date_fin, $lien_image, $categories);
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
            <div class="card-spectacles">
                <div class="img-spectacle">
                    <img src="../src/assets/img/deScenePalais.jpg" alt="">
                </div>
                <div class="description-spectacle">
                    <p class="nom-spectacle">De Scene palais</p>
                    <div class="group-categories">
                        <span>Cat&eacute;gories :</span>
                        <div class="categories">
                            <span>Musique</span>
                            <span>Divertissement</span>
                            <span>Divertissement</span>
                            <span>Divertissement</span>
                            <span>Divertissement</span>
                            <span>Divertissement</span>
                        </div>
                    </div>
                    <div class="duree">
                        <span>Dur&eacute;e :</span>
                        <span>1h30</span>
                    </div>
                    <div class="group-boutons">
                        <form method="post" action=""> <!-- TODO : mettre le lien pour supprimer le spectacle -->
                            <input hidden name="id-spectacle">
                            <div>
                                <button type="submit">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </form>
                        <form method="post" action=""> <!-- TODO : mettre le lien pour éditer le spectacle -->
                            <input hidden name="id-spectacle">
                            <div>
                                <button type="submit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <!-- TODO : Vague -->
    </footer>
    </body>
</html>
