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
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/responsive.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
        <!-- Font Awesome -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
              crossorigin="anonymous"
              referrerpolicy="no-referrer" />
        <!-- Scripts -->
        <!-- GSAP -->  <!-- Jquery -->
        <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
        <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>
        <!-- custom JS -->
        <!-- custom JS -->
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>

    </head>
    <body>
    <div class="app">
        <?php include $_SERVER['DOCUMENT_ROOT']."/Festiplan/FestiplanWeb/static/components/header.php" ?>

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
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>
