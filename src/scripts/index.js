$('.creationCompte').hide();

$('.creerCompte').click(function() {
    // animation : la presentation se décale vers la gauche
    gsap.from('.presentation', {
        x: -500,
        duration: 1.5
    });
    // animation : la connexion se décale vers la gauche
    gsap.to('.connexion', {
        x: 500,
        duration: 1.5
    });
    // animation : le formulaire apparait
    gsap.from('.creationCompte', {
        x: -500,
        duration: 1.5
    });
    $('.creationCompte').show();
    // on attend 1.5s avant de cacher la connexion
    setTimeout(function() {
        $('.connexion').hide();
    }, 1500);


});

$('.retour').click(function() {
    $('.creationCompte').hide();
    $('.connexion').show();
});