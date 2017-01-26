/**
 * Created by Pelomedusa on 24/10/2016.
 */


$(function() {
    $("#importer").change(function () {
        var file = document.getElementById("import").files[0];
        if (file) {
            var reader = new FileReader();
            reader.readAsText(file, "UTF-8");
            reader.onload = function (evt) {
                $("#markup_editor").val(evt.target.result);
            }
            reader.onerror = function (evt) {
                    alert("error reading file");
            }
        }
    });

    $("#exporter").click(function () {
        var elHtml = $("#markup_editor").val();
        var link = document.getElementById('lien');
        link.setAttribute('download', "resume.txt");
        link.setAttribute('href', 'data:' + 'text'  +  ';charset=utf-8,' + encodeURIComponent(elHtml));
        link.click();
    })

    $("#confirmer").click(function () {
        if ($("#markup_editor").val() == ""){
            showNotification("Champ(s) vide(s)","Vous devez entrer un résumé de votre soutenance","warning")
        } else  if ($("#input_titre").val() == ""){
            showNotification("Champ(s) vide(s)","Vous devez entrer le titre de votre soutenance","warning")
        } else {
            jQuery.ajax({
                type: "POST",
                url: baseurl    + "index.php/c_eleve/saveResume",
                data: {titre: $("#input_titre").val(), resume: $("#markup_editor").val()}
            }).done(function (data) {
                if (data == 1){
                    showNotification("Informations sauvegardées","Vous allez être redirigé.","success")
                    setTimeout(function () {
                        location.reload();
                    }, 200);
                } else {
                    showNotification("Non sauvegardé","Le titre et le résumé de votre soutenance n'ont pas pu être sauvegardés","warning")

                }
            });
        }
    });

    $('#markup_editor').markItUp(mySettings);
});