<?php include '../lib/class_connection.php'; ?>
<?php
// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.
//Database connection object creation
$save_email_request=new databaseConnectionClass();
//Accessing the database connection function
$save_email_request ->dbconnector($database, $connect);
if(isset ($_POST['ajax'])) {
 $no = $_POST['no'];
 $name_search_query = "SELECT NAME FROM customer_details WHERE SL_NO = '$no'";
 $result = mysql_query($name_search_query);
 $noOfResults = mysql_num_rows($result);
 $returnArray = array ();
    if($noOfResults) {
        while ($row = mysql_fetch_assoc($result)) {
            array_push($returnArray,$row);
        }
        echo json_encode($returnArray);
    }
    else {
        echo "error";
    } 
}
else {
    if ($_POST['no']!="" && $_POST['software']!="" && $_POST['no_of_selection_of_images']!="" ) {
        $id=$_POST['id'];
        $no = $_POST['no'];
        $software =$_POST['software'];
        $no_of_selection_of_images=$_POST['no_of_selection_of_images'];
        $no_of_email_images =$_POST['no_of_email_images'];
        $email_send_date=$_POST['email_send_date'];
        if($id==0) {
            $insertionQuery = "INSERT INTO email_requests VALUES (NULL,'$no','$software',
                    '$no_of_email_images','$no_of_selection_of_images','$email_send_date')";

            $result = mysql_query($insertionQuery);
            if($result) {
                header("Location:../view/email_request_view.php?msg=1");
            }
            else {
                header("Location:../view/email_request_view.php?msg=2");
            }
        }
        else {
            $updateQuery = "UPDATE email_requests SET SL_NO='$no',SOFTWARE_ID='$software',
                    no_of_email_images='$no_of_email_images',no_of_selection_of_images='$no_of_selection_of_images',
                    email_send_date='$email_send_date' WHERE id='$id'";

            $updateResult = mysql_query($updateQuery);
            $save_email_request ->dbconnector($database, $disconnect);
            if($updateResult) {
                header("Location:../view/email_request_view.php?msg=3");
            }
            else {
                header("Location:../view/email_request_view.php?msg=2");
            }
        }
    }
    else {
        header("Location:../view/email_request_view.php?msg=4");
//    echo "Date,Req.No and RFC/POB fields are required. Please go back. ";
    }
}
?>