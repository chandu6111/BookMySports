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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/dh-card-image-left-dark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Toggle-Switches.css">
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">Book My Sports</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto text-uppercase">
                <li class="nav-item"><a class="nav-link" href="bookings_admin.php">Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" style='color:#fed136;' href="events_admin.php">Events</a></li>
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
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/agency.js"></script>


<?php

  date_default_timezone_set('Asia/Kolkata');
  $currenttime= date('h:i:s',time());
  $currentdate= date("Y-m-d");
  
  $con=mysqli_connect("localhost","root","");
  mysqli_select_db($con,"bms");


  $query1=mysqli_query($con,"SELECT * FROM `events` WHERE ('$currenttime'< event_time and '$currentdate'= event_date) ");
  $num1=mysqli_num_rows($query1);
 //-------------------------------------------------------------------------------------------------------------------------



  $query=mysqli_query($con,"SELECT * FROM `events` WHERE ('$currentdate'< event_date) ");
  $num=mysqli_num_rows($query);
 
//-------------------------------------------------------------------------------------------------------------------------  

  $query2=mysqli_query($con,"DELETE FROM `events` WHERE ('$currentdate'> event_date) ");

//-------------------------------------------------------------------------------------------------------------------------


/*if($num==0 || $num1==0){
    echo "<script type='text/javascript'>
      alert('No current or upcoming events yet!');
      window.location.href='admin_home.php';
      </script>";
  }
*/
if($num1!=0)  //executed
  { 
    $count=0;
    while($y=mysqli_fetch_assoc($query1))
      {
         $eid1=$y["event_id"];
         $ename1=$y["event_name"];
         $etime1=$y["event_time"];
         $edate1=$y["event_date"];
         $evenue1=$y["event_venue"];
         $edesc1=$y["event_desc"];
         $elink1=$y["event_link"];
         $ac1=$y["no_attendees"];
         $et1=date('h:i a', strtotime($etime1));
         $count+=1;
         if($count>1){
           echo "<section style='margin-top:-220px;'>";
         }
         else{
           echo "<section style='margin-top:-140px;'>";
         }
         echo "<div class='container'>
              <div style='background:#fed136;' class='photo-card'>
                  <div class='photo-background' style='background-image:url(&quot;event_images/event-$eid1.jpg&quot;);'></div>
                  <div class='photo-details'>
                      <h5 class='text-dark' style='font-family: 'Source Sans Pro', sans-serif;'>$ename1</h5>
                      <p style='font-family: 'Source Sans Pro', sans-serif;' class='text-dark'><i class='fas fa-map-marker-alt text-danger' style='font-size: 16px;'></i>&nbsp; $evenue1</p>
                      <p class='text-dark' style='font-family: 'Source Sans Pro', sans-serif;'>$edesc1</p>
                      <p class='fs-6 text-dark' style='font-size: 12px;font-family: 'Source Sans Pro', sans-serif;'><i class='far fa-calendar-check' style='font-size: 14px;'></i>&nbsp;$edate1<br><i class='far fa-clock' style='font-size: 14px;'></i>&nbsp;$et1<br><i class='fas fa-user-friends' style='font-size: 14px;'></i>&nbsp;$ac1</p>
                      <div class='photo-tags'>
                      <form method='post'>
                          <ul>
                              <li><button class='text-light bg-danger rounded-pill pt-1 pb-1 p-3' style='text-transform: capitalize;font-family: 'Source Sans Pro', sans-serif;' name='del_event'>Delete Event</button></li>
                          </ul>
                        </form></div>";
                        if(isset($_POST["del_event"])){
                          $q=mysqli_query($con,"delete from `events` where event_id='$eid1'");
                          if($q!=0){
                              echo "<script type='text/javascript'>
                                  alert('Succesfully removed the $ename1 event!');
                                  window.location.href='events_display_admin.php';
                                  </script>";
                              
                          }
                      }
                  echo "</div>
              </div>
          </div>
      </section>";
       }
  }

  if($num!=0)    //executed
  {
     while($x=mysqli_fetch_assoc($query))
       {
        $eid=$x["event_id"];
          $ename=$x["event_name"];
	      $etime=$x["event_time"];
          $edate=$x["event_date"];
          $evenue=$x["event_venue"];
          $edesc=$x["event_desc"];
          $elink=$x["event_link"];
          $et=date('h:i a', strtotime($etime));
          $ac=$x["no_attendees"];
          echo "<section style='margin-top:-100px;'>
          <div class='container'>
              <div class='photo-card'>
                  <div class='photo-background' style='background-image:url(&quot;event_images/event-$eid.jpg&quot;);'></div>
                  <div class='photo-details'>
                      <h5 class='text-white' style='font-family: 'Source Sans Pro', sans-serif;'>$ename</h5>
                      <p style='font-family: 'Source Sans Pro', sans-serif;'><i class='fas fa-map-marker-alt text-primary' style='font-size: 16px;'></i>&nbsp; $evenue</p>
                      <p style='font-family: 'Source Sans Pro', sans-serif;'>$edesc</p>
                      <p class='fs-6' style='font-size: 12px;font-family: 'Source Sans Pro', sans-serif;'><i class='far fa-calendar-check' style='font-size: 14px;'></i>&nbsp;$edate<br><i class='far fa-clock' style='font-size: 14px;'></i>&nbsp;$et<br><i class='fas fa-user-friends' style='font-size: 14px;'></i>&nbsp;$ac</p>
                      <div class='photo-tags'>
                      <form method='post'>
                          <ul>
                              <li><button class='text-light bg-danger rounded-pill pt-1 pb-1 p-3' style='text-transform: capitalize;font-family: 'Source Sans Pro', sans-serif;' name='del_event'>Delete Event</button></li>
                          </ul>
                        </form></div>";
                        if(isset($_POST["del_event"])){
                          $q=mysqli_query($con,"delete from `events` where event_id='$eid'");
                          if($q!=0){
                              echo "<script type='text/javascript'>
                                  alert('Succesfully removed the $ename event!');
                                  window.location.href='events_display_admin.php';
                                  </script>";
                          }
                      }
                  echo "</div>
              </div>
          </div>
      </section>";
		
       }
  }





?>

</body>
</html>