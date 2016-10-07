/**
 * Created by pelomedusa on 07/10/2016.
 */


(function() {
    $( ".slider-info" ).slider({
        value: 70,
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
})();