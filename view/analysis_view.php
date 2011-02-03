<?php session_start(); ?>
<html>
    <head>
        <script type="text/javascript" src='../js/jquery-1.4.2.min.js'> </script>
        <script type="text/javascript" src='../js/jquery-ui-1.8rc3.custom.min.js'> </script>
        <script type="text/javascript" src='../js/jquery.tablesorter.js'> </script>
        <script type="text/javascript" src="../js/email_and_date_wise_list.js"></script>
        <LINK REL=StyleSheet HREF="../css/style.css" TYPE="text/css">
        <LINK REL=StyleSheet HREF="../css/tablesorter/style.css" TYPE="text/css">
        <LINK REL=StyleSheet HREF="../js/dark-hive/jquery-ui-1.8rc3.custom.css" TYPE="text/css">
        <title>Colour Cafe Customer List</title>
        <script>
            $(document).ready(function(){
                $('#start_date').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
                $('#end_date').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
                $('#get_analysis').click(function(e){
                    var start_date = $('#start_date').val();
                    var end_date = $('#end_date').val();
                    if(start_date == "" || end_date == ""){
                        e.preventDefault();
                        alert("Please Select The Dates");
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="wrap">
            <center>
                <img src="../img/Logo.jpg" alt="Logo" width="500" height="60" />
            </center>
            <!--      <h1>SPH Colour Cafe Customer Management</h1> -->
            <p class="text">
                <a href="../index.php">
                    <img src="../img/home-icon.gif" alt="home page" border="0" width="35" height="25">
                    Home</a>
                <a href="./edit_customer_details.php">
                    <img src="../img/user-icon.png" alt="home page" border="0" height="28">
                    New</a>
                <a href="./nameSearchView.php">
                    <img src="../img/Search-icon.png" alt="Search page" border="0" height="28">
                    Search</a>
            </p>
            <div class="option_panel">
                <form action="../model/analysis_model.php" method="post" name="customer_list_form">
                    <div class="controls">
                        <label> Start Date : </label>
                        <input type="text" name="start_date" id="start_date" size="15" />
                    </div>
                    <div class="controls">
                        <label> End Date : </label>
                        <input type="text" name="end_date" id="end_date" size="15" />
                    </div>
                    <div class="controls">
                        <input type="submit" name="get_analysis" id="get_analysis" value="Get Analysis"/>
                    </div>
                </form>
            </div>
            <div class="analysis">
                <table class="report">
                    <thead>
                        <tr style="text-align: center;">
                            <th colspan="2" style="font-size: 15px;"><?php echo "Analysis from ".$_SESSION['start_date']." to ".$_SESSION['end_date']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center;">
                            <th colspan="2">Summary</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td width="250">Total Days of Activity</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_days_of_activity'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Total No: of Customers</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_no_of_customers'] ?></td>
                        </tr>
                        <tr>
                            <td>Average No: of Customers per day</td>
                            <td class="analysis_value"><?php echo $_SESSION['avg_no_of_customers_per_day'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Total Productive Customers</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_productive_customers'] ?></td>
                        </tr>
                        <tr>
                            <td>Total Non-Productive Customers</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_non_productive_customers'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Date with the Highest Customers</td>
                            <td class="analysis_value"><?php echo $_SESSION['date_with_highest_customer'] ?></td>
                        </tr>
                        <tr>
                            <td>Count of customers on that Date</td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_customers_on_that_day'] ?></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th colspan="2">RFC (Request for Colour Browsing)</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Total No: of Requistions</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_no_of_RFC'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Total No:of Customer visited</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_no_of_RFC_visited'] ?></td>
                        </tr>
                        <tr>
                            <td>Customer returned due to queue</td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_customers_returned_due_to_queue'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>No: of Customers have PR#</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_no_of_RFC_with_PR'] ?></td>
                        </tr>
                        <tr>
                            <td>NO: of Customers Purchased </td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_RFC_customer_purchased'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Non-Productive Customers </td>
                            <td class="analysis_value"><?php echo $_SESSION['non_productive_RFC_customers'] ?></td>
                        </tr>
                        <tr>
                            <td>No: of Emails send</td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_RFC_email_send'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>No: of Email Customers </td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_RFC_email_customers'] ?></td>
                        </tr>
                        <tr>
                            <td>Productive Email Customers </td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_RFC_productive_email_customers'] ?></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th colspan="2">POB (Preview of Building)</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Total No: of Requistions</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_no_of_POB'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Total No:of Customer visited</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_no_of_POB_visited'] ?></td>
                        </tr>
                        <tr>
                            <td>No: of Customers have PR#</td>
                            <td class="analysis_value"><?php echo $_SESSION['total_no_of_POB_with_PR'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>NO: of Customers Purchased </td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_POB_customer_purchased'] ?></td>
                        </tr>
                        <tr>
                            <td>Non Productive Customers</td>
                            <td class="analysis_value"><?php echo $_SESSION['non_productive_POB'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>No: of Emails send</td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_POB_email_send'] ?></td>
                        </tr>
                        <tr>
                            <td>No: of Email Customers </td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_POB_email_customers'] ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Productive Email Customers </td>
                            <td class="analysis_value"><?php echo $_SESSION['no_of_POB_productive_email_customers'] ?></td>
                        </tr>
                        <tr>
                            <th>Software opted</th>
                            <th> Nos (percentage)</th>
                        </tr>
                        <tr>
                            <td>Asian (015)</td>
                            <td class="analysis_value"><?php echo $_SESSION['Asian']." nos ( ".$_SESSION['Asian_percentage']." )"; ?> </td>
                        </tr>
                        <tr class="odd">
                            <td>ICI (043)</td>
                            <td class="analysis_value"><?php echo $_SESSION['ICI']." nos ( ".$_SESSION['ICI_percentage']." )" ?></td>
                        </tr>
                        <tr>
                            <td>Nippon (047)</td>
                            <td class="analysis_value"><?php echo $_SESSION['Nippon']." nos ( ".$_SESSION['Nippon_percentage']." )" ?></td>
                        </tr>
                        <tr class="odd">
                            <td>HBC (123)</td>
                            <td class="analysis_value"><?php echo $_SESSION['HBC']." nos ( ".$_SESSION['HBC_percentage']." )" ?></td>
                        </tr>
                        <tr>
                            <td>Jotun (044)</td>
                            <td class="analysis_value"><?php echo $_SESSION['JOTUN']." nos ( ".$_SESSION['JOTUN_percentage']." )" ?></td>
                        </tr>
                        <tr class="odd">
                            <td>Multi Company</td>
                            <td class="analysis_value"><?php echo $_SESSION['Multi_company']." nos ( ".$_SESSION['Multi_company_percentage']." )" ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>