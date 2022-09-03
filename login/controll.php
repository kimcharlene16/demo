<?php
    session_start();
    require "../config.php";
    $email = "";
    $name = "";
    $error = array();

    if(isset($_POST['signup'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $user_type = mysqli_real_escape_string($conn, ($_POST['user_type']));
        $course = mysqli_real_escape_string($conn, $_POST['course']);
     
        //Confirmation password
        if($password !== $cpassword) {
           $error['password'] = "Confirm password not matched";
        }
        //email exist
        $select = mysqli_query($conn, "SELECT * FROM `login` WHERE email = '$email'");
        if(mysqli_num_rows($select) > 0) {
           $error['email'] = "Email already exist";
        }
        if(count($error) == 0) {
           $enpass = password_hash($password, PASSWORD_BCRYPT);
           $code = rand(999999, 111111);
           $status = "notverified";
           $insert = "INSERT INTO `login` (name, email, password, course, image, user_type, code, status) VALUES ('$name', '$email', '$enpass', '$course', '$image', '$user_type', '$code', '$status')";
           $data_check = mysqli_query($conn, $insert);
           if($data_check) {
                $subject = "Email Verification Code";
                $message = "Your verification code for email is $code";
                $sender = "From: cccalendar22@gmail.com";
                 if(mail($email, $subject, $message, $sender)){
                     $info = "We've sent a verification code to your email - $email";
                     $_SESSION['info'] = $info;
                     $_SESSION['email'] = $email;
                     $_SESSION['password'] = $password;
                     header('location: user-otp.php');
                     exit();
                 }
                 else{
                     $error['otp-error'] = "Failed while sending code!";
                 }
           }else{
              $error['db-error'] = "Failed while inserting data into database!";
          }
        }
     }
    

     //user-otp.php
     if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM `login` WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE `login` SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                if($fetch_data['user_type'] == 'admin') {
                    $_SESSION['user_id'] = $fetch_data['id'];
                    header('location:../admin');
               }elseif($fetch_data['user_type'] == 'user') {
                    $_SESSION['user_id'] = $fetch_data['id'];
                    header('location:../student');
               }
                exit();
            }else{
                $error['otp-error'] = "Failed while updating code!";
            }
        }else{
            $error['otp-error'] = "You've entered incorrect code!";
        }
    }

    //login.php
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $select = "SELECT * FROM `login` WHERE email = '$email'";
        $res = mysqli_query($conn, $select);
        if(mysqli_num_rows($res) > 0){
           $row = mysqli_fetch_assoc($res);
           $fetch_pass = $row['password'];
           if(password_verify($password, $fetch_pass)){
              $_SESSION['email'] = $email;
              $status = $row['status'];
                if($status == 'verified') {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                        if($row['user_type'] == 'admin') {
                            $_SESSION['user_id'] = $row['id'];
                            header('location:../admin');
                       }elseif($row['user_type'] == 'user') {
                            $_SESSION['user_id'] = $row['id'];
                            header('location:../student');
                       }
              } else {
                 $info = "It's look like you haven't still verify your email - $email";
                 $_SESSION['info'] = $info;
                 header('location: user-otp.php');
              }
              
           }else{
              $error['email'] = "Incorrect email or password!";
          }
        }
        else{
           $error['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
     
     }

     //forgot-password.php
     if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $check_email = "SELECT * FROM `login` WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE `login` SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: cccalendar22@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $error['otp-error'] = "Failed while sending code!";
                }
            }else{
                $error['db-error'] = "Something went wrong!";
            }
        }else{
            $error['email'] = "This email address does not exist!";
        }
    }

    //reset-otp.php
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM `login` WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $error['otp-error'] = "You've entered incorrect code!";
        }
    }

    //new-password.php
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        if($password !== $cpassword){
            $error['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE `login` SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $error['db-error'] = "Failed to change your password!";
            }
        }
    }

    //password-changed.php
    if(isset($_POST['login-now'])){
        header('Location: login.php');
    }
?>