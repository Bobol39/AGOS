/**
 * Created by Pelomedusa on 04/01/2017.
 */
$(function () {
    $(".block_soutenance").click(function () {
        $("#soutenance_header")
        afficherSoutenance();
    });

    $("#soutenance_layer").click(function () {
        cacherSoutenance();
    });
    $("#soutenance_viewer").click(function (e) {
        e.stopPropagation();
    });
})

function afficherSoutenance() {
    $("#soutenance_layer").fadeIn(100, function () {
        $("#soutenance_viewer").animate({"height":"70%"},300);
    })
}
function cacherSoutenance() {
    $("#soutenance_viewer").animate({"height":"10%"},300, function () {
        $("#soutenance_layer").fadeOut(100);
    });
}