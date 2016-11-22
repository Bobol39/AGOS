
$(function() {
    var newbutton = '\
            <div class="container_groupe col-lg-3 col-md-3">\
                <button class="btn btn-success btn-fill button_groupe">Nouveau Groupe</button>\
                <input type="hidden" class="group_promo" value="default">\
                <input type="hidden" class="group_criteres" value="default">\
                <input type="hidden" class="group_duree" value="40">\
                <input type="hidden" class="group_id" value="0">\
            </div>';

    $("#button_add_groupe").click(function () {
        $(this).parent().before(newbutton);
        $(".button_groupe").last().click(function () {
            editGroup($(this).parent());
        });
    });

    $("#valid_group").click(function(){
       controlInformation();
    });

    $("#delete_group").click(function(){
        deleteGroup();
    });


    $(".button_groupe").click(function () {
        editGroup($(this).parent());
    });

    $("#edit_planning").click(function () {
        if ($("#idgroup").val()==0){
            showNotification("Attention!","Pour editer le planning, vous devez d'abord valider ce groupe","warning");
        } else {
            window.location.replace(baseurl+"index.php/C_admin/showPlanning/"+$("#idgroup").val());
        }
    })
});

function editGroup(container) {

    $("#idgroup").val(container.find(".group_id").val());
    $("#titregroupe").val(container.find("button").text())
        .off("change").change(function () {
            container.find("button").text($(this).val());
        });
    $('#selectpromo').find('option[value='+container.find(".group_promo").val()+']').prop('selected', true);
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

function controlInformation(){
    duree = $("#duree").val();
    titre = $("#titregroupe").val();
    promo = $("#selectpromo").val();
    critere = $("#selectcriteres").val();
    id = $("#idgroup").val();

    if (titre == "" || promo == "" || critere == "" || duree==""){
        showNotification("Champs non remplis","Veuillez remplir tous les champs avant de valider ce groupe.","warning");
        return;
    }


    start_loading();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/saveGroupSoutenance/",
        data: {titre: titre,promo: promo,critere: critere,duree: duree,id: id}
    }).done( function(){
        stop_loading();
        location.reload();
    });
}

function deleteGroup(){
    id = $("#idgroup").val();

    start_loading();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/deleteGroupSoutenance/",
        data: {id: id}
    }).done( function(){
        stop_loading();
        location.reload();
    });
}
