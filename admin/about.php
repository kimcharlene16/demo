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
    <title>CCC</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/hstyle.css">
</head>
<body>
    
    <header class="header fixed-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                    <a href="#home" class="logo">CCC<span> Calendar</span></a>
                <nav class="nav">
                    <a href="index.php">home</a>
                    <a href="about.php" class="ac">about</a>
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

    <section class="about" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 image">
                    <img src="../image/g.png" class="w-100 mb-4 mb-md-0"alt="">
                </div>
                <div class="col-md-6 content">
                    <span>about us</span>
                    <h3>Group 1</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nesciunt distinctio consectetur. Error, quae. A, labore. Dolorum, illo fugiat esse, error amet corrupti quibusdam reprehenderit harum reiciendis laudantium aut aliquam.</p>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <h1 class="heading">About CCC</h1>
        <div class="card-holder">
                <div class="card">
                    <img src="../image/seal.png" alt="" class="card__img">
                    <div class="card-contents">
                        <h1 class="card__name">CCC History</h1>
                        <p><b class="bol">Brief History of Cainta Catholic College</b><br>
                        Cainta Catholic College dawned through the CICM missionary zeal. In 1931, Rev. Fr. Jose Tajon was parish priest of Our Lady of Light. Since he ran a school at the Manila Cathedral. his former parish, he deemed it wise to open a Catholic School so that the children of the town could avail of primary education From charity money and donation, Fr. Tajon was able to maintain the...

                        <a href="https://www.caintacatholiccollege.com/history.html" target="_blank" class="his"><p class="read-more-btn">Read More...</p></a>
                    </div>
                </div>

                <div class="card">

                    <img src="../image/seal.png" alt="" class="card__img">

                    <div class="card-contents">
                        <h1 class="card__name">Vision and Mission</h1>

                        <p><b class="bol">Vision</b><br>
                        Cainta Catholic College envisions itself as the preferred educational institution and center for Religious Education in the Diocese of Antipolo with level 4 accreditation status.<br>
                        <br>
                        <b class="bol">Mission</b><br>
                        Under the patronage of Mary, Our Lady of Light, Cainta Catholic College, commits itself to excellent learner-centered and technology-enabled ...
                        <span class="card__read-more">programs and services with Religion at the core.</span>
                        </p>
                        <p class="read-more-btn">Read More...</p>
                    </div>
                </div>

                <div class="card">
                    <img src="../image/seal.png" alt="" class="card__img">
                    <div class="card-contents">
                        <h1 class="card__name">The CCC Seal</h1>
                        <p>
                        <b class="bol">Marian Emblem</b><br>
                        This represents the school's special affinity to our Lady of Light- patroness of reconciliation, communion and mission. A CCCian takes particular devotion to Our Lady... especially in living the role of a missionary for peace and reconciliation. In general, the school community takes the lead role in propagating the same value of sowing peace, reconciliation and communion...<br>

                        <span class="card__read-more"><br><b class="bol">People in Arms Around a Bell Tower</b><br>
                            This represents the people who respond to the call of the Church to be agents and missionaries of bringing communion (i.e. people of one heart, one mind, one faith and one mission). A CCCian is called by the Church to be an agent of communion among people and should take serious attention in promoting and building Christian communities in and out of school.<br>
                            <br>
                            <b class="bol">The Bible, Chalice, Bread and the Crucifix</b><br>
                            These represents the CCCian's special relationship to God by knowing real wisdom, experiencing a living faith through active worship, and sharing through preferential concern for and involvement with the poor. In essence, the Bible, Chalice and the Crucifix represent the school's vision of integral evangelization as a means toward becoming an evangelized-evangelizing community.<br>
                            <br>
                            <b class="bol">Scroll with Slogan</b><br>
                            Indeed, CCCians are collectively a community on a missionary journey of bringing light, truth and love to everyone.<br>
                            <br>
                            <b class="bol">Gold and Sky Blue Color</b><br>
                            Gold represents an abundant harvest and blue represents heaven. A CCCian is called to prepare an abundant harvest for heaven.</span>
                        </p>
                        <p class="read-more-btn">Read More...</p>
                    </div>
                </div>

                <div class="card">
                    <img src="../image/seal.png" alt="" class="card__img">
                    <div class="card-contents">
                        <h1 class="card__name">Alma Mater Hymn</h1>
                        <p>
                        <b class="bol">CCC Hymn</b><br>
                            Alma Mater dear all hail to thee
                            We will sing your praise and glory
                            You have led and made us fight for right
                            Through your portals our future smiles so bright.<br>
                            
                            <br>We will praise thy name O CCC
                            We will ever stand on defense for it
                            We will sing thy praise dear CCC
                            Through our deed we'll prove we are brave and fit...<br>

                            <br>

                        <span class="card__read-more">We fear not tomorrow
                            We shall not fear the rain
                            And though we be met with sorrow
                            We shall sing on and not feel the pain<br>
                            
                            <br>And when our paths should separate
                            We'll have a heart for any fate
                            We'll have sweet memories that cannot die
                            After we utter that jeweled word goodbye<br>
                            
                            <br>Had God keep watch 'tween thee and us
                            And keep us ever near to Him
                            Alma Mater dear all hail to thee
                            We will sing your praise and glory<br>

                            <br>Ever upward and onward we will strive
                            Loyalty and truth in our hearts will thrive
                            God blesses thee … He blesses us
                            Alma Mater!<br>
                        </span>
                        </p>
                        <p class="read-more-btn">Read More...</p>
                    </div>
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