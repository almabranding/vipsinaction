var ROOT = '/intranet/';
window.onload = function() {
    //CKEDITOR.replace( 'ckeditor' );
    tinyMCE.init({
        mode: "specific_textareas",
        editor_selector: "wysiwyg",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ],
        relative_urls: false,
    });


};

var mycallback = function(value, segment) {
    $segment = $('.optional' + segment);
    if (value)
        $segment.show();
    else
        $segment.hide();
}
$(function() {
    $('#sortable').sortable({
        start: function(event, ui) {
            $(ui.helper).addClass("sortable-drag-clone");
        },
        stop: function(event, ui) {
            $(ui.helper).removeClass("sortable-drag-clone");
        },
        update: function(event, ui) {
            updateListItem();
        },
        tolerance: "pointer",
        connectWith: "#sortable",
        placeholder: "sortable-draggable-placeholder",
        forcePlaceholderSize: true,
        appendTo: 'body',
        helper: 'clone',
        zIndex: 666
    });
});
function showPop(id) {
    $('#white_full').css('display', 'block');
    $('#' + id).css('display', 'block');
}
function secureMsg(Msg, route) {
    if (confirm(Msg))
        location.href = ROOT + route;
}
$(document).ready(function() {

    $("#modelList").change(function() {
        var coma = "";
        if ($('#name').val() != "")
            coma = ', ';
        $('#name').val($('#name').val() + coma + $(this).val());
    });


});


