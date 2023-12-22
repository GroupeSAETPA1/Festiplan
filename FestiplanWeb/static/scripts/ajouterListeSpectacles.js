const tab_boutons = document.querySelectorAll(".bouton-ajouter-spectacle");

console.log(tab_boutons);

function getInfoSpectacle(bouton) {
    console.log(bouton.parentNode.parentNode.parentNode.childNodes);
    console.log(" cliqué")
}

for (let i = 0; i < tab_boutons.length; i++) {
    tab_boutons[i].addEventListener("click", (event) => {
        getInfoSpectacle(event.target)
    });
}