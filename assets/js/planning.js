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
                    <input type="time" class="changetime">\
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
        <input type="hidden" value="salle" class="num_salle" >\
        <input type="hidden" value="Prof 1" class="nom_prof1" >\
        <input type="hidden" value="Prof 2" class="nom_prof2" >\
    ').click(function () {
        edit_case($(this))
    });
}

function edit_case(button){
    $("#block_modif_prof1, #block_modif_prof2, #block_modif_elevessalle, #block_modif_titresoutenance").fadeIn()
    $("#block_modif_prof1").find("input").val(button.find(".nom_prof1").val()).off("change").change(function () {
        button.find(".nom_prof1").val($(this).val())
    });
    $("#block_modif_prof2").find("input").val(button.find(".nom_prof2").val()).off("change").change(function () {
        button.find(".nom_prof2").val($(this).val())
    });
    $("#block_modif_eleves").find("input").first().val(button.find(".nom_eleve").text()).off("change").change(function () {
        button.find(".nom_eleve span").text($(this).val())
    });
    $("#block_modif_salle").find("input").val(button.find(".num_salle").val()).off("change").change(function () {
        button.find(".num_salle").val($(this).val())
    });
}