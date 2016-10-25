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

    $('#markup_editor').markItUp(mySettings);
});