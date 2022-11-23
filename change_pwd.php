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
                    <li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>
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
						<div class="card-3d-wrap mx-auto">	
							<div class="card-3d-wrapper">	
								<div class="card-front">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Reset Password</h4>	
											<div class="form-group"> 
                                            <form method="post" name="reg_form">
												<input type="text" name="reg_roll" class="form-style" placeholder="Your complete Roll number" id="reg_roll" autocomplete="none" pattern="[1-9]{2}[2][5][1-5]{1}[A-Fa-f]{1}[0-5]{2}[\D\d][0-9]{1}" title="Enter complete roll number!" required>
												<i class="input-icon fa fa-at"></i>	
                                                </div>	
                                            <div class="form-group mt-2"> 
												<input type="text" name="verify_code" class="form-style" placeholder="Enter Verification code" id="verify_code" autocomplete="none" title="It is case-sensitive!" required>	
												<i class="input-icon fa fa-lock"></i>	
											</div>	
											<div class="form-group mt-2"> 
												<input type="password" name="new_pass" class="form-style" placeholder="Enter new password" id="new_pass" autocomplete="none"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters, can have special characters" required>	
												<i class="input-icon fa fa-lock"></i>	
											</div>	
											<button class="btn mt-4" name="verify_submit">Change password</button>
										    </form>	
											<?php
	                                            if(isset($_POST['verify_submit']))
	                                            {
	                                              $r=$_POST['reg_roll'];  
                                                  $v=$_POST['verify_code'];
                                                  $r=strtoupper($r);
                                                  $c=mysqli_connect("localhost:3306","root","") or die("connection failed");
	                                              $db=mysqli_select_db($c,"bms");
                                                  $q=mysqli_query($c,"SELECT * FROM `reset_password` where rollno='$r'");
                                                  if(mysqli_num_rows($q)!=0){
                                                    while ($row = mysqli_fetch_assoc($q)){
                                                        $verify=$row['verification_code'];
                                                    }
                                                    if($v==$verify){
                                                        $newp=$_POST['new_pass'];
                                                        $que=mysqli_query($c, "select * from `register` where rollno='$r'");
                                                        if(mysqli_num_rows($que)!=0){
                                                            while($row = mysqli_fetch_assoc($que)){
                                                                $old_pass=$row['pass'];
                                                            }
                                                            if($old_pass==MD5($newp))
                                                                echo "<script type='text/javascript'>
                                                                alert('Your new password cannot be the same as old password! Please try again.');
                                                                window.location.href='change_pwd.php';
                                                                </script>";
                                                            else{
                                                                $up=mysqli_query($c,"update `register` set pass=MD5('$newp') where rollno='$r'");
                                                                if($up!=0){
                                                                    $del=mysqli_query($c,"delete from `reset_password` where rollno='$r'");
                                                                    echo "<script type='text/javascript'>
                                                                    alert('Password updated successfully! You can login now with your new password.');
                                                                    window.location.href='login.php';
                                                                    </script>";
                                                                }
                                                            }
                                                        }
                                                        
                                                    }
                                                    else{
                                                        echo "<script type='text/javascript'>
                                                        alert('Verification code is wrong! Enter again! Note: It is case-sensitive.');
                                                        window.location.href='change_pwd.php';
                                                        </script>";
                                                    }
                                                  }
                                                  else{
                                                    echo "<script type='text/javascript'>
                                                    window.location.href='reset_pwd.php';
                                                    </script>";
                                                  }
                                                }
	                                        ?>
                                            <p class="mb-0 mt-2 text-center" style="color:#fff;"> 
												Didn't receive verification code? <a href="reset_pwd.php" class="link">Resend it!</a> 
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