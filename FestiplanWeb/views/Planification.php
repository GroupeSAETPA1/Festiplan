<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport">
        <title>Festiplan - Planification</title>

        <!-- Bootstrap 5.3 -->
        <link rel="stylesheet" href="/Festiplan/node_modules/bootstrap/dist/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/svg.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/Planification/Planification.css">


        <!-- Fontawesome --><!-- TODO Custom Kit -->
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/framework/fontawesome-free-6.2.1-web/css/all.css">
        <!-- Font Awesome -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
              crossorigin="anonymous"
              referrerpolicy="no-referrer"/>

        <!-- Scripts -->
        <!-- GSAP -->  <!-- Jquery -->
        <script src="/Festiplan/node_modules/gsap/dist/gsap.min.js"></script>
        <script src="/Festiplan/node_modules/jquery/dist/jquery.min.js"></script>

        <!-- Fullcalendar -->
        <script src="/Festiplan/node_modules/fullcalendar/index.global.min.js" defer></script>

        <script src="/Festiplan/FestiplanWeb/static/scripts/Planification.js" defer></script>

        <script src="/Festiplan/FestiplanWeb/static/scripts/redirection_logo.js" defer></script>
        <script src="/Festiplan/FestiplanWeb/static/scripts/responsive/footerResponsive.js" defer></script>
    </head>

    <body>
    <div class="app">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <a href="" class="retourBouton"><i class="fa-solid fa-arrow-left"></i> Retour</a>
                </div>
                <div class="col-12">
                    <h1>Planification du festival <?php echo $festival["nom"] ?></h1>
                    <?php var_dump($festival);
                          echo "<H1>Specacle</H1>";
                          var_dump($spectaclesFestival)?>
                    <div class="col-12 text-right"><button class="genererPlanificationBouton">Générer Automatiquement la Planification</button></div>
                    <div class="Planification">
                        <div class="scrollDIV">
                            <div id="calendar" class="caldendar">
                            <!-- DIV complétée par la librairie fullcalendar -->
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>
