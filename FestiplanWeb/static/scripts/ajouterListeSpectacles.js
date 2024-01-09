/* Gestion de l'affichage des boutons "ajouter" */
const tab_liste_selection_scene = document.getElementsByClassName("selection_scene");
const tab_btn_ajouter_spectacle = document.getElementsByClassName("fa-circle-plus");

console.log(tab_liste_selection_scene);
console.log(tab_btn_ajouter_spectacle);

// On cache tous les boutons "ajouter"
for (const btn_ajouter_spectacle of tab_btn_ajouter_spectacle) {
    btn_ajouter_spectacle.parentElement.style.display = "none";
}

// Dès qu'on sélectionne une scene dans la liste, on affiche le bouton "ajouter
for (const liste_selection_scene of tab_liste_selection_scene) {
    liste_selection_scene.addEventListener("change", function () {
        const id_spectacle = liste_selection_scene.id;
        const btn_ajouter_spectacle = document.getElementById("bouton" + id_spectacle);
        btn_ajouter_spectacle.parentElement.style.display = "block";
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