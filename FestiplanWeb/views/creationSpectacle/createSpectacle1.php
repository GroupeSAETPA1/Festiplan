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
    <title>Festiplan- creation spectacle 1</title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svgInFolder.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/creationSpectacle.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/image.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/input.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/responsivePage1.css">

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
    <script src="/Festiplan/FestiplanWeb/static/scripts/customInput.js" defer></script>
</head>
<body>
<div class="app">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
    <div class="retour">
        <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">
            <button class="btn-retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
        </a>
    </div>
    <div class="wrapper">
        <form method="post" action="index.php" enctype="multipart/form-data">
            <div class="container flex">
                    <div class="title">
                        <h1>Création d'un spectacle</h1>
                    </div>

                    <!-- Premier paquet pour le premier cube d'information-->
                    <div class="flex-row first-row">
                        <div class="NDD flex">
                            <div>
                                <h3><i class="fa-solid fa-circle-exclamation"></i>Nom :</h3>
                                <input type="text" name="nom" placeholder="Tapez le nom de votre spectacle"  value = "<?php echo $nomSpectacle ?? "" ?>" />
                            </div>
                            <div>
                                <h3><i class="fa-solid fa-circle-exclamation"></i>Durée en minute:</h3>
                                <div class="text">Veuillez entrez la durée en minute du spectacle</div>
                                <input type="number" name="duree" value = "<?php echo $dureeSpectacle ?? "" ?>" />
                            </div>
                        </div>

                        <div class="Description">
                            <!-- Contient un second bloc avec la description et qui se situe au cote a cote avec le premier bloc -->
                            <div>

                                <h3><label for="description"><i class="fa-solid fa-circle-exclamation"></i>Description :</label>
                                </h3>
                                <textarea id="description" name="description">
                                     <?php echo $descriptionSpectacle ?? "" ?>
                                </textarea>
                            </div>
                        </div>
                    </div>


                    <!-- Second paquet qui va contenir le champ d'entrée d'image-->
                    <div class="flex-row">
                        <div class="custom-file-input-wrapper">
                            <h3 class="custom-file-input-text">Illustration :</h3></br>
                            <label class="custom-file-input" for="fileInput"><i class="fa-solid fa-image"></i>Parcourir</label>
                            <input type="file" id="fileInput" name="photoSpectacle" accept=".jpg, .jpeg, .png, .gif"/>
                        </div>
                        <div class="format">
                            <br>Format PNG,JPG,GIF</br>
                            <br>800x600</br>
                        </div>
                    </div>


                    <div class="flex-column">
                        <h3><i class="fa-solid fa-circle-exclamation"></i>Catégorie :</h3>
                        <select name="categorie">
                            <option value="vide"></option>
                            <?php

                            foreach ($tableauCategorie as $ligne) {
                                echo '<option' ;
                                // récupération de la catégorie sélectionnée précédemment
                                if (isset($categorieSpectacle) && $ligne['id_categorie'] == $categorieSpectacle ) {
                                    echo ' selected' ;
                                }
                                echo  ' value = "' . $ligne['id_categorie'] . '">' . $ligne['nom'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- selection de la taille de la scene-->
                    <div class="flex-column">
                        <h3><i class="fa-solid fa-circle-exclamation"></i>Taille de la scène :</h3>
                        <div class="text">Veuillez selectionner la taille de scene nécessaire</div>
                        <select name="taille">
                            <option value="vide"></option>
                            <?php
                            foreach ($tableauTailleScene as $ligne) {
                                echo '<option' ;
                                if (isset($tailleSceneSpectacle) && $ligne['id_taille'] == $tailleSceneSpectacle) {
                                    echo ' selected' ;
                                }
                                echo  ' value = "' . $ligne['id_taille'] . '">' . $ligne['taille'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input hidden name="action" value="validerPage1">
                    <input hidden name="controller" value="CreateSpectacle">
            </div>
            <div class="valid-annul-placement flex-row">
                <div class="annulChoix lastButton">
                    <i class="fa-regular fa-circle-xmark"></i> Annuler vos choix
                </div>
                <button type="submit" class="valider page-suivante lastButton">
                    Page Suivante<i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>