<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Festiplan</title>

        <!-- Lien vers mon CSS -->
        <link rel="stylesheet" href="../../static/style/css/createFestiplan/createFestiplan.css">
        <link rel="stylesheet" href="../../static/style/css/createFestiplan/button.css">
        <link rel="stylesheet" href="../../static/style/css/createFestiplan/image.css">
        <link rel="stylesheet" href="../../static/style/css/createFestiplan/input.css">
        <link rel="stylesheet" href="../../static/style/css/footer.css">
        <link rel="stylesheet" href="../../static/style/css/createFestiplan/responsive.css">

        <link rel="stylesheet" href="../../../framework/fontawesome-free-6.2.1-web/css/all.css">

    </head>
    <body>
        <header>
            <div class="logo">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Festiplan</span>
            </div>
            <div>
                <div>
                    <button class="mon-compte"><i class="fa-solid fa-user"></i> Mon Compte</button>
                </div>
            </div>
        </header>

        <div class="retour">
            <a href="createFestival3.php"><button class="Retour"><i class="fa-solid fa-arrow-left"></i> Retour</button></a>
        </div>
        <div class="wrapper">
            <div class="container">
                <div>
                    <h2>Grille Journalière de Contrainte(Grij)</h2>
                </div>

                <div class="flex-row first-row">
                    <!-- Contient un premier bloc avec le nom, les dates de début et de fin -->
                    <div class="NDD">
                        <div>

                            <h3><i class="fa-solid fa-circle-exclamation"></i>Heure de début des spactacles de la journée : </h3>
                            <input class="text" type="time" id="HDS" name="HDS" min="09:00" max="18:00"/>
                        </div>
                        <div>

                            <h3><i class="fa-solid fa-circle-exclamation"></i>Heure de fin des spactacles de la journée : </h3>
                            <input class="text" type="time" id="HFS" name="HFS" min="09:00" max="18:00"/>
                        </div>
                        <div>

                            <h3><i class="fa-solid fa-circle-exclamation"></i>Temps de pause entre les spactcales : </h3>
                            <input class="text" type="time" id="TPS" name="TPS" min="09:00" max="18:00"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="valid-annul-placement">
            <div class="annulChoix">
                <i class="fa-regular fa-circle-xmark"></i>Annuler vos choix  <!-- TODO fontawesome -->
            </div>
            <div class="button-flex-end">
                <button class="valider">Valider <i class="fa-solid fa-check"></i></button>
            </div>
        </div>
        <?php
        include_once "../../static/components/footer/footer.php" ?>
    </body>
</html>