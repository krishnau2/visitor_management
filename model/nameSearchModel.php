<?php

// This page will handle the name search AJAX requests.
include '../lib/class_connection.php';

$searchName = $_POST['searchName'];

// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$search=new databaseConnectionClass();
//Accessing the database connection function
$search ->dbconnector($database, $connect);

$searchQuery = "SELECT * FROM customer_details WHERE NAME LIKE '%$searchName%'";
$searchResult = mysql_query($searchQuery);
$noOfResults = mysql_num_rows($searchResult);

$returnArray = array ();
if($noOfResults) {
    while ($row = mysql_fetch_assoc($searchResult)) {
        array_push($returnArray,$row);
    }
    echo json_encode($returnArray);
}
else {
    echo "error";
}

?>