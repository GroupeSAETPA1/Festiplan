$(document).ready(function($){
    if ($('body').width() < 1000) {
        $('.partiePrincipale').css('flex-direction', 'column-reverse');
    }
}