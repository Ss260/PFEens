 
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>C-rental Vehicle Details</title>
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
     <!-- Include Bootstrap CSS and JS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
    /* Remove margins and padding */
    body, html {
        margin: 0;
        padding: 0;
    }

    /* Style the container */
    #carouselContainer {
        width: 100%; /* Full width */
        padding: 0; /* No padding */
        box-sizing: border-box; /* Make sure padding is included in width */
        overflow: hidden; /* Hide any overflowing content */
    }

    /* Style the carousel */
    #imageCarousel {
        max-height: 588px; /* Adjust the height as needed */
        width: 100%; /* Full width */
        margin: 0; /* No margin */
    }

    /* Style the individual images */
    #image-gallery img {
        width: 100%; /* Make the image fill the available width */
        height: auto; /* Maintain the aspect ratio */
        margin: 10px;
        object-fit: contain; /* Fit the image within the container */
    }
</style>
 
<style>
        body {
            font-family: Arial, sans-serif;
        }
        .listing-detail {
            padding: 60px 0;
        }
        .price_info p {
            font-size: 18px;
            margin: 0;
        }
        .main_features ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
        }
        .main_features li {
            flex: 1;
            text-align: center;
            padding: 20px;
            border: 1px solid #e2e2e2;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        /* Other styling classes as provided */
        #other_info {
            display: block;
        }
        #info_toggle {
            display: none;
        }
        .listing_other_info button {
            font-size: 14px;
            margin: 0 20px 0 0;
        }
        .banner_content {
            padding: 0px;
        }

        #bookNowSection {
    background-color: #f7f7f7;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

#bookNowSection label {
    display: block;
    margin-bottom: 5px;
}

#bookNowSection input[type="date"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#bookNowSection button {

    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

 

    </style>
 
<body>
 <!-- Spinner Start -->
  
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
    <div id="carouselContainer">
        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($images as $index => $imageFilename): ?>
                    <?php $imageUrl = "AdminDash/Controllers/VehImg/" . $imageFilename; ?>
                    <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                        <img src="<?php echo $imageUrl; ?>" class="d-block w-100" alt="Image">
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
    
    <?php } else {
        echo "No images available for this vehicle.";
    } 
    
    ?> 
        <?php
    require_once 'AdminDash/Controllers/AdminControllers/Vehicle.php';
    require_once 'AdminDash/Model/ConnectionController.php';

    if (isset($_GET['vhid']) && is_numeric($_GET['vhid'])) {
        $carID = $_GET['vhid'];
        $vehicleObj = new Vehicle();
        // Fetch the vehicle data
        $result = $vehicleObj->getVehicleData($carID);
        $availability = $result['Availability']; // Added Availability
    
    // Determine the availability status text
    $availabilityText = ($availability == 1) ? 'Available' : 'Unavailable';
 // Default values for total amount and currency
 $totalAmountDisplay = "0 Dirhams";
 $currency = "Dirhams"; // Change to the appropriate currency text
 $totalAmount = 0;

 // Calculate the total amount based on the selected dates and car price
 if (isset($_POST['fromDate']) && isset($_POST['toDate'])) {
     $carPrice = floatval($result['DailyRate']);
     $pickupDate = new DateTime($_POST['fromDate']);
     $returnDate = new DateTime($_POST['toDate']);
     $days = $returnDate->diff($pickupDate)->days;
     $totalAmount = $carPrice * $days;
     $carID = $_GET['vhid'];

     // Update the total amount and display text
     $totalAmountDisplay = $totalAmount . " " . $currency;
     
 }
        
    }
    ?>
        <!-- Displaying Car Details -->

<section class="listing-detail">
    <div class="container">
        <div class="listing_detail_head row">
            <div class="col-md-9">
                <h2><?php echo htmlentities($result['CarModel']); ?></h2>
            </div>
             
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="main_features">
                    <ul>
                        <li>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <h5><?php echo htmlentities($result['Year']); ?></h5>
                            <p>Reg.Year</p>
                        </li>
                        <li>
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <h5><?php echo htmlentities($result['FuelType']); ?></h5>
                            <p>Fuel Type</p>
                        </li>
                        <li>
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            <h5><?php echo htmlentities($result['SeatingCapacity']); ?></h5>
                            <p>Seats</p>
                        </li>
                        <li>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <h5><?php echo htmlentities($result['DailyRate']); ?></h5>
                            <p>Price per Day</p>
                        </li>
                        <li>
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            <h5><?php echo $availabilityText; ?></h5>
                            <p>Availability</p> 
                        </li> <!-- Display Availability -->

                    </ul>
                </div>
                <div class="description">
                    <h5>Description</h5>
                    <p><?php echo htmlentities($result['AdminNotes']); ?></p>
                </div>
            </div>
            <!-- Book now Section -->
            <div class="col-md-3" id="bookNowSection">
                <form action="AdminDash/includes/BookForm.php" method="post">
                    <label for="fromDate">From:</label>
                    <input type="date" id="fromDate" name="fromDate" required>
                    <br>
                    <label for="toDate">To:</label>
                    <input type="date" id="toDate" name="toDate" required>
                    <br>
                    <input type="hidden" name="totalAmount" id="totalAmount" value="<?php echo  $totalAmount; ?>"> 

                    <input type="hidden" name="carID" id="carID" value="<?php echo htmlentities($result['CarID']); ?>">
                    <p>Total Amount: <span id="totalAmountDisplay"><?php echo $totalAmountDisplay; ?></span></p>
                    <button type="submit" class="btn btn-primary">Book Now></button>
                </form>
            </div>


        </div>
    </div>
</section>

 <!-- Place this script block before the closing </body> tag -->
 <script>
    // Function to calculate and update the total amount
    function updateTotalAmount() {
        // Get the car price from PHP (assuming it's echoed as a JavaScript variable)
        const carPrice = <?php echo floatval($result['DailyRate']); ?>;

        // Get the selected dates from the input fields
        const fromDateInput = document.getElementById("fromDate");
        const toDateInput = document.getElementById("toDate");
        const fromDate = new Date(fromDateInput.value);
        const toDate = new Date(toDateInput.value);

        // Calculate the number of days between the two dates
        const days = Math.ceil((toDate - fromDate) / (1000 * 60 * 60 * 24));

        // Calculate the total amount
        const totalAmount = carPrice * days;

        // Update the hidden input field
        const totalAmountInput = document.getElementById("totalAmount");
        totalAmountInput.value = totalAmount; // Update the value attribute

        // Update the total amount display
        const totalAmountDisplay = document.getElementById("totalAmountDisplay");
        totalAmountDisplay.textContent = totalAmount.toFixed(2) + " <?php echo $currency; ?>";
    }

    // Add event listeners to the date input fields
    const fromDateInput = document.getElementById("fromDate");
    const toDateInput = document.getElementById("toDate");

    fromDateInput.addEventListener("change", updateTotalAmount);
    toDateInput.addEventListener("change", updateTotalAmount);

    // Initially calculate and display the total amount (for the default dates, if any)
    updateTotalAmount();
</script>



 
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body> 
  



  <?php

    include 'includes/Footer.php'
  ?>
    <!-- Include Bootstrap JS -->

 


 
