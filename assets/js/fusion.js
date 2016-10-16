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

function selectButton(ui, slider) {
    var selectedIndex = slider.parent().has(".slider-info").index();
    if (selectedIndex>4) selectedIndex--;
    $(".line"+selectedIndex).find("button").removeClass("btn-fill");
    slider.slider('values',1,(ui.values[0] + (ui.values[2]))/2);

    if ((ui.values[0] + (ui.values[2]))/2 < 25){
        slider.find("span:nth-child(2)").css("background","#D9534F");
        $(".line"+selectedIndex).find(".btn-danger").addClass("btn-fill");
    } else if ((ui.values[0] + (ui.values[2]))/2 <50){
        slider.find("span:nth-child(2)").css("background","#F0AD4E");
        $(".line"+selectedIndex).find(".btn-warning").addClass("btn-fill");
    } else if ((ui.values[0] + (ui.values[2]))/2 <75){
        slider.find("span:nth-child(2)").css("background","#2C93FF");
        $(".line"+selectedIndex).find(".btn-info").addClass("btn-fill");
    } else {
        slider.find("span:nth-child(2)").css("background","#5CB85C");
        $(".line"+selectedIndex).find(".btn-success").addClass("btn-fill");
    }
}
$(function() {
    startTime();

    $(".block_button button").click(function(){
        $(this).parent().siblings().each(function(){
            $(this).find("button").removeClass("btn-fill");
        });
        $(this).addClass("btn-fill");
    });

    $( ".slider-info" ).slider({
        min: 0,
        max: 100,
        values: [ 25, 50, 75],
        animate: true,
        disabled: true,
        stop: function( event, ui ) {
            selectButton(ui, $(this))
        },
        create: function( event, ui ) {
            ui.values = $(this).slider('values');
            $(this).find("span:nth-child(2)").removeClass("ui-state-default");
            selectButton(ui, $(this));
        },
    }).removeClass("ui-state-disabled");

});