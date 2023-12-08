<?php
include('../backend/functions/connexion.php');
include('../backend/functions/database.php');
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
        <div class="container categorie">
            <h1>Mes festivals</h1>
            <a href=""> <!-- TODO : Lien vers la page de création de festival -->
                <div>
                    <i class="fa-regular fa-calendar-plus"></i>
                    Cr&eacute;er un festival
                </div>
            </a>
        </div>

        <div class="container">
            <div class="card">
                <div>
                    <img src="../src/assets/img/deScenePalais.jpg">
                </div>
            </div>
        </div>

        <div class="container categorie">
            <h1>Mes Spectacles</h1>
            <a href=""> <!-- TODO : Lien vers la page de création de spectacle -->
                <div>
                    <i class="fa-regular fa-calendar-plus"></i>
                    Cr&eacute;er un spectacle
                </div>
            </a>
        </div>
    </div>


    <footer>
        <!-- TODO : Vague -->
    </footer>
    </body>
</html>
