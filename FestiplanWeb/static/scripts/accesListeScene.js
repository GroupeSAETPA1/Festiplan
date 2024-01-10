/* Gestion du bouton "supprimer" d'une scene */
$(".btn-retirer-spectacle").click(function(e) {
    //Demander confirmation avant de supprimer
    if (!confirm("Supprimer la scene ?")) {
        e.preventDefault();
    }
});