<!doctype html>
</body>
</html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edition Festival </title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/editionFestival/editionFestival.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/createSpectacle.css">
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
    <form method="post" action="index.php" enctype="multipart/form-data">
        <div class="container">
            <div class=wrapper>
                <div class="flex-row first-row">
                    <div class="flex-column first-column">
                        <div>
                            <h3><i class="fa-solid fa-circle-exclamation"></i>Nom :</h3>
                            <input class="text" type="text" name="nom" placeholder="Tapez le nom de votre festival"
                                   value="<? echo $nomActuel ?>"/>
                        </div>
                        <div>
                            <h3><i class="fa-solid fa-circle-exclamation"></i>Catégorie :</h3>
                            <select name="categorie">
                                <option value="vide"></option>
                                <?php
                                foreach ($tableauCategorie as $ligne) {
                                    //var_dump($tableauCategorie);
                                    echo '<option value = "' . $ligne['nom'] . '">' . $ligne['nom'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="flex-column second-column">
                        <div>
                            <h3><i class="fa-solid fa-circle-exclamation"></i>Date de début :</h3>
                            <input class="text" type="date" name="ddd"/>
                        </div>
                        <div>
                            <h3><i class="fa-solid fa-circle-exclamation"></i>Date de fin :</h3>
                            <input class="text" type="date" name="ddf"/>
                        </div>
                    </div>
                </div>
                <div class="Description">
                    <!-- Contient un second bloc avec la description et qui se situe au cote a cote avec le premier bloc -->
                    <div>
                        <h3><label for="description"><i class="fa-solid fa-circle-exclamation"></i>Description
                                :</label>
                        </h3>
                        <textarea id="description" name="description"></textarea>
                    </div>
                </div>
            </div>
            <div>
                <div class="custom-file-input-wrapper">
                    <h3 class="custom-file-input-text">Illustration :</h3></br>
                    <label class="custom-file-input" for="fileInput"><i
                                class="fa-solid fa-image"></i>Parcourir</label>
                    <input type="file" id="fileInput" name="imageFestival" accept=".jpg, .jpeg, .png, .gif"/>
                </div>
                <div class="format">
                    <br>Format PNG,JPG,GIF</br>
                    <br>800x600</br>
                </div>
            </div>
        </div>
</div>
</form>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</div>
</body>
</html>