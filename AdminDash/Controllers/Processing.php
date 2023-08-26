<?php
require_once '../Controllers/AdminControllers/Vehicle.php';
require_once '../Model/ConnectionController.php';
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
        $availability = (int)$_POST['Availability'];

        // Handle uploaded image
        $imageURLs = array();
        if(isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $uploadDirectory = '../Controllers/CarImg/';
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
      }elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['operation'])) {
        $vehicleObj = new Vehicle();
    
        if ($_POST['operation'] === 'ShowData') {
            $retrievedCarID = $_POST['CarID'];
            $vehicleData = $vehicleObj->getVehicleData($retrievedCarID);
    
            if (!$vehicleData) {
                // Keep the form inputs empty
                $carModel = $carType = $year = $color = $mileage = $fuelType = $licensePlate = $seatingCapacity = $dailyRate = $location = $adminNotes = $legalDocuments = $transmission = $availability = '';
            } else {
                $carModel = $vehicleData['CarModel'];
                $carType = $vehicleData['CarType'];
                $year = $vehicleData['Year'];
                $color = $vehicleData['Color'];
                $mileage = $vehicleData['Mileage'];
                $fuelType = $vehicleData['FuelType'];
                $licensePlate = $vehicleData['LicensePlate'];
                $seatingCapacity = $vehicleData['SeatingCapacity'];
                $dailyRate = $vehicleData['DailyRate'];
                $location = $vehicleData['Location'];
                $adminNotes = $vehicleData['AdminNotes'];
                $legalDocuments = $vehicleData['LegalDocuments'];
                $transmission = $vehicleData['Transmission'];
                $availability = (int)$vehicleData['Availability'];
            }
            include '../view/UpdateVehicle.php';
        }
    
        if ($_POST['operation'] === 'UpdVehicle') {
            // Retrieve form data
            $carID = $_POST['CarID'];
            $carModel = $_POST['CarModel'];
            $carType = $_POST['CarType'];
            $year = (int)$_POST['Year'];
            $color = $_POST['Color'];
            $mileage = (int)$_POST['Mileage'];
            $fuelType = $_POST['FuelType'];
            $licensePlate = $_POST['LicensePlate'];
            $transmission = $_POST['Transmission'];
            $seatingCapacity = $_POST['SeatingCapacity'];
            $dailyRate = (float)$_POST['DailyRate'];
            $location = $_POST['Location'];
            $adminNotes = $_POST['AdminNotes'];
            $legalDocuments = $_POST['LegalDocuments'];
            $availability = (int)$_POST['Availability'];
    
            $imageURLs = array();
            if (isset($_FILES['images']['name']) && !empty($_FILES['images']['name'][0])) {
                $uploadDir = '../Controllers/CarImg/'; // Specify the directory where images will be uploaded
                
                // Loop through each uploaded image
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                    $imageName = $_FILES['images']['name'][$i];
                    $imageTmpName = $_FILES['images']['tmp_name'][$i];
                    $imageType = $_FILES['images']['type'][$i];
                    
                    // Generate a unique filename for the image
                    $uniqueFilename = uniqid() . '_' . $imageName;
                    
                    // Construct the full path to the destination file
                    $destination = $uploadDir . $uniqueFilename;
                    
                    // Check if the uploaded file is an image
                    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
                    if (in_array($imageType, $allowedTypes)) {
                        // Move the uploaded file to the destination directory
                        if (move_uploaded_file($imageTmpName, $destination)) {
                            // Store the image URL in the array
                            $imageURLs[] = $uniqueFilename;
                        } else {
                            echo "Error uploading image $imageName. Please try again.";
                        }
                    } else {
                        echo "Unsupported file type for image $imageName.";
                    }
                }
            }
    
            // Call the updateVehicle method
            try {
                require_once 'AdminControllers/Vehicle.php';  // Include your Vehicle class file

                $updateResult = $vehicleObj->updateVehicle($carID, $carModel, $carType, $year, $color, $mileage, $licensePlate, $fuelType, $transmission, $seatingCapacity, $dailyRate, $availability, $location, $adminNotes, $legalDocuments, $imageURLs,);
    
                if ($updateResult) {
                    $successMessage = "Vehicle Updated successfully.";     
                   } else {
                    $errorMessage = "Error Updating vehicle. Please try again.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
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
