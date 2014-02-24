var ROOT = '/';
$(document).ready(function() {
   /* html2canvas(document.body, {
        onrendered: function(canvas) {
            document.body.innerHTML = "";
            document.head.innerHTML = "";
           // document.body.appendChild(canvas);
            var jpgURI = canvas.toDataURL('image/jpeg', 0.75);
            //document.body.appendChild(jpgURI);
             
img = document.createElement("img");

img.src =jpgURI;
document.body.appendChild ( img );

//            var doc = new jsPDF();
//
//            doc.setFontSize(40);
//            doc.text(35, 25, "Paranyan loves jsPDF");
//            doc.addImage(jpgURI, 'JPEG', 15, 40, 180, 160);
//            doc.save('Test.pdf');
        }
    });*/
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