<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BMS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Toggle-Switches.css">
    <link rel="stylesheet" href="assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">

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
    <div class="d-block" style="height: 120px;">
        <div class="container" style="height: 30px;">
            <div class="row" style="height: 30px;">
                <div class="col-md-12" style="height: 30px;">
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card" id="TableSorterCard">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive d-lg-flex justify-content-lg-end">
                        <table class="table table-striped table tablesorter" id="ipi-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" style="border-right-width: 4px;border-right-color: var(--bs-card-bg);padding-right:50px;">Name of Sports</th>
                                    <th class="text-center" style="border-right-width: 4px;border-right-color: var(--bs-card-bg);">Available Resources</th>
                                    <th class="text-center">Maximum Given</th>
                                </tr>
                            </thead>
                            <?php
                                $con=mysqli_connect("localhost","root","");
                                $db=mysqli_select_db($con,"bms");
                                $res = mysqli_query($con,"SELECT * FROM `resources`");
                                while($x=mysqli_fetch_assoc($res)){
                                    $stype=$x["sports_type"];
                                    $num_res=$x["max_num_resources"];
                                    $mg=$x["max_given"];
                                    echo "<tbody class='text-center'>
                                    <tr>
                                    <td style='border-right-width: 4px;border-right-color: var(--bs-card-bg);'>$stype</td>
                                    <td style='border-right-width: 4px;border-right-color: var(--bs-card-bg);'>$num_res</td>
                                    <td>$mg</td>
                                    </tr>
                                    <tr></tr>
                                    </tbody>";
                                }     
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/agency.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-1.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.js"></script>
</body>

</html>