var newId=1;

$(document).ready(function(){
    $("#newSearch").hide();
    enable_tick_boxes();
    uncheck_tick_boxes();

    $("#newSearch").click(function(e){
        e.preventDefault();
        enable_tick_boxes();
        //        location.reload();
        $('.result_row').remove();
        newId=1;
        $("#newSearch").hide();
        $("#categorySearch").show();
        uncheck_tick_boxes();
    //document.category.bed_room.checked=false;
    })

    $("#categorySearch").click(function(e){
        e.preventDefault();
        disable_tick_boxes();
        $("#newSearch").show();
        $("#categorySearch").hide();
        var bed_room;
        var living_room;
        var kitchen;
        var wall_fashion;
        var single_storey;
        var double_storey;
        var single_storey_RT;
        var double_storey_RT;
        
        if (document.category.bed_room.checked==true){
            //            alert("bed room checked");
            bed_room =1;
        }
        else{
            bed_room=0;
        }

        if (document.category.living_room.checked==true){
            //            alert("living room checked");
            living_room =1;
        }
        else{
            living_room=0;
        }

        if (document.category.kitchen.checked==true){
            kitchen =1;
        }
        else{
            kitchen=0;
        }

        if (document.category.wall_fashion.checked==true){
            wall_fashion =1;
        }
        else{
            wall_fashion=0;
        }

        if (document.category.single_storey.checked==true){
            single_storey =1;
        }
        else{
            single_storey=0;
        }

        if (document.category.double_storey.checked==true){
            double_storey =1;
        }
        else{
            double_storey=0;
        }

        if (document.category.single_storey_RT.checked==true){
            single_storey_RT =1;
        }
        else{
            single_storey_RT=0;
        }

        if (document.category.double_storey_RT.checked==true){
            double_storey_RT =1;
        }
        else{
            double_storey_RT=0;
        }

        if(bed_room || living_room || kitchen || wall_fashion || single_storey || double_storey || single_storey_RT || double_storey_RT){
            $.post(".././model/categorySearchModel.php", {
                bed_room:bed_room,
                living_room:living_room,
                kitchen:kitchen,
                wall_fashion:wall_fashion,
                single_storey:single_storey,
                double_storey:double_storey,
                single_storey_RT:single_storey_RT,
                double_storey_RT:double_storey_RT
            }, function(data){

                process_search_data(data);
            
            },"json");
        }
        else{
            alert("Please select a category to search.");
            enable_tick_boxes();
            //        location.reload();
            $("#newSearch").hide();
            $("#categorySearch").show();
            uncheck_tick_boxes();
        }
    });
});

var process_search_data = function(data){

    data_length = data.length;
    for(i=0;i<data_length;i++){
        current_data=data[i];

        var temp_date = String(current_data["DATE"]).split(/[- :]/);
        var date = temp_date[2]+"-"+temp_date[1]+"-"+temp_date[0];
        var img_bed,img_living,img_kitchen,img_wall_fasion,img_single,img_double,img_single_rt,img_double_rt;

        if(current_data["bed_room"]==1){
            img_bed="<img src='../img/tick.png' alt='Logo'/>"
        }
        else{
            img_bed="<img src='../img/cross1.png' alt='Logo' />"
        }
        if(current_data["living_room"]==1){
            img_living="<img src='../img/tick.png' alt='Logo'/>"
        }
        else{
            img_living="<img src='../img/cross1.png' alt='Logo'  />"
        }
        if(current_data["kitchen"]==1){
            img_kitchen="<img src='../img/tick.png' alt='Logo'/>"
        }
        else{
            img_kitchen="<img src='../img/cross1.png' alt='Logo'  />"
        }
        if(current_data["wall_fashion"]==1){
            img_wall_fasion="<img src='../img/tick.png' alt='Logo'/>"
        }
        else{
            img_wall_fasion="<img src='../img/cross1.png' alt='Logo'  />"
        }
        if(current_data["single_storey"]==1){
            img_single="<img src='../img/tick.png' alt='Logo'/>"
        }
        else{
            img_single="<img src='../img/cross1.png' alt='Logo'  />"
        }
        if(current_data["double_storey"]==1){
            img_double="<img src='../img/tick.png' alt='Logo'/>"
        }
        else{
            img_double="<img src='../img/cross1.png' alt='Logo'  />"
        }
        if(current_data["single_storey_with_roof_tiles"]==1){
            img_single_rt="<img src='../img/tick.png' alt='Logo'/>"
        }
        else{
            img_single_rt="<img src='../img/cross1.png' alt='Logo'  />"
        }
        if(current_data["double_storey_with_roof_tiles"]==1){
            img_double_rt="<img src='../img/tick.png' alt='Logo'/>"
        }
        else{
            img_double_rt="<img src='../img/cross1.png' alt='Logo'  />"
        }

        $('#categorySearchResultTable').append($('#categorySearchRow').clone(true).attr('id', 'row'+newId).attr('class','result_row'));
        $('#row'+newId).append(
            td(date)+
            td(current_data["SL_NO"])+
            td(current_data["RFC_POB"])+
            td(current_data["NAME"])+
            td(current_data["MOBILE"])+
            td(current_data["LANDLINE"])+
            td(current_data["ADDRESS"])+
            td(current_data["SOFTWARE_ID"])+
            td(img_bed)+
            td(img_living)+
            td(img_kitchen)+
            td(img_wall_fasion)+
            td(img_single)+
            td(img_double)+
            td(img_single_rt)+
            td(img_double_rt)+
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

function disable_tick_boxes(){
    $("#bed_room").attr('disabled', true);
    $("#living_room").attr('disabled', true);
    $("#kitchen").attr('disabled', true);
    $("#wall_fashion").attr('disabled', true);
    $("#single_storey").attr('disabled', true);
    $("#double_storey").attr('disabled', true);
    $("#single_storey_RT").attr('disabled', true);
    $("#double_storey_RT").attr('disabled', true);
}
function enable_tick_boxes(){
    $("#bed_room").removeAttr('disabled');
    $("#living_room").removeAttr('disabled');
    $("#kitchen").removeAttr('disabled');
    $("#wall_fashion").removeAttr('disabled');
    $("#single_storey").removeAttr('disabled');
    $("#double_storey").removeAttr('disabled');
    $("#single_storey_RT").removeAttr('disabled');
    $("#double_storey_RT").removeAttr('disabled');
}
function uncheck_tick_boxes(){
    document.category.bed_room.checked=false;
    document.category.living_room.checked=false;
    document.category.kitchen.checked=false;
    document.category.wall_fashion.checked=false;
    document.category.single_storey.checked=false;
    document.category.double_storey.checked=false;
    document.category.single_storey_RT.checked=false;
    document.category.double_storey_RT.checked=false;
}