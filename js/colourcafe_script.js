$(document).ready(function(){

    $("a#show-panel").click(function(){
        $("#lightbox, #lightbox-panel").fadeIn(300);
    });
    $("a#close-panel").click(function(){
        $("#lightbox, #lightbox-panel").fadeOut(300);
    });

});