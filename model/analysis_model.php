<?php
session_start();
// This page will handle Analysis section.
include '../lib/class_connection.php';
// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.
//Database connection object creation
$analysis=new databaseConnectionClass();
//Accessing the database connection function
$analysis -> dbconnector($database, $connect);
// End of database connection section.
function GetTimeStamp($MySqlDate) {
    /*
                Take a date in yyyy-mm-dd format and return it to the user
                in a PHP timestamp
    */
    $date_array = explode("-",$MySqlDate); // split the array
    $new_date = $date_array[2]."-".$date_array[1]."-".$date_array[0];
    return($new_date); // return it to the user
}

$start_date = $_POST['start_date'];
$_SESSION['start_date'] = GetTimeStamp($start_date);
$end_date = $_POST['end_date'];
$_SESSION['end_date'] = GetTimeStamp($end_date);
//function startDate($month) {
//    return $startDate = "2010-".$month."-01";
//}
//function endDate($month) {
//    if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12") {
//        return $endDate = "2010-".$month."-31";
//    }
//    else if($month == "04" || $month == "06" || $month == "09" || $month == "11") {
//        return $endDate = "2010-".$month."-30";
//    }
//}
//===========================================================
//
//$month = "06";
//$start_date = startDate($month) ;
//$end_date = endDate($month);
//echo "Start Date:- ".$start_date;
//echo "<br>End Date:- ".$end_date;
//echo "<br>=============================================<br>";
//============================================================
//Total days of activity
$Query = "SELECT COUNT(DISTINCT DATE) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date'";
$result = mysql_query($Query);
$temp = mysql_fetch_array($result);
$total_days_of_activity = $temp[0];
$_SESSION['total_days_of_activity'] = $total_days_of_activity;
//echo "Total days of activity ".(int)$total_days_of_activity;
//============================================================
//Total no of customers
$Query = "SELECT COUNT(DISTINCT SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$total_no_of_customers = $temp[0];
$_SESSION['total_no_of_customers'] = $total_no_of_customers;
//echo "Total no of customers ".(int)$total_no_of_customers;
//============================================================
// Avg no of customers per day
$avg_no_of_customers_per_day = round((int)$total_no_of_customers / (int)$total_days_of_activity,2);
$_SESSION['avg_no_of_customers_per_day'] = $avg_no_of_customers_per_day;
//echo "<br>";
//echo "Avg no of customers per day ".$avg_no_of_customers_per_day;
//============================================================
//Total Productive Customers
$Query = "SELECT COUNT(DISTINCT SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND BILL_1 <> \" \" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$total_productive_customers = $temp[0];
$_SESSION['total_productive_customers'] = $total_productive_customers;
//============================================================
//Total Non-Productive Customers
$Query = "SELECT COUNT(DISTINCT SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND BILL_1 = \" \" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$total_non_productive_customers = $temp[0];
$_SESSION['total_non_productive_customers'] = $total_non_productive_customers;
//===============================================================
//Date with highest customers and count of customers on that day
$Query = "SELECT DATE,COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' GROUP BY DATE ORDER BY COUNT(SL_NO) DESC";
$result = mysql_query($Query);
//echo "<br>";
$count =0;
$highest_date = "";
while($temp = mysql_fetch_array($result)) {
    if($count <= $temp[1]) {
        if($count != 0 ){
            $highest_date .= " , ";
        }
//        echo $temp['DATE']." -> ".$temp[1]."<br />" ;
        $highest_date.= GetTimeStamp($temp['DATE']);
        $count = $temp[1];
    }
}
//echo "<br />". $highest_date;
$_SESSION['date_with_highest_customer'] = $highest_date;
$_SESSION['no_of_customers_on_that_day'] = $count;
//================================================================
// [RFC] Total no of requisitions.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" ";
$result = mysql_query($Query);
//echo "<br>=============================================<br>";
$temp = mysql_fetch_array($result);
$total_no_of_RFC = $temp[0];
$_SESSION['total_no_of_RFC'] =$total_no_of_RFC;
//echo "Total no of RFC ".(int)$total_no_of_RFC;
//================================================================
//[RFC] Total no of customer visited.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" AND SOFTWARE_ID <> 'Cancelled'";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$total_no_of_RFC_visited = $temp[0];
$_SESSION['total_no_of_RFC_visited'] = $total_no_of_RFC_visited;
//echo "Total no of RFC Visited ".(int)$total_no_of_RFC_visited;
//================================================================
//[RFC] Total no of customers have PR.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" AND PR_NO <> \" \"";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$total_no_of_RFC_with_PR = $temp[0];
$_SESSION['total_no_of_RFC_with_PR'] = $total_no_of_RFC_with_PR;
//echo "Total no of RFC have PR ".(int)$total_no_of_RFC_with_PR;
//================================================================
//[RFC] No of customers purchased.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" AND BILL_1 <> \" \" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_RFC_customer_purchased = $temp[0];
$_SESSION['no_of_RFC_customer_purchased'] = $no_of_RFC_customer_purchased;
//echo "No of RFC customer purchased ".(int)$no_of_RFC_customer_purchased;
//================================================================
//[RFC] Non - Productive customers
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" AND BILL_1 = \" \" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$non_productive_RFC_customers = $temp[0];
$_SESSION['non_productive_RFC_customers'] = $non_productive_RFC_customers;
//================================================================
//[RFC] No of customers returned due to Queue.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" AND SOFTWARE_ID = 'Cancelled' ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_RFC_customers_returned_due_to_queue = $temp[0];
$_SESSION['no_of_customers_returned_due_to_queue'] = $no_of_RFC_customers_returned_due_to_queue;
//echo "No of RFC customer returned due to Queue ".(int)$no_of_RFC_customers_returned_due_to_queue;
//================================================================
//[RFC] No of emails send
$Query = "SELECT COUNT(email_requests.SL_NO) FROM customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_RFC_email_send = $temp[0];
$_SESSION['no_of_RFC_email_send'] = $no_of_RFC_email_send;
//echo "No of RFC emails send ".(int)$no_of_RFC_email_send;
//================================================================
//[RFC] No.of email customers
$Query = "SELECT COUNT(DISTINCT email_requests.SL_NO) FROM customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_RFC_email_customers = $temp[0];
$_SESSION['no_of_RFC_email_customers'] = $no_of_RFC_email_customers;
//echo "No of RFC emails customers ".(int)$no_of_RFC_email_customers;
//================================================================
//[RFC] Productive email customers
//
$Query = "SELECT COUNT(DISTINCT email_requests.SL_NO) FROM customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"RFC\" AND BILL_1 <>\" \" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_RFC_productive_email_customers = $temp[0];
$_SESSION['no_of_RFC_productive_email_customers'] = $no_of_RFC_productive_email_customers;
//echo "No of RFC productive emails customers ".(int)$no_of_RFC_productive_email_customers;
//================================================================
// [POB] Total no of requisitions.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"POB\" ";
$result = mysql_query($Query);
//echo "<br>=============================================<br>";
$temp = mysql_fetch_array($result);
$total_no_of_POB = $temp[0];
$_SESSION['total_no_of_POB'] = $total_no_of_POB;
//echo "Total no of POB ".(int)$total_no_of_POB;
//================================================================
//[POB] Total no of customer visited.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"POB\" AND SOFTWARE_ID <> 'Cancelled'";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$total_no_of_POB_visited = $temp[0];
$_SESSION['total_no_of_POB_visited'] = $total_no_of_POB_visited;
//echo "Total no of POB Visited ".(int)$total_no_of_POB_visited;
//================================================================
//[POB] Total no of customers have PR.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"POB\" AND PR_NO <> \" \"";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$total_no_of_POB_with_PR = $temp[0];
$_SESSION['total_no_of_POB_with_PR'] = $total_no_of_POB_with_PR;
//echo "Total no of RFC have PR ".(int)$total_no_of_POB_with_PR;
//================================================================
//[POB] No of customers purchased.
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"POB\" AND BILL_1 <> \" \" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_POB_customer_purchased = $temp[0];
$_SESSION['no_of_POB_customer_purchased'] = $no_of_POB_customer_purchased;
//echo "No of POB customer purchased ".(int)$no_of_POB_customer_purchased;
//==================================================================
//[POB] NON productive customers
$non_productive_POB = (int)$total_no_of_POB_visited - (int)$no_of_POB_customer_purchased;
$_SESSION['non_productive_POB'] = $non_productive_POB;
//echo "<br>";
//echo "No of POB non productive customers ".$non_productive_POB;
//================================================================
//[POB] No of emails send
$Query = "SELECT COUNT(email_requests.SL_NO) FROM customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"POB\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_POB_email_send = $temp[0];
$_SESSION['no_of_POB_email_send'] = $no_of_POB_email_send;
//echo "No of POB emails send ".(int)$no_of_POB_email_send;
//================================================================
//[POB] No.of email customers
//
$Query = "SELECT COUNT(DISTINCT email_requests.SL_NO) FROM customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"POB\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_POB_email_customers = $temp[0];
$_SESSION['no_of_POB_email_customers'] = $no_of_POB_email_customers;
//echo "No of POB emails customers ".(int)$no_of_POB_email_customers;
//================================================================
//[POB] Productive email customers
//
$Query = "SELECT COUNT(DISTINCT email_requests.SL_NO) FROM customer_details INNER JOIN email_requests ON customer_details.SL_NO = email_requests.SL_NO WHERE DATE BETWEEN '$start_date' AND '$end_date' AND RFC_POB =\"POB\" AND BILL_1 <>\" \" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$no_of_POB_productive_email_customers = $temp[0];
$_SESSION['no_of_POB_productive_email_customers'] = $no_of_POB_productive_email_customers;
//echo "No of POB productive emails customers ".(int)$no_of_POB_productive_email_customers;
//================================================================
// SOFTWARE Analysis.
// Asian (015)
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND SOFTWARE_ID =\"015\" ";
$result = mysql_query($Query);
//echo "<br>=============================================<br>";
$temp = mysql_fetch_array($result);
$Asian = $temp[0];
$_SESSION['Asian'] = $Asian;
//echo "Asian(015) ".(int)$Asian;
// ICI (043)
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND SOFTWARE_ID = \"043\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$ICI = $temp[0];
$_SESSION['ICI'] = $ICI;
//echo "ICI(043) ".(int)$ICI;
// Nippon (047)
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND SOFTWARE_ID = \"047\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$Nippon = $temp[0];
$_SESSION['Nippon'] = $Nippon;
//echo "Nippon(047) ".(int)$Nippon;
// HBC (123)
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND SOFTWARE_ID = \"123\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$HBC = $temp[0];
$_SESSION['HBC'] = $HBC;
//echo "HBC(123) ".(int)$HBC;
// JOTUN (044)
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND SOFTWARE_ID = \"044\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$JOTUN = $temp[0];
$_SESSION['JOTUN'] = $JOTUN;
//echo "JOTUN(044) ".(int)$JOTUN;
// Multi company
$Query = "SELECT COUNT(SL_NO) FROM customer_details WHERE DATE BETWEEN '$start_date' AND '$end_date' AND SOFTWARE_ID LIKE \"%,%\" ";
$result = mysql_query($Query);
//echo "<br>";
$temp = mysql_fetch_array($result);
$Multi_company = $temp[0];
$_SESSION['Multi_company'] = $Multi_company;
//echo "Multi Company ".(int)$Multi_company;
// Total software use
$total_software_use = (int)$Asian + (int)$ICI + (int)$Nippon + (int)$HBC + (int)$JOTUN + (int)$Multi_company;
//$_SESSION['total_software_use'] = $total_software_use;
//echo "<br>=============================================<br>";
//echo "Total Software Usage ".$total_software_use;
//Software usage in %
//Asian
$Asian_percentage = ($Asian / $total_software_use)*100;
$_SESSION['Asian_percentage'] = round($Asian_percentage,2);
//echo "<br>=============================================<br>Asian % :- ".$Asian_percentage;
//ICI
$ICI_percentage = ($ICI / $total_software_use)*100;
$_SESSION['ICI_percentage'] = round($ICI_percentage,2);
//echo "<br>ICI % :- ".$ICI_percentage;
//NIPPON
$Nippon_percentage = ($Nippon / $total_software_use)*100;
$_SESSION['Nippon_percentage'] = round($Nippon_percentage,2);
//echo "<br>NIPPON % :- ".$Nippon_percentage;
//HBC
$HBC_percentage = ($HBC / $total_software_use)*100;
$_SESSION['HBC_percentage'] = round($HBC_percentage,2);
//echo "<br>HBC % :- ".$HBC_percentage;
//JOTUN
$JOTUN_percentage = ($JOTUN / $total_software_use)*100;
$_SESSION['JOTUN_percentage'] = round($JOTUN_percentage,2);
//echo "<br>JOTUN % :- ".$JOTUN_percentage;
//Multi company
$Multi_company_percentage = ($Multi_company / $total_software_use)*100;
$_SESSION['Multi_company_percentage'] = round($Multi_company_percentage,2);
//echo "<br>Multi company % :- ".$Multi_company_percentage;
header("Location:../view/analysis_view.php");
?>