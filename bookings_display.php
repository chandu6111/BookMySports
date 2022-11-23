<!DOCTYPE html>
<html>
<?php
    session_start();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BMS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Toggle-Switches.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">Book My Sports</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="book_resources.php">Book Resources</a></li>
                    <li class="nav-item"><a class="nav-link" href="events_display.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="achievements_display.php">Achievements</a></li>
                    <li class="nav-item"><a class="nav-link" href="bookings_display.php" style='color:#fed136;'>Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-block" style="height: 100px;">
        <div class="container" style="height: 30px;">
            <div class="row" style="height: 30px;">
                <div class="col-md-12" style="height: 30px;">
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <?php
        $r=$_SESSION['rollno'];
        $c=mysqli_connect("localhost:3306","root","") or die("connection failed");
	    $db=mysqli_select_db($c,"bms");
        $query=mysqli_query($c,"SELECT * from `bookings` WHERE rollno='$r' order by booking_id desc");
        echo "<center><h3 class='mt-4'>Welcome, $r</h3></center>";
        if(mysqli_num_rows($query)!=0){
            $del_query=mysqli_query($c,"update `bookings` set cancelled=1, taken=1, returned=1 WHERE rollno='$r' and taken=0 and NOW()>= time_slot+ INTERVAL 1 MINUTE");
            $del_query1=mysqli_query($c,"update `bookings` set penalty=1 WHERE rollno='$r' and taken=1 and returned=0 and NOW()>= time_slot+ INTERVAL 1 MINUTE");
            echo "<div class='container py-4 py-xl-5'>
            <div class='row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3'>";
            while($x=mysqli_fetch_assoc($query)){
                $bid=$x['booking_id'];
                $bdate=$x['booking_date'];
                $stype=$x['sports_type'];
                $btime=$x['time_slot'];
                $num=$x['num_resources'];
                $taken=$x['taken'];
                $ret=$x['returned'];
                $can=$x['cancelled'];
                $pen=$x['penalty'];
                
                if($pen==1){
                    echo "<div class='col'>
                        <div class='card bg-info'>
                            <div class='card-body p-4'>
                                <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type:$stype&nbsp;</li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date:$bdate&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time:$btime&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                </ul>
                                <h5>Penalty!</h5>
                            </div>
                        </div>
                    </div>";
                }
                else if($can==1){
                    echo "<div class='col'>
                        <div class='card bg-danger text-light'>
                            <div class='card-body p-4'>
                                <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type:$stype&nbsp;</li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date:$bdate&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time:$btime&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                </ul>
                                <h5>Booking cancelled!</h5>
                            </div>
                        </div>
                    </div>";
                }
                else if($ret==0 && $taken==0){
                    echo "<div class='col'>
                        <div class='card'>
                            <div class='card-body p-4'>
                                <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type:$stype&nbsp;</li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date:$bdate&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time:$btime&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                </ul>
                                <form name='cancel_form' method='post'><button name='cancel_submit' class='btn btn-danger btn-sm fw-normal border rounded-pill d-lg-flex align-items-lg-start' type='submit' style='font-family: Nunito, sans-serif;padding: 4px 10px;'>Cancel Booking</button></form>";
                                if(isset($_POST["cancel_submit"])){
                                    $con=mysqli_connect("localhost","root","") or die("connection failed");
	                                $db=mysqli_select_db($con,"bms");
                                    $query=mysqli_query($con,"update `bookings` set cancelled=1, taken=1, returned=1 where booking_id='$bid'");
                                    if($query!=0){
                                        echo "<script type='text/javascript'>
                                            alert('Succesfully cancelled the resource!');
                                            window.location.href='bookings_display.php';
                                            </script>";
                                    }
                                }
                            echo "</div>
                        </div>
                    </div>";
                }
                else if($taken==1 && $ret==0){
                    echo "<div class='col'>
                        <div class='card bg-warning'>
                            <div class='card-body p-4'>
                                <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type:$stype&nbsp;</li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date:$bdate&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time:$btime&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                </ul>
                                <h5>Resource not returned yet!</h5>
                            </div>
                        </div>
                    </div>";
                }
                else if($ret==1){
                    echo "<div class='col'>
                        <div class='card bg-success text-light'>
                            <div class='card-body p-4'>
                                <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type:$stype&nbsp;</li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date:$bdate&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time:$btime&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                </ul>
                                <h5>Resource returned!</h5>
                            </div>
                        </div>
                    </div>";
                }
            }
            echo "</div>
            </div>";
        }
        else{
            echo "<script type='text/javascript'>
            alert('You have no bookings yet, you can reserve some resources now!');
            window.location.href='book_resources.php';
            </script>";
        }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/agency.js"></script>
</body>

</html>