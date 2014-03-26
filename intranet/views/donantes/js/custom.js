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
});

function updateListItem(itemId, newStatus) {
    //var sorted = $( "#sortable" ).sortable( "toArray" );
    var sorted = $( "#sortable" ).sortable( "serialize" );
     var section=$('#sectionId').val();
    $.post(ROOT+'home/sort',sorted+'&action=updateOrder&id='+section).done(function(data) {});
  }
  $(document).ready(function() {
    $('#addModels').on('click',function(){
         var $listaImages=$('.checkFoto:checked').serialize();
          var section=$('#sectionId').val();
          $.post(ROOT+'EN/home/addToSection/'+section,$listaImages).done(function(data) {location.reload();});
    });
    $('.deleteSingle').on('click',function(){
        var $lista=$(this).parent().children('.checkFoto').val();
        $lista='check%5B%5D='+$lista;
        console.log($lista);
        if(confirm('¿Estas seguro?'))
        $.post(ROOT+'ES/home/deleteImages',$lista).done(function(data) {location.reload();});
    });
    $('#deleteImages').on('click',function(){
        var $lista=$('.checkFoto:checked').serialize();
        if(confirm('¿Estas seguro?'))
        $.post(ROOT+'ES/home/deleteImages',$lista).done(function(data) {location.reload();});
    });
    $('.modelList').on('click',function(){
        var $checkbox=$(this).children('.checkFoto');
        $checkbox.prop('checked', !$checkbox.prop('checked'));
    });
  });