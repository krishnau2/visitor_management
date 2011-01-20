<?php include '../lib/class_connection.php'; ?>
<?php
// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.
//Database connection object creation
$new_customers=new databaseConnectionClass();
//Accessing the database connection function
$new_customers ->dbconnector($database, $connect);
if ($_POST['date']!="" && $_POST['no']!="" && $_POST['category']!="" ) {
    $id=$_POST['id'];
    $date =$_POST['date'];
    $no = $_POST['no'];
    $rfc_pob = $_POST['category'];
    $name = $_POST['customer_name'];
    $mobile = $_POST['mobile'];
    $land_line = $_POST['land_line'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $software = $_POST['software'];
    $pr = $_POST['pr_no'];
    $bill_1 = $_POST['first_bill'];
    $bill_1_val = $_POST['first_bill_value'];
    $bill_1_date = $_POST['first_bill_date'];
    $bill_2 = $_POST['second_bill'];
    $bill_3 = $_POST['third_bill'];
    $bill_4 = $_POST['forth_bill'];
    $bill_5 = $_POST['fifth_bill'];
    $comments = $_POST['comments'];
    
    if(isset ($_POST['bed_room'])) {
        $bed_room=1;
    }
    else {
        $bed_room=0;
    }
    if(isset ($_POST['living_room'])) {
        $living_room = 1;
    }
    else {
        $living_room =0;
    }
    if(isset ($_POST['kitchen'])) {
        $kitchen = 1;
    }
    else {
        $kitchen=0;
    }
    if(isset ($_POST['wall_fashion'])) {
        $wall_fashion = 1;
    }
    else {
        $wall_fashion=0;
    }
    if(isset ($_POST['single_storey'])) {
        $single_storey = 1;
    }
    else {
        $single_storey=0;
    }
    if(isset ($_POST['double_storey'])) {
        $double_storey = 1;
    }
    else {
        $double_storey=0;
    }
    if(isset ($_POST['single_storey_RT'])) {
        $single_storey_RT = 1;
    }
    else {
        $single_storey_RT=0;
    }
    if(isset ($_POST['double_storey_RT'])) {
        $double_storey_RT = 1;
    }
    else {
        $double_storey_RT=0;
    }
    if($id==0) {
//                    echo "Before insertion:- B ".$bed_room." L ".$living_room." K ".$kitchen;
        $insertionQuery = "INSERT INTO customer_details VALUES (NULL,'$no','$date',
                    '$name','$address','$mobile','$land_line','$email','$rfc_pob',
                    '$pr','$bill_1','$bill_1_val','$bill_1_date','$software','$bill_2',
                    '$bill_3','$bill_4','$bill_5','$comments','$bed_room','$living_room',
                    '$kitchen','$wall_fashion','$single_storey','$double_storey','$single_storey_RT',
                    '$double_storey_RT')";

        $result = mysql_query($insertionQuery);
        if($result) {
            header("Location:../view/edit_customer_details.php?msg=1");
        }
        else {
            header("Location:../view/edit_customer_details.php?msg=2");
        }
    }
    else {
        $updateQuery = "UPDATE customer_details SET SL_NO='$no',DATE='$date',
                    NAME='$name',ADDRESS='$address',MOBILE='$mobile',LANDLINE='$land_line',EMAIL='$email',RFC_POB='$rfc_pob',
                    PR_NO='$pr',BILL_1='$bill_1',BILL_1_VAL='$bill_1_val',BILL_1_DATE='$bill_1_date',SOFTWARE_ID='$software',
                    BILL_2='$bill_2',BILL_3='$bill_3',BILL_4='$bill_4',BILL_5='$bill_5',COMMENTS='$comments',bed_room='$bed_room',
                    living_room='$living_room',kitchen='$kitchen',wall_fashion='$wall_fashion',single_storey='$single_storey',
                    double_storey='$double_storey',single_storey_with_roof_tiles='$single_storey_RT',
                    double_storey_with_roof_tiles='$double_storey_RT' WHERE id='$id'";

        $updateResult = mysql_query($updateQuery);
        $new_customers ->dbconnector($database, $disconnect);
        if($updateResult) {
            header("Location:../view/edit_customer_details.php?msg=3");
        }
        else {
            header("Location:../view/edit_customer_details.php?msg=2");
        }
    }
}
else {
    header("Location:../view/edit_customer_details.php?msg=4");
//    echo "Date,Req.No and RFC/POB fields are required. Please go back. ";
}
?>