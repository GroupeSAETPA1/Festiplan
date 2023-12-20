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

        <link rel="stylesheet" href="../../../framework/fontawesome-free-6.2.1-web/css/all.css">

    </head>

    <body>

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
    </body>
</html>
