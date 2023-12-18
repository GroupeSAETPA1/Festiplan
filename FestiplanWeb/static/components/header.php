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
                if (isset($nom) && isset($prenom)) {
                    echo $prenom . " " . $nom;
                } else {
                    echo "Mon Compte";
                }
                ?>
            </span>
        </div>
    </div>
</header>