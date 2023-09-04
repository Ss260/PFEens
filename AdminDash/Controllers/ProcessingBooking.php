<?php
 require_once '../Controllers/AdminControllers/Booking.php';
 require_once 'ClientControllers/client.php'; 
 require_once 'AdminControllers/Vehicle.php';
 
 

        
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone-number'];
    $pickupLocation = $_POST['pickup-location'];
    $returnLocation = $_POST['return-location'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $fullname = $firstName." ".$lastName;
    $carID = $_POST['carID'];


   

    // Create a Client instance and add the client
    $clientObj = new Client();
    $clientID = $clientObj->AddClient($firstName, $lastName, $email, $phoneNumber);
    
    if ($clientID) { 
    // Create a Booking instance and add the booking
    $bookingObj = new Booking();
    $bookingStatus = "Pending"; // Default status
    $carID = $_POST['carID'];
    $totalAmount = $_POST['totalAmount']; // The total amount calculated on the previous page
    $bookingID = $bookingObj->AddBooking($carID, $clientID, $fromDate, $toDate, $totalAmount, $bookingStatus, $pickupLocation, $returnLocation);
    //get Vehicles Carm Model for mail method :
    $VehObj= new vehicle();
    $VehData=$VehObj->getVehicleData($carID);
    $carModel = $VehData["CarModel"];
     if ($bookingID) {
             // Retrieve Booking ID to use in the email method:
 
        // Display success message
        $successMessage = "Booked successfully. We have sent you an Email with all the necessary information";
        // Debugging: Check the value of $successMessage
        echo '<script>console.log("Success Message: ' . $successMessage . '");</script>';
        
        $clientObj->sendBookingEmailConfirmation($email, $fullname, $bookingID, $carModel, $fromDate, $toDate, $totalAmount, $pickupLocation, $returnLocation);
        // Redirect back to the vehicle details page after a short delay
        echo '<script>
                setTimeout(function() {
                    window.location.href = "/C-rental/vehicleDetails.php?vhid=' . $carID . '"; // Use an absolute path
                }, 3000); // Redirect after 2 seconds (you can adjust this delay)
              </script>';

              //send email :
 
        
            
    } else {
        // Display error message or handle the error
        $errorMessage = "Error Booking Vehicle. Please try again.";
    }
} else {
    // Handle the case where client creation failed
    $errorMessage = "Error creating client. Please try again.";
}
}

?>
<!-- JavaScript to display pop-up messages -->
<script>
    function displaySuccessMessage(message) {
        console.log('Displaying success message: ' + message);
        alert(message); // You can customize this to show a more visually appealing pop-up
    }

    function displayErrorMessage(message) {
        alert(message); // You can customize this to show a more visually appealing pop-up
    }

    <?php if (!empty($successMessage)) : ?>
        displaySuccessMessage("<?php echo $successMessage; ?>");
    <?php endif; ?>
</script>
