function responsive() {
    const HAUTEUR_PAGE = $(".app").height();
    if (window.innerWidth < 1_000) {
        if ($('.creationCompte').css('display') !== 'none') {
            $(".partiePrincipale").css({
                flexDirection: "column-reverse",
            });
        } else {
            $(".partiePrincipale").css({
                flexDirection: "column",
            });
        }
    } else {
        $(".partiePrincipale").css({
            flexDirection: "row",
        });
    }
}

responsive();
window.addEventListener("resize", responsive);
setInterval(() => {
    responsive();
}, 25);