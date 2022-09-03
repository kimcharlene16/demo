<?php 
    require_once "controll.php";
?>
<?php
if($_SESSION['info'] == false){
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
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/lstyle.css">
</head>
<body>
    <div class="form-container">
        <form action="login.php" method="POST">
            <?php 
                if(isset($_SESSION['info'])){
            ?>
                <?php echo $_SESSION['info']; ?>
                <?php
                    }
                ?>
            <input type="submit" name="login-now" value="Login Now">
        </form>
    </div>
    
</body>
</html>