var newId=1;

$(document).ready(function(){
    
    $('#date').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    var email = 0;

    $("#email_list_only").click(function(){
        $('.email_customer_list_row').empty()
        newId = 1;

        if($('#email_list_only').attr('checked') == true){
            email = 1;

            $("#loading").show();

            $.post("../model/email_and_date_wise_list_model.php",{
                email: email
            },function(data){
                process_customer_list_data(data);
                $("#loading").hide();
            },"json");


            $("#lightbox, #email_list_lightbox_panel").fadeIn(300);

            $("a#close-panel").click(function(){
                $("#lightbox, #email_list_lightbox_panel").fadeOut(300);
                $('#email_list_only').attr('checked',false);
            });
        }
        else{
            email = 0;
        }

        
    })


});

var process_customer_list_data = function(data){

    var data_length = data.length;

    for(i = 0;i < data_length; i++){

        var current_data=data[i];

        var temp_date = String(current_data["email_send_date"]).split(/[- :]/);
        var email_date = temp_date[2]+"-"+temp_date[1]+"-"+temp_date[0];
        var temp_bill_date = String(current_data["BILL_1_DATE"]).split(/[- :]/);
        var bill_date = temp_bill_date[2]+"-"+temp_bill_date[1]+"-"+temp_bill_date[0]

        $('#email_customer_list_table').append($('#email_customer_list_row').clone(true).attr('id', 'row'+newId));

        $('#row'+newId).append(
            td(newId)+
            td(email_date)+
            td(current_data["SL_NO"])+
            td(current_data["RFC_POB"])+
            td(current_data["NAME"])+
            td(current_data["SOFTWARE_ID"])+
            td(current_data["no_of_email_images"])+
            td(current_data["no_of_selection_of_images"])+
            td("<form action='../view/edit_customer_details.php' method='post'>"
                +"<input type='hidden' name='id' value="+current_data['id']+">"
                +"<input type='submit' style='width: 40px; ' value='Edit' name='edit' id='edit'/>"
                +"</form>")
            );
        $('#row'+newId).show();
        newId=newId+1;

        if(i % 50 ==0 ){
            setTimeout(process_customer_list_data, 5);
        }
    }
}

function td(string) {
    return "<td>"+string+"</td>";
}