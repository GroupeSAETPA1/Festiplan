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
        <!--<link rel="stylesheet" href="../../static/style/css/footer.css">-->

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
            <a href="createFestival2.php"><button class="retour"><i class="fa-solid fa-arrow-left"></i> Retour</button></a>
        </div>

        <div class="wrapper">
            <div class="container">

            <div class="proot">
                <div>
                    <h3><i class="fa-solid fa-circle-exclamation"></i>Spectacle :</h3>
                    <select>
                        <option value=" "></option>
                        <option value="descriauds">Descriaud's pectacle</option>
                    </select>
                </div>
                <div class="butSpec">
                    <button class="ajoutS">Ajouter un spectacle +</button>
                </div>
            </div>

            <div class="proot">
                <div>
                    <h3><i class="fa-solid fa-circle-exclamation"></i>Scène :</h3>
                    <select>
                        <option value=" "></option>
                        <option value="concert">concert</option>
                        <option value="theatre">theatre</option>
                        <option value="danse">danse</option>
                        <option value="cirque">cirque</option>
                        <option value="film">film</option>
                    </select>
                </div>
                <div class="butSpec">
                    <button class="ajoutS">Ajouter une Scène +</button>
                </div>
            </div>
            </div>
            </div>

            <div class="babou">
                <button class="ajoutGrij">Ajouter une GRIJ</button>
            </div>

        <div class="babou">
            <div class="butSpec">
                <button class="annul">Annuler vos choix</button>
            </div>
            <div class="butSpec">
                <button class="valid">Valider</button>
            </div>
        </div>
    </body>
</html>
