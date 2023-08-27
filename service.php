<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Woody - Carpenter Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


       <?php 
       include 'includes/TopBar.php';
       include 'includes/NavBar.php';
       ?>
    
       

    <!-- Page Header Start -->  
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Service</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Service</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


   <!-- Car Listing Start -->
<?php
require_once 'AdminDash/Controllers/AdminControllers/Vehicle.php';
require_once 'AdminDash/Model/ConnectionController.php';      
$vehicleObj = new Vehicle();

// Get the count of vehicles
$vehicleCount = $vehicleObj->countVehicles();

// Initialize loopIndex
$loopIndex = 0;

// Generate HTML cards for each vehicle
for ($i = 1; $i <= 1000; $i++) {
    try {        
        $vehicleData = $vehicleObj->getVehicleData($i);

        if ($vehicleData) {
            // Extract vehicle data
            $carModel = $vehicleData['CarModel'];
            $carType = $vehicleData['CarType'];
            $dailyRate = $vehicleData['DailyRate'];
            $seatingCapacity = $vehicleData['SeatingCapacity'];
            $year = $vehicleData['Year'];
            $fuelType = $vehicleData['FuelType'];
            $carID = $vehicleData['CarID'];
            $imageURL = $vehicleData['ImageURL'];

            // Output a new row at every third iteration
            if ($loopIndex % 3 == 0) {
                echo '<div class="row">';
            }
            ?>
            <div class="col-md-4">
                <div class="product-card" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; background-color: #fff;">
                    <div class="product-card-img">
                        <img src="AdminDash/Controllers/VehImg/<?php echo $imageURL ?>" class="img-responsive" alt="Image" style="max-width: 100%; height: auto;">
                    </div>
                    <div class="product-card-content">
                        <h5><a href="vehical-details.php?vhid=<?php echo $carID; ?>"><?php echo $carModel; ?>, <?php echo $carType; ?></a></h5>
                        <p class="list-price">$<?php echo $dailyRate; ?> Per Day</p>
                        <ul>
                            <li><i class="fa fa-user" aria-hidden="true"></i> <?php echo $seatingCapacity; ?> seats</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $year; ?> model</li>
                            <li><i class="fa fa-car" aria-hidden="true"></i> <?php echo $fuelType; ?></li>
                        </ul>
                        <a href="vehicleDetails.php?vhid=<?php echo $carID; ?>" class="btn btn-primary">View Details <span class="fa fa-angle-right"></span></a>
                     
                    </div>            
                </div>
            </div>
            <?php
            // Close the row tag after every third iteration
            if ($loopIndex % 3 == 2 || $i == $vehicleCount) {
                echo '</div>';
            }
            $loopIndex++;
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}
?>

 
          

    <!-- Testimonial Start -->
     
     <!-- include 'includes/Testimonial.php';
    include 'includes/Footer.php' -->
     
           

   


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>