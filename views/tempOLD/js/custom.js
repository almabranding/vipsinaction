$(document).ready(function() {
    $("#slider1").responsiveSlides({
        maxwidth: 1400,
        speed: 800
    });

    if (isMobile.any() || isiPad.any()) {
        var idVimeo = $('#catwalk').attr('rel');
        var iframe = '<iframe id="player1" src="//player.vimeo.com/video/' + idVimeo + '?api=1&player_id=player1&amp;title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" width="408" height="650" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        $('#catwalk').html(iframe);
  
        /*var iframe = $('#player1')[0],
            player = $f(iframe);
    $('#silenceVimeo').bind('click', function() {
        player.api('setVolume', 0);
    })*/
    }
    
  
        
      
    $('.promotion').removeClass('hide');
    
    $('.promotion').on('click',function(){
        $('.promotion').addClass('hide');
    });
  
   
    

    
});