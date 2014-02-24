if(isMobile.any()) window.location.href = "/experience/home/";
var changed = false;
$(window).on('resize', function() {
    resizeContainer();
});
$(document).ready(function() {
    $(document).on('click', function() {
        $('#cookie').slideUp();
    });
    resizeContainer();
    setInterval(function() {
        if ($('#splash-menu li.selected').next().length) var li=$('#splash-menu li.selected').next();
        else return;//var li=$('#splash-menu li').first();
        if(!changed) nextCover(li);
    },5000);
    $('#splash-menu li').on('click', function() {
        changed = true;
        nextCover($(this));
    });
});
function nextCover(li) {
    $('#splash-menu li').removeClass('selected');
    li.addClass('selected');
    var translate = $(window).width() * li.index();
    var translateSubline = (134 * li.index()) + 50;
    var styles = {
        'transform': 'translate(-' + translate + 'px, 0px)'
    };
    $(".oneperframe ul").removeClass('noMove').css(styles);
    var styles = {
        'transform': 'translate(' + translateSubline + 'px, 0px)'
    };
    $("#splash-menu ul li .subline").css(styles);
}
function resizeContainer() {
    var translate = $(window).width() * $('#splash-menu li.selected').index();
    var styles = {
        'transform': 'translate(-' + translate + 'px, 0px)'
    };
    $(".oneperframe ul").addClass('noMove').css(styles);
    var numLi = $('.oneperframe ul li').size();
    var styles = {
        "width": $(window).width(),
        "height": $(window).height(),
        "background-size": "cover"
    };
    var stylesUL = {
        "width": $(window).width() * numLi + numLi
    };
    $(".oneperframe ul li").css(styles);
    $(".oneperframe ul").css(stylesUL);
}
