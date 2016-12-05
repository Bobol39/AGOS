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
            var id = prompt("Login de l'etudiant? (provisoire)");
            jQuery.ajax({
                type: "POST",
                url: baseurl    + "index.php/c_eleve/saveResume",
                data: {id_etudiant: id,titre: $("#input_titre").val(), resume: $("#markup_editor").val()}
            }).done(function () {
                showNotification("Sauvegardé","Le titre et le résumé de votre soutenance ont bien été sauvegardés","success")
            });
        }
    })

    $('#markup_editor').markItUp(mySettings);
});