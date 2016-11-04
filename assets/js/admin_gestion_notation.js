$(function() {
    $("#select_groupe_critere").hide();
    $("#valider_crit").click(function () {
        saveCritere()
    });
    $("#valider").click(function () {
        if (create){
            saveGroupCritere();
        }else {
            modifGroupCritere();
        }
    });
    $("#add_critere").click(function(){
        addCritere();
    });
    $("#moins_critere").click(function(){
       enleverCritere();
    });
    $('#radioCreer').change(function (evt) {
        updateView();
    });
    $("#select_groupe_critere").change(function () {
        getCritereGroup()
    });
});
var create = true;
function addCritere(){
    $("#add_critere").prev().clone().insertBefore("#add_critere");
}

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
    if (create){
        console.log("modif");
        $("#radioModif").prop("checked", true);
        $("#input_titre").hide();
        $("#select_groupe_critere").show();
        getCritereGroup();
        create = false;
    }else {
        console.log("creer");
        $("#radioCreer").prop("checked", true);
        $("#select_groupe_critere").hide();
        $("#input_titre").show();
        var div = $(".crit_div").first();
        $(".crit_div").each(function(){
            $(this).remove();
        });
        $("#add_critere").before(div);
        for(i=0;i<4;i++){
            addCritere();
        }
        create = true;
    }
}

function getCritereGroup(){
    console.log("ok");
    id = $("#select_groupe_critere").val();
    var div = $(".crit_div").first();
    $(".crit_div").each(function(){
       $(this).remove();
    });

    start_loading();
    jQuery.ajax({
        type: "POST",
        url: baseurl    + "index.php/c_admin/getCritereFromGroup",
        data: {id: id}
    }).done( function(data) {
        data = $.parseJSON(data);
        console.log(data);
        i = 0;
        $.each(data,function(){
            if (i == 0 ){
                $("#add_critere").before(div);
            }else {
                addCritere();
            }
            $(".crit_div").last().children(".crit").val($(this)[0]['id']);
            $(".crit_div").last().children(".bareme").val($(this)[0]['bareme']);
            i++;
        });
        stop_loading();
    }).fail( function(data){
        stop_loading(data);
    })
}

function modifGroupCritere(){
    id = $("#select_groupe_critere").val();
    var array = [];
    var test = false;
    $(".bareme").css("border","1px solid #DDDDDD");

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
        url: baseurl    + "index.php/c_admin/modifCritereFromGroup",
        data: {id: id,array: JSON.stringify(array)}
    }).done(
        stop_loading()
    );
}

function enleverCritere(){
    $("#add_critere").prev().remove();
}



