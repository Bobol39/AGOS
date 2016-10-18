$(function() {
    var newbutton = '\
        <div class="container_groupe col-lg-3 col-md-3">\
            <button class="btn btn-success btn-fill button_groupe">Nouveau groupe</button>\
            <input type="hidden" class="group_promo" value="default">\
            <input type="hidden" class="group_criteres" value="default">\
            <input type="hidden" class="group_duree" value="40">\
        </div>';



    $("#button_add_groupe").click(function () {
        $(this).parent().before(newbutton);
        $(".button_groupe").last().click(function () {
            editGroup($(this).parent());
        });
    });

    $(".datepicker").datepicker();
});

function editGroup(container) {
    $("#titregroupe").val(container.find("button").text())
        .off("change").change(function () {
            container.find("button").text($(this).val())
        });
    $('#selectpromo').find('option[value='+container.find(".group_promo").val()+']').prop('selected', true)
    $('#selectpromo').off("change").change(function () {
        container.find(".group_promo").val($(this).val())
    });
    $('#selectcriteres').find('option[value='+container.find(".group_criteres").val()+']').prop('selected', true);
    $('#selectcriteres').off("change").change(function () {
        container.find(".group_criteres").val($(this).val())
    });
    $("#duree").val(container.find(".group_duree").val())
        .off("change").change(function () {
        container.find(".group_duree").val($(this).val())
    });
    $(".part_modif").fadeIn();

}
