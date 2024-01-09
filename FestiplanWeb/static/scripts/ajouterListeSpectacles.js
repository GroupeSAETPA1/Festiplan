const tab_liste_selection_scene = document.getElementsByClassName("selection_scene");
const tab_btn_ajouter_spectacle = document.getElementsByClassName("fa-circle-plus");

console.log(tab_liste_selection_scene);
console.log(tab_btn_ajouter_spectacle);

for (const btn_ajouter_spectacle of tab_btn_ajouter_spectacle) {
    btn_ajouter_spectacle.parentElement.style.display = "none";
}

for (const liste_selection_scene of tab_liste_selection_scene) {
    liste_selection_scene.addEventListener("change", function () {
        const id_spectacle = liste_selection_scene.id;
        const btn_ajouter_spectacle = document.getElementById("bouton" + id_spectacle);
        btn_ajouter_spectacle.parentElement.style.display = "block";
    });
}

const tab_image_spectacle = document.getElementsByClassName("img-spectacle");

for (const image_spectacle of tab_image_spectacle) {
    console.log(image_spectacle)
    console.log(image_spectacle.firstElementChild.complete)
    image_spectacle.firstElementChild.addEventListener("error", function () {
        image_spectacle.style.display = "none";
    });
}