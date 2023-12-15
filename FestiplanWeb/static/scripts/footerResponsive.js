function gererFooter() {
    const HAUTEUR_PAGE = $(".app").height();

    const FOOTER = $(".footer");
    console.log("hauteur page :  " + HAUTEUR_PAGE, "\nwindow.innerHeight : " + window.innerHeight, "\nFOOTER.height : " + FOOTER.height());

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
}

gererFooter();
window.addEventListener("resize", gererFooter);
setInterval(() => {
    gererFooter();
}, 1000);