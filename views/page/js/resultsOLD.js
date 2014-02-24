$(document).ready(function() {
   var checkedin=false;
    var checkedout=false;
        $('#checkin.datepicker').Zebra_DatePicker({
            direction: 1,
            format: 'd-m-Y',
            onSelect: function(date) {
                checkedin=true;
                var checkout=$('#checkout.datepicker').data('Zebra_DatePicker');
                checkout.update({
                    direction: [date, false]
                });
            }
        });
        $('#checkout.datepicker').Zebra_DatePicker({
            direction: 1,
            format: 'd-m-Y',
            onSelect: function(date) {
                checkedout=true;
                var checkin=$('#checkin.datepicker').data('Zebra_DatePicker');
                checkin.update({
                    direction: [1,date]
                });
            }
        });
     $('#booking').submit(function(event) {
        var isEmpty = true;
        $(this).find('#adults').each(function() {
            if ($(this).val() !== '0')
                isEmpty = false;
        });
        $(this).find('#children').each(function() {
            if ($(this).val() !== '0')
                isEmpty = false;
        });
            if (!checkedout || !checkedin)
                isEmpty = true;
        if(isEmpty)
            $('#errorMsg').html('* Rellene los campos');
        if (isEmpty)
            return false;
    });
});

