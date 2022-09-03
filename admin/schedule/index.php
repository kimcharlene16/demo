<?php 
    require_once('db-connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling Admin</title>
    <script src="https://smtpjs.com/v3/smtp.js">
    </script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <link rel="shortcut icon" type="image/png" href="../../image/cicon.png">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
            --blue: #00b8b8;
            --black: #333;
            --white: #fff;
            --light-color: #666;
            --light-bg: #eee;
            --light-yellow: #F3DC1A;
            --border: .2rem solid rgba(0,0,0,0.1);
            --box-shadow: 0 .5rem 1rem rgba(0,0,0,0.1); 
        }
        *::-webkit-scrollbar {
            height: .5rem;
            width: .5rem;
        }
        *::-webkit-scrollbar-track {
            background-color: transparent;
        }
        *::-webkit-scrollbar-thumb {
            background-color: var(--blue);
        }
        html,
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg{
            background: #00b8b8;
            padding: 1rem;
            border-bottom: var(--border);
        }
        .bg.active {
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            border: 0;
        }
        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
        .container a {
            color: black;
        }
        .container a span{
            color: var(--light-yellow);
        }
        .nav {
            display: inline-block;
        }
        .nav a {
            list-style: none;
            margin: 0 5px;
            text-decoration: none !important;
            color: black;
        }
        .nav a:hover{
            color: yellow;
        }
        .nav .active {
            color: yellow;
        }
        .link-btn {
            visibility: hidden;
            display: inline-block;
            padding: 8px 25px;
            border-radius: .5rem;
            background-color: var(--blue);
            cursor: pointer;
            font-size: 15px;
            color: var(--white);
        }
        .link-btn:hover {
            visibility: hidden;
            background-color: var(--black);
            color: var(--white);
        }
        .title {
            text-align: center;
            margin-top: 45%;
        }
        #menu-btn {
            font-size: 2.5rem;
            color: var(--black);
            cursor: pointer;
            display: none;
        }
        .title {
            text-align: center;
            margin-top: 8%;
            margin-bottom: 3%;
        }
        @media (max-width:991px) {
            html{
                font-size: 55%;
            }
            .bg .link-btn {
                display: none;
            }
        }
        @media (max-width:768px) {
            #menu-btn {
                display: inline-block;
                transition: .2s linear;
            }
            #menu-btn.fa-times {
                transform: rotate(180deg);
            }
            .bg .nav {
                position: absolute;
                top: 99%;
                left: 0;
                right: 0;
                background-color: var(--white);
                border-top: var(--border);
                border-bottom: var(--border);
                padding: 1rem 0;
                text-align: center;
                clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
                transition: .2s linear;
            }
            .bg .nav.active {
                clip-path: polygon(0 0, 100% 0 , 100% 100%, 0 100%);
            }
            .bg .nav a {
                margin: 50px 0;
                font-size: 15px;
                display: block;
            }
        }
        @media (max-width:450px) {
            html{
                font-size: 55%;
            }
        }
    </style>
</head>

<body>
    <header class="bg fixed-top">
        <nav class="navbar navbar-expand-lg" id="topNavBar">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                CCC <span> SCHEDULE</span>
                </a>
                <div>
                    <nav class="nav">
                        <a href="../index.php">HOME</a>
                        <a href="../about.php">ABOUT</a>
                        <a href="schedule" class="active">CALENDAR</a>
                        <a href="../account.php">ACCOUNT</a>
                    </nav>
                </div>
                <a href="#"><button class="link-btn">Log out</button></a>
                <div id="menu-btn" class="fas fa-bars">

                </div>
            </div>
        </nav>
    </header>
    
    <div class="container py-5" id="page-container">
        <div class="title">
            <h3>Make a Schools Actvities Schedule</h3>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="user_type" class="control-label">Institutions</label>
                                    <select class="form-control form-control-sm rounded-0" name="user_type" id="user_type" required>
                                        <option disabled hidden selected>Click Select</option>
                                        <option value="All">All</option>
                                        <option value="Elementary">Elementary</option>
                                        <option value="High school">High School</option>
                                        <option value="College">College</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="year_level" class="control-label">Year Level</label>
                                    <select class="form-control form-control-sm rounded-0" name="year_level" id="year_level">
                                        <option disabled hidden selected>Click Select</option>
                                        <option value="All">All</option>
                                        <option value="Grade 1-6">Grade 1-6</option>
                                        <option value="Junior High">Junior High</option>
                                        <option value="Senior High">Senior High</option>
                                        <option value="BSCS">BSCS</option>
                                        <option value="BSBA">BSBA</option>
                                        <option value="BEED">BEED</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form" value="Submit" name="submit" onclick=""><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Events For</dt>
                            <dd id="user" class=""></dd>
                            <dt class="text-muted">Specifically for</dt>
                            <dd id="yr" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
$schedules = $conn->query("SELECT * FROM `schedule_list`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    $row['user'] = $row['user_type'];
    $row['yr'] = $row['year_level'];
    $sched_res[$row['id']] = $row;
}
?>

<?php 
if(isset($conn)) $conn->close();
?>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    let menu = document.querySelector('#menu-btn');
    let navbar = document.querySelector('.bg .nav');
    let header = document.querySelector('.bg');

    menu.onclick = () => {
        menu.classList.toggle('fa-times');
        navbar.classList.toggle('active');
    }
    window.onscroll = () => {
        menu.classList.remove('fa-times');
        navbar.classList.remove('active');

        if(window.scrollY > 0) {
            header.classList.add('active');
        } else {
            header.classList.remove('active');
        }
    }
    
</script>
<script src="./js/script.js"></script>

</html>