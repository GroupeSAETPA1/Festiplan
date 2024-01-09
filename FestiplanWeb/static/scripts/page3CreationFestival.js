const interList = [];
const sceneList = [];
const spectacleList = [] ;
const BUTTON = $(".button-add-orga");
const SCENE = $("#listeScene");
const SPECTACLE = $("#listeSpectacle");
const INPUT = $('#orga');

async function addOrga() {
    const input = INPUT.val();
    const isMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    console.log(interList)
    const isDuplicate = interList.some(orga => orga.name === input);
    console.log(isDuplicate);
    if (input && isMail.test(input) && !isDuplicate) {
        INPUT.css({
            border: "1px solid black",
        });

        let emailValid;
        try {
            emailValid = await checkInter(input);
        } catch (error) {
            console.error("Erreur lors de la vérification de l'email", error);
            return;
        }

        let inter = {
            id: interList.length,
            name: input,
            valid: emailValid === "1",
        };

        interList.push(inter);
        INPUT.val('');
        displayInter();
    } else {
        INPUT.css({
            border: "1px solid red",
        });

    }
}

async function addScene() {
    input = SCENE.val();
    //console.log(sceneList);
    const isDuplicate = sceneList.some(scene => scene.name === input);
    if (input && input != 'vide' && !isDuplicate) {
        SCENE.css({border: "1px solid black"});

        let choixValide;
        try {
            choixValide = await checkChoixValide(input);
        } catch (error) {
            console.log("erreur de verification")
        }

        let scene = {
            id: sceneList.length,
            name: input,
            valid: choixValide === "1",
        };
        sceneList.push(scene);
        INPUT.val('');
        displayScene();
    } else {
        SCENE.css({border: "1px solid red"});
    }
}

async function addSpectacle() {
    input = SPECTACLE.val();
    const isDuplicate = spectacleList.some(spectacle => spectacle.name === input);
    if (input && input != 'vide' && !isDuplicate) {
        SPECTACLE.css({border: "1px solid black"});

        let choixValide;
        try {
            choixValide = await checkSpectacleValide(input);
        } catch (error) {
            console.log("erreur lors de la verification du spectacle");
        }

        console.log(choixValide);
        let spectacle = {
            id: spectacleList.length ,
            name : input ,
            valid: choixValide === "1" ,
        };

        spectacleList.push(spectacle);
        INPUT.val('');
        displaySpectacle();
    } else {
        SPECTACLE.css({border: "1px solid red"});
    }
}

function displaySpectacle() {
    let selection = $('.spectacleSelect')[0];
    selection.innerHTML = '';
    for (let i = 0 ; i < spectacleList.length ; i++ ) {
        let htmlContent = `<div class="selection">
            <div class="left">
                <i class="fa-${spectacleList[i].valid ? 'solid fa-check ok' : 'regular fa-plus add'}"></i>
            </div>
            <div class="name">${spectacleList[i].name}</div>
            <div class="delete" data-index="${i}">
                <i class="fa-solid fa-trash-can"></i>
            </div>
        </div>`;
        if (spectacleList[i].valid) {
            htmlContent += `<input type="hidden" name="spectacle[]" value="${spectacleList[i].name}"></div>`;
        }

        selection.innerHTML += htmlContent;
    }
}

function displayInter() {
    let selection = $('.selections')[0];
    selection.innerHTML = '';


    for (let i = 0; i < interList.length; i++) {
        let htmlContent = `<div class="selection">
            <div class="left">
                <i class="fa-${interList[i].valid ? 'solid fa-check ok' : 'regular fa-plus add'}"></i>
            </div>
            <div class="name">${interList[i].name}</div>
            <div class="delete" data-index="${i}">
                <i class="fa-solid fa-trash-can"></i>
            </div>
        </div>`;
        if (interList[i].valid) {
            htmlContent += `<input type="hidden" name="organisateur[]" value="${interList[i].name}"></div>`;
        }
        selection.innerHTML += htmlContent;
    }
}

function displayScene() {
    let selection = $('.sceneSelect')[0];
    selection.innerHTML = '';
    for (let i = 0; i < sceneList.length; i++) {
        let htmlContent = `<div class="selection">
            <div class="left">
                <i class="fa-${sceneList[i].valid ? 'solid fa-check ok' : 'regular fa-plus add'}"></i>
            </div>
            <div class="name">${sceneList[i].name}</div>
            <div class="delete" data-index="${i}">
                <i class="fa-solid fa-trash-can"></i>
            </div>`;
            if (sceneList[i].valid) {
                htmlContent +=  `<input type="hidden" name="scene[]" value="${sceneList[i].name}"></div>`;
            }

        selection.innerHTML += htmlContent;
    }
}

function checkInter(mail) {
    return new Promise((resolve, reject) => {
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function() {
            resolve(this.responseText);
        };

        xmlhttp.onerror = function() {
            reject(new Error("Erreur lors de la requête AJAX"));
        };

        let controllerActionUrl = "/Festiplan/FestiplanWeb/index.php?controller=CreateFestival&action=checkUserByEmail";
        xmlhttp.open("GET", controllerActionUrl + "&email=" + encodeURIComponent(mail));
        xmlhttp.send();
    });
}

function checkChoixValide(scene) {
    return new Promise((resolve, reject) => {
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function () {
            resolve(this.responseText);
        };

        xmlhttp.onerror = function () {
            reject(new Error("Erreur lors de la requete ajax"));
        };

        let controllerActionUrl = "/Festiplan/FestiplanWeb/index.php?controller=CreateFestival&action=verifierScene";
        xmlhttp.open("GET", controllerActionUrl +"&scene=" + encodeURIComponent(scene));
        xmlhttp.send();
    });
}

function checkSpectacleValide(spectacle) {
    return new Promise((resolve, reject) => {
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function () {
            resolve(this.responseText);
        };

        xmlhttp.onerror = function () {
            reject(new Error("Erreur lors de la requete ajax"));
        };

        let controllerActionUrl = "/Festiplan/FestiplanWeb/index.php?controller=CreateFestival&action=verifierSpectacle";
        xmlhttp.open("GET", controllerActionUrl +"&spectacle=" + encodeURIComponent(spectacle));
        xmlhttp.send();
    });
}

$('.selections').on('click', '.delete', function() {
    let index = $(this).data('index');

    interList.splice(index, 1);

    // Refresh the display
    displayInter();
});

$('.sceneSelect').on('click', '.delete', function() {
    let index = $(this).data('index');

    // Supprimez la scène correspondante de sceneList
    sceneList.splice(index, 1);

    // Rafraîchissez l'affichage
    displayScene();
});

BUTTON.on('click', addOrga);
SCENE.on('change' , addScene);
SPECTACLE.on('change' , addSpectacle);