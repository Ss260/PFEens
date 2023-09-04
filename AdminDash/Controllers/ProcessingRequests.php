<?php
require_once 'AdminControllers/Booking.php'; 
require_once 'AdminControllers/Vehicle.php';  
require_once 'ClientControllers/client.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['booking_id']) && isset($_POST['operation'])) {
        $bookingID = $_POST['booking_id'];
        $operation = $_POST['operation'];
        $clientID = $_POST['ClientID'];


    
        $carObj = new Vehicle();  
        $bookingObj = new Booking();  
        $clientObj = new client();
        $clientData = $clientObj->getClientData($clientID);
        //Client Data
        $email = $clientData['Email'];
        $FirstName = $clientData['FirstName'];
        $LastName = $clientData['LastName'];
        $fullName= $FirstName." ".$LastName;
        //get Booking Data :
        $BookingData = $bookingObj->getBookingInfo($bookingID);
        $pickupDateTime = $BookingData['PickupDateTime'];
        $returnDateTime = $BookingData['ReturnDateTime'];
        $totalAmount = $BookingData['TotalAmount'];
        $pickupLocation = $BookingData['PickupLocation'];
        $returnLocation =$BookingData['ReturnLocation'];
        if ($operation === 'Accept') {
            // Update car availability to 0
            $carID = $bookingObj->getCarID($bookingID);
            $carUpdated = $carObj->updateAvailability($carID, 0);
            //Getting Vehicle Data 
            $result = $carObj->getVehicleData($carID);
            $CarModel = $result["CarModel"];
           
            // Update booking status to "Reserved"
            $bookingStatusUpdated = $bookingObj->updateBookingStatus($bookingID, "Reserved");

            if ($carUpdated && $bookingStatusUpdated) {
                    $clientObj->sendBookingAcceptationEmail($email,$fullName,$bookingID,$CarModel,$pickupDateTime,$returnDateTime,$totalAmount,$pickupLocation,$returnLocation);
                echo '<script>alert("Booking accepted successfully!A mail was sent to the client");</script>';
            } else {
                // Handle the case where updates failed
                echo '<script>alert("Error accepting booking. Please try again.");</script>';
            }
        } elseif ($operation === 'Refuse') {
            // Update the booking status to "Refused"
            if ($bookingObj->updateBookingStatus($bookingID, 'Refused')) {
                $clientObj->sendBookingRefusalEmail($email,$fullName,$bookingID);

                echo '<script>alert("Booking Refused! A mail was sent to the client");</script>';
            } else {
                $errorMessage = "Error updating booking status to 'Refused'";
            }
        }
    }
    echo '<script>window.location.href = "../view/PendingRequests.php";</script>';
}
?>

<script>
    function displaySuccessMessage(message) {
        alert(message);
        redirectToPendingRequests();
    }

    function displayErrorMessage(message) {
        alert(message);
        redirectToPendingRequests();
    }

    function redirectToPendingRequests() {
        if (window.redirectUrl) {
            window.location.href = window.redirectUrl;
        }
    }

    <?php if (!empty($successMessage)) : ?>
        displaySuccessMessage("<?php echo $successMessage; ?>");
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
        displayErrorMessage("<?php echo $errorMessage; ?>");
    <?php endif; ?>
</script>
