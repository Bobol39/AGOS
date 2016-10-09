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


$(function() {
    startTime();

    $(".block_button button").click(function(){
        $(this).parent().siblings().each(function(){
            $(this).find("button").removeClass("btn-fill");
        });
        $(this).addClass("btn-fill");
    });
});