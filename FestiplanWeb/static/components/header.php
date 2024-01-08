<header>
    <!-- La redirection est géré par scripts/redirection_logo.js -->
    <div class="logo" id="logo">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Festiplan</span>
    </div>
    <div class="mon-compte">
        <div>
            <i class="fa-solid fa-user"></i>
            <span>
                <?php
                if (isset($_SESSION['connecte']) && $_SESSION['connecte']) {
                    $prenom = $_SESSION['prenom'];
                    $nom = $_SESSION['nom'];
                    echo $prenom . " " . $nom;
                } else {
                    echo "Mon Compte";
                }
                ?>
            </span>
        </div>
    </div>
</header>