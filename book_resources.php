<!DOCTYPE html>
<html>
    <?php
        session_start();
    ?>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BMS</title>
	<link rel="stylesheet" href="bookingstyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Toggle-Switches.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">Book My Sports</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="book_resources.php" style='color:#fed136;'>Book Resources</a></li>
                    <li class="nav-item"><a class="nav-link" href="events_display.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="achievements_display.php">Achievements</a></li>
                    <li class="nav-item"><a class="nav-link" href="bookings_display.php">Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <div class="section">	
		<div class="container"> 
			<div class="row full-height justify-content-center">	
				<div class="col-12 text-center align-self-center py-5">	
						<div class="card-3d-wrap mx-auto">	
							<div class="card-3d-wrapper">	
								<div class="card-front">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Book Resources</h4>	
											<div class="form-group"> 
                                            <form method="post" name="book_form">
                                            <div class="form-group mt-2" > 
												<select name="sports_type" class="form-style" id="sports_type" onchange="configureDropDownLists(this,document.getElementById('num_resources'))" autocomplete="none" required>
                                                <option selected disabled hidden>Sports Type</option>	
                                                <option value="BasketBall">BasketBall</option>
		                                        <option value="ThrowBall">ThrowBall</option>
                                                <option value="VolleyBall">VolleyBall</option>
		                                        <option value="Chess">Chess</option>
		                                        <option value="Badminton">Badminton</option>
		                                        <option value="TableTennis">TableTennis</option>
                                                <option value="Carroms">Carroms</option>
                                            </select>
											</div>
                                            <div class="form-group mt-2"> 
                                            <select id="num_resources" name="num_resources" class="form-style" id="num_resources" autocomplete="none" required>
                                                <option selected disabled hidden>Number of resources required</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>	
											</div>
                                            <div class="form-group mt-3"> 
                                            <label class="text-light" style="font-family: 'Source Sans Pro', sans-serif;">Choose the time at which you need the resource:</label>
                                            <input type="time" id="time_slot" name="time_slot" style="color:white;" class="form-style bg-light text-dark" min="09:00" max="16:00" required>
                                            <!--min="09:00" max="16:00"-->
											</div>
											<button class="btn mt-4" name="booking_submit">Book Now!</button>
                                            </form>
                                            <?php
	                                            if(isset($_POST['booking_submit']))
	                                            {
                                                  $r=$_SESSION['rollno'];
	                                              $s=$_POST['sports_type'];
                                                  $n=$_POST['num_resources'];
                                                  $t=$_POST['time_slot'];
	                                              $c=mysqli_connect("localhost:3306","root","") or die("connection failed");
	                                              $db=mysqli_select_db($c,"bms");
                                                  $query= mysqli_query($c,"SELECT * FROM `resources` where sports_type='$s'");
                                                  $query1= mysqli_query($c,"SELECT * FROM `bookings` where time_slot='$t' and sports_type='$s'");
                                                  $rolquery=mysqli_query($c,"SELECT * FROM `register` where rollno='$r'");

                                                  $su=0;
                                                  $book=0;
                                                  if(mysqli_num_rows($rolquery)!=0){
                                                    while($xy=mysqli_fetch_assoc($rolquery)){
                                                        $out_year=$xy['out_year'];
                                                        $branch=$xy['branch'];
                                                        $section=$xy['section'];
                                                    }
                                                    $join_year=($out_year-4);
                                                    date_default_timezone_set('Asia/Kolkata');
                                                    $current_year= date("Y");
                                                    $f=($current_year-$join_year)+1;
                                                    require "vendor/autoload.php";
                                                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                                                    $spreadsheet = $reader->load("timetables/year-$f.xlsx");
                                                    $worksheet = $spreadsheet->getActiveSheet();
                                                    $count=0;
                                                    $times='';
                                                    $found_time=0;
                                                    $found_day=0;
                                                    $cur_time=date("h:i:s");
                                                    foreach ($worksheet->getRowIterator() as $row) {
                                                        $count+=1;
                                                        if($count==1){
                                                            $cellIterator = $row->getCellIterator();
                                                            $cellIterator->setIterateOnlyExistingCells(false);
                                                            $cc=0;
                                                            foreach ($cellIterator as $cell) { 
                                                                $cc+=1;
                                                                if($cc>1){
                                                                    $st=$cell->getValue();
                                                                    $arr=explode("-",$st);
                                                                    $start=$arr[0];
                                                                    $end=$arr[1];
                                                                    $tdt = new DateTime($t);
                                                                    $sdt = new DateTime($start);
                                                                    $edt = new DateTime($end);
                                                                    $ct= new DateTime($cur_time);
                                                                    $s1= new DateTime("8:45:00");
                                                                    $e1= new DateTime("15:45:00");
                                                                    $already_booked=mysqli_query($c,"SELECT * FROM `bookings` where rollno='$r' and returned=0");
                                                                    // if($ct>=$s1 && $ct<=$e1){
                                                                        //if($ct<=$tdt){
                                                                            if(mysqli_num_rows($already_booked)!=0){
                                                                                echo "<script type='text/javascript'>
                                                                                alert('Booking is allowed only after you take and return the resources allotted in your previous bookings!');
                                                                                window.location.href='book_resources.php';
                                                                                </script>";
                                                                            }
                                                                            else{
                                                                                if($tdt>=$sdt && $tdt<=$edt){
                                                                                    $times=implode("-",$arr);
                                                                                    $found_time=$cc;
                                                                                    break;
                                                                                }
                                                                            }
                                                                       /*}
                                                                        else{
                                                                            echo "<script type='text/javascript'>
                                                                                alert('Booking is allowed only from current time and later!');
                                                                                window.location.href='book_resources.php';
                                                                                </script>";
                                                                        }
                                                                    //}
                                                                    /*else{
                                                                        echo "<script type='text/javascript'>
                                                                        alert('You are not allowed to book a resource now! Try reserving them only between 8:45 AM and 3:45 PM!');
                                                                        window.location.href='book_resources.php';
                                                                        </script>";
                                                                    }*/
                                                                }
                                                            }
                                                        }   
                                                        else if($count>1){
                                                            $cellIterator = $row->getCellIterator();
                                                            $cellIterator->setIterateOnlyExistingCells(false);
                                                            $cc=0;
                                                            $current_day=strtolower(date("l"));
                                                            foreach ($cellIterator as $cell) { 
                                                                $cc+=1;
                                                                if($cc==1){
                                                                    $st=strtolower($cell->getValue());
                                                                    if(strcmp($st,$current_day)==0){
                                                                        $found_day=$count;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        } 
                                                        
                                                      } // worksheet end
                                                      $cellValue = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($found_time, $found_day)->getValue();
                                                        // echo $cellValue;
                                                        $arr1=explode(", ",$cellValue);
                                                        foreach($arr1 as $a){
                                                            $arr2=explode("-",$a);
                                                            if(strtolower($arr2[0])==$branch && strtolower($arr2[1])==$section){
                                                                $book=1;
                                                                break;
                                                            }
                                                        }
                                                        if($book==0){
                                                            echo "<script type='text/javascript'>
                                                            alert('You are not allowed to book a resource in given time slot, because it is not a sports hour!');
                                                            </script>";
                                                        }
                                                        else if($book==1){
                                                            if(mysqli_num_rows($query1)!=0)
                                                            {
                                                                while($row=mysqli_fetch_assoc($query1)){
                                                                    $su+=$row['num_resources'];
                                                                }
                                                            }
                                                            $m=0;
                                                            if(mysqli_num_rows($query)!=0){
                                                                while($row=mysqli_fetch_assoc($query)){
                                                                    $m=$row['max_num_resources'];
                                                                    $mg=$row['max_given'];
                                                                }
                                                            }
                                                            if($n>$mg){
                                                                echo "<script type='text/javascript'>
                                                                alert('Only $mg resources can be reserved for $s, booking failed!');
                                                                </script>";
                                                            }
                                                            else{
                                                                if($n<=($m-$su)){
                                                                    $ins=mysqli_query($c,"INSERT INTO `bookings`(sports_type,rollno,num_resources,booking_date,time_slot) VALUES('$s', '$r', '$n', NOW(),'$t')");
                                                                    if($ins!=NULL)
                                                                    {  
                                                                    echo "<script type='text/javascript'>
                                                                    alert('Booking Successful!');
                                                                    window.location.href='bookings_display.php';
                                                                    </script>";
                                                                    } 
                                                                }
                                                                else{
                                                                    $diff=$m-$su;
                                                                    if($diff==0)
                                                                        echo "<script type='text/javascript'>
                                                                        alert('Sorry, all $s resources are occupied in the $t timeslot, please try out some other time, or go with choosing other sports resources!');
                                                                        </script>";
                                                                    else if($diff<$n)
                                                                        {
                                                                        echo "<script type='text/javascript'>      
                                                                        alert('Sorry, only $diff $s resources are available in $t timeslot, please book $diff or less resources of $s or go with choosing other sports resources!');
                                                                        </script>";
                                                                        }
                                                                    }
                                                              }
                                                  }
                                                }
                                                }
                                            ?>												
										</div>	
									</div>	
								</div>	
									
							</div>	
						</div>	
					</div>	
				</div>	
			</div> 
		</div>	
	</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/agency.js"></script>



</body>
</html>