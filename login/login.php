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
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <title>Login Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/lstyle.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" id="Show" placeholder="Enter Password" required>
      <label>Show password <input type="checkbox" name="" onclick="myFunction()"></label>
      <input type="submit" name="login" value="Login" class="form-btn">
      <p><a href="forgot-password.php">Forgot Password?</a></p>
      <p>Don't have an account? <a href="register.php">Register now</a></p>
      <p>Go to website as a guest <a href="../index.php">Click here</a></p>
   </form>

</div>
   <script type="text/javascript">
      function myFunction() {
         var show = document.getElementById('Show');
         if (show.type=='password') {
            show.type='text';
         }
         else {
            show.type='password';
         }
      }
   </script>
</body>
</html>