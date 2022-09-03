<?php

require_once "controll.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" type="image/png" href="../image/cicon.png">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/lstyle.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="course">
         <option disabled hidden selected>Select Institution</option>
         <option value="elementary">Elementary</option>
         <option value="high school">High School</option>
         <option value="college">College</option>
      </select>
      <select name="user_type">
         <option disabled hidden selected>Select User</option>
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="signup" value="register now" class="form-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>