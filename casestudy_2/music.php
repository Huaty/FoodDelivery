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
                <h2><p class ="right_header">Music at JavaJam</p></h2>
                <p class="right-content-header">The first Friday night each month at Javajam is special night. Join us from 8pm to 11pm for<br>some music you won't want to miss</p>
                <div class="right-content-materials" >
                    <table class = "music-table">
                        <tbody>
                            <tr id="music-table-header">
                                <th scope ="col">January</th>
                            </tr>
                            <tr>
                                <td id="music-padding"><img id="music-photo" src="img/musicphoto.jpeg"></td>
                                <td id="music-content-table">Melanine Morris Enterains with her <br> melodic folk style<br>
                                <figure class="music-player">
                                <figcaption>CDs are available now!</figcaption>
                                <audio controls src="sound/bingwei.m4a">bingwei
                                </audio>
                                 </figure>
                            </td>
                            </tr>
                            <tr id="music-table-header">
                                <th scope ="col">February</th>
                            </tr>
                            <tr>
                                <td id="music-padding"><img id="music-photo" src="img/musicphoto.jpeg"></td>
                                <td id="music-content-table">Tahpe Greg is back from his tour. <br>New songs. New stories.
                                <figure class="music-player">
                                <figcaption>CDs are available now!</figcaption>
                                <audio controls src="sound/bingwei.m4a">bingwei
                                </audio>
                                 </figure>
                            </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <footer class="footer">
            <div>Copyright &copy 2014 JavaJam Coffee House</div>
            <a href="mailto:chua@wenhuat.com">chua@wenhuat.com</a>
        </footer>

</body>
</html>