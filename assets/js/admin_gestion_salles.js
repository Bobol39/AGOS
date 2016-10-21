$(function() {

    $("#table_salles").tablesorter();

    $(".supprSalle").click(function () {
        supprSalle(this)
    });
    $("#createSalle").click(function () {
        createSalle()
    });
});



function supprSalle(elt){
    id = $(elt).attr("id");
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/supprSalle",
        data: {id: id}
    }).done(
        location.reload()
    );
}


function createSalle(){
    var name = $("#input_name_salle").val();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/createSalle",
        data: {nom: name}
    }).done(function () {
        location.reload();
    });
}