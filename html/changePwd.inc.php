<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
   require_once "../asset/includePHP/dbh.inc.php";
   $newpwd = $_POST["newpwd"];
   if (isset($_POST["newpwd"])) {
      try {
         $query = "UPDATE users SET pwd=:pwd  WHERE user_id=19";

         $stmt = $pdo->prepare($query);
         $stmt->bindParam(":pwd", $newpwd);
         $stmt->execute();
         $stmt = null;
         $pdo = null;
         header("Location: ../html/login.php");
         exit();
      } catch (PDOEXCEPTION $e) {
         die("Query Failed:" . $e->getMessage());
      }
   } else {
      header("Location: ../html/changePassword.php");
      exit();
   }
} else {
   header("Location: ../html/changePassword.php");
   exit();
}
