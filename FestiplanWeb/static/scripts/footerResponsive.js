$(document).ready(function($){
    console.log(document.body);
    function gererFooter() {
        const HAUTEUR_PAGE = $(".app").height;

        const FOOTER = $(".footer");

        if (HAUTEUR_PAGE < window.innerHeight) {
            FOOTER.css({
                position: "absolute",
                bottom: "0",
                left: "0",
                right: "0"
            });
        }
    }

    gererFooter();
    window.addEventListener("resize", gererFooter);
});