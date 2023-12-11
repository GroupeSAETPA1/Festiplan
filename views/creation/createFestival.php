<?php
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Festiplan</title>

        <!-- Lien vers mon CSS -->
        <link rel="stylesheet" href="../../src/style/css/createFestiplan.css">

        <link rel="stylesheet" href="../../framework/fontawesome-free-6.2.1-web/css/all.css">


    </head>

    <body>
        <header>
            <div class="logo">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Festiplan</span>
            </div>
            <div class="mon-compte">
                <div>
                    <i class="fa-solid fa-user"></i>
                    <span>Mon Compte</span>
                </div>
            </div>
        </header>

        <div class="retour">
             <i class="fa-solid fa-arrow-left"></i>
            <span>Retour</span>
        </div>
        <!-- Premier paquet pour le premier cube d'information-->
        <div>
            <!-- Contient un premier bloc avec le nom, les dates de début et de fin -->
            <div>
                <div>
                    <h3>Nom :</h3>
                    <input class="text" type="text" name="nom" placeholder="Tapez le nom de votre festival" class="form-control"/>
                </div>
                <div>
                    <h2>Date de début :</h2>
                    <input  class="text"type="text" name="ddd" placeholder="Tapez une heure de début"  class="form-control"/>
                </div>
                <div>
                    <h3>Date de fin :</h3>
                    <input  class="text" type="text" name="ddf" placeholder="Tapez une heure de fin"  class="form-control"/>
                </div>
            </div>

            <div>
                <!-- Contient un second bloc avec la description et qui se situe au cote a cote avec le premier bloc -->
                <div>
                <h3>Description :</h3>
                <input class="description" type="text" name="description"  class="form-control"/>
                </div>
            </div>
        </div>

        <!-- Second paquet qui va contenir le champ d'entrée d'image-->
        <div>
            <div>
                <h3>Illusatrtaion : </h3>
                <input type="file" id="illustration" name="illustration" accept="image/*">
            </div>
            <div>
                Format PNG,JPG,GIF
                800x600
            </div>
        </div>

        <div>
            <h3>Catégorie :</h3>
            <select>
                <option value=" "></option>
                <option value="concert">concert</option>
                <option value="theatre">theatre</option>
                <option value="danse">danse</option>
                <option value="cirque">cirque</option>
                <option value="film">film</option>
            </select>
        </div>

        <div>
            <div>
            <h3>Scène :</h3>
            <select>
                <option value=" "></option>
                <option value="concert">concert</option>
                <option value="theatre">theatre</option>
                <option value="danse">danse</option>
                <option value="cirque">cirque</option>
                <option value="film">film</option>
            </select>
            </div>
            <div>
                <button class="ajoutS">Ajouter une Scène +</button>
            </div>
        </div>




    </body>
</html>
