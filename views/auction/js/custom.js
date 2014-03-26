var $tabs = $("#detail-tabs").tabs({
    disabled: [3]
});
$("#detail-tabs li:last-child").attr('aria-controls', '');

$("#bidButton").on('click', function() {
    if ($('#msgCheck').is(":checked")) {
        $('#msgCheck').removeAttr("checked");
    }
    if ($("#user_id").val() === '')
        $('#msgCheck').attr("checked", "checked");
    else
        $("#bid-form").submit();
});
$("#addFav").on('click', function() {
    var auction_id = $('#auction_id').val();
    var user_id = $('#user_id').val();
    $.getJSON("/auction/favorites", {auction_id: auction_id, user_id: user_id}, function(data) {
        if (data != null) {
            $.each(data, function(i, item) {
                if (item === 1)
                    $('#addFav .q-button').html('-');
                if (item === 2)
                    $('#addFav .q-button').html('+');
            });
        }
    });
});
// set the date we're counting down to
var target_date = document.getElementById("countdown").innerHTML;
//var res = countdown.split(",");

//var target_date = new Date(res[0],res[1],res[2],res[3],res[4],res[5],res[6]).getTime();

// variables for time units
var days, hours, minutes, seconds;

// get tag element
var countdownResult = document.getElementById("countdownResult");
var tDays = document.getElementById("days");
var tHours = document.getElementById("hours");
var tMinutes = document.getElementById("minutes");
var tSeconds = document.getElementById("seconds");

// update the tag with id "countdown" every 1 second
setInterval(function() {
    // find the amount of "seconds" between now and target
    //var arr = "2010-03-15 10:30:00".split(/[- :]/),
    //date = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
    var current_date = parseInt(new Date().getTime() / 1000);
    var seconds_left = (target_date - current_date);

    // do some time calculations
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;

    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;

    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);

    // format countdown string + set tag value
    if (current_date > target_date)
    {
        days = hours = minutes = seconds = 0;
    }
    tDays.innerHTML = days;
    tHours.innerHTML = hours;
    tMinutes.innerHTML = minutes;
    tSeconds.innerHTML = seconds;

}, 1000);