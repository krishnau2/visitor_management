<?php

// This page will handle the name search AJAX requests.
include './lib/class_connection.php';

// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$analysis=new databaseConnectionClass();
//Accessing the database connection function
$analysis -> dbconnector($database, $connect);

// End of database connection section.

function startDate($month) {
    return $startDate = "2010-".$month."-01";
}
function endDate($month) {
    if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12") {
        return $endDate = "2010-".$month."-31";
    }
    else if($month == "04" || $month == "06" || $month == "09" || $month == "11") {
        return $endDate = "2010-".$month."-30";
    }
}
//===========================================================

$month = "06";
$start_date = startDate($month) ;
$end_date = endDate($month);
echo "Start Date:- ".$start_date;
echo "<br>End Date:- ".$end_date;
echo "<br>";
//============================================================

//Total days of activity

$Query = "SELECT COUNT(DISTINCT DATE) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date'";
$result = mysql_query($Query);

$temp = mysql_fetch_array($result);
$total_days_of_activity = $temp[0];
echo "Total days of activity ".(int)$total_days_of_activity;
//============================================================
//Total no of customers

$Query = "SELECT COUNT(DISTINCT SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND SOFTWARE_ID <> 'Cancelled'";
$result = mysql_query($Query);

echo "<br>";
$temp = mysql_fetch_array($result);
$total_no_of_customers = $temp[0];
echo "Total no of customers ".(int)$total_no_of_customers;
//============================================================
// Avg no of customers per day

$avg_no_of_customers_per_day = ((int)$total_no_of_customers / (int)$total_days_of_activity);

echo "<br>";
echo "Avg no of customers per day ".$avg_no_of_customers_per_day;

?>