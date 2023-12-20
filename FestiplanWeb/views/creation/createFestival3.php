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
            <a href="createFestival.php"><button class="Retour"><i class="fa-solid fa-arrow-left"></i> Retour</button></a>
        </div>

        <div class="wrapper">
            <div class="container">

            <div class="buttons  end-row">
                <div>
                    <h3><i class="fa-solid fa-circle-exclamation"></i>Spectacle :</h3>
                    <select>
                        <option value=" "></option>
                        <option value="descriauds">Descriaud's pectacle</option>
                    </select>
                </div>
                <div class="ajouter">
                    Ajouter un Spectacle  <i class="fa-solid fa-plus"></i> <!-- TODO fontawesome -->
                </div>
            </div>

            <div class="buttons end-row">
                <div>
                    <h3><i class="fa-solid fa-circle-exclamation"></i>Scène :</h3>
                    <select>
                        <option value=" "></option>
                        <option value="concert">concert</option>
                        <option value="theatre">theatre</option>
                        <option value="danse">danse</option>
                        <option value="cirque">cirque</option>
                        <option value="film">film</option>
                    </select>
                </div>
                <div class="ajouter">
                    Ajouter une Scène<i class="fa-solid fa-plus"></i>  <!-- TODO fontawesome -->
                </div>
            </div>
                <div class="flex-row end-row">
                    <div>
                        <h3> <i class="fa-solid fa-circle-exclamation"></i>Organisateur : </h3>
                        <input class="text" type="text" id="rechercheOrga" name="rechercheOrga"
                               placeholder="Entrez le mail d'un organisateur"/>
                    </div>

                    <div class="ajouter">
                        Ajouter l'organisateur <i class="fa-solid fa-plus"></i> <!-- TODO fontawesome -->
                    </div>

                    <div class="suppOrga">
                        Supprimer Organisateur <i class="fa-solid fa-trash-can"></i><!-- TODO fontawesome -->
                    </div>
                </div>
            </div>
            </div>
        <div class="valid-annul-placement">
            <div class="annulChoix">
                <i class="fa-regular fa-circle-xmark"></i>Annuler vos choix  <!-- TODO fontawesome -->
            </div>
            <div class="button-flex-end">
                <a href="createFestival2.php"><button class="page-suivante">Page suivante <i class="fa-solid fa-arrow-right"></i> </button></a>
            </div>
        </div>
        <?php
         include_once "../../static/components/footer/footer-absolute.php" ?>
    </body>
</html>
