$( "#detail-tabs" ).tabs();
$(".colabores-auctions a").on('click',function(){
    var sign=$(this).children();
    (sign.html()==='+')?sign.html('-'):sign.html('+');
    $(this).parents('li').find('#listBids').slideToggle('slow');
});