<html>
    <head>
        <title>Colour Cafe Customer Management</title>
        <script type="text/javascript" src='./js/jquery-1.4.2.min.js'> </script>
        <script type="text/javascript" src='./js/menu.js'> </script>
        <script type="text/javascript" src="./js/colourcafe_script.js"></script>
        <LINK REL=StyleSheet HREF="./css/style.css" TYPE="text/css">
  <!--      <style type="text/css">
            #lightbox{
                display:none;
                background:#000000;
                opacity:0.7;
                filter:alpha(opacity=90);
                position:absolute;
                top:0px;
                left:0px;
                min-width:100%;
                min-height:100%;
                z-index:1000;
            }
            #lightbox-panel{
                display:none;
                position:fixed;
                top:100px;
                left:50%;
                margin-left:-200px;
                width:400px;
                background:#FFFFFF;
                padding:10px 15px 10px 15px;
                border:2px solid #CCCCCC;
                z-index:1001;
            }
            #about{
                width: 200px;
                height: 20px;
                position: relative;
                left: 830px;
            }
            #about a{
                color: #434343;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function(){
//                $("a#show-panel").click(function(){
//                    $("#lightbox, #lightbox-panel").fadeIn(300);
//                });
//                $("a#close-panel").click(function(){
//                    $("#lightbox, #lightbox-panel").fadeOut(300);
//                });

//                var isCtrl = false;
//                var isAlt = false;
//                var isShift = false;
//                $(document).keyup(function (e) {
//                    if(e.which == 17) isCtrl=false;
//                }).keydown(function (e) {
//                    if(e.which == 16) isShift=true;
//                    if(e.which == 17) isCtrl=true;
//                    if(e.which == 18) isAlt=true;
//                    if(e.which == 75 && isCtrl == true && isAlt == true && isShift == true) {
//                        alert('-KK-');
//
//                        isCtrl = false;
//                        isAlt = false;
//                        isShift = false;
//                        return false;
//                    }
//                });

            });
        </script>
        -->
    </head>
    <title>
        Colour Cafe Customer Management
    </title>
    <body>
        <div id="wrap">
            <center>
                <img src="./img/Logo.jpg" alt="Logo" width="500" height="60" />
            </center>
            <!--      <h1>SPH Colour Cafe Customer Management</h1> --> 
            <p class="text">Customer Management</p>
            <div id="navigation">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="./view/edit_customer_details.php">New Customer</a></li>
                    <li><a href="./view/customer_list.php">Customer List</a></li>
                    <li><a href="./view/nameSearchView.php">Customer Search</a></li>
                    <li><a href="./view/categorySearchView.php">Category Search</a></li>
                    <li><a href="#">Email Requests</a></li>
                    <li><a href="#">Analysis</a> </li>
                </ul>
            </div>
            <div id="about">
                <a id="show-panel" style="text-decoration: none;" href="#">&copy; Datamen Consultants Pvt Ltd.</a>
            </div>
            <div id="lightbox-panel">
                <center>
                    <h2>Colour Cafe Customer Management V 1.0</h2>
                    <p>Developed and Maintained by</p>
                    <h2>Datamen Consultants Pvt Ltd.</h2>
                </center>
                <div class="close_button">
                    <a id="close-panel" style="text-decoration: none;" href="#">close [X]</a>
                </div>
            </div><!-- /panel -->

            <div id="lightbox"></div><!-- /lightbox -->

        </div>
    </body>
</html>