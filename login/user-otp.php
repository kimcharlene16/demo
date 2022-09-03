<?php 
    require_once "controll.php";
?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../image/cicon.png">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/lstyle.css">
</head>
<body>
    <div class="form-container">
        <form action="user-otp.php" method="POST" autocomplete="off">
            <h2 class="text-center">Code Verification</h2>
                <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                ?>
                <?php
                    if(count($error) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($error as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                        <input type="number" name="otp" placeholder="Enter verification code" required>
                        <input type="submit" name="check" value="Submit">
        </form>
    </div>
    
</body>
</html>