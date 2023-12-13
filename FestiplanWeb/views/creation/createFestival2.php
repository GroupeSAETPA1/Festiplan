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
            <a href="createFestival.php"><button class="retour"><i class="fa-solid fa-arrow-left"></i> Retour</button></a>
        </div>
        <div class="wrapper">
            <div class="container">
                <div class="proot">
                    <div>
                        <h3> <i class="fa-solid fa-circle-exclamation"></i>Organisateur : </h3>
                        <input class="text" type="text " id="rechercheOrga" name="rechercheOrga"
                               placeholder="Entrez le nom d'un organisateur"/>
                    </div>
                    <div class="butSpec">
                        <button class="ajoutS">Ajouter l'organisateur +</button>
                    </div>
                    <div class="butSpec">
                        <button class="supp">Supprimer un organisateur</button>
                    </div>
                </div>

                <div>
                    <h3> <i class="fa-solid fa-circle-exclamation"></i>Responsable :</h3>
                    <input class="text" type="text " id="rechercheRespon" name="rechercheRespon"
                           placeholder="Entrez le nom du Responsable"/>
                </div>
            </div>
        </div>

        <div class="babou">
            <div class="butSpec">
                <button class="annul">Annuler vos choix </button>
            </div>
            <div class="butSpec">
                <a href="createFestival3.php"><button class="valid">Page suivante </button></a>
            </div>
        </div>
    </body>
</html>