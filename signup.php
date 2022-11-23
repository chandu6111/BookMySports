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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">Book My Sports</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>
                    <li class="nav-item"><a class="nav-link" href="signup.php" style='color:#fed136;' >SIGN UP</a></li>
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
					
						<div class="card-3d-wrap1 mx-auto">	
							<div class="card-3d-wrapper">	
								<div class="card-front">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Sign Up</h4>	
											<div class="form-group"> 
                                            <form method="post" name="reg_form">
												<input type="text" name="reg_roll" class="form-style" placeholder="Your complete Roll number" id="reg_roll" autocomplete="none" pattern="[1-9]{2}[2][5][1-5]{1}[A-Fa-f]{1}[0-5]{2}[\D\d][0-9]{1}" title="Enter complete roll number!" required>
												<i class="input-icon fa fa-at"></i>	
											</div>	
                                            <div class="form-group mt-2"> 
												<input type="text" name="reg_name" class="form-style" placeholder="Your Full name" id="reg_name" autocomplete="none" required>	
												<i class="input-icon fa fa-dot-circle-o"></i>	
											</div>
											<div class="form-group mt-2"> 
												<input type="text" name="reg_year" class="form-style" placeholder="Your Academic passout year" id="reg_year" autocomplete="none" required>	
												<i class="input-icon fa fa-dot-circle-o"></i>	
											</div>
                                            <div class="form-group mt-2"> 
												<input type="text" name="reg_ccode" class="form-style" placeholder="Country code (+91)" id="reg_ccode" autocomplete="none" required>	
												<i class="input-icon fa fa-phone-alt"></i>	
											</div>
                                            <div class="form-group mt-2"> 
												<input type="text" name="reg_phone" class="form-style" placeholder="Your Phone number" id="reg_phone" autocomplete="none" required>	
												<i class="input-icon fa fa-phone-alt"></i>	
											</div>
                                            <div class="form-group mt-2"> 
												<input type="email" name="reg_email" class="form-style" placeholder="Your Email ID" id="reg_email" autocomplete="none" required>	
												<i class="input-icon fa fa-at"></i>	
											</div>
                                            <div class="form-group mt-2"> 
												<select name="reg_branch" class="form-style" id="reg_branch" autocomplete="none" required>
                                                <option selected disabled hidden>Select your branch</option>	
                                                <option value="cse">CSE</option>
		                                        <option value="ece">ECE</option>
		                                        <option value="eee">EEE</option>
		                                        <option value="etm">ETM</option>
		                                        <option value="it">IT</option>
                                            </select>
												<i class="input-icon fa fa-chevron-right"></i>	
											</div>
                                            <div class="form-group mt-2"> 
												<select name="reg_sec" class="form-style" id="reg_sec" autocomplete="none" required>
                                                <option selected disabled hidden>Select your Section</option>	
                                                <option value="a">A</option>
		                                        <option value="b">B</option>
		                                        <option value="c">C</option>
                                            </select>
												<i class="input-icon fa fa-chevron-right"></i>	
											</div>
                                            <div class="form-group mt-2" id="show_hide_password" > 
												<input type="password" name="reg_pass" class="form-style" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters, can have special characters" placeholder="Your Password" id="reg_pass" autocomplete="none" required>	
                                                <i class="input-icon fa fa-lock"></i>
                                                <!--i class="input-icon fa fa-eye-slash" aria-hidden="true"></i-->
											</div>	
											<button class="btn mt-4" name="reg_submit">Register</button>
                                            </form>
                                            <?php
                                                function validate_mobile($mobile)
                                                {
                                                    return preg_match('/^[0-9]{10}+$/', $mobile);
                                                }
	                                            if(isset($_POST['reg_submit']))
	                                            {
	                                              $r=$_POST['reg_roll'];
                                                  $n=$_POST['reg_name'];
	                                              $y=$_POST['reg_year'];
                                                  $co=$_POST['reg_ccode'];
	                                              $m=$_POST['reg_phone'];
	                                              $e=$_POST['reg_email'];
	                                              $b=$_POST['reg_branch'];
	                                              $s=$_POST['reg_sec'];
	                                              $p=$_POST['reg_pass'];  
                                                  $r=strtoupper($r);
                                                  if(!validate_mobile($m))
														echo "<script type='text/javascript'>
														alert('Phone number is not valid, it should contain only \'10 digits\' it should not have any other characters except numbers! Please enter valid phone number.');
                                                        window.location.href='signup.php';
														</script>";
                                                  /*
                                                        // Include library file
                                                  require_once 'VerifyEmail.class.php';     
                                                  // Initialize library class
                                                  $mail = new VerifyEmail();    
                                                  // Set the timeout value on stream
                                                  $mail->setStreamTimeoutWait(20);    
                                                  // Set debug output mode
                                                  $mail->Debug= TRUE; 
                                                  $mail->Debugoutput= 'html';     
                                                  // Set email address for SMTP request
                                                  $mail->setEmailFrom('dvs6112001@gmail.com');    
                                                  // Email to check
                                                  $email = $e;     
                                                  // Check if email is valid and exist
                                                  if(!($mail->check($email))){ 
                                                    echo "<script type='text/javascript'>
                                                    alert('Mail ID $email is not valid, it doesn't exist at all! please enter the correct email id');
                                                    window.location.href='signup.php';
                                                    </script>";
                                                      //echo 'Email &lt;'.$email.'&gt; exist!'; 
                                                      //if(verifyEmail::validate($email)) 
                                                        //echo 'Email &lt;'.$email.'&gt; is valid, but not exist!'; 
                                                  }
                                                  */
                                                  if($y<date("Y"))
                                                        echo "<script type='text/javascript'>
                                                        alert('Sorry, you are not allowed to avail resources!');
                                                        </script>;
                                                        window.location.href='index.html'";
                                                  else{
                                                    $c=mysqli_connect("localhost:3306","root","") or die("connection failed");
	                                              $db=mysqli_select_db($c,"bms");
                                                  $q=mysqli_query($c,"SELECT * FROM `register` where rollno='$r'");
                                                  if(mysqli_num_rows($q)!=0){
                                                    echo "<script type='text/javascript'>
                                                    alert('Account with rollno $r already exists, please login now!');
                                                    window.location.href='login.php';
                                                    </script>";
                                                  }
	                                              $ins=mysqli_query($c,"INSERT INTO `register`(rollno,fullname,out_year,country_code,phone,email,branch,section,pass) VALUES('$r','$n','$y','$co','$m','$e','$b','$s',MD5('$p'))");
                                                  if($ins!=NULL)
                                                   {  
                                                    echo "<script type='text/javascript'>
                                                    alert('Registered Successfully, you can Login now!');
                                                    window.location.href='login.php';
                                                    </script>";
                                                    } 
                                                    
                                                }
                                                  }
	                                              
	  
                                            ?>
											<p class="mb-0 mt-4 text-center" style="color:#fff;"> 
												Already have an account? <a href="login.php" class="link">Login here</a> 
											</p>	
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






