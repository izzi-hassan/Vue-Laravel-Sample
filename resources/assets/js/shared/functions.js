// Common page functionality

window.getPageFieldData = function() {
    let data = {};

    $('[data-edit-field]').each(function(index, el) {
        if ($(el).is('input,select,textarea'))
            data[$(el).data('edit-field')] = $(el).val();
        else
            data[$(el).data('edit-field')] = $(el).html();
    });

    return data;
};