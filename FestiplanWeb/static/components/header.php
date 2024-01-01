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
                if (isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                    echo $_SESSION['prenom'] . " " . $_SESSION['nom'];
                } else {
                    echo "Mon Compte";
                }
                ?>
            </span>
        </div>
    </div>
</header>