<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festiplan- creation spectacle 1</title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components\footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components\header.css">


    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components\header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/creationSpectacle.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/button.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/image.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createFestiplan/input.css">

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
    <script src="/Festiplan/FestiplanWeb/static/scripts/customInput.js" defer></script>
</head>
<body>
<div class="app">
    <?php
    include_once "../../static/components/header.php" ?>

    <div class="retour">
        <button class="Retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
    </div>
    <div class="wrapper">
        <div class="container">


            <!-- Premier paquet pour le premier cube d'information-->
            <div class="flex-row first-row">
                <!-- Contient un premier bloc avec le nom, les dates de début et de fin -->
                <div class="NDD">
                    <div>

                        <h3><i class="fa-solid fa-circle-exclamation"></i>Nom :</h3>
                        <input class="text" type="text" name="nom" placeholder="Tapez le nom de votre festival"/>
                    </div>
                    <div>

                        <h3><i class="fa-solid fa-circle-exclamation"></i>Date de début :</h3>
                        <input class="text" type="date" name="ddd"/>
                    </div>
                    <div>

                        <h3><i class="fa-solid fa-circle-exclamation"></i>Date de fin :</h3>
                        <input class="text" type="date" name="ddf"/>
                    </div>
                </div>

                <div class="Description">
                    <!-- Contient un second bloc avec la description et qui se situe au cote a cote avec le premier bloc -->
                    <div>

                        <h3><label for="description"><i class="fa-solid fa-circle-exclamation"></i>Description :</label></h3>
                        <textarea  id="description" name="description"></textarea>
                    </div>
                </div>
            </div>


            <!-- Second paquet qui va contenir le champ d'entrée d'image-->
            <div class="flex-row">
                <div class="custom-file-input-wrapper">
                    <h3 class="custom-file-input-text">Illustration :</h3></br>
                    <label class="custom-file-input" for="fileInput"><i class="fa-solid fa-image"></i>Parcourir</label>
                    <input type="file" id="fileInput" name="fileInput" />
                </div>
                <div class="format">
                    <br>Format PNG,JPG,GIF</br>
                    <br>800x600</br>
                </div>
            </div>


            <div class="flex-column">
                <h3> <i class="fa-solid fa-circle-exclamation"></i>Catégorie :</h3>
                <select>
                    <option value=" "></option>
                    <option value="concert">concert</option>
                    <option value="theatre">theatre</option>
                    <option value="danse">danse</option>
                    <option value="cirque">cirque</option>
                    <option value="film">film</option>
                </select>
            </div>
        </div>
    </div>

    <div class="valid-annul-placement">
        <div class="annulChoix">
            <i class="fa-regular fa-circle-xmark"></i>Annuler vos choix  <!-- TODO fontawesome -->
        </div>

        <div class="button-flex-end">
            <a href="createFestival3.php">
                <button class="page-suivante">
                    Page Suivante<i class="fa-solid fa-arrow-right"></i>
                </button>
            </a>
        </div>
    </div>

    <?php
    include_once "../../static/components/footer.php" ?>
</div>
</body>
</html>