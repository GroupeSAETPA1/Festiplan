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
    } catch (error) {
        console.error("Erreur lors de la récupération des données du festival", error);
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
        contentHeight: 800, // TODO définir une bonne hauteur
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
            end: ''
        },

        dayHeaderFormat: {
            weekday: 'long',
            month: 'numeric',
            day: 'numeric'
        },

        locale: 'fr',
        allDaySlot: false,
        slotDuration: '01:00:00', // la durée des intervalles affichés
        snapDuration: '00:15:00',

        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: false,
        },

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
    calendar.render();
}
async function displayEvents(){
    // Pour restreindre le placement de spectacles à la durée du festival
    let events = [{
        groupId: 'heureValideFestival',
        startTime: festival.heure_debut_spectacles,
        endTime: festival.heure_fin_spectacles,
        display: 'none'
    }];
    let finDernierSpectacle = new Date(festival.debut.toString() + "T" + festival.heure_debut_spectacles); // Au départ, il n'y a pas de dernier spectacle, c'est pour cela que l'on met au début du spectacle
    for (let i = 0; i < spectacles.length; i++) {
        let nomSpectacle = spectacles[i].nom;
        let donneesRetour =  await planifieSpectacle(festival.debut,
                                                                festival.fin,
                                                                finDernierSpectacle,
                                                                festival.heure_fin_spectacles,
                                                                festival.duree_entre_spectacle,
                                                                spectacles, i);
        let horairesSpectacles = donneesRetour[0];
        finDernierSpectacle = donneesRetour[1];
        let dateDebutSpectacle = horairesSpectacles[0]
        let dateFinSpectacle =  horairesSpectacles[1]

        events.push({
            title: nomSpectacle,
            start: dateDebutSpectacle,
            end: dateFinSpectacle,
            constraint: 'heureValideFestival'
        });
    }
    return events;
}

async function planifieSpectacle(debutFestival, finFestival, dateFinDernierSpectacle, heureFinSpectacle, dureeEntreSpectacles, spectacles, i){
    let donneesRetour = [];
    let sceneSpectacle = spectacles[i].id_scene;
    let horairesSpectacles = [];
    let plusieursSpectacleMemeScene = false

    finDernierSpectacle = dateFinDernierSpectacle;
    console.log("data fin dernier spectacle " + finDernierSpectacle); 

    // On parcours la liste des spectacles a l'envers pour voir s'il y a un spectacle qui est sur la meme scene auparavant FIXME
    for (let j = i + 1 ; j < spectacles.length ; j++) {
        if (spectacles[j].id_scene === sceneSpectacle) { // S'il y a déja eu un spectacle sur la même scene avant
            console.log("Le spectacle " + spectacles[j].nom + " est sur la meme scene que le spectacle " + spectacles[i].nom);
            plusieursSpectacleMemeScene = true;
            break;
        }
    }
    console.log(plusieursSpectacleMemeScene);

    // Séparer les heures et les minutes de la string
    let heures = finDernierSpectacle.getHours();
    let minutes = finDernierSpectacle.getMinutes();

    // Les heures et minutes à rajouter
    let nbHeureDureeSpectacle = Math.floor(spectacles[i].duree / 60);
    let nbMinutesDureeSpectacle = spectacles[i].duree % 60;

    heures += nbHeureDureeSpectacle;
    minutes += nbMinutesDureeSpectacle;

    // Gestion du report des heures et des minutes si nécessaire
    if (minutes >= 60) {
        heures += Math.floor(minutes / 60);
        minutes = minutes % 60;
    }

    // Construction la nouvelle chaîne au format HH:MM:SS
    let heureTheoriqueFinSpectacle = new Date(finDernierSpectacle);
    heureTheoriqueFinSpectacle.setHours(heures, minutes)

    // Si le spectacle est trop long pour le mettre dans le festival, on renverra null
    if (heureTheoriqueFinSpectacle.getHours() > heureFinSpectacle) { //
        alert("Le spectacle " + spectacles[i].nom + " à une durée trop longue ou invalide ("
              + spectacles[i].duree + ") pour le festival, il a été ignoré")
        return new Date('0000-00-00T00:00:00'); // une date invalide pour que le spectacle ne soit pas affiché
    // Sinon lancer le spectacle au début du festival
    } else {
        horairesSpectacles[0] = new Date(finDernierSpectacle);
        horairesSpectacles[1] = new Date(horairesSpectacles[0]);
        horairesSpectacles[1].setMinutes(horairesSpectacles[0].getMinutes() + spectacles[i].duree);
        donneesRetour[0] = horairesSpectacles

        if (plusieursSpectacleMemeScene) {
            finDernierSpectacle.setMinutes(finDernierSpectacle.getMinutes() + dureeEntreSpectacles + spectacles[i].duree);
            console.log(finDernierSpectacle + "ligne 200");
        } else {
            finDernierSpectacle = new Date(festival.debut.toString() + "T" + festival.heure_debut_spectacles);
        }

        donneesRetour[1] = finDernierSpectacle;

        return donneesRetour;
    }
}
async function getFestivalDuration() {
    let dateDebutFestival = new Date(festival.debut);
    let dateFinFestival = new Date(festival.fin);

    // Pour calculer la différence de temps entre la date de début et la date de fin du festival
    let DifferenceDeTemps = dateFinFestival.getTime() - dateDebutFestival.getTime();
 
    // Pour calculer apres cette différence en jour pour pouvoir afficher que l'agenda de la durée du festival
    return Math.round(DifferenceDeTemps / (1000 * 3600 * 24)) + 1;
}