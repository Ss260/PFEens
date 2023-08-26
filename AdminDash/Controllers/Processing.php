<?php

if (isset($_POST['operation'])) {
    
  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['operation'] === 'AddVehicle') {
        // Extract form data
        $carModel = $_POST['CarModel'];
        $carType = $_POST['CarType'];
        $year = $_POST['Year'];
        $color = $_POST['Color'];
        $mileage = $_POST['Mileage'];
        $fuelType = $_POST['FuelType'];
        $licensePlate = $_POST['LicensePlate'];
        $seatingCapacity = $_POST['SeatingCapacity'];
        $dailyRate = $_POST['DailyRate'];
        $location = $_POST['Location'];
        $adminNotes = $_POST['AdminNotes'];
        $legalDocuments = $_POST['LegalDocuments'];
        $transmission = $_POST['Transmission'];
        $availability = $_POST['Availability'];

        // Handle uploaded image
        $imageURLs = array();
        if(isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $uploadDirectory = '../img';  
            $imageCount = count($_FILES['images']['name']);
            for($i = 0; $i < $imageCount; $i++) {
                $imageName = $_FILES['images']['name'][$i];
                $imageTmpName = $_FILES['images']['tmp_name'][$i];
                $imagePath = $uploadDirectory . $imageName;
                move_uploaded_file($imageTmpName, $imagePath);
                $imageURLs[] = $imagePath;
            }
        }

        // Call the addVehicle method
        try {
            // Include or require the necessary files
            require_once 'AdminControllers/Vehicle.php';  // Include your Vehicle class file
            // Create an instance of the Vehicle class
            $vehicleObj = new Vehicle();
            
            // Call the addVehicle method
            $result = $vehicleObj->addVehicle($carModel, $carType, $year, $color, $mileage, $licensePlate, $fuelType, $transmission, $seatingCapacity, $dailyRate, $availability, $location, $adminNotes, $legalDocuments, $imageURLs);

            if ($result) {
                $successMessage = "Vehicle added successfully.";
            } else {
                $errorMessage = "Error adding vehicle. Please try again.";
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while adding the vehicle: " . $e->getMessage();
        }
    }elseif ($_POST['operation'] === 'DeleteVehicle') {
        // Extract the Car ID to be deleted
          // Extract the Car ID to be deleted
          $carID = $_POST['CarId'];

          // Include the necessary files
          require_once 'AdminControllers/Vehicle.php';
  
          // Create an instance of the Vehicle class
          $vehicleObj = new Vehicle();
  
          // Call the deleteVehicle method
          try {
              $result = $vehicleObj->deleteVehicle($carID);
  
              echo "Processing Result: " . ($result ? "Success" : "Failure"); // Debugging line
  
              if ($result) {
                  $successMessage = "Vehicle deleted successfully.";
              } else {
                  $errorMessage = "Error deleting vehicle. Please check the Car ID and try again.";
              }
          } catch (Exception $e) {
              $errorMessage = "An error occurred while deleting the vehicle: " . $e->getMessage();
          }
      }

                
}
 

}
?>

<!-- JavaScript to display pop-up messages -->
<script>
    function displaySuccessMessage(message) {
        alert(message); // You can customize this to show a more visually appealing pop-up
    }

    function displayErrorMessage(message) {
        alert(message); // You can customize this to show a more visually appealing pop-up
    }

    <?php if (!empty($successMessage)) : ?>
        displaySuccessMessage("<?php echo $successMessage; ?>");
    <?php endif; ?>

    // Display a pop-up error message
    <?php if (!empty($errorMessage)) : ?>
        displayErrorMessage("<?php echo $errorMessage; ?>");
    <?php endif; ?>
</script>
