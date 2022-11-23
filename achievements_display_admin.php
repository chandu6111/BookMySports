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
    <link rel="stylesheet" href="assets/css/Search-Input-Responsive-with-Icon.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Toggle-Switches.css">
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">Book My Sports</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto text-uppercase">
                <li class="nav-item"><a class="nav-link" href="bookings_admin.php">Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="events_admin.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link" style='color:#fed136;' href="achievements_admin.php">Achievements</a></li>
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
    
    <h4 class="text-center mb-4 pb-3">Sports Achievements</h4>
    <form method="post">
    <div class="d-flex justify-content-center align-items-center mb-4">
    <div class="row padMar">
        <div class="col-auto col-lg-12 offset-lg-1 padMar">
            <div class="input-group" >
                <select name="depyear" id="depyear" class="form-control form-style bg-dark text-light autocomplete" >
                <option selected disabled hidden>Search by ...</option>
                <option value="Department">Department</option>
                <option value="Year">Year</option>
                <option value="Rollno">Roll number</option>
                </select>
                <input name="search_text" class="form-control autocomplete" type="text" placeholder="Search here..." required>
                <button name="submit_search" class="btn btn-warning btnAddAction" type="submit">
                    Search
                </button>
            </div>
        </div>
        </div>
        </div>
    </form>
        <?php
  $con=mysqli_connect("localhost","root","");
  mysqli_select_db($con,"bms");
  $query=mysqli_query($con,"SELECT * FROM `achievements`");
  $num=mysqli_num_rows($query);
  if($num==0){
    echo "<script type='text/javascript'>
    alert('No achievements available at the moment for search!');
    window.location.href='admin_home.php';
    </script>";
    }
else{
  if(isset($_POST['submit_search'])){
    $t=$_POST['search_text'];
    $depyear=$_POST['depyear'];
    if($depyear=='Department'){
        $t=strtolower($t);
        $sq=mysqli_query($con,"select * from `achievements` natural join `register` where branch like '%$t%'");
    }
    else if($depyear=='Year'){
        $sq=mysqli_query($con,"select * from `achievements` where event_from_date like '%$t%' or event_to_date like '%$t%'");
    }
    else if($depyear=='Rollno'){
        $t=strtoupper($t);
        $sq=mysqli_query($con,"select * from `achievements` natural join `achievement_normalise` where rollno like '%$t%'");
    }
    
    $rows=mysqli_num_rows($sq);
    if($rows==0){
        echo "<script type='text/javascript'>
        alert('Search failed!');
        window.location.href='achievements_display_admin.php';
        </script>";
    }
    else{
        $count=0;
        while($x=mysqli_fetch_assoc($sq))
            {
                $aid=$x["ach_id"];
                $ename=$x["event_name"];
                $est_date=$x["event_from_date"];
                $eend_date=$x["event_to_date"];
                $adesc=$x["ach_desc"];
                $alikes=$x["ach_likes"];
                $query1= mysqli_query($con,"SELECT rollno FROM `achievement_normalise` WHERE ach_id='$aid'");
                $count+=1;
                if($count>1){
                    echo "<section style='margin-top:-180px;'>";
                }
                else{
                    echo "<section style='margin-top:-100px;'>";
                }
                echo "
                    <div class='container'>
                    <div class='photo-card'>
                    <div class='photo-background' style='background-image:url(&quot;achievement_images/achievement-$aid.jpg&quot;);'></div>
                    <div class='photo-details'>
                    <h5 class='text-white' style='font-family: 'Source Sans Pro', sans-serif;'>$ename</h5>
                      <p style='font-family: 'Source Sans Pro', sans-serif;'>$adesc</p>
                      <p class='fs-6' style='font-size: 12px;font-family: 'Source Sans Pro', sans-serif;'><i class='far fa-calendar-check text-warning' style='font-size: 14px;'></i>&nbsp;$est_date to $eend_date<br><i class='fas fa-user-friends text-warning' style='font-size: 14px;'></i>&nbsp; Participants are:<br>";
                      if(mysqli_num_rows($query1)!=0){
                        while($y=mysqli_fetch_assoc($query1)){
                            $r=$y["rollno"];
                            $query2=mysqli_query($con,"SELECT * from `register` where rollno='$r'");
                            if(mysqli_num_rows($query2)!=0){
                                while($z=mysqli_fetch_assoc($query2))
                                 echo "-> ".$z["fullname"]." ( ".$z['rollno']." )"." of ".strtoupper($z["branch"])."-".strtoupper($z["section"])."<br>";
                             }
                             else{
                                echo "-> ( ".$r." )<br>";
                             }
                          }
                      }
                      
                      echo "<i class='fas fa-heart' style='font-size: 14px;'></i>&nbsp;$alikes</p>";
                      echo "</p>
                           <div class='photo-tags'>
                           <form method='post'>
                               <ul>
                                   <li><button class='text-bg-danger' style='text-transform: capitalize;font-family: 'Source Sans Pro', sans-serif;' name='del_ach'>Delete Achievement</button></li>
                               </ul>
                             </form></div>";
                             if(isset($_POST["del_ach"])){
                               $q=mysqli_query($con,"delete from `achievements` where ach_id='$aid'");
                               if($q!=0){
                                   echo "<script type='text/javascript'>
                                       alert('Succesfully removed the achievement!');
                                       window.location.href='achievements_display_admin.php';
                                       </script>";
                               }
                           }
                        echo "</div>
                        </div>
                        </div>
                        </section>";
            }       
        }
    }
    // without search
    else{
        $count=0;
     while($x=mysqli_fetch_assoc($query))
       {
          $aid=$x["ach_id"];
          $ename=$x["event_name"];
          $est_date=$x["event_from_date"];
          $eend_date=$x["event_to_date"];
          $adesc=$x["ach_desc"];
          $alikes=$x["ach_likes"];
          $query1= mysqli_query($con,"SELECT rollno FROM `achievement_normalise` WHERE ach_id='$aid'");
          $count+=1;
         if($count>1){
           echo "<section style='margin-top:-180px;'>";
         }
         else{
           echo "<section style='margin-top:-100px;'>";
         }
          echo "<div class='container'>
              <div class='photo-card'>
                  <div class='photo-background' style='background-image:url(&quot;achievement_images/achievement-$aid.jpg&quot;);'></div>
                  <div class='photo-details'>
                      <h5 class='text-white' style='font-family: 'Source Sans Pro', sans-serif;'>$ename</h5>
                      <p style='font-family: 'Source Sans Pro', sans-serif;'>$adesc</p>
                      <p class='fs-6' style='font-size: 12px;font-family: 'Source Sans Pro', sans-serif;'><i class='far fa-calendar-check text-warning' style='font-size: 14px;'></i>&nbsp;$est_date to $eend_date<br><i class='fas fa-user-friends text-warning' style='font-size: 14px;'></i>&nbsp; Participants are:<br>";
                      if(mysqli_num_rows($query1)!=0){
                        while($y=mysqli_fetch_assoc($query1)){
                            $r=$y["rollno"];
                            $query2=mysqli_query($con,"SELECT * from `register` where rollno='$r'");
                            if(mysqli_num_rows($query2)!=0){
                                while($z=mysqli_fetch_assoc($query2))
                                 echo "-> ".$z["fullname"]." ( ".$z['rollno']." )"." of ".strtoupper($z["branch"])."-".strtoupper($z["section"])."<br>";
                             }
                             else{
                                echo "-> ( ".$r." )<br>";
                             }
                          }
                      }
                      
                      echo "<i class='fas fa-heart' style='font-size: 14px;'></i>&nbsp;$alikes</p>";
                      echo "</p>
                           <div class='photo-tags'>
                           <form method='post'>
                               <ul>
                                   <li><button class='text-bg-danger' style='text-transform: capitalize;font-family: 'Source Sans Pro', sans-serif;' name='del_ach'>Delete Achievement</button></li>
                               </ul>
                             </form></div>";
                             if(isset($_POST["del_ach"])){
                               $q=mysqli_query($con,"delete from `achievements` where ach_id='$aid'");
                               if($q!=0){
                                   echo "<script type='text/javascript'>
                                       alert('Succesfully removed the achievement!');
                                       window.location.href='achievements_display_admin.php';
                                       </script>";
                               }
                           }
                  echo "</div>
              </div>
          </div>
      </section>";
        }
    }
}

  
?>


        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/agency.js"></script>




</body>
</html>
                           