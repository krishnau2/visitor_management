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
        <script type="text/javascript" src='../js/jquery.tablesorter.js'> </script>
        <LINK REL=StyleSheet HREF="../css/style.css" TYPE="text/css">
        <LINK REL=StyleSheet HREF="../css/tablesorter/style.css" TYPE="text/css">
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
            </p><br>
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