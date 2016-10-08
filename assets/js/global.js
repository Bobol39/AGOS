/**
 * Created by Pelomedusa on 08/10/2016.
 */


function showNotification(title,text,time) {
    var notif = $("#notification");
    notif.find("h3").text(title);
    notif.find("span").text(text);
    notif.animate({bottom:"5px"},500, function () {
        setTimeout(function () {
            notif.animate({bottom: -150},500);
        },time)
    })
}