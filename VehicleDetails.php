 
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Woody - Carpenter Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

      <!-- Libraries Stylesheet -->
      <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Google Web Fonts -->
    <!-- ... (fonts) ... -->

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
    /* Adjust the carousel height */
    #listing_img_slider {
    max-height: 280px; /* Adjust the value as needed */
}
</style>
<body>
 <!-- Spinner Start -->
 <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->


       <?php 
       include 'includes/TopBar.php';
       include 'includes/NavBar.php';
       ?>

<?php
require_once 'AdminDash/Controllers/AdminControllers/Vehicle.php';
require_once 'AdminDash/Model/ConnectionController.php';

if (isset($_GET['vhid']) && is_numeric($_GET['vhid'])) {
    $carID = $_GET['vhid'];
    $vehicleObj = new Vehicle();
    // Fetch the images associated with the vehicle
    $images = $vehicleObj->getVehicleImages($carID);
}
?>
<?php if (!empty($images)) { ?>
    <section id="listing_img_slider">
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($images as $index => $imageFilename): ?>
                    <?php $imageUrl = "AdminDash/Controllers/VehImg/" . $imageFilename; ?>
                    <?php $activeClass = ($index === 0) ? 'active' : ''; ?>
                    <div class="carousel-item <?php echo $activeClass; ?>">
                        <img src="<?php echo $imageUrl; ?>" class="d-block w-100" alt="Image">
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev" data-target="#carouselExample" data-slide-to="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next" data-target="#carouselExample" data-slide-to="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>

        </div>
    </section>
<?php 
} else {
    echo "No images available for this vehicle.";
}
?>



</body>
</html>
