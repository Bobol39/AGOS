/**
 * Created by Pelomedusa on 08/10/2016.
 */


function showNotification(title,text, typecolor) {
    var notif = $("#notification"), color;
    notif.find("div").removeClass("notifwarning notifinfo notifsuccess").addClass("notif"+typecolor);
    notif.find("h4").text(title);
    $("#textnotif").text(text);
    notif.animate({bottom:"5px"},500, function () {
        setTimeout(function () {
            notif.animate({bottom: -150},500);
        },5000)
    })
}


function start_loading(){
    $("#loading_layer").fadeIn()
}

function stop_loading(error){
    $("#loading_layer").fadeOut(50, function () {
        if (error){
            showNotification("Echec",error, "warning")
        }
    })

}

function start_waiting(nom){
    $("#waiting_layer").find(".load").text("En attente de "+nom);
    $("#waiting_layer").fadeIn()
}

function stop_waiting(){
    $("#waiting_layer").fadeOut(50);
}
