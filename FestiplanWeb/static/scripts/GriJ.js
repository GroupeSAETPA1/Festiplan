var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'timeGridCustomDuration',
    views: {
        timeGridCustomDuration: {
            type: 'timeGrid',
            duration: { days: 4 } // TODO recuperer le nombre de jour du festival ou faire 4 jour et apres regler gauche droite
        }
    },
    locale: 'fr',
    allDaySlot: false,
    slotDuration: '00:15:00', // la durée des intervalles affichés
    slotLabelFormat: {
        hour: 'numeric',
        minute: '2-digit',
        omitZeroMinute: false,
    },
    height: 500, // TODO définir une bonne hauteur
    headerToolbar: {
        left: '',
        center: 'title',
        end: 'today prev,next'
    }
});
calendar.render();
