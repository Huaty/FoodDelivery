<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

</head>

<body>
        <!-- NAV Component -->
        <header class= "header">
            <div class = "Logo">
                <h2 class= "header-word">JavaJam Coffee House</h2>
            </div>
        </header>

        <!-- END NAV Component -->
        <!-- Start Main Content -->
        <div class="main">
            <!-- Start Left Content -->
            <div class="left-content">
                <ul>
                    <li id= "left_content_bullet"><a href= "index.php">Home</a></li>
                    <li id= "left_content_bullet"><a href= "menu.php">Menu</a></li>
                    <li id= "left_content_bullet"><a href="music.php">Music</a></li>
                    <li id= "left_content_bullet"><a href="jobs.php">Jobs</a></li>
                </ul>
            </div>
            <!-- End Left Content -->

            <!-- Start Right Content -->
            <div class="right-content">
                <h2><p class ="right_header">Coffee at JavaJam</p></h2>

                <!-- Table Menu -->
                <div class = "tableMenu"> 
                    <table class ="menu-table">
                        <tbody>
                            <tr id= "table-header">
                                <th >Just Java</th>
                                <td >Regular house blend, decaffeinated coffee,or flavor of the day.<br><span>Endless Cup $2.00</span></td>  
                            </tr>
                            <tr id = "table-body">
                                <th>
                                    Cafe au Lait
                                </th>
                                <td>
                                    House Blended Coffee infused into a smooth,steamedmilk.<br><span>
                                    Single $2.00 Double $3.00
                                    </span> 
                                </td>
                            </tr>
                            <tr id = "table-footer">
                                <th >
                                    Iced<br> Cappuccino
                                </th>
                                <td>
                                    Sweetened espresso blended with icy-cold milk and served in a chilled glass.<br><span>
                                    Single $4.75 Double $5.75
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Table Menu -->

            </div>
        </div>
        <!-- End Main Content -->

        <footer class="footer">
            <div>Copyright &copy 2014 JavaJam Coffee House</div>
            <a href="mailto:chua@wenhuat.com">chua@wenhuat.com</a>
        </footer>

</body>
</html>