<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festiplan - Page d'Acceuil</title>
    <link rel="stylesheet" href="../static/style/css/index/index.css">
    <link rel="stylesheet" href="../static/style/css/index/forms.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />

    <link rel="icon" href="../static/assets/img/Favicon.png" /> <!--  A remplacer quand on aura la favicon  -->

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>
    <!-- JS -->
    <script src="../static/scripts/index.js" type="module" defer></script>
</head>
<body>
    <div class="app">
        <div class="partiePrincipale">
            <div class="formulaire creationCompte">
                <form>
                    <div class="form-duo">
                        <div class="colonneCreationCompte">
                            <label id="nom">
                                Nom :
                            </label>
                            <input type="text" id="nom" placeholder="Votre nom :" required>
                        </div>
                        <div class="colonneCreationCompte">
                            <label id="prenom">
                                Prénom :
                            </label>
                            <input type="text" id="prenom" placeholder="Votre prénom :" required>
                        </div>
                    </div>
                    <div class="colonneCreationCompte">
                        <label id="mail">
                            Email :
                        </label>
                        <input type="email" id="mail" placeholder="Votre email :" required>
                    </div>
                    <div class="form-duo">
                        <div class="colonneCreationCompte">
                            <label id="identifiantCrea">
                                Identifiant :
                            </label>
                            <input type="text" id="identifiantCrea" placeholder="Votre identifiant :">
                        </div>
                        <div class="colonneCreationCompte">
                            <label id="mdpCrea">
                                Mot de passe :
                            </label>
                            <input type="text" id="mdpCrea" placeholder="Votre mot de passe :">
                        </div>
                    </div>
                    <div class="form-duo">
                        <button class="retour">
                            <i class="fa-solid fa-arrow-left"></i>
                            Retour
                        </button>
                        <input type="submit" class="boutonCreation" value="Créer le compte">
                    </div>
                </form>
            </div>
            <div class="presentation">
                <i class="fa-solid fa-calendar-days"></i>
                <div class="titre">Festiplan</div>
                <p>
                    Créer et gérer tous vos évenements,<br>
                    avec facilité et ergonomie.
                </p>
            </div>
            <div class="formulaire connexion">
                <form>
                    <div class="colonneCreationCompte">
                        <label id="identifiant">
                            Identifiant
                        </label>
                        <input type="text" id="identifiant" placeholder="Entrez votre identifiant :" required>
                    </div>
                    <div class="colonneCreationCompte">
                        <label id="mdp">
                            Mot de passe
                        </label>
                        <input type="password" id="mdp" placeholder="Entrez votre mot de passe :" required> <!-- TODO mettre des longeur max d'id et de mdp -->
                    </div>
                    <button class="creerCompte">Créer un compte <i class="fa-solid fa-arrow-right"></i></button>
                    <input type="submit" class="boutonConnexion" value="Me Connecter">
                </form>
            </div>

        </div>
    </div>
    <footer class="footer">
    </footer>
</body>
</html>