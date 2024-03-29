<?php

// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="icon" href="/Festiplan/FestiplanWeb/datas/img/logo.ico" />
    <title>Festiplan - Planification</title>

    <!-- Bootstrap 5.3 -->
    <link rel="stylesheet" href="/Festiplan/node_modules/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
    <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/Planification/Planification.css">


    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/d9b7264c5a.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <!-- GSAP -->  <!-- Jquery -->
    <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
    <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>

    <!-- Fullcalendar -->
    <script src="/Festiplan/node_modules/fullcalendar/index.global.min.js" defer></script>
    <script src="/Festiplan/FestiplanWeb/static/scripts/Planification.js" defer></script>

    <!-- Autres scripts -->
    <script src="/Festiplan/FestiplanWeb/static/scripts/redirection_logo.js" defer></script>
    <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
</head>

<body>
<div class="app">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-3 retour">
                <a href="/Festiplan/FestiplanWeb/?controller=Dashboard" class="retourBouton"><i
                            class="fas fa-arrow-left"></i> Retour</a>
            </div>
            <div class="col-12">
                <h1>Planification du festival <?php echo $festival["nom"] ?></h1>
                <input hidden id="renvoiIDFestival" value="<?php echo $festival["id_festival"] ?>">
                <div class="Planification">
                    <div class="scrollDIV">
                        <div id="calendar" class="caldendar">
                            <!-- DIV complétée par la librairie fullcalendar -->
                        </div>
                    </div>
                    <br>
                    <div id="couleurScenes">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
</body>
</html>
