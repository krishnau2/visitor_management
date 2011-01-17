<?php

// This page will handle the name search AJAX requests.
include '../lib/class_connection.php';

$email = $_POST['email'];
// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$listOfemailCustomers=new databaseConnectionClass();
//Accessing the database connection function
$listOfemailCustomers ->dbconnector($database, $connect);

if(email) {
    $listQuery = "SELECT customer_details.SL_NO,
    NAME,
    RFC_POB,
    email_requests.email_send_date,
    email_requests.no_of_email_images,
    email_requests.SOFTWARE_ID,
    email_requests.no_of_selection_of_images
    from customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO";
    $result = mysql_query($listQuery);
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
?>