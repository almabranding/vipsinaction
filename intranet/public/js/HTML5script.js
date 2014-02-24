$(function() {
    var URL = '/intranet/';
    var LANG = '';
    var dropbox = $('#dropbox'),
    message = $('.message', dropbox);
    var typeUpload = $('#typeUpload').val();
    var project = $('#project').val();
    var uploadType = $('#uploadType').val();
    var bbdd = $('#bbdd').val();
    var maxfilesize = 2;
    var maxfiles = 50;
    dropbox.filedrop({
        // The name of the $_FILES entry:
        paramname: 'pic',
        maxfiles: maxfiles,
        maxfilesize: maxfilesize,
        url: URL + LANG + typeUpload,
        uploadFinished: function(i, file, response) {
            $.data(file).addClass('done');
            // response is the JSON object that post_file.php returns
        },
        error: function(err, file) {
            switch (err) {
                case 'FileTooLarge':
                    alert(file.name + ' is too large! Please upload files up to ' + maxfilesize + 'mb (configurable).');
                    break;
                case 'TooManyFiles':
                    alert('Too many files! Please select ' + maxfiles + ' at most! (configurable)');
                    break;
                case 'BrowserNotSupported':
                    showMessage('Your browser does not support HTML5 file uploads!');
                    break;
                default:
                    break;
            }
        },
        // Called before each upload is started
        beforeEach: function(file) {
            
            if(!file.type.match(/^image\//)){
             alert('Only images are allowed!');
             
             // Returning false will cause the
             // file to be rejected
             return false;
             }
        },
        uploadStarted: function(i, file, len) {
            createImage(file);
        },
        progressUpdated: function(i, file, progress) {
            $.data(file).find('.progress').width(progress);

        }

    });

    var template = '<div class="preview">' +
            '<span class="imageHolder">' +
            '<img />' +
            '<span class="uploaded"></span>' +
            '</span>' +
            '<div class="progressHolder">' +
            '<div class="progress"></div>' +
            '</div>' +
            '</div>';


    function createImage(file) {

        var preview = $(template),
                image = $('img', preview);

        var reader = new FileReader();

        image.width = 100;
        image.height = 100;

        reader.onload = function(e) {

            // e.target.result holds the DataURL which
            // can be used as a source of the image:

            image.attr('src', e.target.result);
        };

        // Reading the file as a DataURL. When finished,
        // this will trigger the onload function above:
        reader.readAsDataURL(file);

        message.hide();
        preview.appendTo(dropbox);

        // Associating a preview container
        // with the file, using jQuery's $.data():

        $.data(file, preview);
    }

    function showMessage(msg) {
        alert(msg);
        message.html(msg);
    }

});