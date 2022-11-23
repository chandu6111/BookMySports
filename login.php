<!DOCTYPE html>
<html>
	<?php
        session_start();
    ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BMS</title>
	<link rel="stylesheet" href="loginstyle.css">
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
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">Book My Sports</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php" style='color:#fed136;' >LOGIN</a></li>
                    <li class="nav-item"><a class="nav-link" href="signup.php">SIGN UP</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
	<br>
	<br>
	<div class="section">	
		<div class="container"> 
			<div class="row full-height justify-content-center">	
				<div class="col-12 text-center align-self-center py-5">	
					<div class="section pb-5 pt-5 pt-sm-2 text-center">	
						<h6 class="mb-0 pb-3"><span>Student Login </span><span>Admin Login</span></h6>	
						<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>	
						<label for="reg-log"></label>	
						<div class="card-3d-wrap mx-auto">	
							<div class="card-3d-wrapper">	
								<div class="card-front">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Student Login</h4>	
											<div class="form-group"> 
											<form method="post" name="log_form">
												<input type="text" name="log_roll" class="form-style" placeholder="Your Roll number" id="log_roll" autocomplete="none"  pattern="[1-9]{2}[2][5][1-5]{1}[A-Fa-f]{1}[0-5]{2}[\D\d][0-9]{1}" title="Enter complete roll number!" required>	
												<i class="input-icon fa fa-at"></i>	
											</div>	
											<div class="form-group mt-2"> 
												<input type="password" name="log_pass" class="form-style" placeholder="Your Password" id="log_pass" autocomplete="none"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters, can have special characters" required>	
												<i class="input-icon fa fa-lock"></i>	
											</div>	
											<button class="btn mt-4" name="log_submit">Login</button>
										    </form>
											<?php
												
	                                            if(isset($_POST['log_submit']))
	                                            {
	                                              $r=$_POST['log_roll'];
	                                              $p=$_POST['log_pass'];
                                                  $r=strtoupper($r);
												$con=mysqli_connect("localhost","root","");
												mysqli_select_db($con,"bms");
												$query="SELECT `rollno`, `pass` FROM `register` WHERE `rollno`='$r' && `pass`= MD5('$p')";
												$res=mysqli_query($con,$query);
												if(mysqli_num_rows($res)!=0)
												{
													$_SESSION['rollno']=$r;
													echo "<script type='text/javascript'>
														alert('Login Succesful. Welcome $r');
														window.location.href='student_home.php';
														</script>";
												}
												else
												{
													$query1="SELECT `rollno`, `pass` FROM `register` WHERE `rollno`='$r' && `pass`!=MD5('$p')";
													$res1=mysqli_query($con,$query1);
													if(mysqli_num_rows($res1)!=0)
													{
														echo "<script type='text/javascript'>
														alert('Password mismatch! Please type correct password again.');
														</script>";
													}
													else
													{
														echo "<script type='text/javascript'>
														alert('There is no account with the rollno $r. We are navigating you to the signup page, Please create an account now!');
														window.location.href='signup.php';
														</script>";
													}
												}
	                                               
                                            }
	  
                                            ?>
											<p class="mb-0 mt-4 text-center" style="color:#fff;"> 
												Don't have an account? <a href="signup.php" class="link">Register here</a> 
											</p>	
											<p class="mb-0 mt-2 text-center" style="color:#fff;"> 
												Forgot password? <a href="reset_pwd.php" class="link">Reset password</a> 
											</p>	
										</div>	
									</div>	
								</div>	
								<div class="card-back">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Admin Login</h4>		
											<div class="form-group mt-2"> 
												<form method="post" name="log_adm_form">
												<input type="text" name="log_adm_id" class="form-style" placeholder="Admin ID" id="log_adm_id" autocomplete="none" required>	
												<i class="input-icon fa fa-at"></i>	
											</div>	
											<div class="form-group mt-2"> 
												<input type="password" name="log_adm_pass" class="form-style" placeholder="Password" id="log_adm_pass" autocomplete="none" required>	
												<i class="input-icon fa fa-lock"></i>	
											</div>	
											<button class="btn mt-4" name="log_adm_submit">Login</button>
										</form>
										<?php
											if(isset($_POST['log_adm_submit']))
											{
												$r=$_POST['log_adm_id'];
												$p=$_POST['log_adm_pass'];
												if($r=="gnits_admin" && $p=='admin')
													echo "<script type='text/javascript'>
													alert('Login Succesful. Welcome!');
													window.location.href='admin_home.php';
													</script>";
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






