const liste_spectacles = document.getElementById("container-card-spectacles");
const btn_accordeon = document.getElementById("bouton-drop-down");

const boutons_retirer_spectacle = document.getElementsByClassName("btn-retirer-spectacle");

/* Gestion de l'accordéon */
btn_accordeon.addEventListener("click", () => {
    if (liste_spectacles.style.display === "none") {
        liste_spectacles.style.display = "block";
    } else {
        liste_spectacles.style.display = "none";
    }
});

/* Gestion du bouton supprimer d'un spectacle */
for (let bouton of boutons_retirer_spectacle) {
    bouton.addEventListener("click", ()=>{
        console.log("Parent")
        console.log(bouton.parentNode.childNodes)
        //Demander confirmation avant de supprimer
        if (!confirm("Supprimer le spectacle ?")) {
            bouton.preventDefault();
        }
    });
}