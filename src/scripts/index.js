$('.creationCompte').hide();

$('.creerCompte').click(function() {
    $('.creationCompte').show();
    $('.connexion').hide();
});

$('.retour').click(function() {
    $('.creationCompte').hide();
    $('.connexion').show();
});