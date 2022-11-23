<?php
    session_start();
    $r=$_SESSION['rollno'];
    $c=mysqli_connect("localhost:3306","root","") or die("connection failed");
	$db=mysqli_select_db($c,"bms");
    $query=mysqli_query($c,"SELECT * from `register` WHERE rollno='$r'");
    session_unset();
    if(mysqli_num_rows($query)!=0){
        while($row=mysqli_fetch_assoc($query)){
            $f=$row['fullname'];
            echo "<script type='text/javascript'>
            alert('Thank you for logging in $f, you are logged out now!');
            window.location.href='index.php';
            </script>";
        }
    }
?>