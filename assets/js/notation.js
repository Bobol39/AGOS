/**
 * Created by pelomedusa on 07/10/2016.
 */

var timer,showtimer;
var sec=58, min=19, hr=0;


function chronoStart(){
    timer = setInterval(function(){
        sec++;
        if (sec > 59){sec = 0; min++}
        if (min > 59){min = 0; hr++}
        showtimer.text(("0"+min).slice(-2)+":"+("0"+sec).slice(-2));
        if (min==20 && sec==0){showNotification("Temps écoulé", "20 minutes sont écoulées, il est temps de terminer la présentation","info")}
        if (min >= 20){
            $("#button_debut").fadeTo(500,0.5,function () {
                $(this).fadeTo(500,1)
            })
        }
    },1000)
}

function chronoStop(){
    clearInterval(timer);
    $("#showDuree").text(("0"+min).slice(-2)+":"+("0"+sec).slice(-2));
    $("#block_chrono").fadeOut(200, function () {
        $("#button_next").fadeIn();
    })
}
(function() {
    $("#button_next").hide();

    $( ".slider-info" ).slider({
        value: 50,
        orientation: "horizontal",
        range: "min",
        animate: true,
        stop: function( event, ui ) {
            if (ui.value < 25){
                $(this).find("div").css("background-color","#D9534F");
            } else if (ui.value <50){
                $(this).find("div").css("background-color","#F0AD4E");
            } else if (ui.value <75){
                $(this).find("div").css("background-color","#2C93FF");
            } else {
                $(this).find("div").css("background-color","#5CB85C");;
            }
        }
    });

    $("#button_debut").click(function(){
        if ($(this).text()=="Début"){
            $(this).removeClass("btn-success").addClass("btn-danger").text("Stop");
            chronoStart();
        } else {
            $(this).addClass("btn-success").removeClass("btn-danger").text("Début");
            chronoStop();
        }
    });

    showtimer = $("#showTimer");


})();