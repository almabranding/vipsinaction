
$(function() {
   $('.sortable tbody').sortable({
        start: function(event, ui) {
            $(ui.helper).addClass("sortable-drag-clone");
        },
        stop: function(event, ui) {
            $(ui.helper).removeClass("sortable-drag-clone");
        },
        update: function(event, ui) {
            updateListItem($(this));
        },
        tolerance: "pointer",
        connectWith: ".sortable tbody",
        placeholder: "sortable-draggable-placeholder",
        forcePlaceholderSize: true,
        appendTo: 'body',
        helper: 'clone',
        zIndex: 666
    }).disableSelection();
    //var sorted = $( "#sortable" ).sortable( "serialize", { key: "sort" } );    
});
function updateListItem(sortable) {
    var sorted = sortable.sortable( "toArray" );
    $.post(ROOT+'ES/menu/sort',{ 'sort[]': sorted}).done(function(data) {});
  }