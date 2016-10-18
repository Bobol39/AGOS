$(function() {
    $("#button_add_groupe").click(function () {
        $(this).parent().before('\
        <div class="container_groupe col-lg-3 col-md-3">\
        <button class="btn btn-success btn-fill button_groupe">Nouveau groupe</button>\
        </div>');
        $(".button_groupe").last().click(function () {
            editGroup();
        });
    });

    $(".datepicker").datepicker();
});

function editGroup() {
    
}