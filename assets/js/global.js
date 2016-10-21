/**
 * Created by Pelomedusa on 08/10/2016.
 */


function showNotification(title,text, typecolor) {
    var notif = $("#notification"), color;
    notif.find("div").removeClass("notifwarning notifinfo notifsuccess").addClass("notif"+typecolor);
    notif.find("h3").text(title);
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

function stop_loading(var success){
    if (success == true){
        $("#loading_layer").find("img").addClass("imgsuccess");
    }
}