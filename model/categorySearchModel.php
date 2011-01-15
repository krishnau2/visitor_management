<?php
include '../lib/class_connection.php';

// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$search=new databaseConnectionClass();
//Accessing the database connection function
$search ->dbconnector($database, $connect);

$bed_room = $_POST['bed_room'];
$living_room = $_POST['living_room'];
$kitchen = $_POST['kitchen'];
$wall_fashion = $_POST['wall_fashion'];
$single_storey = $_POST['single_storey'];
$double_storey = $_POST['double_storey'];
$single_storey_RT = $_POST['single_storey_RT'];
$double_storey_RT = $_POST['double_storey_RT'];

$single = 1;
$OR = "OR";
$string_bed_room = " bed_room = 1 ";
$string_living_room = " living_room = 1 ";
$string_kitchen = " kitchen = 1 ";
$string_wall_fashion = " wall_fashion = 1 ";
$string_single_storey = " single_storey = 1 ";
$string_double_storey = " double_storey = 1 ";
$string_single_storey_RT = " single_storey_with_roof_tiles = 1 ";
$string_double_storey_RT = " double_storey_with_roof_tiles = 1 ";


$searchQuery = "SELECT * FROM customer_details WHERE ";

if($bed_room) {
    if($single == 1) {
        $searchQuery = $searchQuery.$string_bed_room;
        $single = $single + 1;
    }
}
if ($living_room){
    if($single == 1) {
        $searchQuery = $searchQuery.$string_living_room;
        $single = $single + 1;
    }
    else{
        $searchQuery = $searchQuery.$OR.$string_living_room;
    }
}
if ($kitchen){
    if($single == 1) {
        $searchQuery = $searchQuery.$string_kitchen;
        $single = $single + 1;
    }
    else{
        $searchQuery = $searchQuery.$OR.$string_kitchen;
    }
}
if ($wall_fashion){
    if($single == 1) {
        $searchQuery = $searchQuery.$string_wall_fashion;
        $single = $single + 1;
    }
    else{
        $searchQuery = $searchQuery.$OR.$string_wall_fashion;
    }
}
if ($single_storey){
    if($single == 1) {
        $searchQuery = $searchQuery.$string_single_storey;
        $single = $single + 1;
    }
    else{
        $searchQuery = $searchQuery.$OR.$string_single_storey;
    }
}
if ($double_storey){
    if($single == 1) {
        $searchQuery = $searchQuery.$string_double_storey;
        $single = $single + 1;
    }
    else{
        $searchQuery = $searchQuery.$OR.$string_double_storey;
    }
}
if ($single_storey_RT){
    if($single == 1) {
        $searchQuery = $searchQuery.$string_single_storey_RT;
        $single = $single + 1;
    }
    else{
        $searchQuery = $searchQuery.$OR.$string_single_storey_RT;
    }
}
if ($double_storey_RT){
    if($single == 1) {
        $searchQuery = $searchQuery.$string_double_storey_RT;
        $single = $single + 1;
    }
    else{
        $searchQuery = $searchQuery.$OR.$string_double_storey_RT;
    }
}



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