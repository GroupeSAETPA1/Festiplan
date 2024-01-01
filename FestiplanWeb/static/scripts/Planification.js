let festival;
let spectacles;

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
        console.log(spectacles);
        console.log(festival);
    } catch (error) {
        console.error("Erreur lors de la récupération des données du festival", error.stack);
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
                duration: { days: await getFestivalDuration()}
            }
        },
        contentHeight: 600, // TODO définir une bonne hauteur
        slotMinTime: festival.heure_debut_spectacles,
        slotMaxTime: festival.heure_fin_spectacles,
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

        slotLabelInterval : "00:30",
        scrollTime : festival.heure_debut_spectacles, // Temps affiché a l'initialisation
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
        events: await displayEvents()
    });
    console.log(calendar);
    calendar.render();
}
async function displayEvents(){
    let events = [];

    for (let i = 0; i < spectacles.length; i++) {
        let nomSpectacle = spectacles[i].nom;
        let dateDebut = new Date("2024-01-01T14:00");
        let dateFin = new Date(dateDebut.getTime() + spectacles[i].duree * 60000);

        events.push({
            title: nomSpectacle,
            start: dateDebut,
            end: dateFin
        });
    }
    console.log(events);
    return events;
}
async function getFestivalDuration() {
    let resultat;
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
    return resultat;
}