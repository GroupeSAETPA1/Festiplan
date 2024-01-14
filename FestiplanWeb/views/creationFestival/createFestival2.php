<?php

// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Festiplan</title>

        <!-- Lien vers mon CSS -->
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/createFestiplan.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/page3CreationFestival.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/button.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/image.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/input.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svgInFolder.css">

        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/framework/fontawesome-free-6.2.1-web/css/all.css">

    </head>
    <body>
    <?php
     include_once $_SERVER['DOCUMENT_ROOT']."/Festiplan/FestiplanWeb/static/components/header.php" ?>
    <div class="retour">
        <a href=/Festiplan/FestiplanWeb/?controller=CreateFestival&action=page2><button class="btn-retour"><i class="fa-solid fa-arrow-left"></i> Retour</button></a>
    </div>
    <form>
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
                            <input class="text" type="time" id="HDS" name="HDS"  value="<?php echo $debutSpectacle ?: "" ?>"/>
                        </div>
                        <div>

                            <h3><i class="fa-solid fa-circle-exclamation"></i>Heure de fin des spactacles de la journée : </h3>
                            <input class="text" type="time" id="HFS" name="HFS" value="<?php echo $finSpectacle ?: "" ?>"/>
                        </div>
                        <div>

                            <h3><i class="fa-solid fa-circle-exclamation"></i>Temps de pause entre les spectacles : </h3>
                            <input class="text" min="0" id="TPS" name="TPS" type="number" step="1" value="<?php echo $tempPause ?: "" ?>"/>
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
                <button type="submit" class="valider">Valider <i class="fa-solid fa-check"></i></button>
            </div>
            <input hidden name="action" value="validerPage3">
            <input hidden name="controller" value="CreateFestival">
        </form>
        </div>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT']. "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>