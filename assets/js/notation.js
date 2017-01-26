/**
 * Created by pelomedusa on 07/10/2016.
 */

var timer,showtimer;
var sec=0, min=0, hr=0;

var el = $('#block_titre_soutenance');
if (el.width() < el.find("span").width()) {
    el.find("span").replaceWith("<marquee>"+el.html()+"</marquee>")
}


function chronoStart(){
    timer = setInterval(function(){
        sec++;
        if (sec > 59){sec = 0; min++}
        if (min > 59){min = 0; hr++}
        showtimer.text(("0"+min).slice(-2)+":"+("0"+sec).slice(-2));
        if ((min == duree - delay_alert) && (sec==0)){showNotification("Temps écoulé,"+(duree - delay_alert)+" minutes se sont écoulées, il reste "+delay_alert+"mn pour terminer la présentation","warning")}
        if (min >= duree - delay_alert){
            $("#button_debut").fadeTo(500,0.5,function () {
                $(this).fadeTo(500,1);
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

function afficherFiche() {
    $("#fiche_layer").fadeIn(100, function () {
        $("#fiche_viewer").animate({"height":"70%"},300);
    })
}

function cacherFiche() {
    $("#fiche_viewer").animate({"height":"10%"},300, function () {
        $("#fiche_layer").fadeOut(100);
    });
}

function afficherAjuster() {
    var valSlider, valButton,bareme;
    $(".ui-slider").each(function (index) {
        valSlider = $(this).slider("option","value");
        bareme = $(".bareme_choose:nth-of-type("+(index+1)+")").find("button").last().text();
        valButton = roundHalf(bareme*(valSlider/100));
        console.log(valButton);
        $(".bareme_choose:nth-of-type("+(index+1)+")").find("button").each(function () {
            if ($(this).text() == valButton){
                $(this).click();
            }
        })
    })

    $("#ajuster_layer").fadeIn(100, function () {
        $("#block_ajuster").animate({"height":"70%"},300);
    })
}

function cacherAjuster() {
    $("#block_ajuster").animate({"height":"10%"},300, function () {
        $("#ajuster_layer").fadeOut(100);
    });
}

function getNotes(){
    var slidValues = [], butValues = [];
    $(".ui-slider").each(function () {
        slidValues.push($(this).slider("option","value"));
    });
    $(".button_bareme").each(function () {
        if ($(this).hasClass("btn-fill")) butValues.push($(this).text());
    });

    return {sliders: slidValues, buttons: butValues};
}

function roundHalf(x) {
    return Math.round(x*2)/2
}

function saveCommentaire(callback){
    var text = $("textarea").val();
    var canvas = document.getElementById("colors_sketch");
    var img = canvas.toDataURL("image/png");
    $.ajax({
        type: "POST",
        url: baseurl    + "index.php/C_prof/saveCommentaire",
        data: {
            id_soutenance: id_soutenance,
            login: login,
            text: text,
            img: img
        }
    }).done(function() {
         callback();
    });
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

    $("#button_fiche").click(function () {
        afficherFiche();
    });

    $("#fiche_layer").click(function () {
        cacherFiche();
    });
    $("#fiche_viewer").click(function (e) {
        e.stopPropagation();
    });

    $("#ajuster_layer").click(function () {
        cacherAjuster();
    });

    $("#block_ajuster").click(function (e) {
        e.stopPropagation();
    });

    $(".button_bareme").click(function () {
        $(this).addClass("btn-fill").siblings(".button_bareme").removeClass("btn-fill");
    })
})();

function runSocketIo(id,login,tuteur) {
    var socketio = io.connect('http://127.0.0.1:3000/');
    socketio.emit('notation',{id: id, login: login, tuteur: tuteur});


    socketio.on("waiting", function () {
        start_loading();
    }).on("stopWaiting", function () {
        stop_loading();
    }).on("startChrono", function () {
        stop_loading();
        $("#button_debut").removeClass("btn-success").addClass("btn-danger").text("Stop");
        chronoStart();
    }).on("stopChrono", function () {
        $("#button_debut").addClass("btn-success").removeClass("btn-danger").text("Début");
        chronoStop();
    }).on("redirectFusion", function () {
        stop_loading();
        saveCommentaire(function () {
            window.location.replace(baseurl+"index.php/C_prof/showFusion/" + id_soutenance + "/" + login);
        });
    });

    $("#button_debut").click(function(){
        if ($(this).text()=="Début"){
            socketio.emit("startChrono");
        } else {
            socketio.emit("stopChrono");
        }
    });

    $("#button_next").click(function () {
        afficherAjuster();
    });

    $("#validerBareme").click(function () {
        socketio.emit('clientReadyForFusion', getNotes());
        start_loading();
    })
}
