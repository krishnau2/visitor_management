<?php include '../lib/class_connection.php'; ?>
<?php
// Database connection parameters
$connect=1;
$disconnect=0;
$database="colourcafe"; // Database used.

//Database connection object creation
$edit_email_request=new databaseConnectionClass();
//Accessing the database connection function
$edit_email_request ->dbconnector($database, $connect);
?>

<?php
$msg=$_GET['msg'];
if($msg=='1') {
    $message = "New email request have been saved successfully .";
    $css_class = "form_success_message";
}
else if($msg=='2') {
    $message="Error in saving data .";
    $css_class = "form_failure_message";
}
else if($msg=='3') {
    $message="Email request have been updated successfully .";
    $css_class = "form_success_message";
}
else if($msg=='4') {
    $message="Please Fill All mandatory Feilds .";
    $css_class = "form_failure_message";
}

?>

<?php
$id=0;
$no = "";
$software ="";
$no_of_selection_of_images="";
$no_of_email_images ="";
$email_send_date="";


if(isset ($_POST["edit"])) {
    $id=$_POST["id"];
    $editQuery = "SELECT
    email_requests.id,
    email_requests.SL_NO,
    email_requests.SOFTWARE_ID,
    no_of_email_images,
    no_of_selection_of_images,
    email_send_date,
    customer_details.NAME
    FROM email_requests
    INNER JOIN customer_details ON customer_details.SL_NO = email_requests.SL_NO
    WHERE email_requests.id = $id";
    $result = mysql_query($editQuery);

    while ($row = mysql_fetch_array($result)) {
        $no = $row['SL_NO'];
        $software = $row['SOFTWARE_ID'];
        $no_of_email_images = $row['no_of_email_images'];
        $no_of_selection_of_images = $row['no_of_selection_of_images'];
        $email_send_date = $row['email_send_date'];
        $name = $row['NAME'];
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
        <script type="text/javascript" src='../js/new_email_request_validation.js'> </script>
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
                <form action="../model/email_request_model.php" method="post" name="email_request">
                    <table>
                        <tbody>
                            <tr id="show_name">
                                <td width="300">Request No <span class="star_indication">*</span></td>
                                <td><input type="text" name="no" id="no" size="4" value="<?php echo $no ?>"/></td>
                                <?php if($id != 0 ) {  ?>
                                <td class="name_board"><?php echo "NAME :- ".$name; ?></td>
                                    <?php } ?>
                            </tr>
                            <tr>
                                <td>Software <span class="star_indication">*</span></td>
                                <td><input type="text" name="software" id="software" value="<?php echo $software ?>"/></td>
                            </tr>
                            <tr>
                                <td>No of Selection of images <span class="star_indication">*</span></td>
                                <td>
                                    <input type="text" size="4" name="no_of_selection_of_images" id="no_of_selection_of_images" value="<?php echo $no_of_selection_of_images ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>No of email Images </td>
                                <td><input type="text" size="4" name="no_of_email_images" id="no_of_email_images" value="<?php echo $no_of_email_images ?>"/> </td>
                            </tr>
                            <tr>
                                <td>Email send date </td>
                                <td>
                                    <input type="text"  name="email_send_date" id="email_send_date" value="<?php echo $email_send_date ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="id" id="id" value="<?php echo $id ?>" </td>
                                <td><input class="submit_button" type="submit" name="save_button" id="save_button"
                                           value="<?php if($id == 0) echo "Save Details"; else echo "Update Details"; ?>" /> </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
