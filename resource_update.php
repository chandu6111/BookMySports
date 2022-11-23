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
                    <li class="nav-item"><a class="nav-link" href="achievements_admin.php">Achievements</a></li>
                    <li class="nav-item"><a class="nav-link" style='color:#fed136;' href="resources_admin.php">Resources</a></li>
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
						<div class="card-3d-wrap mx-auto" style="height:460px !important;">	
							<div class="card-3d-wrapper">	
								<div class="card-front">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Update Resources</h4>	
											<div class="form-group"> 
                                            <form method="post" name="res_form">
                                            <?php
                                                $con=mysqli_connect("localhost","root","");
                                                mysqli_select_db($con,"bms");
                                                $retr=mysqli_query($con,"SELECT * FROM `resources`");
                                                if(mysqli_num_rows($retr)!=0){
                                                    echo "<div class='form-group mt-2'> 
                                                    <select name='sports_type' class='form-style' id='sports_type' autocomplete='none' required>
                                                        <option selected disabled hidden>Sports Type</option>";
                                                        while($x=mysqli_fetch_assoc($retr)){
                                                            $s=$x["sports_type"];
                                                            echo "<option value='$s'>$s</option>";
                                                        }
                                                    echo "</select>
                                                </div>";
                                                }
                                            ?>
                                            <div class="form-group mt-2">
                                            <select name="opt" class="form-style" id="opt" autocomplete="none" required>
                                                <option selected disabled hidden>Add/Delete</option>	
                                                <option value="Add">Add</option>
		                                        <option value="Remove">Remove</option>
                                            </select>
											</div>
                                            <div class="form-group mt-2">
                                            <select name="opt1" class="form-style" id="opt1" autocomplete="none" required>
                                                <option selected disabled hidden>What to update?</option>	
                                                <option value="Number of Resources">Number of Resources</option>
		                                        <option value="Maximum Given">Maximum Given</option>
                                            </select>
											</div>
                                            <div class="form-group mt-3"> 
                                            <input type="number" id="num_res" name="num_res" style="color:white;" class="form-style" min=1 placeholder="How many to add/delete?" required>
											</div>
											<button class="btn mt-4" name="res_submit">Update Resources!</button>
                                            </form>
                                            <?php
	                                            if(isset($_POST['res_submit']))
	                                            {
                                                    $stype=$_POST["sports_type"];
                                                    $opt=$_POST["opt"];
                                                    $opt1=$_POST["opt1"];
                                                    $num_res=$_POST["num_res"];
                                                    $con=mysqli_connect("localhost","root","");
                                                    mysqli_select_db($con,"bms");
                                                    $query=mysqli_query($con,"SELECT * FROM `resources` where sports_type='$stype'");
                                                    if(mysqli_num_rows($query)!=0){
                                                        while($x=mysqli_fetch_assoc($query)){
                                                            $m=$x["max_num_resources"];
                                                            $mg=$x["max_given"];
                                                        }
                                                        if($opt=='Add')
                                                        {
                                                            if($opt1=="Number of Resources"){
                                                                $m+=$num_res;
                                                                $ins=mysqli_query($con,"UPDATE `resources` SET `max_num_resources`='$m' WHERE `sports_type`='$stype'");
                                                                if($ins!=NULL)
                                                                    echo "<script type='text/javascript'>
                                                                    alert('$num_res $stype resources are added succesfully!');
                                                                    </script>";
                                                            }
                                                            else{
                                                                $mg+=$num_res;
                                                                $ins=mysqli_query($con,"UPDATE `resources` SET `max_given`='$mg' WHERE `sports_type`='$stype'");
                                                                if($ins!=NULL)
                                                                    echo "<script type='text/javascript'>
                                                                    alert('Updation succesfully!');
                                                                    </script>";
                                                            }
                                                        }
                                                        else{
                                                            if($opt1=="Number of Resources"){
                                                                if($num_res<=$m){
                                                                    $m-=$num_res;
                                                                    $ins=mysqli_query($con,"UPDATE `resources` SET `max_num_resources`='$m' WHERE `sports_type`='$stype'");
                                                                    if($ins!=NULL)
                                                                        echo "<script type='text/javascript'>
                                                                        alert('Deletion succesful! $num_res $stype resources are deleted.');
                                                                        </script>";
                                                                }
                                                                else
                                                                    echo "<script type='text/javascript'>
                                                                    alert('Deletion failed! Since, Number of resources you wanted to delete are greater than available resources.');
                                                                    </script>";
                                                            }
                                                            else{
                                                                if($num_res<=$mg){
                                                                    $mg-=$num_res;
                                                                    $ins=mysqli_query($con,"UPDATE `resources` SET `max_given`='$mg' WHERE `sports_type`='$stype'");
                                                                    if($ins!=NULL)
                                                                        echo "<script type='text/javascript'>
                                                                        alert('Deletion succesful!');
                                                                        </script>";
                                                                }
                                                                else
                                                                    echo "<script type='text/javascript'>
                                                                    alert('Deletion failed! Since, Number of resources you wanted to delete are greater than available resources.');
                                                                    </script>";
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
    <script src="assets/js/agency.js"></script>
</body>

</html>