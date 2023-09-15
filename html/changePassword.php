<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>This is the Change password</h3>
    <form method="POST" action="changePwd.inc.php">
        <label for="oldPwd">New Password</label>
        <input type="password" name="newpwd" id="newpwd" required>
        <input type="submit" value="submit" name="submit">

    </form>

</body>

</html>