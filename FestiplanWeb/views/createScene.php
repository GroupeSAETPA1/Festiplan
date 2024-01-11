<?php

// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}
?>
<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festiplan- creation spectacle 2</title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svgInFolder.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/formsInput/input.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/creationSpectacle.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/index/index.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createScene/createScene.css">

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
    <script src="/Festiplan/FestiplanWeb/static/scripts/creationSpectacle/inputIntervenantsScene.js" defer></script>
    <script src="/Festiplan/FestiplanWeb/static/scripts/creationSpectacle/creerCompte.js" defer></script>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
<div class="retour">
    <form action="index.php" method="post">
        <input type="hidden" name="controller" value="AjouterListesScene">
        <input type="hidden" name="id_festival" value="<?php echo $id_festival; ?>">
        <input type="hidden" name="nom_festival" value="<?php echo $nom_festival; ?>">
        <button type="submit" class="Retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
    </form>
</div>
<div class="app">
    <div class="title">
        <h1>Création d'une scene</h1>
    </div>
    <div class="wrapper">
        <form action="index.php" method="post" >
            <div class="container">
                <?php
                if (isset($erreur)) {
                    echo '<div class="erreur">' . $erreur . '</div>';
                }
                ?>
                <div class="input">
                    <h3>Nom de la scene:</h3>
                    <div class="text">Veuillez entrez le nom de la scene</div>
                    <input type="text" name="nomScene" value = "<?php echo $nomScene ?? "" ?>" />
                </div>
                <div class="input">
                    <h3>Taille de la scène :</h3>
                    <div class="text">Veuillez selectionner la taille de la scene</div>
                    <select name="tailleScene">
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
                <div class="input">
                    <h3>Nombre de spectateur :</h3>
                    <div class="text">Veuillez entrez le nombre de spectateur maximum</div>
                    <input type="number" name="nombreSpectateur" value = "<?php echo $nombreSpectateur ?? "" ?>" />
                </div>
                <div class="input">
                    <h3>Longitude :</h3>
                    <div class="text">Veuillez entrez la longitude de la scene</div>
                    <input type="number" name="longitude" value = "<?php echo $longitude ?? 0 ?>" />
                </div>
                <div class="input">
                    <h3>Latitude :</h3>
                    <div class="text">Veuillez entrez la latitude de la scene</div>
                    <input type="number" name="latitude" value = "<?php echo $latitude ?? 0 ?>" />
                </div>
                <div class="valid-annul-placement flex-row">
                    <input type="hidden" name="controller" value="CreateScene">
                    <input type="hidden" name="action" value="valider">
                    <input type="hidden" name="id_festival" value="<?php echo $id_festival; ?>">
                    <input type="hidden" name="nom_festival" value="<?php echo $nom_festival; ?>">
                    <button type="submit" class="valider page-suivante lastButton">
                        Creer la scene<i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>