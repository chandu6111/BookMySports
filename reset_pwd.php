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
						<div class="card-3d-wrap mx-auto" style="height:300px;">	
							<div class="card-3d-wrapper">	
								<div class="card-front">	
									<div class="center-wrap">	
										<div class="section text-center">	
											<h4 class="mb-4 pb-3">Reset Password</h4>	
											<div class="form-group"> 
                                            <form method="post" name="reg_form">
												<input type="text" name="reg_roll" class="form-style" placeholder="Your complete Roll number" id="reg_roll" autocomplete="none" pattern="[1-9]{2}[2][5][1-5]{1}[A-Fa-f]{1}[0-5]{2}[\D\d][0-9]{1}" title="Enter complete roll number!" required>
												<i class="input-icon fa fa-at"></i>	
                                                <button class="btn mt-2" name="verify_submit">Send verification code</button>
                                            </form>
											</div>	
											<?php
                                                function generateRandomString($length) {
                                                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$%^&*';
                                                    $charactersLength = strlen($characters);
                                                    $randomString = '';
                                                    for ($i = 0; $i < $length; $i++) {
                                                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                                                    }
                                                    return $randomString;
                                                }
	                                            if(isset($_POST['verify_submit']))
	                                            {
	                                              $r=$_POST['reg_roll'];  
                                                  $r=strtoupper($r);
                                                  $c=mysqli_connect("localhost","root","") or die("connection failed");
	                                              $db=mysqli_select_db($c,"bms");
                                                  $q=mysqli_query($c,"SELECT * FROM `register` where rollno='$r'");
                                                  if(mysqli_num_rows($q)!=0){
                                                    while ($row = mysqli_fetch_assoc($q)){
                                                        $ccode=$row['country_code'];
                                                        $mob=$row['phone'];
                                                    }
                                                    $phoneNum=$ccode.$mob;
                                                    require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
                                                    // use Twilio\Rest\Client;
                                                    // Your Account SID and Auth Token from twilio.com/console
                                                    $account_sid = 'xxx';
                                                    $auth_token = 'xxx';
                                                    // In production, these should be environment variables. E.g.:
                                                    // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
                                                    $randstring=generateRandomString(6);
                                                    // A Twilio number you own with SMS capabilities
                                                    $twilio_number = "xxxx";
                                                    $client = new Twilio\Rest\Client($account_sid, $auth_token);
                                                    $client->messages->create(
                                                        // Where to send a text message (your cell phone?)
                                                        $phoneNum,
                                                        array(
                                                            'from' => $twilio_number,
                                                            'body' => "You have requested to reset your password on the Book My Sports website. Here is the verification code: $randstring",
                                                        )
                                                    );
                                                    $q1=mysqli_query($c,"SELECT * FROM `reset_password` where rollno='$r'");
                                                    if(mysqli_num_rows($q1)!=0){
                                                        $up=mysqli_query($c,"update `reset_password` set verification_code='$randstring' where rollno='$r'");
                                                    }
                                                    else{
                                                        $ins=mysqli_query($c,"insert into `reset_password` values('$r','$randstring')");
                                                    }
                                                    if($ins!=NULL || $up!=0)
                                                        echo "<script type='text/javascript'>
                                                        alert('Notification sent succesfully to your mobile $phoneNum');
                                                        window.location.href='change_pwd.php';
                                                        </script>";
                                                    else
                                                        echo "<script type='text/javascript'>
                                                        alert('Notification failed!');
                                                        window.location.href='reset_pwd.php';
                                                        </script>";
                                                  }
                                                  else
                                                    echo "<script type='text/javascript'>
                                                    alert('Account with roll number $r does not exist! sign up now');
                                                    window.location.href='signup.php';
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