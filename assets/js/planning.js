/**
 * Created by pelomedusa on 16/10/2016.
 */
var disableddates = [];
var nouveauAjouter = "<td><button class='buttonAjouter'>Ajouter</button></td>";

var nouveauJour = "<table>" +
        "<thead>" +
            "<tr>" +
                "<th></th>" +
                "<th><select class='selectpicker' data-live-search='true' data-size='5' title='Salle' multiple></select></th>" +
                "<th><select class='selectpicker' data-live-search='true' data-size='5' title='Salle' multiple></select></th>" +
                "<th><select class='selectpicker' data-live-search='true' data-size='5' title='Salle' multiple></select></th>" +
                "<th><select class='selectpicker' data-live-search='true' data-size='5' title='Salle' multiple></select></th>" +
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
var nouveauCreneau = "<tr>" +
    "<th><input class='timepicker'></th>" +
    "</tr>";

var nouvelleSalle ="<th><select class='selectpicker' data-size='5' data-live-search='true' title='Salle' multiple></select></th>";


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
        else alert(date);
        $("#tabs").find(".ui-tabs-nav li:eq("+index+")").remove();
        $("#tabs").tabs("refresh");


    });
    $("#newday_datepicker").datepicker({
        beforeShowDay: function (date) {
            var string = $.datepicker.formatDate('mm/dd/yy', date);
            return [disableddates.indexOf(string) == -1];
        }
    });

    $( "#tabs" ).tabs();

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
        'timeFormat': "G:i"
    });
    bindAjouter();
}

function bindAjouter(){
    $(".buttonAjouter").off("click").click(function () {
        $(this).hide()
        $(this).parent().append("" +
            "<div class='buttonSoutenance'>" +
            "<div class='col-lg-12 col-md-12 nomEleve'><span>eleve</span></div>" +
            "<div class='col-lg-6 nomProf1'><span>prof1</span></div>" +
            "<div class='col-lg-6 nomProf2'><span>prof2</span></div>" +
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
        'timeFormat': "G:i"
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
    $("#block_modif_prof1, #block_modif_prof2, #block_modif_eleve").fadeIn()
    $("#block_modif_eleve").find("input").val(button.find(".nomEleve span").text()).off("change").change(function () {
        button.find(".nomEleve span").text($(this).val())
    });
    $("#block_modif_prof1").find("select option[value='"+button.find(".nomProf1 span").text()+"']").prop('selected', true);
    $("#block_modif_prof1").find("select").off("change").change(function () {
        button.find(".nomProf1 span").text($(this).val())
    });

    $("#block_modif_prof2").find("select option[value='"+button.find(".nomProf2 span").text()+"']").prop('selected', true);
    $("#block_modif_prof2").find("select").off("change").change(function () {
        button.find(".nomProf2 span").text($(this).val())
    });
}


function save_planning() {
    //POUR CHAQUE JOUR
    var data = [], soutenance, tabnumber,heure, salle;
    $(".tabbed").each(function () {
        tabnumber = $(this).attr("id");
        $(this).find("tbody tr").each(function () {
            //POUR CHAQUE LIGNE
            heure = $(this).find("th input").val();

            $(this).find(".buttonSoutenance").each(function () {
                //POUR CHAQUE SOUTENANCE
                salle = $(this).parents("table").find("thead th:nth-child("+($(this).parent().index()+1)+")").find("button").attr("title");
                soutenance = {
                    eleve: $(this).find(".nomEleve span").text(),
                    prof1: $(this).find(".nomProf1 span").text(),
                    prof2: $(this).find(".nomProf2 span").text(),
                    date: $(".ui-tabs-tab[aria-controls="+tabnumber+"]").text(),
                    heure: heure,
                    salle: salle
                };
                data.push(soutenance);
            })
        });

    });
    console.log(data);
}
