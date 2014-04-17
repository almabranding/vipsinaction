var ROOT = '/';
$(document).ready(function() {
    $('#socialMediaMargin a').on('click',function(){
        var addr=$(this).attr('rel');
        window.open(addr,"social","toolbar=no, scrollbars=no, resizable=yes, top=500, left=500, width=400, height=400");
    });
});
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};
var isiPad = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPad|iPod/i);
    },
    any: function() {
        return (isiPad.iOS());
    }
};
function setCookie(c_name, value, exdays)
{
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}
function getCookie(c_name)
{
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1)
    {
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1)
    {
        c_value = null;
    }
    else
    {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1)
        {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
}
$('#signup #_btnsubmit').on('click', function() {
    var email = $('#signup #email').val();
    var nick = $('#signup #nick').val();
    $('.error').hide();
    var error = false;
    $.getJSON("/user/checkRegister", {email: email, nick: nick}, function(data) {
        if (data != null) {
            $.each(data, function(i, item) {
                $('#signup #error_' + item).show();
                error = true;
            });
        }
        if (!error) {
            $('#signup').submit();
        }
    });

    return false;
});
$('.away').each(function() {
    $(this).on('change', function() {
        var checkId = $(this).attr('id');
        $('.away').not('#' + checkId).removeAttr("checked");
    })
});