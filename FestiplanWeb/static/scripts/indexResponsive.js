function responsive() {
    const HAUTEUR_PAGE = $(".app").height();

    const FOOTER = $(".footer");

    if (HAUTEUR_PAGE < window.innerHeight - FOOTER.height()) {
        FOOTER.css({
            position: "absolute",
            bottom: "0",
            left: "0",
            right: "0"
        });
    } else {
        FOOTER.css({
            position: "relative"
        });
    }
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
}, 500);