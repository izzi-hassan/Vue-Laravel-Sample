// Medium Editor Functionality goes here

// TODO: need to figure out Shift Enter Functionality on special editors
window.editorTypes = {
    editOnly: {
        buttonLabels: 'fontawesome',
        toolbar: false
    },
    basicEditor: {
        buttonLabels: 'fontawesome',
        targetBlank: true,
        toolbar: {
            /* These are the default options for the toolbar,
             if nothing is passed this is what is used */
            buttons: ['bold', 'italic', 'underline', 'anchor']
        }
    },
    normalEditor: {
        buttonLabels: 'fontawesome',
        targetBlank: true,
        toolbar: {
            /* These are the default options for the toolbar,
             if nothing is passed this is what is used */
            buttons: ['bold', 'italic', 'underline', 'anchor', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol']
        }
    }
};


window.editors = [];

$('body.home .medium-editable').each(function(index, el) {
    console.log(editorTypes[$(el).data('editor-type')]);
    let editor = new medium(el, window.editorTypes[$(el).data('editor-type')]);
    window.editors.push(editor);
});