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
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/button.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/image.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/input.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svgInFolder.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svgInFolder.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/responsive.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">


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
    <script src="/Festiplan/FestiplanWeb/static/scripts/customInput.js" defer></script>

</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/Festiplan/FestiplanWeb/static/components/header.php" ?>

    <div class="retour">
        <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">
        <button class="btn-retour">
            <i class="fa-solid fa-arrow-left"></i> Retour
        </button>
        </a>
    </div>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <div class="wrapper">
            <div class="container">
                <!-- Premier paquet pour le premier cube d'information-->
                <div class="flex-row">
                    <!-- Contient un premier bloc avec le nom, les dates de début et de fin -->
                    <div class="NDD">
                        <div>
                            <h3>
                                <?php
                                    if ($nomOk) {
                                        echo '<i class="fa-solid fa-circle-check"></i>' ;
                                    } else {
                                        echo '<i class="fa-solid fa-circle-exclamation"></i>';
                                    }
                                ?>
                                Nom :</h3>
                            <input class="text" type="text" name="nom" placeholder="Tapez le nom de votre festival" value = "<?php echo $nomFestival ?: "" ?>" />
                        </div>
                        <div>
                            <h3>
                                <?php
                                if ($dateOk) {
                                    echo '<i class="fa-solid fa-circle-check"></i>' ;
                                } else {
                                    echo '<i class="fa-solid fa-circle-exclamation"></i>';
                                }
                                ?>
                                </i>Date de début :</h3>
                            <input class="text" type="date" name="ddd" value = "<?php echo $ddd ?: "" ?>" />
                        </div>
                        <div>
                            <h3>
                                <?php
                                if ($dateOk) {
                                    echo '<i class="fa-solid fa-circle-check"></i>' ;
                                } else {
                                    echo '<i class="fa-solid fa-circle-exclamation"></i>';
                                }
                                ?>
                                </i>Date de fin :</h3>
                            <input class="text" type="date" name="ddf" value = "<?php echo $ddf ?: "" ?>" />
                        </div>
                    </div>
                    <div class="Description">
                        <!-- Contient un second bloc avec la description et qui se situe au cote a cote avec le premier bloc -->
                        <div>
                            <label for="description">
                                <?php
                                if ($descriptionOk) {
                                    echo '<i class="fa-solid fa-circle-check"></i>' ;
                                } else {
                                    echo '<i class="fa-solid fa-circle-exclamation"></i>';
                                }
                                ?>
                                </i>Description :</label>
                            <textarea id="description" name="description" > <?php echo $descriptionFestival ?: "" ?></textarea>
                        </div>
                    </div>
                </div>
                <!-- Second paquet qui va contenir le champ d'entrée d'image-->
                <div class="flex-row">
                    <div class="custom-file-input-wrapper">
                        <h3 class="custom-file-input-text">Illustration :</h3></br>
                        <label class="custom-file-input" for="fileInput"><i
                                class="fa-solid fa-image"></i>Parcourir</label>
                        <input type="file" id="fileInput" name="imageFestival" accept=".jpg, .jpeg, .png, .gif" />
                    </div>
                    <div class="format">
                        <br>Format PNG,JPG,GIF</br>
                        <br>800x600</br>
                    </div>
                </div>
                <div>
                    <h3>
                        <?php
                        if ($categorieOk) {
                            echo '<i class="fa-solid fa-circle-check"></i>' ;
                        } else {
                            echo '<i class="fa-solid fa-circle-exclamation"></i>';
                        }
                        ?>Catégorie :</h3>

                    <select name="categorie">
                        <option value="vide"></option>
                        <?php
                        foreach ($tableauCategorie as $ligne) {
                            echo '<option' ;
                            if (isset($_SESSION['categorie']) && $ligne['id_categorie'] == $_SESSION['categorie']    ) {
                                echo ' selected' ;
                            }
                            echo  ' value = "' . $ligne['id_categorie'] . '">' . $ligne['nom'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="valid-annul-placement">
            <div class="annulChoix">
                <a href="/Festiplan/FestiplanWeb/?controller=CreateFestival&action=viderChampPage1">
                <i class="fa-regular fa-circle-xmark"></i>Vider le formulaire </a><!-- TODO fontawesome -->
            </div>
            <div class="button-flex-end">
                <button type="submit" class="valider">Page Suivante<i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
        <input hidden name="action" value="validerPage1">
        <input hidden name="controller" value="CreateFestival">
    </form>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT']. "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>

</html>