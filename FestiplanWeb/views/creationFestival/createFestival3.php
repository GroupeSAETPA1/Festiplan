<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Festiplan</title>

        <!-- Lien vers mon CSS -->
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/createFestiplan.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/page3CreationFestival.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">

        <!-- Font Awesome -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        <!-- GSAP -->  <!-- Jquery -->
        <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
        <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>
        <!-- custom js -->
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/page3CreationFestival.js" defer></script>
    </head>
    <body>
    <div class="app">
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/Festiplan/FestiplanWeb/static/components/header.php" ?>
    <form>
        <div class="retour">
            <a href=/Festiplan/FestiplanWeb/?controller=CreateFestival&action=validerPage2>
                <button class="Retour">
                    <i class="fa-solid fa-arrow-left"></i> Retour
                </button>
            </a>
        </div>
        <div class="wrapperCustomInput">
            <div class="custom-select">
                <label for="inter">Organisateur :</label>
                <div class="text">Veuillez rentrer l'email du compte, </br>le compte n'existe pas, vous pouvez le crer avec le + </div>
                <div class="rowCustomInput">
                    <input id="orga" type="text" placeholder="exemple@mail.fr">
                    <div class="button-add-orga">
                        <i class="fa-solid fa-plus"></i>

                        Ajouter l'organisateur
                    </div>
                </div>
                <div class="selections">
                    <!-- rempli avec le js -->
                </div>
            </div>
            <div class="custom-select">
                <label for="scene">Scene :</label>
                <div class="text">Veuillez selectioner les scenes que vous souhaitez utilisez</div>
                <div class="rowCustomInput">
                    <select id="listeScene">
                        <option value="vide"></option>
                        <?php
                            foreach ($tableauScene as $ligne) {
                                echo '<option value="'.$ligne['nom'].'">'.$ligne['nom'].' - ' .$ligne['nb_spectateurs'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="sceneSelect">
                    <!-- rempli avec le js -->
                </div>
            </div>
            <div class="custom-select">
                <label for="spectacle"> Spectacle : </label>
                <div class="text">Veuillez selectioner les spectacles que vous souhaitez integrer a votre festival</div>
                <div class="rowCustomInput">
                    <select id="listeSpectacle">
                        <option value = "vide"></option>
                        <?php
                            foreach($tableauSpectacle as $ligne) {
                                echo '<option value="'.$ligne['nom'].'">'.$ligne['nom'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="spectacleSelect">
                    <!-- rempli avec le js -->
                </div>
            </div>
        </div>
        <div class="valid-annul-placement">
            <div class="annulChoix">
                <i class="fa-regular fa-circle-xmark"></i>Annuler vos choix <!-- TODO fontawesome -->
            </div>
            <div class="button-flex-end">
                <button type="submit" class="valider">Page Suivante<i class="fa-solid fa-arrow-right"></i></button>
            </div>
            <input hidden name="action" value="validerPage2">
            <input hidden name="controller" value="CreateFestival">
    </form>
    </div>
         <?php include_once $_SERVER['DOCUMENT_ROOT']. "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>
