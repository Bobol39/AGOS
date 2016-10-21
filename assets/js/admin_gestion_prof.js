$(function() {

    $("#table_prof").tablesorter();

    $("#valider").click(function () {
        saveAbre()
    });
});


function saveAbre(){
    var array = {};
    $('.input_abre').each(function () {
        array[$(this).attr('id')] = $(this).val();
    });
    start_loading();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/saveAbreviation",
        data: {array: JSON.stringify(array)}
    }).done(function () {
        stop_loading();
        showNotification("Changements enregistrés","La modification des abbréviations a bien été enregistrée","success")
    }).fail(function () {
        stop_loading("error")
    });

}