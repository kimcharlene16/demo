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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/lstyle.css">
</head>
<body>
    <div class="form-container">
        <form action="forgot-password.php" method="POST" autocomplete="">
            <h2 class="text-center">Forgot Password</h2>
            <p class="text-center">Enter your email address</p>
            <?php
                if(count($error) > 0){
            ?>
            <div class="alert alert-danger text-center">
                <?php 
                    foreach($error as $error){
                    echo $error;
                    }
                ?>
            </div>
            <?php
                }
            ?>
            <input type="email" name="email" placeholder="Enter email address" required>
            <input type="submit" name="check-email" value="Continue">
    </form>
    </div>
    
</body>
</html>