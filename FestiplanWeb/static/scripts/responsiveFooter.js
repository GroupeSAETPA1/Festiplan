function changeFooterPosition() {
    const FOOTER = $(".footer"),
        BODY = $("body");

    if (window.innerHeight > BODY.getBoundingClientRect().height) {
        FOOTER.style.position = "absolute";
        FOOTER.style.bottom = 0;
    } else {
        FOOTER.style.position = "";
        FOOTER.style.bottom = "";
    }
}

window.addEventListener("resize", changeFooterPosition);
changeFooterPosition();