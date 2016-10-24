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
        if (min==20 && sec==0){showNotification("Temps écoulé", "20 minutes sont écoulées, il est temps de terminer la présentation","warning")}
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
    $("#notification").click(function () {
        $(this).animate({bottom: -150},500);
    });

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

    $(".ct-green").change(function () {
        if (!this.checked){
            $(this).parents(".lineblock").find(".slider-info").slider('disable');
        } else {
            $(this).parents(".lineblock").find(".slider-info").slider('enable');
        }
    });

    showtimer = $("#showTimer");
    $.each(['#f00', '#ff0', '#0f0', '#0ff', '#00f', '#f0f', '#000', '#fff'], function() {
        $('#colors_demo .tools').append("<a href='#colors_sketch' data-color='" + this + "' style='width: 10px; background: " + this + ";'></a> ");
    });
    $.each([3, 5, 10, 15], function() {
        $('#colors_demo .tools').append("<a href='#colors_sketch' data-size='" + this + "' style='background: #ccc'>" + this + "</a> ");
    });
    $('#colors_sketch').sketch().attr("height",$('#colors_sketch').height()).attr('width',$('#colors_sketch').width());


    $("#switchtextdraw").click(function () {
            if ($(this).hasClass("switchtext")){
                $(this).removeClass("switchtext").addClass("switchdraw").siblings(".option_draw").hide()
                                                                        .siblings(".option_text").show();
                $("#colors_sketch").hide()
                $("textarea").show().height("calc(100% - 30px)");
            } else {
                $(this).removeClass("switchdraw").addClass("switchtext").siblings(".option_draw").show()
                                                                        .siblings(".option_text").hide();
                $("textarea").hide();
                $("#colors_sketch").show();
            }
    })

    $(".colorpicker").click(function () {
        $(".colorpicker").css("border","none")
        $(this).css("border","2px solid white");
    });

    $("#textplus").click(function () {
        var size = parseInt($("textarea").css("font-size")) +1;
        $("textarea").css("font-size", size)
    });
    $("#textless").click(function () {
        var size = parseInt($("textarea").css("font-size")) -1;
        $("textarea").css("font-size", size)
    });

})();