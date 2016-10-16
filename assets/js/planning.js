/**
 * Created by pelomedusa on 16/10/2016.
 */
$(function() {
    $("#addline").click(function(){
        addline();
    });
});

function addline(){
    $("#container_soutenances").find("table").append(' \
            <tr>\
                <td>\
                    <input type="time">\
                </td>\
                <td>\
                    <div class="button_soutenance">\
                         <button class="btn btn-success button_case">Ajouter</button> \
                    </div>\
                </td>\
                <td>\
                    <div class="button_soutenance">\
                         <button class="btn btn-success button_case">Ajouter</button> \
                    </div>\
                </td>\
                <td>\
                    <div class="button_soutenance">\
                         <button class="btn btn-success button_case">Ajouter</button> \
                    </div>\
                </td>\
                <td>\
                    <div class="button_soutenance">\
                         <button class="btn btn-success button_case">Ajouter</button> \
                    </div>\
                </td>\
            </tr>\
            ');
    $(".button_case").click(function(){
        add_case($(this));
    });
}

function add_case(button){
    button.hide();
    button.parent().append('\
        <div class="nom_eleve"><span>Eleve</span></div>\
        <div class="nom_prof1"><span>Prof</span></div>\
        <div class="nom_prof2"><span>Prof</span></div>\
    ');
}