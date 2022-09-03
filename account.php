<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location: account.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Account</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

</head>
<body>
   
   <header class="header fixed-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                    <a href="#home" class="logo">CCC<span> Calendar</span></a>
                <nav class="nav">
                    <a href="ahome.php">home</a>
                    <a href="about.php">about</a>
                    <a href="schedule">calendar</a>
                    <a href="account.php" class="active">account</a>
                </nav>
                <div id="menu-btn" class="fas fa-bars">

                </div>
                <a href="logout.php"><button class="link-btn">Log out</button></a>
            </div>
        </div>
    </header>

<div class="cont">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM login WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['name']; ?></h3>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

</div>
<script src="js/hscript.js"></script>
</body>
</html>