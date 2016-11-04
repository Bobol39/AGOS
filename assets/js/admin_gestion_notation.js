$(function() {

    $("#select_groupe_critere").hide();
    $("#valider_crit").click(function () {
        saveCritere()
    });
    $("#valider").click(function () {
        if (isCreate()){
            saveGroupCritere();
        }else {
            modifGroupCritere();
        }
    });
    $("#add_critere").click(function(){
        $("#add_critere").prev().clone().insertBefore("#add_critere");
    });
    $('#radioCreer, #radioModif').change(function (evt) {
        updateView();
    });

    $("#select_groupe_critere").change(function () {
        getCritereGroup()
    });
});
function saveCritere(){
    $("#input_titre_crit").css("border","initial");

    titre = $("#input_titre_crit").val();

    if (titre == ""){
        $("#input_titre_crit").css("border","red 2px solid");
        return;
    }


    start_loading();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/saveCritere",
        data: {titre: titre}
    }).done(function(){
        stop_loading();
        location.reload();
    });
}

function saveGroupCritere(){
    var array = [];
    var test = false;
    $("#input_titre").css("border","initial");
    $(".bareme").css("border","1px solid #DDDDDD");

    titre = $("#input_titre").val();
    if (titre == ""){
        $("#input_titre").css("border","red 2px solid");
        return;
    }
    $(".bareme").each(function(){
        if ($(this).val() == ""){
            $(this).css('border','red 2px solid');
            test = true;
        }
    });
    if (test){
        return;
    }

    $(".crit").each(function(){
        temp = [$(this).val(),$(this).next().val()];
        array.push(temp);
    });
    start_loading();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/createGroupCritere",
        data: {titre: titre,array: JSON.stringify(array)}
    }).done( function(){
        stop_loading();
        location.reload();
    });
}

function updateView(){
    if (!isCreate()){
        $("#radioModif").prop("checked", true);
        $("#input_titre").hide();
        $("#select_groupe_critere").show();
        getCritereGroup();
    }else {
        $("#radioCreer").prop("checked", true);
        $("#select_groupe_critere").hide();
        $("#input_titre").show();
    }
}

function getCritereGroup(){
    id = $("#select_groupe_critere").val();

    start_loading();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/getCritereFromGroup",
        data: {id: id}
    }).done( function(data) {
        data = $.parseJSON(data);
        var i = 0;
        data.forEach(function(element) {
            $('#crit'+ i +' option[value="'+ element["id"] +'"]').prop('selected', true);
            i += 1;
        });
        stop_loading();
    }).fail( function(data){
        stop_loading(data);
    })
}

function modifGroupCritere(){
    id = $("#select_groupe_critere").val();

    crit1 = $("#crit0").val();
    crit2 = $("#crit1").val();
    crit3 = $("#crit2").val();
    crit4 = $("#crit3").val();
    crit5 = $("#crit4").val();
    crit6 = $("#crit5").val();

    start_loading();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/modifCritereFromGroup",
        data: {id: id,crit1: crit1,crit2: crit2,crit3: crit3,crit4: crit4,crit5: crit5,crit6: crit6}
    }).done(
        stop_loading()
    );
}

function isCreate() {
    return $("input:radio[name ='groupcreermodifier']:checked").val() == "creer";

}



