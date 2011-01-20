var newId=1;

$(document).ready(function(){
    $("#newSearch").hide();

    enable_input_box();
    clear_input_box();

    $("#newSearch").click(function(e){
        e.preventDefault();
        enable_input_box();
        //        location.reload();
        $('.result_row').remove();
        newId=1;
        $("#newSearch").hide();
        $("#submitSearch").show();
        clear_input_box();
    });

    

    $("#submitSearch").click(function(e){
        e.preventDefault();
        var searchName = $('#searchName').val();
        if( searchName == ""){
            alert("Please enter a name to search");
        }
        else{

            disable_input_box();
            $("#newSearch").show();
            $("#submitSearch").hide();
        

            $.post("../model/nameSearchModel.php", {
                searchName:searchName
            }, function(data){
                process_search_data(data);
            },"json");
        }
    });
});

var process_search_data = function(data){

    var data_length = data.length;
    for(i=0;i<data_length;i++){
        var current_data = data[i];

        var temp_date = String(current_data["DATE"]).split(/[- :]/);
        var date = temp_date[2]+"-"+temp_date[1]+"-"+temp_date[0];
        var temp_bill_date = String(current_data["BILL_1_DATE"]).split(/[- :]/);
        var bill_date = temp_bill_date[2]+"-"+temp_bill_date[1]+"-"+temp_bill_date[0]
        //                alert(date[2]+"-"+date[1]+"-"+date[0]);
        $('#nameSearchTable').append($('#nameSearchRow').clone(true).attr('id', 'row'+newId).attr('class','result_row'));
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
            setTimeout(process_search_data, 5);
        }
    }
}

function td(string) {
    return "<td>"+string+"</td>";
}

function disable_input_box(){
    $("#searchName").attr('disabled', true);
}
function enable_input_box(){
    $("#searchName").removeAttr('disabled');
}
function clear_input_box(){
    $("#searchName").val("");
}