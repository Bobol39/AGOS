/**
 * Created by pelomedusa on 09/10/2016.
 */

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    // add a zero in front of numbers<10
    m = checkTime(m);
    $("#timeblock span").html(h+":"+m);
    t = setTimeout(function () {
        startTime()
    }, 5000);
}


function roundHalf(x) {
    return Math.round(x*2)/2
}




$(function() {
    startTime();

    $("#button_fiche").click(function () {
        afficherFiche();
    });

    $("#fiche_layer").click(function () {
        cacherFiche();
    });
    $("#fiche_viewer").click(function (e) {
        e.stopPropagation();
    });

    $(".button_bareme").click(function(){
        $(this).addClass("btn-fill btn-primary").removeClass("btn-default btn-warning btn-success").siblings().each(function () {
            $(this).addClass("btn-default").removeClass("btn-warning btn-success btn-fill btn-primary")
        })

        var note = 0;
        $(".button_bareme").each(function () {
            if ($(this).hasClass("btn-fill")){
                note += parseFloat($(this).text());
            }
        })
        $("#block_button_note_finale button span:nth-child(2)").text(note);
    });
});

function runSocketIo(id, tuteur) {
    var socketio = io.connect(config.server);
    socketio.on('connect_error', function() {
        stop_loading();
        showNotification("Erreur de connection","SocketIO ne parvient pas à se connecter","warning");
        socketio.disconnect();
    });
    start_loading()
    socketio.emit('fusion',{idsout: id, tuteur: tuteur});

    socketio.on('getNotes',function(data){
        console.log("DATA:");
        console.log(data);
        $( ".slider-info" ).each(function(index){
            $(this).slider({
                min: 0,
                max: 100,
                values: [ data.p1.sliders[index],50, data.p2.sliders[index]],
                animate: true,
                disabled: true,
                create: function( event, ui ) {
                    ui.values = $(this).slider('values');
                    $(this).find("span:nth-child(2)").removeClass("ui-state-default");
                    //selectButton(ui, $(this));
                },
            }).removeClass("ui-state-disabled");
        });

        var np1, np2, valToSelect, color;
        $(".container_buttons_moyennes").each(function (index) {
            np1 = parseFloat(data.p1.buttons[index]);
            np2 = parseFloat(data.p2.buttons[index]);
            if (np1 == np2) {
                valToSelect = np1;
                color = "success"
            } else {
                if (np1 > np2) valToSelect = (np1 - np2)/2 + np2;
                else valToSelect = (np2 - np1)/2 + np1;
                color = "warning";
            }
            valToSelect = roundHalf(valToSelect);

            console.log("valToSelect: "+valToSelect+", car np1="+np1+" et np2="+np2+", donc color="+color);
            $(this).find("button").each(function () {
                if ($(this).text() == valToSelect){
                    $(this).removeClass("btn-default").addClass("btn-"+color+" btn-fill");
                }
            })
        });

        $("#block_button_deliberer").click(function () {
            var val = [];
            $(".button_bareme").each(function () {
                if ($(this).hasClass("btn-fill")) val.push($(this).text())
            });
            socketio.emit('deliberer', val);
            start_loading();
        })

        stop_loading();
    });

    socketio.on("deliberationWaiting", function () {
        start_loading();
    });

    socketio.on("deliberationFinished", function (note) {
        if(tuteur) {
            sauvergardeNote(note);
            socketio.emit('theend');
        } else {
            window.location.replace(baseurl+"index.php/C_prof/");
        }
    });

    socketio.on("deliberationNotEqual", function () {
        stop_loading();
        showNotification("Probleme de deliberation","Vos notes finales ne sont pas en accord avec celles de l'autre professeur","warning");
    });
}

function sauvergardeNote(note){
    console.log("id_soutenance : " + id_soutenance);
    console.log(note);
    console.log(critere);

    $.ajax({
        type: "POST",
        url: baseurl    + "index.php/C_prof/saveNote",
        data: {
            id_soutenance: id_soutenance,
            note: JSON.stringify(note),
            critere: JSON.stringify(critere)
        }
    }).done(function() {
        window.location.replace(baseurl+"index.php/C_prof/");
    });
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