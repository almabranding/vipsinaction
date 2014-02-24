$(document).ready(function() {
    $(window).on('resize',function(){
        $('#container').css('height',$(window).height()-60);
        $('.backgroundContainer').css('width',$(window).width()-40);
    });
    $('#container').css('height',$(window).height()-60);
    $('.backgroundContainer').css('width',$(window).width()-40);
});

    
