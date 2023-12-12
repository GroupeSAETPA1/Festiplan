<?php
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Festiplan</title>

        <!-- Lien vers mon CSS -->
        <link rel="stylesheet" href="../../static/style/css/createFestiplan.css">

        <link rel="stylesheet" href="../../framework/fontawesome-free-6.2.1-web/css/all.css">


    </head>

    <body>
        <header>
            <div class="logo">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Festiplan</span>
            </div>
            <div>
                <div>
                    <button class="mon-compte"> <i class="fa-solid fa-user"></i> Mon Compte</button>
                </div>
            </div>
        </header>

        <div>
            <button class="retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
        </div>

        <div class="container">


            <!-- Premier paquet pour le premier cube d'information-->
            <div class="proot">
                <!-- Contient un premier bloc avec le nom, les dates de début et de fin -->
                <div class="NDD">
                    <div>
                        <h3>Nom :</h3>
                        <input class="text" type="text" name="nom" placeholder="Tapez le nom de votre festival"/>
                    </div>
                    <div>
                        <h2>Date de début :</h2>
                        <input  class="text"type="text" name="ddd" placeholder="Tapez une heure de début" />
                    </div>
                    <div>
                        <h3>Date de fin :</h3>
                        <input  class="text" type="text" name="ddf" placeholder="Tapez une heure de fin"/>
                    </div>
                </div>

                <div class="Descr">
                    <!-- Contient un second bloc avec la description et qui se situe au cote a cote avec le premier bloc -->
                    <div>
                    <h3>Description :</h3>
                    <input class="description" type="text" name="description"/>
                    </div>
                </div>
            </div>

            <!-- Second paquet qui va contenir le champ d'entrée d'image-->
            <div>
                <div>
                    <h3>Illusatrtaion : </h3>
                    <input  type="file" id="illustration" name="illustration" accept="image/*">
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

            <div>
                <div>
                    <h3> Organisateur : </h3>
                    <input class="text" type="text " id="rechercheOrga" name="rechercheOrga" placeholder="Entrez le nom d'un organisateur"/>
                </div>
                <div>
                    <button class="ajoutS">Ajouter l'organisateur +</button>
                </div>
                <div>
                    <button class="supp">Supprimer un organisateur</button>
                </div>
            </div>

            <div>
                <h3>Responsable :</h3>
                <input class="text" type="text " id="rechercheRespon" name="rechercheRespon" placeholder="Entrez le nom du Responsable"/>
            </div>

            <div>
                <div>
                    <h3>Spectacle :</h3>
                    <select>
                        <option value=" "></option>
                        <option value="descriauds">Descriaud's pectacle</option>
                    </select>
                </div>
                <div>
                    <button class="ajoutS">Ajouter un spectacle +</button>
                </div>
            </div>

            <div>
                <button class="ajoutGrij">Ajouter une GRIJ</button>
            </div>

            <div>
                <div>
                    <button class="annul">Annuler</button>
                </div>
                <div>
                    <button class="valid">Valider</button>
                </div>
            </div>
        </div>

        <footer>
            <!-- Attendre que Quentin l'ai fait -->
        </footer>

    </body>
</html>
