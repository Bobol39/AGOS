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
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/saveAbreviation",
        data: {array: JSON.stringify(array)}
    }).done(
       alert("Enregistré")
    );

}