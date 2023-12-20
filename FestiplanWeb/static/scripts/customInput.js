const interList = [];
const BUTTON = $(".button-add-inter");
const INPUT = $('#inter');

function addInter() {
    const input = INPUT.val();

    if (input) {
        INPUT.css({
            border: "1px solid black",
        });

        let inter = {
            id: interList.length,
            name: input,
            valid: checkInter(input),
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
    const xmlhttp = new XMLHttpRequest();

    let emailValid;

    xmlhttp.onload = function() {
        emailValid = this.responseText;
    };
    xmlhttp.open("GET", "fichier.php?q=" + mail);
    xmlhttp.send();

    return emailValid;
}

$('.selections').on('click', '.delete', function() {
    let index = $(this).data('index');

    interList.splice(index, 1);

    // Refresh the display
    displayInter();
});

BUTTON.on('click', addInter);
