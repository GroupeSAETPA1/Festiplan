<?php

// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="/Festiplan/FestiplanWeb/datas/img/logo.ico" />
        <title>Edition Festival </title>

        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/editionFestival/editionFestival.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/image.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/input.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/editionFestival/responsive.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/button.css">
        <!-- Font Awesome -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>

        <!-- Scripts -->
        <!-- GSAP -->  <!-- Jquery -->
        <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
        <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>
        <!-- custom js -->
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
    </head>
        <body>
        <div class="app">
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
            <div class="retour">
                <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">
                    <button class="btn-retour">
                        <i class="fa-solid fa-arrow-left"></i> Retour
                    </button>
                </a>
            </div>
            <form method="post" action="index.php" enctype="multipart/form-data">
                <div class="container">
                    <div class=wrapper>
                        <div class="flex-row">
                            <div class="flex-column first-column">
                                <div>
                                    <h3>Nom :</h3>
                                    <input class="text" type="text" name="nom" placeholder="Tapez le nom de votre festival"
                                           value="<?php echo $nomActuel ?>"/>
                                </div>
                                <div>
                                    <h3>Catégorie :</h3>
                                    <select name="categorie">
                                        <?php
                                        foreach ($tableauCategorie as $ligne) {
                                            echo '<option';
                                            if ($_SESSION['categorie_editer'] == $ligne['id_categorie']) {
                                                echo 'selected';
                                            }
                                            echo ' value = "' . $ligne['id_categorie'] . '">' . $ligne['nom'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="flex-column second-column">
                                <div>
                                    <h3>Date de début :</h3>
                                    <input class="text" type="date" name="ddd" value="<?php echo $debut ?>"/>
                                </div>
                                <div>
                                    <h3></i>Date de fin :</h3>
                                    <input class="text" type="date" name="ddf" value="<?php echo $fin ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="Description">
                            <!-- Contient un second bloc avec la description et qui se situe au cote a cote avec le premier bloc -->
                                <h3><label for="description">Description :</label>
                                </h3>
                                <textarea id="description" name="description"><?php echo $descriptionFestival ?></textarea>
                        </div>
                        <div class="illustration">
                            <div class="custom-file-input-wrapper"
                                <h3 class="custom-file-input-text">Illustration :</h3></br>
                                <?php
                                if ($_SESSION['illustration_editer'] != 'null') {
                                    echo '<img src="/Festiplan/FestiplanWeb/datas/img/' . $_SESSION['illustration_editer'] . '" alt="Illustration du festival" class="illustration">';
                                }
                                ?>
                                <label class="custom-file-input" for="fileInput">Parcourir</label>
                                <input type="file" id="fileInput" name="imageFestival" accept=".jpg, .jpeg, .png, .gif"/>
                            </div>
                            <div class="format">
                                <br>Format PNG,JPG,GIF</br>
                                <br>800x600</br>
                            </div>
                        </div>

                        <div>
                            <div class="flex-row">
                                <div class="flex-column">
                                    <div>
                                        <h3>Heure de début des spectacles :</h3>
                                        <input class="text" type="time" name="heure_debut_spectacle"
                                               value="<?php echo $heure_debut_spectacle ?>"/>
                                    </div>
                                    <div>
                                        <h3>Heure de fin des spectacles :</h3>
                                        <input class="text" type="time" name="heure_fin_spectacle"
                                               value="<?php echo $heure_fin_spectacle ?>"/>
                                    </div>
                                </div>
                                <div class="flex-column">
                                    <div>
                                        <h3>Durée entre les spectacles :</h3>
                                        <input class="text" type="text" name="duree_entre_spectacle"
                                               value="<?php echo $duree_entre_spectacle ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class ="valid-annul-placement">
                                <div class="annulChoix">
                                    <a href="/Festiplan/FestiplanWeb/?controller=EditFestival&action=formulaireDefaut">
                                    <i class="fa-regular fa-circle-xmark"></i>Annuler vos modification </a><!-- TODO fontawesome -->
                                </div>
                                <div class="button-flex-end">
                                    <button type="submit" class="editer">Editer<i class="fa-solid fa-arrow-right"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <input hidden name="action" value="editerFestival">
                <input hidden name="controller" value="EditFestival">
            </form>
        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
        </body>
</html>