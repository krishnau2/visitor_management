$(document).ready(function(){
    $('#date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $('#first_bill_date').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $("#cancel").click(function(){
        
        if($('#cancel').attr('checked') == true){
            //            alert("checked");
            $("#software").val("Cancelled");
            $("#software").attr('disabled', true);
        }
        else{
            $("#software").val("");
            $("#software").removeAttr('disabled');
        }
    });


    $("#save_button").click(function(e){
        entry_field_validations(e);
    //        e.preventDefault();
    });
               
});

function entry_field_validations(e){
    var date = $("#date").val();
    var req_no = $("#no").val();
    var customer_name = $("#customer_name").val();
    var address = $("#address").val();

    //        alert(address);

    if(date == ""){
        alert("Please enter a Date");
        e.preventDefault();
    }
    else if(req_no == ""){
        alert("Please enter a Requestion No.");
        e.preventDefault();
    }
    else if(customer_name == ""){
        alert("Please enter Customer Name.");
        e.preventDefault();
    }
    else if(address == ""){
        alert("Please enter Address.");
        e.preventDefault();
    }

}