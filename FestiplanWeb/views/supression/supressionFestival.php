<?php
// vérification de la connexion
if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header('Location: /Festiplan/FestiplanWeb/?controller=Home');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport">
        <title>Festiplan - Supression d'un Festival</title>

        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/footer.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/components/header.css">
        <link rel="stylesheet" href="/Festiplan/FestiplanWeb/static/style/css/supression/supression-festival.css">

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

    </head>
    <body>
    <div class="app">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/header.php" ?>
        <div class="retour">
            <a href="/Festiplan/FestiplanWeb/?controller=Dashboard">
                <button class="btn-retour"><i class="fa-solid fa-arrow-left"></i> Retour</button>
            </a>
        </div>
        <div class="wrapper">

            <div class="container">
                <div class="title">
                    <h1>Souhaitez vous supprimer ce festival ? </h1>
                </div>

                <div class="card-festival rounded">
                    <div class="haut-card">
                        <div class="img-festival">
                            <img src="<?php echo $festival[0]['illustration'] ?>"
                                 alt="Image du festival <?php echo $festival[0]['nom'] ?>'">
                        </div>
                        <p class="nom-festival bold"><?php echo $festival[0]['nom'] ?></p>
                        <div class="description-festival">
                            <p>Du <?php echo $festival[0]['debut'] ?></p>
                            <p>Au <?php echo $festival[0]['fin'] ?></p>
                        </div>
                        <div class="group-categories">
                            <span class="label-categorie">Cat&eacute;gories :</span>
                            <span class="categorie rounded"><?php echo $festival[0]['categorie'] ?></span>
                        </div>
                    </div>
                    <div class="group-description">
                        <span class="label-description">D&eacute;scription :</span><br>
                        <span class="description"><?php echo $festival[0]['description'] ?></span>
                    </div>
                </div>
            </div>
            <form method="post" action="/Festiplan/FestiplanWeb/">
                <div class="valid-annul-placement flex-row">
                    <a href="/Festiplan/FestiplanWeb/?controller=Dashboard" title="Annuler et garder le festival">
                        <div class="annulChoix lastButton rounded">
                            Garder
                        </div>
                    </a>
                    <input hidden name="action" value="suprimmer">
                    <input hidden name="controller" value="SupressionFestival">
                    <button type="submit" class="supprimer lastButton rounded"
                            title="Supprimer définitivement le festival">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Festiplan/FestiplanWeb/static/components/footer.php" ?>
    </body>
</html>
