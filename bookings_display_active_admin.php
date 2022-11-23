<!DOCTYPE html>
<html>

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
                <li class="nav-item"><a class="nav-link" style='color:#fed136;' href="bookings_admin.php">Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="events_admin.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="achievements_admin.php">Achievements</a></li>
                    <li class="nav-item"><a class="nav-link" href="resources_admin.php">Resources</a></li>
                    <li class="nav-item"><a class="nav-link" href="timetable_admin.php">TimeTable</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Logout</a></li>
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
        function taken($ft,$rop){
            if($ft!=0){
                $c=mysqli_connect("localhost","root","") or die("connection failed");
                $db=mysqli_select_db($c,"bms");
                $res=mysqli_query($c,"update `bookings` set taken=1 where booking_id='$ft' and rollno='$rop'");
                if($res!=0){
                    echo "<script type='text/javascript'>
                    alert('Succesfully taken the resource!');
                    window.location.href='bookings_display_active_admin.php';
                    </script>";
                }
            }
        }
        function penalty($fp,$ropp){
            if($fp!=0){
                $c=mysqli_connect("localhost","root","") or die("connection failed");
                $db=mysqli_select_db($c,"bms");
                $res=mysqli_query($c,"update `bookings` set returned=1, penalty=0 where booking_id='$fp' and rollno='$ropp'");
                if($res!=0){
                    echo "<script type='text/javascript'>
                    alert('Succesfully returned the resource!');
                    window.location.href='bookings_display_active_admin.php';
                    </script>";
                }
            }
        }
        function returned($fr,$ropr){
            if($fr!=0){
                $c=mysqli_connect("localhost","root","") or die("connection failed");
                $db=mysqli_select_db($c,"bms");
                $query=mysqli_query($c,"update `bookings` set returned=1 where booking_id='$fr' and rollno='$ropr'");
                if($query!=0){
                    echo "<script type='text/javascript'>
                    alert('Succesfully received the resource!');
                    window.location.href='bookings_display_active_admin.php';
                    </script>";
                }
            }
        }
        $c=mysqli_connect("localhost","root","") or die("connection failed");
        $db=mysqli_select_db($c,"bms");
        $qu=mysqli_query($c,"SELECT * from `bookings` where booking_date=CURDATE()");
        if(mysqli_num_rows($qu)!=0){
                echo "<div class='container py-4 py-xl-5'>
                <div class='row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3'>";
                while($x=mysqli_fetch_assoc($qu)){
                    $ft=0;
                    $fr=0;
                    $fp=0;
                    $bid=$x['booking_id'];
                    $bdate=$x['booking_date'];
                    $stype=$x['sports_type'];
                    $btime=$x['time_slot'];
                    $num=$x['num_resources'];
                    $roll=$x['rollno'];
                    $taken=$x["taken"];
                    $ret=$x["returned"];
                    $can=$x["cancelled"];
                    $pen=$x["penalty"];
                    if($can==1){
                        echo "<div class='col'>
                            <div class='card bg-danger text-light'>
                                <div class='card-body p-4'>
                                    <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                    <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Roll number: $roll&nbsp;<br></li>
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
                    else if($pen==1){
                        echo "<div class='col'>
                            <div class='card bg-info'>
                                <div class='card-body p-4'>
                                    <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                    <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Roll number: $roll&nbsp;</li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type:$stype&nbsp;</li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date:$bdate&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time:$btime&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                    </ul>
                                    <form name='pen_form' method='post' action=''>
                                    <button name='pen_submit' class='btn btn-dark btn-sm fw-normal border rounded-pill d-lg-flex align-items-lg-start' type='submit' style='font-family: Nunito, sans-serif;padding: 4px 10px;'>Penalty paid?</button>
                                    </form>";
                                    if(isset($_POST['pen_submit'])){
                                        $fp=$bid;
                                        $ropp=$roll;
                                        penalty($fp,$ropp);
                                        break;
                                    }
                                    
                    }
                    else if($taken==1 && $ret==1){
                        echo "<div class='col'>
                            <div class='card bg-success text-light' id='card'>
                                <div class='card-body p-4'>
                                    <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                    <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Roll number: $roll&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type: $stype&nbsp;</li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date: $bdate&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time: $btime&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                    </ul>
                                    <h5>Resource returned!</h5>";
                    }
                    else if($taken==0 && $ret==0){
                        echo "<div class='col'>
                            <div class='card'>
                                <div class='card-body p-4'>
                                    <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                    <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Roll number: $roll&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type: $stype&nbsp;</li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date: $bdate&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time: $btime&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                    </ul>
                                    <form name='taken_form' method='post' action=''>
                                    <button name='taken_submit' class='btn btn-warning btn-sm fw-normal border rounded-pill d-lg-flex align-items-lg-start' type='submit' style='font-family: Nunito, sans-serif;padding: 4px 10px;'>Taken?</button>
                                    </form>";
                                    if(isset($_POST['taken_submit'])){
                                        $ft=$bid;
                                        $rop=$roll;
                                        taken($ft,$rop);
                                        break;
                                    }
                    }
                    else if($taken==1 && $ret==0){
                        echo "<div class='col'>
                            <div class='card' id='card'>
                                <div class='card-body p-4'>
                                    <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                    <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Roll number: $roll&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type: $stype&nbsp;</li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date: $bdate&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time: $btime&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                    </ul>
                                    <form name='returned_form' method='post' action=''>
                                    <input name='returned_submit' value='Returned?' class='btn btn-success btn-sm fw-normal border rounded-pill d-lg-inline align-items-lg-end' type='submit' style='font-family: Nunito, sans-serif;padding: 4px 10px;'>
                                    </form>";
                                    if(isset($_POST['returned_submit'])){
                                        $fr=$bid;
                                        $ropr=$roll;
                                        returned($fr,$ropr);
                                        break;
                                    }
                    }
                    echo "</div>
                        </div>
                        </div>";
                }
                echo "</div>
                </div>";
                }
                else{
                    echo "<script type='text/javascript'>
                    alert('No active bookings yet!');
                    window.location.href='bookings_admin.php';
                    </script>";
                }                                             
            ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/agency.js"></script>
</body>

</html>
