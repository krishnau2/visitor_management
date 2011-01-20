<?php include '../lib/class_connection.php'; ?>
<?php
// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$edit_customers=new databaseConnectionClass();
//Accessing the database connection function
$edit_customers ->dbconnector($database, $connect);
?>

<?php
$msg=$_GET['msg'];
if($msg=='1') {
    $message = "New Customer Details have been saved successfully .";
    $css_class = "form_success_message";
}
else if($msg=='2') {
    $message="Error in saving data .";
    $css_class = "form_failure_message";
}
else if($msg=='3') {
    $message="Customer Details have been updated successfully .";
    $css_class = "form_success_message";
}
else if($msg=='4') {
    $message="Please Fill All mandatory Feilds .";
    $css_class = "form_failure_message";
}

?>

<?php
$id=0;
$date = "";
$no = "";
$rfc_pob="";
$name="";
$mobile ="";
$land_line="";
$email ="";
$address ="";
$software ="";
$pr ="";
$bill_1 ="";
$bill_1_val ="";
$bill_1_date ="";
$bill_2 ="";
$bill_3 ="";
$bill_4 ="";
$bill_5 ="";
$comments ="";
$bed_room = "";
$living_room = "";
$kitchen = "";
$wall_fashion = "";
$single_storey = "";
$double_storey = "";
$single_storey_RT = "";
$double_storey_RT = "";
if(isset ($_POST["edit"])) {
    $id=$_POST["id"];
    $editQuery = "SELECT * FROM customer_details WHERE id=$id";
    $result = mysql_query($editQuery);

    while ($row = mysql_fetch_array($result)) {
        $date = $row['DATE'];
        $no = $row['SL_NO'];
        $rfc_pob=$row['RFC_POB'];
        $name=$row['NAME'];
        $mobile = $row['MOBILE'];
        $land_line=$row['LANDLINE'];
        $email = $row['EMAIL'];
        $address = $row['ADDRESS'];
        $software = $row['SOFTWARE_ID'];
        $pr = $row['PR_NO'];
        $bill_1 =$row['BILL_1'];
        $bill_1_val = $row['BILL_1_VAL'];
        $bill_1_date = $row['BILL_1_DATE'];
        $bill_2 = $row['BILL_2'];
        $bill_3 = $row['BILL_3'];
        $bill_4 = $row['BILL_4'];
        $bill_5 = $row['BILL_5'];
        $comments = $row['COMMENTS'];
        $bed_room = $row['bed_room'];
        $living_room = $row['living_room'];
        $kitchen = $row['kitchen'];
        $wall_fashion = $row['wall_fashion'];
        $single_storey = $row['single_storey'];
        $double_storey = $row['double_storey'];
        $single_storey_RT = $row['single_storey_with_roof_tiles'];
        $double_storey_RT = $row['double_storey_with_roof_tiles'];
    }
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Colour Cafe Customer Management</title>
        <script type="text/javascript" src='../js/jquery-1.4.2.min.js'> </script>
        <script type="text/javascript" src='../js/jquery-ui-1.8rc3.custom.min.js'> </script>
        <script type="text/javascript" src='../js/new_customer_validation.js'> </script>
        <LINK REL=StyleSheet HREF="../js/dark-hive/jquery-ui-1.8rc3.custom.css" TYPE="text/css">
        <LINK REL=StyleSheet HREF="../css/style.css" TYPE="text/css">

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
                <a href="./customer_list.php">
                    <img src="../img/user-icon.png" alt="List page" border="0" height="28">
                    List</a>
                <a href="./nameSearchView.php">
                    <img src="../img/Search-icon.png" alt="Search page" border="0" height="28">
                    Search</a>
            </p><br>
            <div class="form_container">
                <div class="form_messages">
                    <p class="<?php echo $css_class; ?>" >
                        <?php echo $message; ?>
                    </p>
                </div>
                <form action="../model/save_customer_details.php" method="post" name="edit_customer">
                    <table>
                        <tbody>
                            <tr>
                                <td width="300">Date <span class="star_indication">*</span></td>
                                <td >
                                    <input type="text" name="date" id="date" size="10" value="<?php echo $date ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Request No <span class="star_indication">*</span></td>
                                <td><input type="text" name="no" id="no" size="5" value="<?php echo $no ?>"/></td>
                            </tr>
                            <tr>
                                <td>RFC/POB <span class="star_indication">*</span></td>
                                <td><select name=category id="category">
                                        <option value='RFC' <?php if($rfc_pob == "RFC") echo "selected" ?> >RFC</option>
                                        <option value='POB' <?php if($rfc_pob == "POB") echo "selected" ?> >POB</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Name <span class="star_indication">*</span> </td>
                                <td><input type="text" name="customer_name" id="customer_name" value="<?php echo $name ?>"/> </td>
                            </tr>
                            <tr>
                                <td>Address <span class="star_indication">*</span></td>
                                <td><textarea name="address" id="address" rows="3" cols="25"><?php echo $address ?></textarea> </td>
                            </tr>
                            <tr>
                                <td>Land Line </td>
                                <td><input type="text" name="land_line" id="land_line" value="<?php echo $land_line ?>"/> </td>
                            </tr>
                            <tr>
                                <td>Mobile </td>
                                <td><input type="text" name="mobile" id="mobile" value="<?php echo $mobile ?>" /> </td>
                            </tr>
                            <tr>
                                <td>e-mail </td>
                                <td><input type="text" name="email" id="email" value="<?php echo $email ?>" /> </td>
                            </tr>
                            <tr>
                                <td>Software</td>
                                <td><input type="text" name="software" id="software" value="<?php echo $software ?>"/></td>
                            </tr>
                            <tr>
                                <td>I Bill </td>
                                <td><input type="text" name="first_bill" id="first_bill" size="10" value="<?php echo $bill_1 ?>" /> </td>
                            </tr>
                            <tr>
                                <td>I Bill Date </td>
                                <td><input type="text" name="first_bill_date" id="first_bill_date" size="10" value="<?php echo $bill_1_date?>"/> </td>
                            </tr>
                            <tr>
                                <td>I Bill Value </td>
                                <td><input type="text" name="first_bill_value" id="first_bill_value" size="10" value="<?php echo $bill_1_val ?>"/> </td>
                            </tr>
                            <tr>
                                <td>PR No. </td>
                                <td><input type="text" name="pr_no" id="pr_no" size="10" value="<?php echo $pr ?>"/> </td>
                            </tr>
                            <tr>
                                <td>II Bill </td>
                                <td><input type="text" name="second_bill" id="second_bill" size="10" value="<?php echo $bill_2 ?>"/> </td>
                            </tr>
                            <tr>
                                <td>III Bill</td>
                                <td><input type="text" name="third_bill" id="third_bill" size="10" value="<?php echo $bill_3 ?>"/> </td>
                            </tr>
                            <tr>
                                <td>IV Bill </td>
                                <td><input type="text" name="forth_bill" id="forth_bill" size="10" value="<?php echo $bill_4 ?>"/> </td>
                            </tr>
                            <tr>
                                <td>V Bill</td>
                                <td><input type="text" name="fifth_bill" id="fifth_bill" size="10" value="<?php echo $bill_5 ?>"/> </td>
                            </tr>
                            <tr>
                                <td>Comments</td>
                                <td><textarea name="comments" id="comments" rows="4" cols="25"><?php echo $comments ?></textarea> </td>
                            </tr>
                            <tr>
                                <td>Bed Room</td>
                                <td><input type="checkbox" name="bed_room" id="bed_room"  <?php if($bed_room) {
                                        echo "checked";
                                           } ?> /></td>
                            </tr>
                            <tr>
                                <td>Living Room</td>
                                <td><input type="checkbox" name="living_room" id="living_room" <?php if($living_room) {
                                        echo "checked";
                                           } ?> /></td>
                            </tr>
                            <tr>
                                <td>Kitchen</td>
                                <td><input type="checkbox" name="kitchen" id="kitchen"  <?php if($kitchen) {
                                        echo "checked";
                                           } ?>/></td>
                            </tr>
                            <tr>
                                <td>Wall Fashions</td>
                                <td><input type="checkbox" name="wall_fashion" id="wall_fashion"  <?php if($wall_fashion) {
                                        echo "checked";
                                           } ?>/></td>
                            </tr>
                            <tr>
                                <td>Single Storey</td>
                                <td><input type="checkbox" name="single_storey" id="single_storey"  <?php if($single_storey) {
                                        echo "checked";
                                           } ?>/></td>
                            </tr>
                            <tr>
                                <td>Double Storey</td>
                                <td><input type="checkbox" name="double_storey" id="double_storey"  <?php if($double_storey) {
                                        echo "checked";
                                           } ?>/></td>
                            </tr>
                            <tr>
                                <td>Single Storey with Roof Tiles</td>
                                <td><input type="checkbox" name="single_storey_RT" id="single_storey_RT"  <?php if($single_storey_RT) {
                                        echo "checked";
                                           } ?>/></td>
                            </tr>
                            <tr>
                                <td>Double Storey with Roof Tiles</td>
                                <td><input type="checkbox" name="double_storey_RT" id="double_storey_RT"  <?php if($double_storey_RT) {
                                        echo "checked";
                                           } ?>/></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="id" id="id" value="<?php echo $id ?>" </td>
                                <td><input style="height: 45px; width: 160px; margin: 20px;" type="submit" name="save_button" id="save_button" value="Save Details" /> </td>
                                <td> For Cancellation <input type="checkbox" id="cancel" name="cancel" />  </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
