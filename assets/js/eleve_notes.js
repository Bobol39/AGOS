/**
 * Created by Pelomedusa on 04/01/2017.
 */
$(function () {
    $(".block_soutenance").click(function () {
        afficherSoutenance($(this).find(".soutid").val());
    });

    $("#soutenance_layer").click(function () {
        cacherSoutenance();
    });
    $("#soutenance_viewer").click(function (e) {
        e.stopPropagation();
    });
})

function afficherSoutenance(id) {
    $("#soutenance_layer").fadeIn(100, function () {
        jQuery.ajax({
            type: "POST",
            url: baseurl    + "index.php/c_eleve/getInfoSoutHTML",
            data: {id: id}
        }).done(function (data) {
            $("#soutenance_body").html(data);
            $("#soutenance_viewer").animate({"height":"70%"},300);
        });
    })
}
function cacherSoutenance() {
    $("#soutenance_viewer").animate({"height":"10%"},300, function () {
        $("#soutenance_layer").fadeOut(100);
    });
}