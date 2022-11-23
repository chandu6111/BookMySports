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
						<div class="card-3d-wrap mx-auto" style="height:400px !important;">	
							<div class="card-3d-wrapper">	
								<div class="card-front">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Update Resources</h4>	
											<div class="form-group"> 
                                            <form method="post" name="res_form">
                                            <div class="form-group mt-2">
                                                <input type="text" id="sports_type" name="sports_type" style="color:white;" class="form-style" min=1 placeholder="Name of the Sports" required>
											</div>
                                            <div class="form-group mt-3"> 
                                                <input type="number" id="num_res" name="num_res" style="color:white;" class="form-style" min=1 placeholder="How many resources to add?" required>
											</div>
                                            <div class="form-group mt-3"> 
                                                <input type="number" id="max_given" name="max_given" style="color:white;" class="form-style" min=1 placeholder="How many can be given maximum?" required>
											</div>
											<button class="btn mt-4" name="res_submit">Add new Sports</button>
                                            </form>
                                            <?php
	                                            if(isset($_POST['res_submit']))
	                                            {
                                                    $sty=$_POST["sports_type"];
                                                    $stype = preg_replace("/\s+/", "", $sty);
                                                    $num_res=$_POST["num_res"];
                                                    $m=$_POST["max_given"];
                                                    $con=mysqli_connect("localhost","root","");
                                                    mysqli_select_db($con,"bms");
                                                    $ins=mysqli_query($con,"INSERT into `resources`(sports_type,max_num_resources,max_given) values('$stype','$num_res','$m')");
                                                    if($ins!=NULL){
                                                        echo "<script type='text/javascript'>
                                                        alert('$stype resources are added succesfully!');
                                                        window.location.href='resource_avail_admin.php';
                                                        </script>";
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