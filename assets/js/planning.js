/**
 * Created by pelomedusa on 16/10/2016.
 */
var disableddates = [];
var blinker;
var nouveauAjouter = "<td><button class='buttonAjouter'>Ajouter</button></td>";

var nouveauJour = "<table>" +
        "<thead>" +
            "<tr>" +
                "<th></th>" +
                "<th><select class='selectpicker' data-live-search='true' data-size='5' title='Salle' ></select></th>" +
                "<th><select class='selectpicker' data-live-search='true' data-size='5' title='Salle' ></select></th>" +
                "<th><select class='selectpicker' data-live-search='true' data-size='5' title='Salle' ></select></th>" +
                "<th><select class='selectpicker' data-live-search='true' data-size='5' title='Salle' ></select></th>" +
            "</tr>" +
        "</thead>" +
        "<tbody>" +
            "<tr>" +
                "<th><input class='picktime'></th>" +
                nouveauAjouter +
                nouveauAjouter +
                nouveauAjouter +
                nouveauAjouter +
            "</tr>" +
        "</tbody>" +
    "</table>";

var nouveauJourEmpty = "<table>" +
    "<thead>" +
        "<tr>" +
            "<th></th>" +
        "</tr>" +
    "</thead>" +
    "<tbody>" +
    "</tbody>" +
    "</table>";
var nouveauCreneau = "<tr>" +
    "<th><input class='picktime'></th>" +
    "</tr>";

var nouvelleSalle ="<th><select class='selectpicker' data-size='5' data-live-search='true' title='Salle'></select></th>";


$(function() {

    $("#addline").click(function(){
        ajouterCreneau();
    });
    $("#addcolumn").click(function(){
        ajouterSalle();
    });

    $("#removeday").click(function () {
        var index = $('#tabs').tabs("option","active");
        var date = $("#tabs").find(".ui-tabs-nav li:eq("+index+")").text();
        if (disableddates.indexOf(date)>-1) disableddates.splice(disableddates.indexOf(date), 1);
        $(".ui-tabs-nav li:eq("+index+")").remove();
        $("#tab"+date).remove();
        $("#tabs").tabs("refresh");


    });
    $.datepicker.setDefaults($.datepicker.regional['fr']);
    $("#newday_datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        beforeShowDay: function (date) {
            var string = $.datepicker.formatDate('yy-mm-dd', date);
            return [disableddates.indexOf(string) == -1];
        }
    })

    restore();


    $("#ajouterJour").click(function () {
        pickDay();
    });

    $("#savePlanning").click(function () {
        save_planning();
    })

    $("#promptday_layer").click(function () {
        $("#promptday").animate({"height":"10%"},300, function () {
            $("#promptday_layer").hide();
        });
    });
    $("#promptday").click(function (e) {
        e.stopPropagation();
    })

});

function pickDay() {
    $("#promptday_layer").fadeIn(100, function () {
        $("#promptday").animate({"height":"40%"},300,function () {
            $("#valider_promptday").off("click").click(function () {
                if ($("#newday_datepicker").val() == ""){
                    showNotification("Mauvaise valeur","Merci de sélectionner un jour","warning")
                } else {
                    $("#promptday").animate({"height":"10%"},300, function () {
                        $("#promptday_layer").hide();
                        ajouterJour();
                    });
                }
            });
        });
    })
}

function ajouterJour() {
    var newday = $("#newday_datepicker").val();
    disableddates.push(newday);
    $("#newday_datepicker").val("");
    var num_tabs = $("div#tabs .ui-tabs-nav li").length + 1;
    $("div#tabs .ui-tabs-nav").find("li").last().before(
        "<li><a href='#tab" + num_tabs + "'>" + newday + "</a></li>"
    );
    $("div#tabs").append("<div class='tabbed' id='tab" + num_tabs + "' class='tabbedDiv'>" +nouveauJour+ "</div>");
    for (var i=0; i< salles.length; i++){
        $("#tab" + num_tabs).find(".selectpicker").append("<option>"+salles[i].id+"</option>")
    }
    $('.selectpicker').selectpicker();
    $("div#tabs").tabs("refresh");
    var index = $('#tabs a[href="#tab'+num_tabs+'"]').parent().index();
    $("#tabs").tabs("option", "active", index);
   $(".picktime").timepicker({
        'minTime': '8:00',
        'maxTime': '19:30',
        'timeFormat': "G:i",
        'step': 15
    });
    bindAjouter();
}

function bindAjouter(){
    $(".buttonAjouter").off("click").click(function () {
        $(this).hide()
        $(this).parent().append("" +
            "<div class='buttonSoutenance'>" +
            "<div class='col-lg-12 col-md-12 nomEleve'><span>Eleve</span></div>" +
            "<div class='col-lg-6 nomProf1'><span>Professeur</span></div>" +
            "<div class='col-lg-6 nomProf2'><span>Professeur</span></div>" +
            "</div>");
        edit_case($(this).siblings(".buttonSoutenance"));
        $(this).siblings(".buttonSoutenance").click(function () {
            edit_case($(this));
        })
    });
}

function ajouterCreneau() {
    $("#tabs .ui-tabs-panel:visible").find("tbody").append(nouveauCreneau);
    $(".picktime").timepicker({
        'minTime': '8:00',
        'maxTime': '19:30',
        'timeFormat': "G:i",
        'step': 15
    });
    $("#tabs .ui-tabs-panel:visible").find(".selectpicker").each(function () {
        $("#tabs .ui-tabs-panel:visible").find("tr").last().append(nouveauAjouter);
        bindAjouter();
    })

}

function ajouterSalle() {
    $("#tabs .ui-tabs-panel:visible").find("tr").first().append(nouvelleSalle);
    for (var i=0; i< salles.length; i++){
        $("#tabs .ui-tabs-panel:visible").find("tr").first().find("select").last().append("<option>"+salles[i].id+"</option>")
    }
    $("#tabs .ui-tabs-panel:visible").find("tbody tr").each(function () {
        $(this).append(nouveauAjouter)
    })
    $(".selectpicker").selectpicker();
    bindAjouter();
}


function edit_case(button){
    clearInterval(blinker);
    button.animate({ opacity: 0.5 },500,function () {
        $(this).animate({ opacity: 1 },500);
    })
    blinker = setInterval(function(){
        button.animate({ opacity: 0.5 },500,function () {
            $(this).animate({ opacity: 1 },500);
        })
    }, 1000);

    $("#block_modif_prof1, #block_modif_prof2, #block_modif_eleve").fadeIn();

    $("#block_modif_eleve").find("select option[value='"+button.find(".nomEleve span").text()+"']").prop('selected', true);
    $("#block_modif_eleve").find("select").off("click").click(function () {
        button.find(".nomEleve span").text($(this).val())
    });


    $("#block_modif_prof1").find("select option[value='"+button.find(".nomProf1 span").text()+"']").prop('selected', true);
    $("#block_modif_prof1").find("select").off("click").click(function () {
        button.find(".nomProf1 span").text($(this).val())
    });

    $("#block_modif_prof2").find("select option[value='"+button.find(".nomProf2 span").text()+"']").prop('selected', true);
    $("#block_modif_prof2").find("select").off("click").click(function () {
        button.find(".nomProf2 span").text($(this).val())
    });

    $("#removeSoutenance").off("click").click(function () {
        button.parent().replaceWith(nouveauAjouter);
        bindAjouter();
    })
}

function validerPlanning(data) {
    if (data.length == 0){
        showNotification("Aucune soutenance","Vous n'avez pas ajouté de soutenance","warning");
        return false;
    }
    valid = true;
    data.forEach(function (sout) {
        if (valid){
            if (sout["id_salle"] == "Salle"){
                showNotification("Salle manquante", "Une des soutenances n'a pas de salle", "warning");
                valid = false;
            } else if ((sout["professeur1"] == "Professeur") || (sout["professeur2"] == "Professeur")){
                showNotification("Professeur manquant", "Une des soutenances n'a pas de professeur défini", "warning");
                valid = false;
            } else if (sout["eleve"] == "Eleve"){
                showNotification("Eleve manquante", "Une des soutenances n'a pas de Chef de Projet défini", "warning");
                valid = false;
            }else if (sout["horaire"] == ""){
                showNotification("Horaire manquante", "Une des soutenances n'a pas d'horaire définie", "warning");
                valid = false;
            }
        }
        data.forEach(function (soutCompare) {
            if ((sout!=soutCompare) && ((soutCompare.horaire == sout.horaire) && (soutCompare.id_salle == sout.id_salle) && (sout.date == soutCompare.date))){
                showNotification("Conflit", "Deux soutenances ont la même date ET la même horaire", "warning");
                valid = false;
            }
        })
    });

    return valid;
}

function save_planning() {
    //POUR CHAQUE JOUR
    var data = [], soutenance, tabnumber,heure, salle, unformatted, formatted_date;
    $(".tabbed").each(function () {

        tabnumber = $(this).attr("id");
        $(this).find("tbody tr").each(function () {

            //POUR CHAQUE LIGNE
            heure = $(this).find("th input").val();

            $(this).find(".buttonSoutenance").each(function () {
                //POUR CHAQUE SOUTENANCE
                salle = $(this).parents("table").find("thead th:nth-child("+($(this).parent().index()+1)+")").find("button").attr("title");
                soutenance = {
                    id_etudiant: $(this).find(".nomEleve span").text(),
                    professeur1: $(this).find(".nomProf1 span").text(),
                    professeur2: $(this).find(".nomProf2 span").text(),
                    date: $(".ui-tabs-tab[aria-controls="+tabnumber+"]").text(),
                    horaire: heure,
                    id_salle: salle,
                    id_planning: $("#idgroup").val()
                };
                data.push(soutenance);
            })
        });

        console.log(data);

    });

    if (validerPlanning(data)){
        start_loading();
        jQuery.ajax({
            type: "POST",
            url: baseurl    + "index.php/c_admin/savePlanning/",
            data: {soutenances: JSON.stringify(data)}
        }).done( function(result){
            stop_loading();
            //location.reload();
        });
    }
}

function restore() {
    start_loading();
    var tabs = $( "#tabs" ).tabs();
    var tab = soutJSON;
    var days = [], sallesFound = [], horaireFound = [];
    tab.forEach(function (sout) {
        if ($.inArray(sout.date, days) == -1) {
            //ADD TABS FOR DAYS
            days.push(sout.date);
            var ul = tabs.find( "ul" );
            $( "<li><a href='#tab"+sout.date+"'>"+sout.date+"</a></li>" ).insertBefore(ul.find("li").last());
            $( "<div class='tabbed ui-tabs-panel ui-corner-bottom ui-widget-content' id='tab"+sout.date+"'>"+nouveauJourEmpty+"</div>" ).appendTo( tabs );
        }
    });

    //AJOUT DES SALLES
    days.forEach(function (day) {
        sallesFound = [];
        tab.forEach(function (sout) {
            if (($.inArray(sout.id_salle, sallesFound) == -1) && (sout.date == day)) {
                sallesFound.push(sout.id_salle);
                $("#tab"+day).find("thead tr").append("<th><select class='selectpicker' data-live-search='true' data-size='5' title='"+sout.id_salle+"' ></select></th>")
            }
        })
    })
    for (var i=0; i< salles.length; i++){
        $(".selectpicker").append("<option>"+salles[i].id+"</option>")
    }
    $(".selectpicker").selectpicker();


    var nbrSalles;
    //AJOUT DES HORAIRES
    days.forEach(function (day) {
        nbrSalles = $("#tab"+day).find("thead th").length-1;
        horaireFound = [];
        tab.forEach(function (sout) {
            if (($.inArray(sout.horaire, horaireFound) == -1) && (sout.date == day)) {
                horaireFound.push(sout.horaire);
                $("#tab"+day).find("tbody").append("<tr><th><input class='picktime' value='"+sout.horaire+"'></th></tr>").find(".picktime").timepicker({
                    'minTime': '8:00',
                    'maxTime': '19:30',
                    'timeFormat': "G:i",
                    'step': 15
                });;
                for (var i=0; i<nbrSalles;i++){
                    $("#tab"+day).find("tbody tr").last().append(nouveauAjouter);
                }
            }
        })

        var indexsalle,indexhoraire;
        tab.forEach(function (sout) {
            if (sout.date == day){
                $("#tab"+day).find("thead button").each(function (index) {
                    if ($(this).attr("title") == sout.id_salle) {
                        indexsalle = index+2;
                        return false;
                    }
                });
                $("#tab"+day).find("tbody .picktime").each(function (index) {
                    if ($(this).val() == sout.horaire) {
                        indexhoraire = index+1;
                        return false;
                    }
                });

                $("#tab"+day).find("tbody tr:nth-child("+indexhoraire+")").find("td:nth-child("+indexsalle+")").html("" +
                    "<div class='buttonSoutenance'>" +
                    "<div class='col-lg-12 col-md-12 nomEleve'><span>"+sout.id_etudiant+"</span></div>" +
                    "<div class='col-lg-6 nomProf1'><span>"+sout.professeur1+"</span></div>" +
                    "<div class='col-lg-6 nomProf2'><span>"+sout.professeur2+"</span></div>" +
                    "</div>").find(".buttonSoutenance").click(function () {
                    edit_case($(this));
                })
            }
        });

    })


    $(".picktime")



    //var selectpickers = $('.selectpicker').selectpicker();
    tabs.tabs( "refresh" );
    stop_loading();
}


