/**
 * Created by Bobol on 14/02/2017.
 */

$(function () {
    $("#container_commentaire").hover(function () {
        $("#spoiler").animate({height: 0},300, function () {
            $(this).hide();
        })
    }, function () {
        $("#spoiler").show().fadeTo(1.0).animate({height: 200})

    })
})