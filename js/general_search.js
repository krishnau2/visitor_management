var newId=1;

$(document).ready(function(){

    var select_all = 0;

    select_all =1;
    $("#loading").show();

    $.post("../model/customer_list_model.php",{
        select_all: select_all
    },function(data){
        process_customer_list_data(data);
        $("#loading").hide();
    },"json");

});

var process_customer_list_data = function(data){

    var data_length = data.length;

    for(i = 0;i < data_length; i++){

        var current_data=data[i];

        var temp_date = String(current_data["DATE"]).split(/[- :]/);
        var date = temp_date[2]+"-"+temp_date[1]+"-"+temp_date[0];
        var temp_bill_date = String(current_data["BILL_1_DATE"]).split(/[- :]/);
        var bill_date = temp_bill_date[2]+"-"+temp_bill_date[1]+"-"+temp_bill_date[0]

        $('#customer_list_table').append($('#customer_list_row').clone(true).attr('id', 'row'+newId));

        $('#row'+newId).append(
            td(date)+
            td(current_data["SL_NO"])+
            td(current_data["RFC_POB"])+
            td(current_data["NAME"])+
            td(current_data["MOBILE"])+
            td(current_data["LANDLINE"])+
            td(current_data["ADDRESS"])+
            td(current_data["SOFTWARE_ID"])+
            td(current_data["BILL_1"])+
            td(bill_date)+
            td(current_data["BILL_1_VAL"])+
            td(current_data["PR_NO"])+
            td(current_data["BILL_2"])+
            td(current_data["BILL_3"])+
            td(current_data["BILL_4"])+
            td(current_data["BILL_5"])+
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