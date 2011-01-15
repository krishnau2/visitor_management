<?php

// This page will handle the name search AJAX requests.
include '../lib/class_connection.php';

$select_all = $_POST['select_all'];
// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$listOfCustomers=new databaseConnectionClass();
//Accessing the database connection function
$listOfCustomers ->dbconnector($database, $connect);

$listQuery = "SELECT * FROM customer_details ORDER BY SL_NO limit 0,50 ";
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

?>