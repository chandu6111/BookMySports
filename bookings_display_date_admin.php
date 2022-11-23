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
    <br><br><br><br><br><br>
    <center>
    <form method="post">
        <input type="date" name="date_picker" style="height:36px;border-width:3px;">
        <input type="submit" name="date_submit" class="btn bg-warning" value="Check Bookings">
    </form>
    </center>
    <?php
        $c=mysqli_connect("localhost:3306","root","") or die("connection failed");
	    $db=mysqli_select_db($c,"bms");
        if(isset($_POST["date_submit"])){
            $d=$_POST["date_picker"];
            $query1=mysqli_query($c,"SELECT * from `bookings` where booking_date='$d' order by booking_id desc");
            if(mysqli_num_rows($query1)!=0){
                echo "<div class='container py-4 py-xl-5'>
                <div class='row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3'>";
                while($x=mysqli_fetch_assoc($query1)){
                    $bid=$x['booking_id'];
                    $bdate=$x['booking_date'];
                    $stype=$x['sports_type'];
                    $btime=$x['time_slot'];
                    $num=$x['num_resources'];
                    $ret=$x['returned'];
                    if($ret==0){
                        echo "<div class='col'>
                        <div class='card' id='card'>
                            <div class='card-body p-4'>
                                <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                <ul>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type:$stype&nbsp;</li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date:$bdate&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time:$btime&nbsp;<br></li>
                                    <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                </ul>
                                <form name='returned_form' method='post'><button name='returned_submit1' class='btn btn-success btn-sm fw-normal border rounded-pill d-lg-flex align-items-lg-start' type='submit' style='font-family: Nunito, sans-serif;padding: 4px 10px;'>Returned</button></form>";
                                if(isset($_POST["returned_submit1"])){
                                    $res=mysqli_query($c,"update `bookings` set returned=1 where booking_id='$bid'");
                                    if($res!=0){
                                        echo "Succesfully received!";
                                    }
                                }
                            echo "</div>
                        </div>
                    </div>";
                    }
                    else{
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
                alert('No bookings done!');
                </script>";
        }
    }
        else{
            $query=mysqli_query($c,"SELECT * from `bookings` where booking_date=CURDATE() and returned=0 order by booking_id desc");
            if(mysqli_num_rows($query)!=0){
                echo "<div class='container py-4 py-xl-5'>
                <div class='row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3'>";
                while($x=mysqli_fetch_assoc($query)){
                    $bid=$x['booking_id'];
                    $bdate=$x['booking_date'];
                    $stype=$x['sports_type'];
                    $btime=$x['time_slot'];
                    $num=$x['num_resources'];
                        echo "<div class='col'>
                            <div class='card' id='card'>
                                <div class='card-body p-4'>
                                    <h4 class='card-title' style='font-size: 18px;font-family: 'Source Sans Pro', sans-serif;'>Booking ID:&nbsp;$bid</h4>
                                    <ul>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Sports Type:$stype&nbsp;</li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Date:$bdate&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Booking Time:$btime&nbsp;<br></li>
                                        <li style='font-family: Nunito, sans-serif;font-size: 14px;'>Number of resources reserved:&nbsp;$num<br></li>
                                    </ul>
                                    <form name='returned_form' method='post'><button name='returned_submit' class='btn btn-success btn-sm fw-normal border rounded-pill d-lg-flex align-items-lg-start' type='submit' style='font-family: Nunito, sans-serif;padding: 4px 10px;'>Returned</button></form>";
                                    if(isset($_POST["returned_submit"])){
                                        $query=mysqli_query($c,"update `bookings` set returned=1 where booking_id='$bid'");
                                        if($query!=0){
                                            echo "<script type='text/javascript'>
                                                alert('Succesfully received the resource!');
                                                window.location.href='bookings_admin.php';
                                                </script>";
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
                /*echo "<script type='text/javascript'>
                alert('No active bookings yet!');
                </script>";*/
                echo "<br><br><center>No active bookings yet!</center>";
            }
        }
        
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/agency.js"></script>
</body>

</html>