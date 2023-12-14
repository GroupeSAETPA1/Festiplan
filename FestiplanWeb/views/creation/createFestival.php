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

        <div class="ret">
            <button class="retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
        </div>
        <div class="wrapper">
            <div class="container">


                <!-- Premier paquet pour le premier cube d'information-->
                <div class="proot">
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

                    <div class="Descr">
                        <!-- Contient un second bloc avec la description et qui se situe au cote a cote avec le premier bloc -->
                        <div>

                            <label for="description"><i class="fa-solid fa-circle-exclamation"></i>Description :</label>
                            <textarea  id="description" name="description"></textarea>
                        </div>
                    </div>
                </div>


                <!-- Second paquet qui va contenir le champ d'entrée d'image-->
                <div class="proot">
                    <div class="custom-file-input-wrapper">
                        <h3 class="custom-file-input-text">Illustration :</h3></br>
                        <label class="custom-file-input" for="fileInput">Parcourir</label>
                        <input type="file" id="fileInput" name="fileInput" />
                    </div>
                    <div class="format">
                        <br>Format PNG,JPG,</br>
                        <br>800x600</br>
                    </div>
                </div>


                <div>
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

        <div class="babou">
            <div class="annulChoix">
                Annuler vos choix  <!-- TODO fontawesome -->
            </div>
            <div class="butSpec">
                <a href="createFestival2.php"><button class="valid">Page Suivante</button></a>
            </div>
        </div>

        <?php
        include_once "../../static/components/footer/footer.php" ?>
    </body>
</html>
