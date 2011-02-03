<?php

// This page will handle the name search AJAX requests.
include '../lib/class_connection.php';

if(isset ($_POST['search_cateogry'])) {
    $search_cateogry = $_POST['search_cateogry'];
}
else {
    $search_cateogry = "";
}

if(isset ($_POST['date'])) {
    $search_date = $_POST['date'];
}
else {
    $search_date = "";
}

// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$listOfemailCustomers=new databaseConnectionClass();
//Accessing the database connection function
$listOfemailCustomers ->dbconnector($database, $connect);

if($search_cateogry == "email") {
    $email_list_query = "SELECT customer_details.SL_NO,
    NAME,
    RFC_POB,
    email_requests.id,
    email_requests.email_send_date,
    email_requests.no_of_email_images,
    email_requests.SOFTWARE_ID,
    email_requests.no_of_selection_of_images
    FROM customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO
    WHERE email_requests.no_of_email_images <> 0 
    ORDER BY customer_details.SL_NO,email_requests.email_send_date DESC  ";
    $result = mysql_query($email_list_query);
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
else if($search_cateogry == "day_wise" && $search_date != "") {

    $day_wise_list_query = "SELECT customer_details.SL_NO,
    customer_details.id,
    NAME,
    DATE,
    RFC_POB,
    ADDRESS,
    customer_details.SOFTWARE_ID,
    email_requests.no_of_email_images,
    email_requests.no_of_selection_of_images
    FROM customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO
    WHERE DATE = '$search_date' 
    ORDER BY customer_details.SL_NO ";
    $result = mysql_query($day_wise_list_query);
    $noOfResults = mysql_num_rows($result);

    $returnArray = array ();

    if($noOfResults) {
        while ($row = mysql_fetch_assoc($result)) {
            array_push($returnArray,$row);
        }
        echo json_encode($returnArray);
    }
    else {
        $returnArray = "No data available for this search";
        echo json_encode($returnArray);
    }

}
else if($search_cateogry == "non-productive") {
    $email_list_query = "SELECT DATE,SL_NO,
    NAME,
    RFC_POB,
    NAME,
    ADDRESS,
    SOFTWARE_ID
    FROM customer_details
    WHERE BILL_1 = \" \" AND SOFTWARE_ID <> 'Cancelled'
    ORDER BY SL_NO DESC ";
    $result = mysql_query($email_list_query);
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