<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Festiplan</title>

        <!-- Lien vers mon CSS -->
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/createFestiplan.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/button.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/image.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/input.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">


        <link rel="stylesheet" href="/Festiplan/framework/fontawesome-free-6.2.1-web/css/all.css">

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
            <a href="createFestival2.php"><button class="Retour"><i class="fa-solid fa-arrow-left"></i> Retour</button></a>
        </div>

        <div class="wrapper">
            <div class="container">

            <div class="flex-row">
                <div>
                    <h3><i class="fa-solid fa-circle-exclamation"></i>Spectacle :</h3>

                    <select>
                        <option value="vide"></option>
                        <?php
                        foreach ($tableauSpectacle as $ligne) {
                            echo "<option value ='>".$ligne['nom']."'>".$ligne['nom']."</option>";
                            //ar_dump($ligne);
                            //echo $ligne ;
                        }
                        ?>
                    </select>


                </div>
                <div class="ajouter">
                    Ajouter un Spectacle  <i class="fa-solid fa-plus"></i> <!-- TODO fontawesome -->
                </div>
            </div>

            <div class="flex-row">
                <div>
                    <h3><i class="fa-solid fa-circle-exclamation"></i>Scène :</h3>
                    <select>
                        <option value="vide"></option>
                        <?php
                            foreach ($tableauScene as $ligne) {
                                var_dump($tableauScene);
                                echo "<option value='".$ligne['taille']."'>".$ligne['taille']."</option>" ;
                            }
                        ?>
                    </select>
                </div>
                <div class="ajouter">
                    Ajouter une Scène<i class="fa-solid fa-plus"></i>  <!-- TODO fontawesome -->
                </div>
            </div>
            </div>
            </div>

            <div class="valid-annul-placement">
                <button class="ajoutGrij">Générer une GRIJ</button>
            </div>

        <div class="valid-annul-placement">
            <div class="annulChoix">
                <i class="fa-regular fa-circle-xmark"></i>Annuler vos choix  <!-- TODO fontawesome -->
            </div>
            <div class="button-flex-end">
                <button class="valid">Valider <i class="fa-solid fa-check"></i></button>
            </div>
        </div>
         <?php include_once $_SERVER['DOCUMENT_ROOT']. "/Festiplan/FestiplanWeb/static/components/footer/footer.php" ?>
    </body>
</html>
