$(document).ready(function(){

    $('#email_send_date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
    
    $("#no").blur(function(){
        var request_no = $("#no").val();
        var name = "";
        $(".name_board").remove();
        $.post("../model/email_request_model.php",{
            ajax: "name_search",
            no:request_no
        },function(data){
            //            alert(data[0]["NAME"]);
            name = "<td class=\"name_board\">NAME :- "+data[0]["NAME"]+"</td>";
            $("#show_name").append(name);
        },"json");
    });

});