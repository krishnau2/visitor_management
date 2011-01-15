<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../css/style.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="../js/categorySearch.js"></script>
        <title>
            Colour Cafe Customer Management - Category search
        </title>
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
                    <img src="../img/user-icon.png" alt="home page" border="0" height="28">
                    List</a>
            </p><br>
            <form action="../model/categorySearchModel.php" method="post" name="category">
                <table id="categorySearchTable" class="report">
                    <thead>
                        <tr>
                            <th width="100">Bed Room</th>
                            <th width="100">Living Room</th>
                            <th width="100">Kitchen</th>
                            <th width="100">Wall Fashion</th>
                            <th width="100">Single Storey</th>
                            <th width="100">Double Storey</th>
                            <th>Single Storey With Roof Tiles</th>
                            <th>Double Storey with Roof Tiles</th>
                        </tr>
                    </thead>
                    <tr>
                        <td align="center"><input type="checkbox" name="bed_room" id="bed_room" /></td>
                        <td align="center"><input type="checkbox" name="living_room" id="living_room" /></td>
                        <td align="center"><input type="checkbox" name="kitchen" id="kitchen"  /></td>
                        <td align="center"><input type="checkbox" name="wall_fashion" id="wall_fashion"  /></td>
                        <td align="center"><input type="checkbox" name="single_storey" id="single_storey" /></td>
                        <td align="center"><input type="checkbox" name="double_storey" id="double_storey" /></td>
                        <td align="center"><input type="checkbox" name="single_storey_RT" id="single_storey_RT" /></td>
                        <td align="center"><input type="checkbox" name="double_storey_RT" id="double_storey_RT" /></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center">
                            <input type="submit" name="categorySearch" id="categorySearch" value="Search" style="width: 100px; height: 30px; font-weight: bold;"/>
                            <input type="submit" name="newSearch" id="newSearch" value="New" style="width: 100px; height: 30px; font-weight: bold;"/>
                        </td>
                    </tr>
                </table>
            </form>
            <table id="categorySearchResultTable" class="report">
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
                        <th>Bed Room</th>
                        <th>Living Room</th>
                        <th>Kitchen</th>
                        <th>Wall Fashion</th>
                        <th>Single Storey</th>
                        <th>Double Storey</th>
                        <th>Single Storey with Roof Tiles</th>
                        <th>Double Storey with Roof Tiles</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="categorySearchRow" class="categorySearchRow" style="display: none"></tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
