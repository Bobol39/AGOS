/**
 * Created by pelomedusa on 16/10/2016.
 */
$(function() {
    $("#addline").click(function(){
        addline();
    });

    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function (i) {
                $(this).html(i + 1);
            });
        };

    $("#container_soutenances").find("tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    });

    $('#test').timepicker();
});

function addline(){
    $("#container_soutenances").find("tbody").append(' \
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
            ').find("input").timepicker();
    $(".button_case").off("click").click(function(){
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