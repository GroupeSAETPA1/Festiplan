const interList = [];
const interListHorsScene = [];

const BUTTON = $(".button-add-inter");
const BUTTON_HORS_SCENE = $(".button-add-interHorsScene");

const INPUT = $('#inter');
const INPUT_HORS_SCENE = $('#interHorsScene');

const SELECTION = $('.selections');
const SELECTION_HORS_SCENE = $('.selectionsHorsScene');

async function addInter(INPUT, list, SELECTION) {
    const input = INPUT.val();
    const isMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (input && isMail.test(input) && !list.find(inter => inter.name === input)) {
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
            id: list.length,
            name: input,
            valid: emailValid === "1",
        };

        list.push(inter);
        INPUT.val('');
        displayInter(SELECTION, list);
    } else {
        if (list.find(inter => inter.name === input)) {
            alert("L'adresse mail est déjà présente");
        }
        INPUT.css({
            border: "1px solid red",
        });
    }
}

function displayInter(SELECTION, list) {
    let selection = SELECTION[0];
    selection.innerHTML = '';

    for (let i = 0; i < list.length; i++) {
        let htmlContent = `<div class="selection">
            <div class="left">
                <i class="fa-${list[i].valid ? 'solid fa-check ok' : 'regular fa-plus add'}"></i>
            </div>
            <div class="name">${list[i].name}</div>
            <div class="delete" data-index="${i}">
                <i class="fa-solid fa-trash-can"></i>
            </div>`;
        // si la liste est celle des intervenants hors scene on ajoute une input caché pour le formulaire
        if (SELECTION === SELECTION_HORS_SCENE) {
            htmlContent += `<input type="hidden" name="interHorsScene[]" value="${list[i].name}">`;
        } else {
            htmlContent += `<input type="hidden" name="inter[]" value="${list[i].name}">`;
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

        let controllerActionUrl = "/Festiplan/FestiplanWeb/index.php?controller=CreateSpectacle&action=checkUserByEmail";
        xmlhttp.open("GET", controllerActionUrl + "&email=" + encodeURIComponent(mail));
        xmlhttp.send();
    });
}

SELECTION.on('click', '.delete', function() {
    let index = $(this).data('index');

    interList.splice(index, 1);
    // Refresh the display
    displayInter(SELECTION, interList);
});
SELECTION_HORS_SCENE.on('click', '.delete', function() {
    let index = $(this).data('index');

    interListHorsScene.splice(index, 1);
    // Refresh the display
    displayInter(SELECTION_HORS_SCENE, interListHorsScene);
});


BUTTON.on('click', function() {
    addInter(INPUT, interList, SELECTION);
});
BUTTON_HORS_SCENE.on('click', function() {
    addInter(INPUT_HORS_SCENE, interListHorsScene, SELECTION_HORS_SCENE);
});
