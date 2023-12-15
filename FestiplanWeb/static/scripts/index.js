if($('#displayInscription').val()) {
    const TL = gsap.timeline({paused: false});
    TL
        .to(".presentation, .connexion", {
            duration: 0,
            delay: 0,

            opacity: 0,
            x: "100%",

            ease: "power2.in",
            stagger: .1,
        })
        .to(".connexion", {
            duration: 0,
            delay: 0,

            display: "none",
        })
        .to(".presentation", {
            duration: 0,
            delay: 0,

            x: "-100%",
        })
        .to(".creationCompte", {
            duration: 0,
            delay: 0,

            display: "block",
        })
        .to(".creationCompte, .presentation", {
            duration: 0,
            delay: 0,

            opacity: 1,
            x: 0,

            ease: "power2.out",
            stagger: -.1,
        })
        .play();
}

$('#switchToSignup').click(function() {
    const TL = gsap.timeline({paused: false});

    // animation : la presentation se décale vers la gauche
    TL
        .to(".presentation, .connexion", {
            duration: 1,
            delay: 0,

            opacity: 0,
            x: "100%",

            ease: "power2.in",
            stagger: .1,
        })
        .to(".connexion", {
            duration: 0,
            delay: 0,

            display: "none",
        })
        .to(".presentation", {
            duration: 0,
            delay: 0,

            x: "-100%",
        })
        .to(".creationCompte", {
            duration: 0,
            delay: 0,

            display: "block",
        })
        .to(".creationCompte, .presentation", {
            duration: 1,
            delay: 0,

            opacity: 1,
            x: 0,

            ease: "power2.out",
            stagger: -.1,
        })
        .play();
});

$('#switchToSLogin').click(function() {
    // inverse de la fonction précédente
    const TL = gsap.timeline({paused: false});

    TL
        .to(".creationCompte, .presentation", {
            duration: 1,
            delay: 0,

            opacity: 0,
            x: "-100%",

            ease: "power2.in",
            stagger: .1,
        })
        .to(".creationCompte", {
            duration: 0,
            delay: 0,

            display: "none",
        })
        .to(".presentation", {
            duration: 0,
            delay: 0,

            x: "100%",
        })
        .to(".connexion", {
            duration: 0,
            delay: 0,

            display: "block",
        })
        .to(".connexion, .presentation", {
            duration: 1,
            delay: 0,

            opacity: 1,
            x: 0,

            ease: "power2.out",
            stagger: -.1,
        })
        .play();
});