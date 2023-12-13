function changeFooterPosition() {
    const FOOTER = $(".footer"),
        BODY = $("body");

    if (window.innerHeight > BODY[0].getBoundingClientRect().height) {
        console.log("absolute");
        FOOTER.css({
            "position": "absolute",
            "bottom": 0
        });
    } else {
        console.log("normal")
        FOOTER.css({
            "position": "",
            "bottom": ""
        });
    }
}

window.addEventListener("resize", changeFooterPosition);
changeFooterPosition();
