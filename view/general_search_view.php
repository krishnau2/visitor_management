<html>
    <head>
        <script type="text/javascript" src='./js/jquery-1.4.2.min.js'> </script>
        <script type="text/javascript" src='./js/jquery.tablesorter.js'> </script>
        <script type="text/javascript" src='./js/general_search.js'> </script>
        <LINK REL=StyleSheet HREF="./css/style.css" TYPE="text/css">
        <LINK REL=StyleSheet HREF="./css/tablesorter/style.css" TYPE="text/css">
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
                <img src="./img/Logo.jpg" alt="Logo" width="500" height="60" />
            </center>
            <!--      <h1>SPH Colour Cafe Customer Management</h1> -->
            <p class="text">
                <a href="index.php">
                    <img src="./img/home-icon.gif" alt="home page" border="0" width="35" height="25">
                    Home</a>
                <a href="edit_customer_details.php">
                    <img src="./img/user-icon.png" alt="home page" border="0" height="28">
                    New</a>
                <a href="nameSearchView.php">
                    <img src="./img/Search-icon.png" alt="Search page" border="0" height="28">
                    Search</a>
            </p><br>

            <div class="option_panel">
                <form action="customer_list_model.php" method="post" name="customer_list_form">
                    <label> List all </label>
                    <input type="checkbox" name="list_all" id="list_all" />
                    <label>Select Date</label>
                    <input type="text" name="date" id="date" />
                    <input type="submit" name="customer_list_submit" id="customer_list_submit" value="Submit"/>
                </form>                
            </div>
            <div id ="loading" class="loading"></div>

            <table class="tablesorter" id="customer_list_table" style="border: 1px solid silver;">

                <thead>
                    <tr>
                        <th>Sl</th>
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
                    
                    <tr id="customer_list_row" class="customer_list_row" style="display: none;" ></tr>
                </tbody>
            </table>
        </div>
    </body>
</html>