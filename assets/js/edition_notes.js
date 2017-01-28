/**
 * Created by Pelomedusa on 28/01/2017.
 */
$("#selectGroupe").change(function () {
    $("#tablemodif tbody").html("");
    var val = $(this).find("option:selected").val();
    if (val != 0){
        start_loading();
        jQuery.ajax({
            type: "POST",
            url: baseurl    + "index.php/c_admin/getSoutenancesToEdit/",
            data: {id: val}
        }).done( function(data){
            data = JSON.parse(data)
            console.log(data);
            data.forEach(function (sout) {
                var ligne = $("<tr><td>"+sout.titre+"</td><td>"+sout.id_etudiant+"</td><td>"+sout.date+"</td><td>"+sout.id_salle+"</td><td>"+sout.professeur1+"/"+sout.professeur2+"</td></tr>");
                $("#tablemodif tbody").append(ligne);
            });
            $("#tablemodif tbody tr").click(function () {

            })
            stop_loading();
        });
    }
});

