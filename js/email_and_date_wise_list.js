var newId=1;

$(document).ready(function(){
    
    $('#search_date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
    
    $("table.tablesorter").tablesorter();

    // removing TICK while loading
    $('#email_list_only').attr('checked',false);
    $('#non_productive').attr('checked',false);
    // email secion.
    var email = 0;

    $("#email_list_only").click(function(){
        
        $('.email').remove(); // emptying the table
        $(".pop-up_caption").empty();
        $(".pop-up_caption").append("E-mail Requests ");

        newId = 1;

        if($('#email_list_only').attr('checked') == true){
            email = 1;

            $("#loading").show();

            $.post("../model/email_and_date_wise_list_model.php",{
                search_cateogry: "email"
            },function(data){
                process_email_customer_list_data(data);
                $("#loading").hide();
            },"json");


            $("#lightbox, #email_list_lightbox_panel").fadeIn(300);

            $("a#close-panel").click(function(){
                $("#lightbox, #email_list_lightbox_panel").fadeOut(300);
                $('#email_list_only').attr('checked',false);
                $('.email').remove(); // emptying the table
                $(".pop-up_caption").empty();
            });
        }
        else{
            email = 0;
        }

        
    });

    //Day wise customer list

    $("#day_wise_customer_list_submit").click(function(e){
        e.preventDefault();
        $('.day_list').remove();
        $(".pop-up_caption").empty();
        newId = 1;
        var search_date = $("#search_date").val();

        var temp_date = String(search_date).split(/[- :]/);
        var banner_display_date = temp_date[2]+"-"+temp_date[1]+"-"+temp_date[0];
        var banner_caption = "Day wise list for :- " + banner_display_date;


        if(search_date != ""){
            $(".pop-up_caption").append(banner_caption);
            $("#loading").show();

            $.post("../model/email_and_date_wise_list_model.php",{
                search_cateogry: "day_wise",
                date:search_date
            },function(data){
                if(data != "No data available for this search"){
                    process_day_wise_customer_list_data(data);
                }
                else{
                    alert("No data available for this search.");
                }
                $("#loading").hide();
            },"json");


            $("#lightbox, #day_wise_list_lightbox_panel").fadeIn(300);

            $("a#close-panel").click(function(){
                $("#lightbox, #day_wise_list_lightbox_panel").fadeOut(300);
                $("#search_date").val("");
                $('.day_list').remove();
                $(".pop-up_caption").empty();
            });
        }
        else if(search_date == ""){
            alert("Please Select a date to search.")
        }
    });
    //    Non - Productive customers list.
var non_productive = 0;
    $("#non_productive").click(function(){

        $('.non_productive').remove(); // emptying the table
        $(".pop-up_caption").empty();
        $(".pop-up_caption").append("Non-Productive customers List");

        newId = 1;

        if($('#non_productive').attr('checked') == true){
            non_productive = 1;

            $("#loading").show();

            $.post("../model/email_and_date_wise_list_model.php",{
                search_cateogry: "non-productive"
            },function(data){
                process_non_productive_customer_list_data(data);
                $("#loading").hide();
            },"json");


            $("#lightbox, #non_productive_customers_list_lightbox_panel").fadeIn(300);

            $("a#close-panel").click(function(){
                $("#lightbox, #non_productive_customers_list_lightbox_panel").fadeOut(300);
                $('#non_productive').attr('checked',false);
                $('.non_productive').remove(); // emptying the table
                $(".pop-up_caption").empty();
            });
        }
    });


});

var process_non_productive_customer_list_data = function(data){

    var data_length = data.length;

    for(i = 0;i < data_length; i++){

        var current_data=data[i];

        var temp_date = String(current_data["DATE"]).split(/[- :]/);
        var date = temp_date[2]+"-"+temp_date[1]+"-"+temp_date[0];

        $('#non_productive_customer_list_table').append($('#non_productive_customer_list_row').clone(true)
            .attr('id', 'row'+newId).attr('class','non_productive'));

        $('#row'+newId).append(
            td(newId)+
            td(date)+
            td(current_data["SL_NO"])+
            td(current_data["RFC_POB"])+
            td(current_data["NAME"])+
            td(current_data["ADDRESS"])+
            td(current_data["SOFTWARE_ID"])
            );
        $('#row'+newId).show();
        newId=newId+1;

        if(i % 50 ==0 ){
            setTimeout(process_non_productive_customer_list_data, 5);
        }
    }
}
var process_email_customer_list_data = function(data){

    var data_length = data.length;

    for(i = 0;i < data_length; i++){

        var current_data=data[i];

        var temp_date = String(current_data["email_send_date"]).split(/[- :]/);
        var email_date = temp_date[2]+"-"+temp_date[1]+"-"+temp_date[0];

        $('#email_customer_list_table').append($('#email_customer_list_row').clone(true)
            .attr('id', 'row'+newId).attr('class','email'));

        $('#row'+newId).append(
            td(newId)+
            td(email_date)+
            td(current_data["SL_NO"])+
            td(current_data["RFC_POB"])+
            td(current_data["NAME"])+
            td(current_data["SOFTWARE_ID"])+
            td(current_data["no_of_email_images"])+
            td(current_data["no_of_selection_of_images"])+
            td("<form action='../view/email_request_view.php' method='post'>"
                +"<input type='hidden' name='id' value="+current_data['id']+">"
                +"<input type='submit' style='width: 40px; ' value='Edit' name='edit' id='edit'/>"
                +"</form>")
            );
        $('#row'+newId).show();
        newId=newId+1;

        if(i % 50 ==0 ){
            setTimeout(process_email_customer_list_data, 5);
        }
    }
}
var process_day_wise_customer_list_data = function(data){

    var data_length = data.length;

    for(i = 0;i < data_length; i++){

        var current_data=data[i];

        var temp_date = String(current_data["DATE"]).split(/[- :]/);
        var date = temp_date[2]+"-"+temp_date[1]+"-"+temp_date[0];

        $('#day_wise_customer_list_table').append($('#day_wise_customer_list_row').clone(true)
            .attr('id', 'row'+newId).attr('class','day_list'));

        $('#row'+newId).append(
            td(newId)+
            td(date)+
            td(current_data["SL_NO"])+
            td(current_data["RFC_POB"])+
            td(current_data["NAME"])+
            td(current_data["ADDRESS"])+
            td(current_data["SOFTWARE_ID"])+
            td(current_data["no_of_selection_of_images"])+
            td(current_data["no_of_email_images"])+
            td("<form action='../view/edit_customer_details.php' method='post'>"
                +"<input type='hidden' name='id' value="+current_data["id"]+">"
                +"<input type='submit' style='width: 40px; ' value='Edit' name='edit' id='edit'/>"
                +"</form>")
            );
        $('#row'+newId).show();
        newId=newId+1;

        if(i % 50 ==0 ){
            setTimeout(process_day_wise_customer_list_data, 5);
        }
    }
}

function td(string) {
    return "<td>"+string+"</td>";
}