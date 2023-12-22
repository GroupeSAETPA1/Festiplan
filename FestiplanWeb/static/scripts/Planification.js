var festival;
var spectacles;

function getDataFestival() {
    return new Promise((resolve, reject) => {
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function() {
            resolve(this.responseText);
        };

        xmlhttp.onerror = function() {
            reject(new Error("Erreur lors de la requête AJAX"));
        };

        let controllerActionUrl = "/Festiplan/FestiplanWeb/index.php?controller=Planification&action=getDataFestival";
        xmlhttp.open("GET", controllerActionUrl);
        xmlhttp.send();
    });
}

function getDataSpectacle() {
    return new Promise((resolve, reject) => {
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function() {
            resolve(this.responseText);
        };

        xmlhttp.onerror = function() {
            reject(new Error("Erreur lors de la requête AJAX"));
        };

        let controllerActionUrl = "/Festiplan/FestiplanWeb/index.php?controller=Planification&action=getDataSpectacle";
        xmlhttp.open("GET", controllerActionUrl);
        xmlhttp.send();
    });
}

async function getAllData() {
    try {
        festival = JSON.parse(await getDataFestival());
        spectacles = JSON.parse(await getDataSpectacle());
    } catch (error) {
        console.error("Erreur lors de la récupération des données du festival", error);
        return;
    }
}

construireCalendrier();

async function construireCalendrier() {
    await getAllData();
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridCustomDuration',
        views: {
            timeGridCustomDuration: {
                type: 'timeGrid',
                duration: { days: await getFestivalDuration()} // TODO recuperer le nombre de jour du festival ou faire 4 jour et apres regler gauche droite
            }
        },
        contentHeight: 600, // TODO définir une bonne hauteur
        slotMinTime: '00:00:00',
        slotMaxTime: '10:00:00',
        titleFormat: { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        },
    
        headerToolbar: {
            left: '',
            center: 'title',
            end: 'prev,next'
        },
    
        dayHeaderFormat: {
            weekday: 'long', 
            month: 'numeric', 
            day: 'numeric'
        },
    
        locale: 'fr',
        allDaySlot: false,
        slotDuration: '00:30:00', // la durée des intervalles affichés
    
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: false,
        },
    
        slotLabelInterval : '00:30:00',
        scrollTime : '10:00:00', // Temps affiché a l'initialisation
        scrollTimeReset: false,
    
        initialDate: new Date(festival.debut), // Date d'initialisation du spectacle 
        validRange: {
            start: new Date(festival.debut), // Date de début et de fin du spéctacle
            end: new Date(festival.fin)
        },
    
        // Pour les Events
        slotEventOverlap:false,
        editable: true,
        eventDurationEditable: false,
        events: [
            {
              title: 'Vidéo projection du seigneur des annaux : les deux tours',
              start: '2001-09-11T14:14',
              end: '2001-09-11T17:30'
            },
            {
                title: 'Concert de Mariah Carey',
                start: '2001-09-11T13:00',
                end: '2001-09-11T15:30'
            }
        ]
    });
    calendar.render();
}

function getFestivalDuration() {
    let dateDebutFestival = new Date(festival.debut);
    let dateFinFestival = new Date(festival.fin);

    // Pour calculer la différence de temps entre la date de début et la date de fin du festival
    let DifferenceDeTemps = dateFinFestival.getTime() - dateDebutFestival.getTime();
 
    // Pour calculer apres cette différence en jour
    let DifferenceEnJour = 
    Math.round(DifferenceDeTemps / (1000 * 3600 * 24)) + 1;

    // Si la durée est plus grande que 4 jours on affiche que 4 jour 
    // pour plus de visibilitée pour l'utilisateur
    resultat = DifferenceEnJour > 4 ? 4 : DifferenceEnJour;
    console.log(resultat);
    return resultat;
}