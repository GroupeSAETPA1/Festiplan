// Gestion du bouton "supprimer" d'un spectacle
$(".btn-retirer-spectacle").click(function(e) {
    // Demander confirmation avant de supprimer
    if (!confirm("Supprimer le spectacle ?")) {
        e.preventDefault();
    }
});

// Gestion de l'affichage des images
$(".img-spectacle").each(function() {
    // On cache toutes les images qui n'ont pas pu être chargées
    $(this).find(":first-child").on("error", function() {
        $(this).parent().hide();
    });
});