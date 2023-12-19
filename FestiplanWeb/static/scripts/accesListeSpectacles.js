const liste_spectacles = document.getElementById("container-card-spectacles");
const btn_accordeon = document.getElementById("bouton-drop-down");

console.log(liste_spectacles);

liste_spectacles.style.display = "none";

btn_accordeon.addEventListener("click", () => {
    if (liste_spectacles.style.display === "none") {
        liste_spectacles.style.display = "block";
    } else {
        liste_spectacles.style.display = "none";
    }
});