<?php
$tempIntervenants = ["quentin", "pierre", "paul", "jacques"];
?>

<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festiplan- creation spectacle 1</title>

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/dashboard/dashboard.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components\footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components\header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/createSpectacle/createSpectacle.css">
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
    <?php include $_SERVER['DOCUMENT_ROOT']."/Festiplan/FestiplanWeb/static/components/header.php" ?>
    <div class="wrapper">
        <div class="custom-select">
            <label for="inter">Intervenants :</label>
            <div class="text">Veuillez rentrer l'email du compte, </br>le compte n'existe pas, vous pouvez le crer avec le + </div>
            <div class="row">
                <input id="inter" type="text" placeholder="exemple@mail.fr">
                <div class="button-add-inter">
                    <i class="fa-solid fa-plus"></i>
                    Ajouter l'intervenant
                </div>
            </div>
            <div class="selections">
                <!-- rempli avec le js -->
            </div>
        </div>
        <div class="creation-compte">
            <div class="title">
                <h2>Création de compte</h2>
            </div>
            <div class="row">
                <div class="input">
                    <label for="nom">Nom :</label>
                    <input id="nom" type="text" placeholder="Nom">
                </div>
                <div class="input">
                    <label for="prenom">Prénom :</label>
                    <input id="prenom" type="text" placeholder="Prénom">
                </div>
            </div>
            <div class="row">
                <div class="input">
                    <label for="email">Email :</label>
                    <input id="email" type="text" placeholder="Email">
                </div>
                <div class="input">
                    <label for="mdp">Mot de passe :</label>
                    <input id="mdp" type="password" placeholder="Mot de passe">
                </div>
            </div>
            <div class="row">
                <div class="input">
                    <label for="mdp2">Confirmer le mot de passe :</label>
                    <input id="mdp2" type="password" placeholder="Confirmer le mot de passe">
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT']."/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>