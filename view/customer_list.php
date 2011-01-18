<?php include '../lib/class_connection.php'; ?>
<?php
// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$listOfCustomers=new databaseConnectionClass();
//Accessing the database connection function
$listOfCustomers ->dbconnector($database, $connect);
?>
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

        <script type="text/javascript">
            $(document).ready(function() {
                $("table.tablesorter").tablesorter();
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
                <form action="../model/email_and_date_wise_list_model.php" method="post" name="customer_list_form">
                    <div class="controls">
                        <label> email List only :  </label>
                        <input type="checkbox" name="email_list_only" id="email_list_only" />
                    </div>
                    <div class="controls">
                        <label>Date wise List :  </label>
                        <input type="text" name="search_date" id="search_date" size="10" />
                        <input type="submit" name="day_wise_customer_list_submit" id="day_wise_customer_list_submit" value="List it"/>
                    </div>
                </form>
            </div>
            <table class="tablesorter" style="border: 1px solid silver;">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>No.</th>
                        <th>RFC/POB</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Land line</th>
                        <th>Address</th>
                        <th>SW Id</th>
                        <th>I Bill</th>
                        <th>I Bill Date</th>
                        <th>I Bill Value</th>
                        <th>PR CODE</th>
                        <th>II Bill</th>
                        <th>III Bill</th>
                        <th>IV Bill</th>
                        <th>V Bill</th>
                        <th width="30">EDIT</th>
                        <td width="10"></td>
                    </tr>
                </thead>
                <tbody class="list_view" >
                    <?php
                    $listQuery = "SELECT * FROM customer_details ORDER BY SL_NO ";
                    $result = mysql_query($listQuery);
                    $noOfResults = mysql_num_rows($result);

                    if($noOfResults) {
                        while ($row = mysql_fetch_assoc($result)) {
                            ?>
                    <tr>
                                <?php $date = GetTimeStamp($row['DATE']); ?>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $row['SL_NO']; ?></td>
                        <td><?php echo $row['RFC_POB']; ?></td>
                        <td><?php echo $row['NAME']; ?> </td>
                        <td><?php echo $row['MOBILE']; ?> </td>
                        <td><?php echo $row['LANDLINE']; ?> </td>
                        <td><?php echo $row['ADDRESS']; ?> </td>
                        <td><?php echo $row['SOFTWARE_ID']; ?> </td>
                        <td><?php echo $row['BILL_1']; ?></td>
                                <?php $bill_date = GetTimeStamp($row['BILL_1_DATE']);?>
                        <td><?php echo $bill_date; ?></td>
                        <td><?php echo $row['BILL_1_VAL']; ?></td>
                        <td><?php echo $row['PR_NO']; ?> </td>
                        <td><?php echo $row['BILL_2']; ?> </td>
                        <td><?php echo $row['BILL_3']; ?> </td>
                        <td><?php echo $row['BILL_4']; ?> </td>
                        <td><?php echo $row['BILL_5']; ?> </td>

                        <td><form action="./edit_customer_details.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                <input type="submit" style="width: 40px; " value="Edit" name="edit" id="edit" />
                            </form>
                        </td>
                                <?PHP  }
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
            <!-- email section -->
            <div id="email_list_lightbox_panel">
                <div class="pop-up_caption">
                    E-mail Requests
                </div>
                <div class="close_button">
                    <a id="close-panel" style="text-decoration: none;" href="#">close [X]</a>
                </div>
                <div id="loading"></div>
                <table class="report" id="email_customer_list_table" style="border: 1px solid silver;">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>email Date</th>
                            <th>No.</th>
                            <th>RFC/POB</th>
                            <th>Name</th>
                            <th>SW Id</th>
                            <th>No email images</th>
                            <th>No selected images</th>
                            <th width="30">EDIT</th>
                            <td width="10"></td>
                        </tr>
                    </thead>
                    <tbody class="list_view" >
                        <tr id="email_customer_list_row" class="email_customer_list_row" style="display: none;" ></tr>
                    </tbody>
                </table>
            </div><!-- /panel -->
            <div id="lightbox"></div><!-- /lightbox -->
            <!-- End of email section -->

            <!-- Day wise list section -->
            <div id="day_wise_list_lightbox_panel">
                <div class="pop-up_caption">
                    <!-- Day wise list for :- --><!-- commented because it is handled by javascript-->
                </div>
                <div class="close_button">
                    <a id="close-panel" style="text-decoration: none;" href="#">close [X]</a>
                </div>
                <div id="loading"></div>
                <table class="report" id="day_wise_customer_list_table" style="border: 1px solid silver;">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>No.</th>
                            <th>RFC/POB</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>SW Id</th>
                            <th>No selected images</th>
                            <th>Email</th>
                            <th width="30">EDIT</th>
                            <td width="10"></td>
                        </tr>
                    </thead>
                    <tbody class="list_view" >
                        <tr id="day_wise_customer_list_row" class="day_wise_customer_list_row" style="display: none;" ></tr>
                    </tbody>
                </table>
            </div><!-- /panel -->
            <!-- The following <div> lightbox is commented because it is already included in the email section
            and it is enough for this section also. If multiple declaration is done then transparacy get reduced. -->
            <!--     <div id="lightbox"></div><!-- /lightbox -->
            <!-- End of day wise list section -->
        </div>
    </body>
</html>

<?php
function GetTimeStamp($MySqlDate) {
    /*
                Take a date in yyyy-mm-dd format and return it to the user
                in a PHP timestamp
    */
    $date_array = explode("-",$MySqlDate); // split the array

//   year = $date_array[0];
//   month = $date_array[1];
//   day = $date_array[2];

    $new_date = $date_array[2]."-".$date_array[1]."-".$date_array[0];

    return($new_date); // return it to the user
}
?>