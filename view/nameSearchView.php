<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../css/style.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="../js/nameSearch.js"></script>
        <title>
            Colour Cafe Customer Management- Name Search
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
            <form action="nameSearchModel.php" method="post">
                <table>
                    <tr>
                        <td>Name for search :</td>
                        <td>
                            <input type="text" name="searchName" id="searchName" />
                        </td>
                        <td>
                            <input type="submit" name="submitSearch" id="submitSearch" value="Search" style="width: 100px; height: 30px; font-weight: bold;"/>
                            <input type="submit" name="newSearch" id="newSearch" value="New" style="width: 100px; height: 30px; font-weight: bold;"/>
                        </td>
                    </tr>
                </table>
            </form>
            <table id="nameSearchTable" class="report">
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
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="nameSearchRow" class="nameSearchRow" style="display: none"></tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
