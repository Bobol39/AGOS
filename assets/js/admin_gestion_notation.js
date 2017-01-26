var div;
$(function() {
    if (div==null) div = $(".crit_div").first();
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
    $("#container_crits").append(div.clone());
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
    var tot = 0;
    $(".bareme").each(function(){
        tot = tot + parseInt($(this).val());
        if ($(this).val() == ""){
            $(this).css('border','red 2px solid');
            test = true;
        }
    });
    if (test){
        return;
    }
    if (tot != 20){
        showNotification("Attention","Le barème total doit être de 20.",'warning');
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
    //Modifie la vue pour la modification de groupe de critères
    if (create){
        $("#radioModif").prop("checked", true);
        $("#input_titre").hide();
        $("#select_groupe_critere").show();
        getCritereGroup();
        create = false;
    }else {
        //Modifie la vue pour la création de groupe de critères
        $("#radioCreer").prop("checked", true);
        $("#select_groupe_critere").hide();
        $("#input_titre").show();
        var div = $(".crit_div").first();
        $(".crit_div").each(function(){
            $(this).remove();
        });
        $("#container_crits").append(div);
        for(i=0;i<4;i++){
            addCritere();
        }
        create = true;
    }
}

function getCritereGroup(){
    id = $("#select_groupe_critere").val();
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
        $.each(data,function(){
            $("#container_crits").append(div.clone());
            console.log('append');
            console.log(div);

            $(".crit_div").last().children(".crit").val($(this)[0]['id']);
            $(".crit_div").last().children(".bareme").val($(this)[0]['bareme']);
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

    var tot = 0;
    $(".bareme").each(function(){
        tot= tot + parseInt($(this).val());
        if ($(this).val() == ""){
            $(this).css('border','red 2px solid');
            test = true;
        }
    });
    if (test){
        return;
    }
    if (tot != 20){
        showNotification("Attention","Le barème total doit être de 20.",'warning');
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
    $(".crit_div").last().remove();
}



