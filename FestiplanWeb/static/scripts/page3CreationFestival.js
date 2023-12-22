const interList = [];
const sceneList = [];
const BUTTON = $(".button-add-orga");
const SCENE = $("#listeScene");
const INPUT = $('#orga');

async function addOrga() {
    const input = INPUT.val();
    const isMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (input && isMail.test(input)) {
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

function addScene() {
    console.log(SCENE.val());
    input = SCENE.val();
    if (input && input != 'vide' && !sceneList.includes(input)) {
        //console.log("oui");
        SCENE.css({border: "1px solid black"});

        let choixValide;
        try {
            choixValide = await checChoixValide(input);
        } catch (error) {
            console.log("erreur de verification")
        }
    } else {
        SCENE.css({border: "1px solid red"});
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

        let controllerActionUrl = "/Festiplan/FestiplanWeb/index.php?controller=CreateSpectacle&action=checkUserByEmail";
        xmlhttp.open("GET", controllerActionUrl + "&email=" + encodeURIComponent(mail));
        xmlhttp.send();
    });
}

function checChoixValide(scene) {
    return new Promise(resolve , reject ) => {
        const xmlhttp = New XMLHttpRequest();

        xmlhttp.onload = function ()   {
            resolve(this.responseText);
        };

        xmlhttp.onerror = function() {
            reject(new Error("Erreur lors de la requete ajax"));
        };

        let controllerActionUrl = "/Festiplan/FestiplanWeb/index.php?controller=CreateFestival&action="

    }
}

$('.selections').on('click', '.delete', function() {
    let index = $(this).data('index');

    interList.splice(index, 1);

    // Refresh the display
    displayInter();
});

BUTTON.on('click', addOrga);
SCENE.on('change' , addScene);