<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>

  <?php
  
  include("db_connection.php");


  ?>
  <body>
    <form method="POST" action="signup.php">
      <input type="text" name="firstname" placeholder="First Name" /><br />
      <input type="text" name="lastname" placeholder=" Last Name" /><br />
      <input type="text" name="email" placeholder="Email" /><br />
      <input type="password" name="password" placeholder="Password" /><br />
      <input type="text" name="homeaddress" placeholder="Home Address " /><br />
      <input type="Submit" value="Submit" /><br />
    </form>
  </body>
</html>
