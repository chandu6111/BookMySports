<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BMS</title>
    <link rel="stylesheet" href="adminstyle.css">
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
    <br>
    <br>
    <div class="section">	
		<div class="container"> 
			<div class="row full-height justify-content-center">	
				<div class="col-12 text-center align-self-center py-5">	
						<div class="card-3d-wrap mx-auto" style="height:700px;">	
							<div class="card-3d-wrapper">	
								<div class="card-front">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Update Achievements</h4>	
											<div class="form-group"> 
                                            <form method="post" name="ach_form" enctype="multipart/form-data">
                                            <div class="form-group mt-2"> 
                                                <input type="text" name="event_name" class="form-style" placeholder="Event Name" id="event_name" autocomplete="none" required>	
											</div>
                                            <div class="form-group mt-2"> 
                                                <textarea name="ach_desc" class="form-style" placeholder="Achievement Description" rows="4" cols="50" id="ach_desc" autocomplete="none" required></textarea>
											</div>
                                            <div class="form-group mt-2">
                                            <sub style="color:white;">
                                                (You can enter multiple rollnos with
                                                each separated by comma)
                                            </sub> 
                                                <input type="text" name="ach_rolls" class="form-style" placeholder="Roll Numbers of students" id="ach_rolls" autocomplete="none" required multiple size="50">
											</div>
                                            <div class="form-group mt-3"> 
                                            <label class="text-light" style="font-family: 'Source Sans Pro', sans-serif; font-size: 16px; float:left !important;">Event Start Date:</label>
                                            <input type="date" id="event_from_date" name="event_from_date" class="form-style bg-light text-dark" required>
											</div>
                                            <div class="form-group mt-3"> 
                                            <label class="text-light" style="font-family: 'Source Sans Pro', sans-serif; font-size: 16px; float:left !important;">Event End Date:</label>
                                            <input type="date" id="event_to_date" name="event_to_date" class="form-style bg-light text-dark" required>
											</div>
                                            <div class="form-group mt-3"> 
                                                <label class='text-light' style="font-family: 'Source Sans Pro', sans-serif; font-size: 16px; float:left !important;">Select Achievement Image:</label>
                                                <input type="file" name="ach_image" id="ach_image" class='bg-light text-dark' style="
                                                width: 100%;
                                                font-weight: 500;
                                                border-radius: 4px;" required>
                                            </div>
											<button class="btn mt-4" name="ach_submit">Update Achievement!</button>
                                            </form>
                                            <?php
	                                            if(isset($_POST['ach_submit']))
	                                            {
                                                    $ename=$_POST["event_name"];
	                                                $adesc=$_POST["ach_desc"];
                                                    $esdate=$_POST["event_from_date"];
                                                    $eedate=$_POST["event_to_date"];
                                                    $arolls=$_POST["ach_rolls"];
                                                    $arr=explode(",",$arolls);
                                                    $con=mysqli_connect("localhost","root","");
                                                    mysqli_select_db($con,"bms");
                                                    date_default_timezone_set('Asia/Kolkata');
                                                    $current_date=date("Y-m-d");
                                                    if($esdate>$current_date || $eedate>$current_date){
                                                        echo "<script type='text/javascript'>
                                                        alert('You cannot enter future dates for achievements! only present and past achievements can be added!');
                                                        window.location.href='achievements_update.php';
                                                        </script>";
                                                    }
                                                    $query=mysqli_query($con,"select max(ach_id) as `maxid` from `achievements`");
                                                    if(mysqli_num_rows($query)!=0){
                                                        while($row=mysqli_fetch_assoc($query)){
                                                            $m=$row["maxid"];
                                                        }
                                                    }
                                                    $m+=1;
                                                    if (($_FILES['ach_image']['name']!="")){
                                                        $target_dir = "achievement_images/";
                                                        $file = $_FILES['ach_image']['name'];
                                                        $path = pathinfo($file);
                                                        $filename = $path['filename'];
                                                        $ext = $path['extension'];
                                                        $temp_name = $_FILES['ach_image']['tmp_name'];
                                                        $path_filename_ext = $target_dir."achievement-".$m.".".$ext;
                                                    
                                                        // Check if file already exists
                                                        if (file_exists($path_filename_ext)) {
                                                            unlink($path_filename_ext);
                                                        }
                                                        

                                                        if(!empty($_FILES["ach_image"]["name"])) { 
                                                            // Get file info 
                                                            $fileName = basename($_FILES["ach_image"]["name"]); 
                                                            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                                                             
                                                            // Allow certain file formats 
                                                            $allowTypes = array('jpg'); 
                                                            if(in_array($fileType, $allowTypes)){ 
                                                                $image = $_FILES['ach_image']['tmp_name']; 
                                                                $imgContent = addslashes(file_get_contents($image)); 
                                                                
                                                                $ins=mysqli_query($con,"insert into `achievements`(ach_id,event_name,ach_desc,event_from_date,event_to_date) values('$m','$ename','$adesc','$esdate','$eedate')");
                                                                $var=0;
                                                                if($ins!=NULL){
                                                                        foreach($arr as $y){
                                                                            $ins1=mysqli_query($con,"INSERT INTO `achievement_normalise`(`ach_id`, `rollno`) VALUES ('$m','$y')");
                                                                            $var=1;
                                                                        }
                                                                }
                                                                if($var!=0){
                                                                    move_uploaded_file($temp_name,$path_filename_ext);
                                                                        echo "<script type='text/javascript'>
                                                                        alert('Achievement succesfully added!');
                                                                        window.location.href='achievements_display_admin.php';
                                                                        </script>";
                                                                } 
                                                                else{
                                                                    echo "<script type='text/javascript'>
                                                                    alert('Achievement update failed!');
                                                                    window.location.href='achievements_display_admin.php';
                                                                    </script>";
                                                                }
                                                                
                                                            }else{ 
                                                                echo "<script type='text/javascript'>
                                                                alert('Sorry, only JPG files are allowed to upload.');
                                                                </script>";
                                                            } 
                                                        }else{ 
                                                            echo "<script type='text/javascript'>
                                                            alert('Please select an image file to upload.'; 
                                                            </script>";
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
    <script src="assets/js/agency.js"></script>
</body>

</html>