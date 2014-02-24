
$(function() {
   $('#sortable').sortable({
        start: function(event, ui) {
            $(ui.helper).addClass("sortable-drag-clone");
        },
        stop: function(event, ui) {
            $(ui.helper).removeClass("sortable-drag-clone");
        },
        update: function(event, ui) {
            updateListItem($(ui.item).attr('rel'), $(this).attr('rel'));
        },
        tolerance: "pointer",
        connectWith: "#sortable",
        placeholder: "sortable-draggable-placeholder",
        forcePlaceholderSize: true,
        appendTo: 'body',
        helper: 'clone',
        zIndex: 666
    }).disableSelection();
    //var sorted = $( "#sortable" ).sortable( "serialize", { key: "sort" } );    
});
function updateListItem(itemId, newStatus) {
    //var sorted = $( "#sortable" ).sortable( "toArray" );
    var sorted = $( "#sortable" ).sortable( "serialize" );
    $.post(ROOT+'packages/sort',sorted+'&action=updateOrder').done(function(data) {});
  }
  $(document).ready(function() {
    $('#addModels').on('click',function(){
         var $listaImages=$('.checkFoto:checked').serialize();
          var package=$('#packageId').val();
          $.post(ROOT+'EN/packages/addToPackage/'+package,$listaImages).done(function(data) {location.reload();});
    });
    $('#deleteModels').on('click',function(){
        var $lista=$('.checkFoto:checked').serialize();
        console.log($lista);
        $.post(ROOT+'ES/packages/deleteModels',$lista).done(function(data) {location.reload();});
    });
    $('.listImage').on('click',function(){
        var $checkbox=$(this).children('.checkFoto');
        $checkbox.attr('checked', !$checkbox.attr('checked'));
    });
    $( "#contacts" ).change(function() {
        var coma="";
        if($('#recipients').val()!="") coma=', ';
        $('#recipients').val($('#recipients').val()+coma+$(this).val());
    });
  });