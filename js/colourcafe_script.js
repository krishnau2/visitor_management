$(document).ready(function(){
    $('#date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $('#first_bill_date').datepicker({
        dateFormat: 'yy-mm-dd'
    });

//    $('#cancel').click(function(){
//        $("#customer_name").val("Cancelled")
//        $("#address").val("Cancelled");
//    });


    var isCtrl = false;
    var isAlt = false;
    var isShift = false;
    $(document).keyup(function (e) {
        if(e.which == 17) isCtrl=false;
    }).keydown(function (e) {
        if(e.which == 16) isShift=true;
        if(e.which == 17) isCtrl=true;
        if(e.which == 18) isAlt=true;
        if(e.which == 75 && isCtrl == true && isAlt == true && isShift == true) {
            alert('-KK-');

            isCtrl = false;
            isAlt = false;
            isShift = false;
            return false;
        }
    });

//$("#software").multiNumberEntry({delimiter: ' and '});

});