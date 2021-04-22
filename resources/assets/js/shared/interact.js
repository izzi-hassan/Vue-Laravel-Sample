// Common interactive functions go here

$(document).ready(function() {
    $('button[data-href]').click(function(e) {
        e.preventDefault();

        if ($(this).data('target') == '_blank')
            window.open($(this).data('href'), '_blank');
        else
            window.location.href = $(this).data('href');
    });
});