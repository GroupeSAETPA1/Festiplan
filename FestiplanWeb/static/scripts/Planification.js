let festival;
let spectacles;
let couleursEvents = ["#182825", "#016FB9", "#22AED1", "#FF7F11", "#FF1B1C"];

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
        contentHeight: 800, // TODO définir une bonne hauteur et trouver comment fixer une largeur
        // slotMinTime: festival.heure_debut_spectacles,
        // slotMaxTime: festival.heure_fin_spectacles, TODO voir si c'est bon a garder avec les heures de fin qui sont > a 24h
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
        slotEventOverlap: false,
        editable: false,
        eventDurationEditable: false,
        events: await displayEvents()
    });
    calendar.render();
}
async function displayEvents(){
    // Pour restreindre le placement de spectacles à la durée du festival
    let events = [{
        groupId: 'heureValideFestival',
        startTime: festival.heure_debut_spectacle,
        endTime: festival.heure_fin_spectacles,
        display: 'none'
    }];

    // Dans le cas ou l'heure dee fin de festival est apres 23h, il faut le savoir pour ajuster la duree max spectacle
    let heure_fin_apres23H = parseInt(festival.heure_fin_spectacles.split(":")[0]) < parseInt(festival.heure_debut_spectacles.split(":")[0]);
    let dureeMaxSpectacle = (parseInt(festival.heure_fin_spectacles.split(":")[0]) * 60 + parseInt(festival.heure_fin_spectacles.split(":")[1]))
                          - (parseInt(festival.heure_debut_spectacles.split(":")[0]) * 60 + parseInt(festival.heure_debut_spectacles.split(":")[1]));

    dureeMaxSpectacle = heure_fin_apres23H ? dureeMaxSpectacle + 1440 : dureeMaxSpectacle; // on rajoute 24h en minutes si c'est le cas
    let finDernierSpectacle = new Date(festival.debut.toString() + "T" + festival.heure_debut_spectacles); // Au départ, il n'y a pas de dernier spectacle, c'est pour cela que l'on met au début du spectacle
    
    for (let i = 0; i < spectacles.length; i++) {

        if (spectacles[i].duree > dureeMaxSpectacle) {
            alert("Le spectacle \"" + spectacles[i].nom + "\" a une durée trop grande pour le festival \"" + festival.nom + "\". Il sera donc ignoré")
            continue;
        }

        let donneesRetour =  await planifieSpectacle(finDernierSpectacle,
                                                     festival.duree_entre_spectacle,
                                                     spectacles, i);
        let horairesSpectacles = donneesRetour[0];
        finDernierSpectacle = donneesRetour[1];
        let dateDebutSpectacle = horairesSpectacles[0]
        let dateFinSpectacle =  horairesSpectacles[1]

        events.push({
            title: spectacles[i].nom,
            start: dateDebutSpectacle,
            end: dateFinSpectacle,
            constraint: 'heureValideFestival',
            overlap: 'none',
            backgroundColor: couleursEvents[spectacles[i].id_scene % 5], // Pour avoir une couleur de fond parmis les 5 proposées en fonction de la scène
        });
    }
    return events;
}

async function planifieSpectacle(dateFinDernierSpectacle, dureeEntreSpectacles, spectacles, i) {
    
    let donneesRetour = [];
    let horairesSpectacles = [];
    let plusieursSpectacleMemeScene = false

    finDernierSpectacle = dateFinDernierSpectacle;
    // On parcours la liste des spectacles a l'envers pour voir s'il y a un spectacle qui est sur la meme scene auparavant FIXME
    for (let j = i + 1 ; j < spectacles.length ; j++) {
        if (spectacles[j].id_scene === spectacles[i].id_scene) { // S'il y aura un spectacle sur la meme scene après
            spectacleApres = spectacles[j];
            plusieursSpectacleMemeScene = true;
            break;
        }
    }

    horairesSpectacles[0] = new Date(finDernierSpectacle);
    horairesSpectacles[1] = new Date(horairesSpectacles[0]);
    horairesSpectacles[1].setMinutes(horairesSpectacles[0].getMinutes() + spectacles[i].duree);
    donneesRetour[0] = horairesSpectacles;

    if (plusieursSpectacleMemeScene) {
        finDernierSpectacle.setMinutes(finDernierSpectacle.getMinutes() + dureeEntreSpectacles + spectacles[i].duree);
        finTheoriqueProchainSpectacle = new Date(finDernierSpectacle);
        finTheoriqueProchainSpectacle.setMinutes(finTheoriqueProchainSpectacle.getMinutes() + dureeEntreSpectacles + spectacleApres.duree);

        finTheoriqueProchainSpectacleString = (finTheoriqueProchainSpectacle.getHours() < 10 ? "0" + finTheoriqueProchainSpectacle.getHours() : finTheoriqueProchainSpectacle.getHours()) + ":"
                                            + (finTheoriqueProchainSpectacle.getMinutes() < 10 ? "0" + finTheoriqueProchainSpectacle.getMinutes() : finTheoriqueProchainSpectacle.getMinutes())  + ":00";
        console.log(finTheoriqueProchainSpectacleString + " OUA VS " + festival.heure_fin_spectacles)
        finApres24H = festival.heure_fin_spectacles < festival.heure_debut_spectacles;

         if (((finTheoriqueProchainSpectacleString > festival.heure_fin_spectacles && !finApres24H)
          && !(finTheoriqueProchainSpectacle < finDernierSpectacle && finTheoriqueProchainSpectacleString > festival.heure_fin_spectacles)) // FIXME CONDITION DE MERDE INTESTABLE C4EST L4ENFER QUAND UN FESTIVAL A UNE HEURE DE FIN > 24H
          || (!(finTheoriqueProchainSpectacleString > festival.heure_fin_spectacles && !finApres24H)
          && (finTheoriqueProchainSpectacle < finDernierSpectacle && finTheoriqueProchainSpectacleString > festival.heure_fin_spectacles))) {
            if (festival.heure_fin_spectacles < "23:59:59" && festival.heure_fin_spectacles > festival.heure_debut_spectacles) {
                finDernierSpectacle.setDate(finDernierSpectacle.getDate() + 1);
            }
            finDernierSpectacle.setHours(festival.heure_debut_spectacles.split(":")[0], festival.heure_debut_spectacles.split(":")[1]);
        }

        if (finDernierSpectacle.getDay()   > festival.fin.split("-")[2]
         || finDernierSpectacle.getMonth() > festival.fin.split("-")[1]
         || finDernierSpectacle.getYear()  > festival.fin.split("-")[0]) {
            alert("Il y a trop de spectacles sur la scene \"" + spectacles[i].nomScene + "\". Le spectacle " + spectacles[i].nom
                + " et tout les spectacles suivants sur la même scène seront ignorés");
        }

    } else {
        finDernierSpectacle = new Date(festival.debut.toString() + "T" + festival.heure_debut_spectacles);
    }

    donneesRetour[1] = finDernierSpectacle;

    return donneesRetour;
    
}

async function getFestivalDuration() {
    let dateDebutFestival = new Date(festival.debut);
    let dateFinFestival = new Date(festival.fin);

    // Pour calculer la différence de temps entre la date de début et la date de fin du festival
    let DifferenceDeTemps = dateFinFestival.getTime() - dateDebutFestival.getTime();
 
    // Pour calculer apres cette différence en jour pour pouvoir afficher que l'agenda de la durée du festival
    return Math.round(DifferenceDeTemps / (1000 * 3600 * 24)) + 1;
}