<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BMS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Inscriptional+Pahlavi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Clean-Button-Scale-Hover-Effect.css">
    <link rel="stylesheet" href="assets/css/dh-card-image-left-dark.css">
    <link rel="stylesheet" href="assets/css/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.css">
    <link rel="stylesheet" href="assets/css/Features-Cards-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="assets/css/Mega-Menu-Dropdown-100-Editable---Ambrodu.css">
    <link rel="stylesheet" href="assets/css/Search-Input-Responsive-with-Icon.css">
    <link rel="stylesheet" href="assets/css/select2-select2.css">
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
                    <li class="nav-item"><a class="nav-link" href="resources_admin.php">Resources</a></li>
                    <li class="nav-item"><a class="nav-link" style='color:#fed136;' href="timetable_admin.php">TimeTable</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <div class="m-5">
        <div id="backdrop" class="backdrop backdrop-transition backdrop-light">
            <div class="text-center w-100" style="position: absolute;top: 50%;">
                <div class="bg-light border rounded border-success shadow-lg m-auto" style="width: 150px;height: 150px;"><i class="fa fa-upload d-block p-4" style="font-size: 50px;"></i><span>Drop file to attach</span></div>
            </div>
        </div>
        <div class="bg-dark border rounded border-light pt-1 jumbotron py-5 px-4" style="padding-top: 8px;">
            <div class="alert alert-success invisible mt-5" role="alert"><span id="notify"></span></div>
            <h1><span style="color: rgb(255, 255, 255);">Upload TimeTables</span></h1>
            <form method="post" enctype="multipart/form-data">
            <div class="form-group mt-2"> 
				<select name="reg_year" class="form-style" id="reg_year" autocomplete="none" required>
                    <option selected disabled hidden>Select year of study</option>	
                    <option value="1">1</option>
		            <option value="2">2</option>
		            <option value="3">3</option>
		            <option value="4">4</option>
                </select>
            </div>
            <p><label class="form-label mt-2" for="form-files"><a class="btn btn-secondary btn-sm" role="button">Choose Files</a></label><span style="color: rgb(255, 255, 255);">&nbsp; &nbsp; &nbsp;or drag the files to anywhere on this page.</span><br></p>
            <p id="filecount" style="color:white !important;"><br></p>
            <div id="list"></div>
            <input class="form-control invisible" type="file" id="form-files" name="files" multiple="">
            <button class="btn btn-outline-primary d-block w-100" type="submit" name="sub" style="margin-top: 58px;">Submit</button>
            <button class="btn btn-danger mt-5" type="reset" onclick="clearFiles()">Reset</button>
            </form>
        </div>
        <div class="text-center bg-light border rounded border-dark shadow-lg p-3"><img id="image_preview" width="100">
            <div><button class="btn btn-warning btn-sm m-3" onclick="previewClose()">Close</button></div>
        </div>
    </div>
    <?php
        if(isset($_POST['sub'])){
            $y=$_POST['reg_year'];
            if (($_FILES['files']['name']!="")){
                $target_dir = "timetables/";
                $file = $_FILES['files']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['files']['tmp_name'];
                $path_filename_ext = $target_dir."year-".$y.".".$ext;
                
                // Check if file already exists
                if (file_exists($path_filename_ext)) {
                    unlink($path_filename_ext);
                }
                move_uploaded_file($temp_name,$path_filename_ext);

                error_reporting(0);
                ini_set('display_errors',0);

                require "excelReader/excel_reader2.php";
                require "excelReader/SpreadsheetReader.php";
                $reader=new SpreadsheetReader($path_filename_ext);
                $count=0;
                $table_name="timetable_year_".$y;
                $con=mysqli_connect("localhost","root","");
                mysqli_select_db($con,"bms");
                $mysqli = new mysqli("localhost","root","","bms");
                try{
                    $query=mysqli_query($con,"SELECT 1 FROM `$table_name` LIMIT 0");
                    if($query){
                        $drquery=mysqli_query($con,"DROP TABLE $table_name");
                        throw new Exception("dropped table, table doesn't exist");
                    }
                }
                catch(Exception $e){
                    // table not there
                    foreach($reader as $key=>$row){
                        $count+=1;
                        $day=$row[0];
                        $t1=$row[1];
                        $t2=$row[2];
                        $t3=$row[3];
                        $t4=$row[4];
                        $t5=$row[5];
                        $t6=$row[6];
                    if($count==1){
                        $crquery="CREATE TABLE IF NOT EXISTS $table_name (
                            "."$day varchar(30) primary key, 
                            "."`$t1` varchar(30), 
                            "."`$t2` varchar(30), 
                            "."`$t3` varchar(30), 
                            "."`$t4` varchar(30), 
                            "."`$t5` varchar(30), 
                            "."`$t6` varchar(30)
                            )
                            ";
                        $mysqli->query($crquery);
                    }
                    else if($count>1){
                        $ins=mysqli_query($con, "INSERT into `$table_name` values('$day','$t1','$t2','$t3','$t4','$t5','$t6')");
                    }
                    }    
                }
                echo "<script type='text/javascript'>
                alert('File uploaded succesfully');
                </script>";                              
            }
        }
        
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/agency.js"></script>
    <script src="assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-1.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.js"></script>
</body>

</html>