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

        <div class="main">
            <div class="left-content">
                <ul>
                    <li id= "left_content_bullet"><a href= "index.php">Home</a></li>
                    <li id= "left_content_bullet"><a href= "menu.php">Menu</a></li>
                    <li id= "left_content_bullet"><a href="music.php">Music</a></li>
                    <li id= "left_content_bullet"><a href="jobs.php">Jobs</a></li>
                </ul>
            </div>


            
            <div class="right-content">
                <h2><p class ="right_header">Jobs at JavaJam</p></h2>
                <p class="right-content-header">Want to work at JavaJam? Fill out the form below to start your application. Required fields <br>are mark with an asterisk *</p>

                <div class = "right-content-materials">
                <form method= "POST" action ="processJob.php" id= "job-form">
                    <div class="form-job">
                        <label for="name">Enter your name:</label>
                        <input type="text" name="name" id="name" required/>
                    </div>
                    <div class="form-job">
                        <label for="email">Enter your Email:</label>
                        <input type="email" name="email" id="email" required/>
                    </div>
                    <div class="form-job">
                        <label for="datepicker">Select a Date:</label>
                        <input type="date" id="datepicker" name="date" >
                    </div>

                    <div class="form-job">
                        <label for="Experience">Experience:</label>
                        <input type="text" id="experience" name="experience" class=" large-input" required>
                    </div>


                </form>
                </div>
                <div id="button">
                    <div class= "button-placement"><button type="reset" class="button" form="job-form">Clear</button><br></div>
                    <div class= "button-placement"><button type="submit" class="button" form="job-form">Apply Now </button></div>
                        
                </div>

            </div>



        </div>

        <footer class="footer">
            <div>Copyright &copy 2014 JavaJam Coffee House</div>
            <a href="mailto:chua@wenhuat.com">chua@wenhuat.com</a>
        </footer>

</body>
</html>