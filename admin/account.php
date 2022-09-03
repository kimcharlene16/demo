<?php

include '../config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../image/cicon.png">
    <title>CCC Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/hstyle.css">
</head>
<body>
    
    <header class="header fixed-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                    <a href="#home" class="logo">CCC<span> Calendar</span></a>
                <nav class="nav">
                    <a href="index.php">home</a>
                    <a href="about.php">about</a>
                    <a href="schedule">calendar</a>
                </nav>
                <div class="action">
                    <div class="proimg" onclick="proToggle();">
                        <?php
                            $select = mysqli_query($conn, "SELECT * FROM `login` WHERE id = '$user_id'") or die('query failed');
                            if(mysqli_num_rows($select) > 0){
                                $fetch = mysqli_fetch_assoc($select);
                            }
                            if($fetch['image'] == ''){
                                echo '<img src="../image/default-avatar.png">';
                            }else{
                                echo '<img src="../uploaded_img/'.$fetch['image'].'">';
                            }
                        ?>
                    </div>
                    <div class="drop">
                        <h3>My Account<span class="usn"><br><?php echo $fetch['name']; echo "<br>"; echo $fetch['course']; ?></span></h3>
                        <ul class="ic_ul">
                            <li>
                                <div class="icon">
                                    <img src="../image/eye.svg"><a href="account.php"> View Profile</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="../image/edit.svg"><a href="update_profile.php"> Edit Profile</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="../image/signout.svg"><a href="../logout.php"> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="menu-btn" class="fas fa-bars">
                </div>
            </div>
        </div>
    </header>

    <section class="home" id="home">
        <div class="ner">

            <div class="profile">
                <?php
                    $select = mysqli_query($conn, "SELECT * FROM `login` WHERE id = '$user_id'") or die('query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                    }
                    if($fetch['image'] == ''){
                        echo '<img src="../image/default-avatar.png">';
                    }else{
                        echo '<img src="../uploaded_img/'.$fetch['image'].'">';
                    }
                ?>
                <h3><?php echo $fetch['name']; ?></h3>
                <h3><?php echo $fetch['course']; ?></h3>
                <a href="update_profile.php" class="link-btn">update profile</a>
            </div>
        </div>
    </section>

    <script>
        function proToggle(){
            const togglePro = document.querySelector('.drop');
            togglePro.classList.toggle('active');
        }
    </script>
    <script src="../js/hscript.js"></script>


</body>
</html>