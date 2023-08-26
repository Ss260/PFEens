<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['operation'] === 'ShowData') {
        require_once '../Controllers/AdminControllers/Vehicle.php'; // Include your Vehicle class file
        $vehicleObj = new Vehicle();
        $retrievedCarID = $_POST['CarID'];
        $vehicleData = $vehicleObj->getVehicleData($retrievedCarID); // Implement getVehicleData method
                
        if ($vehicleData) {
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
            include '../view/UpdateVehicle.php';

        }
                    //include '../view/UpdateVehicle.php';
                    //include '../includes/VehicleFormUpdate.php'; // Create a separate file for the form to keep the code clean
            } } 
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['operation'])) {
                require_once '../Controllers/AdminControllers/Vehicle.php'; // Include your Vehicle class file
                require_once '../Model/ConnectionController.php'; // Include your ConnectionController file
                
                $vehicleObj = new Vehicle();
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
                    
                    // Handle file uploads and update images if necessary
                    $imageURLs = array();
                    if (isset($_FILES['images']['name']) && !empty($_FILES['images']['name'][0])) {
                        $uploadDir = '../../AdminDash/img/'; // Specify the directory where images will be uploaded
                
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
                        // Now you have populated $imageURLs array with the URLs of the uploaded images
                        // You can pass this array to the updateImageURLs method to update the database
                        
                        $vehicleObj->updateImageURLs($carID, $imageURLs);
                    }
                    
                    // Call the updateVehicle method
                    try {
                        // Obtain the database connection
                        require_once 'AdminControllers/Vehicle.php';  // Include your Vehicle class file

                        $updateResult = $vehicleObj->updateVehicle( $carID, $carModel, $carType, $year, $color, $mileage, $licensePlate, $fuelType, $transmission, $seatingCapacity, $dailyRate, $availability, $location, $adminNotes, $legalDocuments, $imageURLs);

                        
                        if ($updateResult) { 
                            // Display success message or redirect to a success page
                            echo "Update successful!";
                        } else {
                            // Display error message or handle the error
                            echo "Error updating vehicle.";
                        }
                    } catch (Exception $e) {
                        // Handle exceptions or display error message
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
?>
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