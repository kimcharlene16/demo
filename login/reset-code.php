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
        <form action="reset-code.php" method="POST" autocomplete="off">
            <h2 class="text-center">Code Verification</h2>
                <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                            <?php echo $_SESSION['info']; ?>
                        <?php
                    }
                ?>
                <?php
                    if(count($error) > 0){
                        ?>
                            <?php
                            foreach($error as $showerror){
                                echo $showerror;
                            }
                            ?>
                        <?php
                    }
                ?>
                <input type="number" name="otp" placeholder="Enter code" required>
                <br>
                <input type="submit" name="check-reset-otp" value="Submit">
        </form>
    </div>
</body>
</html>