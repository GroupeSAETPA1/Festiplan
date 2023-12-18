const div_logo = document.getElementById("div_logo");

div_logo.style.cursor = "pointer";
div_logo.addEventListener("click", () => {
    //Demander confirmation avant de quitter la page
    if (confirm("Êtes-vous sûr de vouloir quitter la page ?")) {
        window.location.href = "/Festiplan/FestiplanWeb/";
    }
});