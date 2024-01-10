/* Gestion du bouton "supprimer" d'un spectacle */
const boutons_retirer_spectacle = document.getElementsByClassName("btn-retirer-spectacle");

for (let bouton of boutons_retirer_spectacle) {
    bouton.addEventListener("click", ()=>{
        console.log("Parent")
        console.log(bouton.parentNode.childNodes)
        //Demander confirmation avant de supprimer
        //if (!confirm("Supprimer le spectacle ?")) {
        //    bouton.preventDefault();
        //}
    });
}

/* Gestion de l'affichage des images */
const tab_image_spectacle = document.getElementsByClassName("img-spectacle");

// On cache toutes les images qui n'ont pas pu être chargées
for (const image_spectacle of tab_image_spectacle) {
    console.log(image_spectacle)
    console.log(image_spectacle.firstElementChild.complete)
    image_spectacle.firstElementChild.addEventListener("error", function () {
        image_spectacle.style.display = "none";
    });
}