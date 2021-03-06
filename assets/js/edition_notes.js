/**
 * Created by Pelomedusa on 28/01/2017.
 */

var ligneSelected = null;

$(function () {
    $("#selectGroupe").change(function () {
        $("#tableShow tbody").html("");
        $("#tableEditNote tbody").html("");
        var val = $(this).find("option:selected").val();
        if (val != 0){
            $('#button_export').fadeIn();
            start_loading();
            jQuery.ajax({
                type: "POST",
                url: baseurl    + "index.php/c_prof/getSoutenancesToEdit/",
                data: {id: val}
            }).done( function(data){
                data = JSON.parse(data)
                console.log(data);

                data.forEach(function (sout) {
                    if (sout.notes.length != 0){
                        var ligne = $("<tr><td>"+sout.titre+"</td><td>"+sout.id_etudiant+"</td><td>"+sout.date+"</td><td>"+sout.horaire+"</td><td>"+sout.id_salle+"</td><td>"+sout.professeur1+"/"+sout.professeur2+"</td><td>"+calcNote(sout.notes)+"/20</td><td><a href='"+baseurl+"index.php/c_prof/showRecap/"+sout.id+"'>Details</a></td></tr>")
                            .click(function () {
                                start_loading();
                                ligneSelected = $(this);
                                editNotes(sout);
                                stop_loading();
                            });
                        $("#tableShow tbody").append(ligne);

                    }
                });
                stop_loading();
            });
        }else{
            $('#button_export').fadeOut();
        }
    });
})

function calcNote(notes) {
    note = 0;
    notes.forEach(function (crit) {
        note += Number(crit.note);
    })
    return note;
}

function editNotes(sout) {
    $("#tableEditNote tbody").html("");
    $("#inputIdSout").val(sout.id);
    $("#btnValider").hide();
    sout.notes.forEach(function (crit) {
        var line = $("<tr><td><input type='hidden' class='critId' value='"+crit.id+"'>"+crit.titre_critere+"</td><td><input type='number' min='0' max='"+crit.bareme+"' class='inputNote' value='"+crit.note+"'></td><td>"+crit.bareme+"</td></tr>")
        line.find("input").change(function () {
            $("#btnValider").fadeIn();
        });
        $("#tableEditNote tbody").append(line);
    })
    $("#btnValider").off("click").click(function () {
        if (checkBeforeSave()){
            start_loading();
            var data = {idsout:"", crits:[]};
            var note, id;
            data["idsout"] = $("#inputIdSout").val();

            $("#tableEditNote tbody tr").each(function () {
                id = $(this).find(".critId").val()
                note = $(this).find(".inputNote").val();

                data["crits"].push({id: id, note: note})
            });
            jQuery.ajax({
                type: "POST",
                url: baseurl    + "index.php/c_prof/editNote/",
                data: data
            }).done( function(data){
                if (data == "true"){
                    $("#btnValider").hide();
                    sout.notes.forEach(function (crit, index) {
                        console.log($(".inputNote").eq(index).val());;
                        crit.note = $(".inputNote").eq(index).val();
                    });
                    ligneSelected.find("td").last().text(calcNote(sout.notes)+"/20");
                    $("#tableEditNote tbody").html("");
                    showNotification("Critères sauvegardés", "Les criteres de la soutenance ont bien été modifiés","success");
                } else {
                    showNotification("Une erreure est survenue", "Les criteres de la soutenance n'ont PAS pu être modifiés","warning");
                }
                stop_loading();
            });
        }
    })
}

function checkBeforeSave() {
    var valid = true;
    $("#tableEditNote tbody tr").each(function () {
        var bareme = Number($(this).find("td").last().text());
        if ($(this).find(".inputNote").val() == 0){
            valid = false;
            showNotification("Critère non noté","Un des critère n'a pas de note", "warning");
        } else if ($(this).find(".inputNote").val() > bareme ){
            valid = false;
            showNotification("Note invalide","Un des critère a une note superieure à son barême", "warning");
        } else if ($(this).find(".inputNote").val() < 0) {
            valid = false;
            showNotification("Note invalide","Une note semble negative", "warning");
        }
    });
    return valid;
}

