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
        festival = await getDataFestival();
        spectacles = await getDataSpectacle();
        console.log(festival['nom']);
        console.log(spectacles);
    } catch (error) {
        console.error("Erreur lors de la récupération des données du festival", error);
        return;
    }
}

getAllData();
var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'timeGridCustomDuration',
    views: {
        timeGridCustomDuration: {
            type: 'timeGrid',
            duration: { days: 4 } // TODO recuperer le nombre de jour du festival ou faire 4 jour et apres regler gauche droite
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

    initialDate: new Date(2001, 8, 11), // Date d'initialisation du spectacle (mois - 1 !!!)
    validRange: {
        start: '2001-09-01', // Date de début et de fin du spéctacle
        end: '2001-09-24'
    },

    // Pour les Events
    slotEventOverlap:false,
    editable: true,
    eventDurationEditable: false,
    events: [
        {
            title: 'Durée du Festival',
            start: '2001-09-11T12:00',
            end: '2001-09-14T17:30',
            eventOverlap: false,
            display: 'background'
        },
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




