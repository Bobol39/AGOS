$(document).ready(function () {
    //Initialize tooltips
    var namePromo = null;
    var yearPromo = null;

    var nameLdap = null;


    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });


    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });

    $("#goStep2").click(function () {//Ajout du titre et filtre de la promo
        name = $("#name").val();
        year = $("#year").val();
        nameLdap = $("#nameLdap").val();
        if(name =='' || nameLdap== ''){
            showNotification("Champs non remplis", "Veuillez remplir tous les champs.", "warning");
        }else{
            namePromo = name;
            yearPromo = year;
            if(nameLdap != '')
                nameLdap = nameLdap;//apply custom filter
            next_step();
        }
    });


    $("#goStep3").click(function (e) {
        login = $("#login").val();
        pass = $("#password").val();
        if (login == "" || pass == "") {//TEST FORM
            showNotification("Champs non remplis", "Veuillez remplir tous les champs avant de poursuivre.", "warning");
        } else {
            start_loading();

            $.ajax({
                type: 'POST',
                url: baseurl    + "index.php/c_cas/get_promo_from_ldap/",
                data: {login: login,pass: pass,nameLdap: nameLdap,year: yearPromo,request: "import"}
            })
                .done( function(data){
                    console.log('Response '+data);
                    stop_loading();
                    // location.reload();
                    if(data == "connect_error"){
                        showNotification("Identifiants rejetés", "Ces identifiants ont été rejetés par le serveur LDAP.", "warning");
                    } else if(data == "up_to_date"){
                        showNotification("Promotion à jour", "Aucune nouvelle entrée n'a été trouvé pour cette promotion.", "success");
                        next_step();
                        next_step();
                    }else {
                        if(data == false){//if no results
                            $('#nbResults').text("Aucun");
                            showNotification("Auncun résultat", "Aucun résultat n'a été trouvé dans l'annuaire LDAP, vérifiez le filtre.", "warning");
                        }else{
                            data = jQuery.parseJSON(data);
                            $('#results').empty();//removing previous results
                            $('#nbResults').text(data.length);
                            $.each(data, function(index,row) {
                                uid = row["uid"];
                                fname = row["sn"];
                                lname = row["givenname"];
                                $('#results').append("<tr> <td>"+uid+"</td> <td>"+fname+" "+lname+"</td></tr>");
                                // console.log("Index: "+index);
                                // console.log("Row: "+row["uid"]);

                            });

                            next_step();
                            // showNotification("Succès", "Filtre :"+filter, "success");
                        }

                    }

                });
        }
    });


    $("#goStep4").click(function (e) {
        start_loading();
        $.ajax({
            type: 'POST',
            url: baseurl    + "index.php/c_cas/create_new_promo/",
            data: {namePromo: namePromo, nameLdap: nameLdap}
        })
        .done( function(data){
            // console.log('NamePromo '+namePromo);
            console.log('Response '+data);

            stop_loading();
            // location.reload();
            if(data == "false"){
                showNotification("Erreur de création", "Une erreur inatendue est survenue lors de la création de la promotion. Assurez-vous qu'il n'y a pas de doublon d'étudiants", "warning");

            } else if(data =="true")  {
                    showNotification("Création validée", "La nouvelle promotion \""+namePromo+"\" a été créée !", "success");
                    next_step();
            }

        });
    });


});




function next_step() {

    var $active = $('.wizard .nav-tabs li.active');
    console.log($active);
    $active.next().removeClass('disabled');
    nextTab($active);

};



function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


//according menu

$(document).ready(function()
{
    //Add Inactive Class To All Accordion Headers
    $('.accordion-header').toggleClass('inactive-header');

    //Set The Accordion Content Width
    var contentwidth = $('.accordion-header').width();
    $('.accordion-content').css({});

    //Open The First Accordion Section When Page Loads
    $('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
    $('.accordion-content').first().slideDown().toggleClass('open-content');

    // The Accordion Effect
    $('.accordion-header').click(function () {
        if($(this).is('.inactive-header')) {
            $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
            $(this).toggleClass('active-header').toggleClass('inactive-header');
            $(this).next().slideToggle().toggleClass('open-content');
        }

        else {
            $(this).toggleClass('active-header').toggleClass('inactive-header');
            $(this).next().slideToggle().toggleClass('open-content');
        }
    });

    return false;
});