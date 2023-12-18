function footerResponsive() {
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
}
window.addEventListener("resize", footerResponsive);
setInterval(() => {
    footerResponsive();
}, 500);
footerResponsive();